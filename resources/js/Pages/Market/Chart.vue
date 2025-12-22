<script setup>
import { ref, computed, onMounted, onUnmounted, watch } from 'vue'
import axios from 'axios'
import { createChart, CrosshairMode } from 'lightweight-charts'
import { init as initEcho } from '@/echo.js'

const props = defineProps({
    symbol: String,
    expiry: String,
})

/* ---------------- STATE ---------------- */
const instrument = ref(null)
const lastPrice = ref(0)
const priceChange = ref(0)
const optionChain = ref([])
const expiryDate = ref(props.expiry)
const chartContainer = ref(null)
const loading = ref(true)
const selectedTimeframe = ref('1m')
const chartInitialized = ref(false)

const showOrderModal = ref(false)
const isSubmitting = ref(false)
const orderForm = ref({
    side: 'BUY',
    quantity: 1,
    price: 0,
    type: 'MARKET',
    product: 'MIS'
})

// Non-reactive variables for performance
let chart = null
let candleSeries = null
let volumeSeries = null
let echo = null
let channelName = null
let resizeObserver = null
let currentCandle = { time: 0, open: 0, high: 0, low: 0, close: 0 }

const timeframes = [
    { value: '1m', label: '1m', seconds: 60 },
    { value: '5m', label: '5m', seconds: 300 },
    { value: '15m', label: '15m', seconds: 900 },
    { value: '1h', label: '1h', seconds: 3600 },
    { value: '1D', label: '1D', seconds: 86400 }
]

/* ---------------- CORE LOGIC ---------------- */

async function resetAndLoad(newSymbol) {
    if (!newSymbol) return
    loading.value = true

    if (echo && channelName) echo.leave(channelName)
    if (candleSeries) candleSeries.setData([])
    if (volumeSeries) volumeSeries.setData([])

    try {
        const { data } = await axios.get(`/api/instruments/${newSymbol}`)
        instrument.value = data
        lastPrice.value = Number(data.underlying_state?.last_price ?? data.base_price ?? 0)

        await loadCandles(newSymbol)
        await loadOptionChain()
        loading.value = false
    } catch (e) {
        console.error('Switch Instrument Error:', e)
        loading.value = false
    }
}

async function loadCandles(symbol) {
    if (!candleSeries) return
    try {
        const { data } = await axios.get(`/api/instruments/${symbol}/candles`, {
            params: { timeframe: selectedTimeframe.value, limit: 500 }
        })

        const formatted = data.map(c => ({
            time: Math.floor(new Date(c.timestamp).getTime() / 1000),
            open: parseFloat(c.open),
            high: parseFloat(c.high),
            low: parseFloat(c.low),
            close: parseFloat(c.close),
            volume: parseFloat(c.volume || 0)
        })).sort((a, b) => a.time - b.time)

        const unique = formatted.filter((v, i, a) => i === a.findIndex(t => t.time === v.time))

        candleSeries.setData(unique)
        volumeSeries.setData(unique.map(c => ({
            time: c.time,
            value: c.volume,
            color: c.close >= c.open ? 'rgba(8, 153, 129, 0.3)' : 'rgba(242, 54, 69, 0.3)'
        })))

        if (unique.length > 0) {
            currentCandle = { ...unique[unique.length - 1] }
        }

        chart.timeScale().fitContent()
        initSocket(symbol)
    } catch (e) {
        console.error('Candle Load Error:', e)
    }
}

function initChart() {
    if (chart) return

    chart = createChart(chartContainer.value, {
        layout: { background: { color: '#131722' }, textColor: '#d1d4dc' },
        grid: { vertLines: { color: '#2a2e39' }, horzLines: { color: '#2a2e39' } },
        crosshair: { mode: CrosshairMode.Normal },
        timeScale: { borderColor: '#2a2e39', timeVisible: true, secondsVisible: false },
        rightPriceScale: { borderColor: '#2a2e39', autoScale: true }
    })

    candleSeries = chart.addCandlestickSeries({
        upColor: '#089981', downColor: '#f23645',
        borderVisible: false, wickUpColor: '#089981', wickDownColor: '#f23645'
    })

    volumeSeries = chart.addHistogramSeries({
        color: '#26a69a', priceFormat: { type: 'volume' }, priceScaleId: ''
    })

    chart.priceScale('').applyOptions({ scaleMargins: { top: 0.8, bottom: 0 } })

    resizeObserver = new ResizeObserver(() => {
        if (chart && chartContainer.value) {
            chart.applyOptions({ width: chartContainer.value.clientWidth, height: chartContainer.value.clientHeight })
        }
    })
    resizeObserver.observe(chartContainer.value)
    chartInitialized.value = true

    if (props.symbol) resetAndLoad(props.symbol)
}

