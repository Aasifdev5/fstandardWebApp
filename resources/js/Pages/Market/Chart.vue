<script setup>
import { ref, computed, onMounted, onUnmounted, watch, nextTick } from 'vue'
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
const changePercent = ref(0)
const optionChain = ref([])
const expiryDate = ref(props.expiry)
const chartContainer = ref(null)
const loading = ref(true)
const selectedTimeframe = ref('1m')
const chartInitialized = ref(false)

// Order Form State
const showOrderModal = ref(false)
const isSubmitting = ref(false)
const orderForm = ref({
    side: 'BUY',
    quantity: 1,
    price: 0,
    type: 'MARKET',
    product: 'MIS' // Intraday
})

let chart = null
let candleSeries = null
let volumeSeries = null
let echo = null
let channel = null
let lastCandleEndTime = 0
let resizeObserver = null

const timeframes = [
    { value: '1m', label: '1m' },
    { value: '5m', label: '5m' },
    { value: '15m', label: '15m' },
    { value: '1h', label: '1h' },
    { value: '1D', label: '1D' }
]

/* ---------------- INITIALIZATION ---------------- */

onMounted(async () => {
    if (props.symbol) await loadInitialData(props.symbol)
})

watch([loading, chartContainer], async ([newLoading, newContainer]) => {
    if (!newLoading && newContainer && !chartInitialized.value) {
        await nextTick()
        initChart()
    }
})

watch(selectedTimeframe, async () => {
    if (props.symbol && candleSeries) await loadCandles(props.symbol)
})

watch(() => props.symbol, async (newSymbol) => {
    if (!newSymbol) return
    await loadInitialData(newSymbol)
})

/* ---------------- CORE LOGIC ---------------- */

async function loadInitialData(symbol) {
    loading.value = true
    chartInitialized.value = false
    try {
        const { data } = await axios.get(`/api/instruments/${symbol}`)
        instrument.value = data
        lastPrice.value = Number(data.underlying_state?.last_price ?? data.base_price ?? 0)

        loading.value = false
        initSocket(symbol)
        await loadOptionChain()
    } catch (e) {
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

        chart.timeScale().fitContent()
        lastCandleEndTime = unique.at(-1)?.time || 0
    } catch (e) { console.error('Candle Error:', e) }
}