/**
 * UPDATED SOCKET LOGIC
 * Correctly detects channel type and listens for namespaced event
 */
function initSocket(symbol) {
    if (echo && channelName) echo.leave(channelName)

    echo = initEcho()

    // Determine exact channel name
    if (symbol.includes('-F-')) {
        channelName = `market.futures.${symbol}`
    } else if (symbol.includes('-C-') || symbol.includes('-P-')) {
        channelName = `market.options.${symbol}`
    } else {
        channelName = `market.underlying.${symbol}`
    }

    // listen('.TickUpdated') uses the dot to match the broadcastAs() alias from PHP
    echo.channel(channelName).listen('.TickUpdated', e => {
        const price = Number(e.price)
        // Convert ISO timestamp from backend to Unix seconds for the chart
        const timestamp = e.timestamp ? Math.floor(new Date(e.timestamp).getTime() / 1000) : Math.floor(Date.now() / 1000)

        const tf = timeframes.find(t => t.value === selectedTimeframe.value)
        const bucketSize = tf ? tf.seconds : 60
        const candleTime = Math.floor(timestamp / bucketSize) * bucketSize

        priceChange.value = price - lastPrice.value
        lastPrice.value = price

        if (candleSeries && !loading.value) {
            if (candleTime > currentCandle.time) {
                // Start a new candle
                currentCandle = { time: candleTime, open: price, high: price, low: price, close: price }
            } else {
                // Update the current candle
                currentCandle.close = price
                if (price > currentCandle.high) currentCandle.high = price
                if (price < currentCandle.low) currentCandle.low = price
            }
            candleSeries.update(currentCandle)
        }
    })
}

/* ---------------- WATCHERS ---------------- */

watch(() => props.symbol, (newVal) => {
    resetAndLoad(newVal)
})

watch(selectedTimeframe, () => {
    if (props.symbol) loadCandles(props.symbol)
})

onMounted(() => {
    initChart()
})

onUnmounted(() => {
    if (chart) {
        chart.remove()
        chart = null
    }
    if (resizeObserver) resizeObserver.disconnect()
    if (echo && channelName) echo.leave(channelName)
})

/* ---------------- API ACTIONS ---------------- */

async function loadOptionChain() {
    if (!showOptionChain.value) return
    try {
        const { data } = await axios.get(`/api/instruments/${props.symbol}/option-chain`, {
            params: { expiry_date: expiryDate.value }
        })
        optionChain.value = Object.values(data).sort((a, b) => a.strike - b.strike)
    } catch (e) { console.error('Option Chain Error:', e) }
}

const showOptionChain = computed(() => ['index', 'stock'].includes(instrument.value?.category))

function openOrderEntry(side) {
    orderForm.value.side = side
    orderForm.value.price = lastPrice.value
    orderForm.value.quantity = instrument.value?.lot_size || 1
    showOrderModal.value = true
}

async function submitOrder() {
    isSubmitting.value = true
    try {
        await axios.post('/api/orders/place', {
            symbol: props.symbol,
            side: orderForm.value.side,
            quantity: orderForm.value.quantity,
            price: orderForm.value.type === 'MARKET' ? null : orderForm.value.price,
            type: orderForm.value.type,
            product: orderForm.value.product
        })
        alert('Order Placed Successfully')
        showOrderModal.value = false
    } catch (e) {
        alert(e.response?.data?.message || 'Order Failed')
    } finally { isSubmitting.value = false }
}
</script>