function initChart() {
    chart = createChart(chartContainer.value, {
        layout: { background: { color: '#131722' }, textColor: '#d1d4dc' },
        grid: { vertLines: { color: '#2a2e39' }, horzLines: { color: '#2a2e39' } },
        crosshair: { mode: CrosshairMode.Normal },
        timeScale: { borderColor: '#2a2e39', timeVisible: true },
        rightPriceScale: { borderColor: '#2a2e39' }
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
    loadCandles(props.symbol)
}

/* ---------------- TRADING LOGIC ---------------- */

function openOrderEntry(side) {
    orderForm.value.side = side
    orderForm.value.price = lastPrice.value
    orderForm.value.quantity = instrument.value?.lot_size || 1
    showOrderModal.value = true
}

async function submitOrder() {
    isSubmitting.value = true
    try {
        const payload = {
            symbol: props.symbol,
            side: orderForm.value.side,
            quantity: orderForm.value.quantity,
            price: orderForm.value.type === 'MARKET' ? null : orderForm.value.price,
            type: orderForm.value.type,
            product: orderForm.value.product
        }
        await axios.post('/api/orders/place', payload)
        alert('Order Success')
        showOrderModal.value = false
    } catch (e) {
        alert(e.response?.data?.message || 'Order Failed')
    } finally {
        isSubmitting.value = false
    }
}

/* ---------------- HELPERS & SOCKET ---------------- */

function initSocket(symbol) {
    if (echo) echo.leave(channel)
    echo = initEcho()
    channel = symbol.includes('-F-') ? `market.futures.${symbol}` : `market.underlying.${symbol}`
    echo.channel(channel).listen('TickUpdated', e => {
        const price = Number(e.price)
        priceChange.value = price - lastPrice.value
        lastPrice.value = price
        if (candleSeries) candleSeries.update({ time: Math.floor(Date.now()/1000/60)*60, close: price })
    })
}

async function loadOptionChain() {
    if (!showOptionChain.value) return
    const { data } = await axios.get(`/api/instruments/${props.symbol}/option-chain`, {
        params: { expiry_date: expiryDate.value }
    })
    optionChain.value = Object.values(data).sort((a, b) => a.strike - b.strike)
}

const showOptionChain = computed(() => ['index', 'stock'].includes(instrument.value?.category))
onUnmounted(() => { if (chart) chart.remove(); if (resizeObserver) resizeObserver.disconnect() })
</script>

<template>
  <div class="flex flex-col h-screen bg-[#0b0e14] text-[#d1d4dc] overflow-hidden">
    <header class="h-14 border-b border-[#2a2e39] flex items-center justify-between px-6 shrink-0 bg-[#131722]">
      <div class="flex items-center space-x-4">
        <h1 class="text-lg font-bold text-white">{{ symbol }}</h1>
        <div class="h-6 w-[1px] bg-[#2a2e39]"></div>
        <div class="flex space-x-1">
          <button v-for="tf in timeframes" :key="tf.value" @click="selectedTimeframe = tf.value"
            :class="selectedTimeframe === tf.value ? 'bg-[#2962ff] text-white font-bold' : 'hover:bg-[#2a2e39] text-gray-400'"
            class="px-2.5 py-1 text-xs rounded transition uppercase">
            {{ tf.label }}
          </button>
        </div>
      </div>

      <div class="flex items-center space-x-6">
        <div class="text-right">
            <div :class="priceChange >= 0 ? 'text-[#089981]' : 'text-[#f23645]'" class="text-lg font-mono font-bold leading-none">
                {{ lastPrice.toFixed(2) }}
            </div>
        </div>
        <div class="flex space-x-2">
            <button @click="openOrderEntry('BUY')" class="bg-[#089981] hover:bg-[#067d69] text-white px-5 py-1.5 rounded text-xs font-bold transition shadow-lg">BUY</button>
            <button @click="openOrderEntry('SELL')" class="bg-[#f23645] hover:bg-[#d02e3c] text-white px-5 py-1.5 rounded text-xs font-bold transition shadow-lg">SELL</button>
        </div>
      </div>
    </header>

    <main class="flex-1 flex flex-col overflow-hidden">
      <div class="h-[65%] relative bg-[#131722]">
        <div v-if="loading" class="absolute inset-0 flex items-center justify-center bg-[#131722] z-50">
          <div class="animate-spin h-8 w-8 border-2 border-blue-500 border-t-transparent rounded-full"></div>
        </div>
        <div ref="chartContainer" class="w-full h-full"></div>
      </div>

      <div v-if="showOptionChain" class="h-[35%] flex flex-col border-t border-[#2a2e39] bg-[#131722]">
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
    </main>

    <div v-if="showOrderModal" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/70 backdrop-blur-sm">
      <div class="bg-[#1e222d] w-full max-w-sm rounded-lg border border-[#363a45] shadow-2xl">
        <div :class="orderForm.side === 'BUY' ? 'bg-[#089981]' : 'bg-[#f23645]'" class="p-3 rounded-t-lg flex justify-between">
          <span class="font-bold text-white uppercase">{{ orderForm.side }} Order</span>
          <button @click="showOrderModal = false">✕</button>
        </div>
        <div class="p-5 space-y-4">
          <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="text-[10px] text-gray-500 block mb-1">QTY</label>
                <input v-model="orderForm.quantity" type="number" class="w-full bg-[#131722] border border-[#2a2e39] rounded p-2 text-sm outline-none">
            </div>
            <div>
                <label class="text-[10px] text-gray-500 block mb-1">PRICE</label>
                <input v-model="orderForm.price" :disabled="orderForm.type === 'MARKET'" type="number" step="0.05" class="w-full bg-[#131722] border border-[#2a2e39] rounded p-2 text-sm outline-none disabled:opacity-30">
            </div>
          </div>
          <div class="flex space-x-4">
            <label class="flex items-center text-xs space-x-2"><input v-model="orderForm.type" type="radio" value="MARKET"> <span>Market</span></label>
            <label class="flex items-center text-xs space-x-2"><input v-model="orderForm.type" type="radio" value="LIMIT"> <span>Limit</span></label>
          </div>
          <button @click="submitOrder" :disabled="isSubmitting" :class="orderForm.side === 'BUY' ? 'bg-[#089981]' : 'bg-[#f23645]'" class="w-full py-3 rounded font-bold text-white transition">
            {{ isSubmitting ? 'SENDING...' : 'PLACE ORDER' }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.custom-scrollbar::-webkit-scrollbar { width: 4px; }
.custom-scrollbar::-webkit-scrollbar-thumb { background: #363a45; border-radius: 10px; }
</style>