<template>
  <div class="flex flex-col h-full bg-[#0b0e14] text-[#d1d4dc] overflow-hidden font-sans">
    <header class="h-14 border-b border-[#2a2e39] flex items-center justify-between px-6 shrink-0 bg-[#131722]">
      <div class="flex items-center space-x-4">
        <h1 class="text-lg font-bold text-white tracking-tight">{{ symbol }}</h1>
        <div class="h-6 w-[1px] bg-[#2a2e39]"></div>
        <div class="flex space-x-1">
          <button v-for="tf in timeframes" :key="tf.value" @click="selectedTimeframe = tf.value"
            :class="selectedTimeframe === tf.value ? 'bg-[#2962ff] text-white font-bold' : 'hover:bg-[#2a2e39] text-gray-400'"
            class="px-2.5 py-1 text-[11px] rounded transition uppercase">
            {{ tf.label }}
          </button>
        </div>
      </div>

      <div class="flex items-center space-x-6">
        <div class="text-right">
            <div :class="priceChange >= 0 ? 'text-[#089981]' : 'text-[#f23645]'"
                 class="text-xl font-mono font-bold leading-none transition-colors duration-200">
                {{ lastPrice.toFixed(2) }}
            </div>
        </div>
        <div class="flex space-x-2">
            <button @click="openOrderEntry('BUY')" class="bg-[#089981] hover:bg-[#067d69] text-white px-5 py-1.5 rounded text-xs font-bold transition shadow-lg active:scale-95">BUY</button>
            <button @click="openOrderEntry('SELL')" class="bg-[#f23645] hover:bg-[#d02e3c] text-white px-5 py-1.5 rounded text-xs font-bold transition shadow-lg active:scale-95">SELL</button>
        </div>
      </div>
    </header>

    <div class="flex-1 relative bg-[#131722] min-h-0">
        <div v-if="loading" class="absolute inset-0 flex items-center justify-center bg-[#131722] z-50">
          <div class="animate-spin h-8 w-8 border-2 border-blue-500 border-t-transparent rounded-full"></div>
        </div>
        <div ref="chartContainer" class="w-full h-full"></div>
    </div>

    <div v-if="showOptionChain" class="h-1/3 flex flex-col border-t border-[#2a2e39] bg-[#131722]">
        <div class="px-4 py-2 bg-[#1c202b] flex justify-between items-center shrink-0 border-b border-[#2a2e39]">
          <span class="text-[10px] font-bold uppercase tracking-widest text-gray-500">Live Option Chain</span>
          <span class="text-[10px] text-blue-400 font-mono">{{ expiryDate }}</span>
        </div>
        <div class="flex-1 overflow-auto custom-scrollbar">
          <table class="w-full text-xs text-center border-collapse">
            <thead class="sticky top-0 bg-[#131722] z-20">
              <tr class="text-gray-500 border-b border-[#2a2e39]">
                <th class="py-2 font-medium">CALLS LTP</th>
                <th class="py-2 font-medium bg-[#1c202b]/50">STRIKE</th>
                <th class="py-2 font-medium">PUTS LTP</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="row in optionChain" :key="row.strike" class="border-b border-[#2a2e39]/30 hover:bg-[#2a2e39]/20 transition">
                <td class="py-2.5 text-[#089981] font-mono">{{ row.call?.optionsState?.last_price || '-' }}</td>
                <td class="py-2.5 font-bold bg-[#1c202b]/30 text-gray-400">{{ row.strike }}</td>
                <td class="py-2.5 text-[#f23645] font-mono">{{ row.put?.optionsState?.last_price || '-' }}</td>
              </tr>
            </tbody>
          </table>
        </div>
    </div>

    <div v-if="showOrderModal" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/70 backdrop-blur-sm p-4">
      <div class="bg-[#1e222d] w-full max-w-sm rounded-lg border border-[#363a45] shadow-2xl overflow-hidden">
        <div :class="orderForm.side === 'BUY' ? 'bg-[#089981]' : 'bg-[#f23645]'" class="p-4 flex justify-between items-center">
          <span class="font-bold text-white uppercase tracking-tight">{{ orderForm.side }} {{ symbol }}</span>
          <button @click="showOrderModal = false" class="text-white hover:opacity-50 transition text-lg">✕</button>
        </div>
        <div class="p-6 space-y-4">
          <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="text-[10px] text-gray-500 block mb-1 uppercase font-bold">Qty</label>
                <input v-model="orderForm.quantity" type="number" class="w-full bg-[#131722] border border-[#2a2e39] rounded p-2 text-sm outline-none focus:border-blue-500 transition text-white">
            </div>
            <div>
                <label class="text-[10px] text-gray-500 block mb-1 uppercase font-bold">Price</label>
                <input v-model="orderForm.price" :disabled="orderForm.type === 'MARKET'" type="number" step="0.05" class="w-full bg-[#131722] border border-[#2a2e39] rounded p-2 text-sm outline-none disabled:opacity-30 transition text-white">
            </div>
          </div>
          <div class="flex space-x-6 py-2">
            <label class="flex items-center text-xs space-x-2 cursor-pointer text-gray-300">
              <input v-model="orderForm.type" type="radio" value="MARKET" class="accent-blue-500">
              <span>Market</span>
            </label>
            <label class="flex items-center text-xs space-x-2 cursor-pointer text-gray-300">
              <input v-model="orderForm.type" type="radio" value="LIMIT" class="accent-blue-500">
              <span>Limit</span>
            </label>
          </div>
          <button @click="submitOrder" :disabled="isSubmitting"
                  :class="orderForm.side === 'BUY' ? 'bg-[#089981] hover:bg-[#067d69]' : 'bg-[#f23645] hover:bg-[#d02e3c]'"
                  class="w-full py-3 rounded font-bold text-white transition-all transform active:scale-95 disabled:opacity-50">
            {{ isSubmitting ? 'PROCESSING...' : 'PLACE ORDER' }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.custom-scrollbar::-webkit-scrollbar { width: 4px; }
.custom-scrollbar::-webkit-scrollbar-thumb { background: #363a45; border-radius: 10px; }
input::-webkit-outer-spin-button, input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
</style>
