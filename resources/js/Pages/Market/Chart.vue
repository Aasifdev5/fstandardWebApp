<script setup>
import { ref, computed, onMounted, onUnmounted, watch, nextTick } from 'vue'
import axios from 'axios'
import { createChart, CrosshairMode } from 'lightweight-charts'
import { init as initEcho } from '@/echo.js'

const props = defineProps({
    symbol: String,
    expiry: String,
})

/* ---------------- STATE: CHART & DATA ---------------- */
const instrument = ref(null)
const lastPrice = ref(0)
const priceChange = ref(0)
const optionChain = ref([])
const expiryDate = ref(props.expiry)
const chartContainer = ref(null)
const loading = ref(true)
const selectedTimeframe = ref('1m')
const chartInitialized = ref(false)

/* ---------------- STATE: ORDER MODAL ---------------- */
const showOrderModal = ref(false)
const isSubmitting = ref(false)

// Angel One style structure
const orderForm = ref({
    side: 'BUY',
    product: 'MIS',     // MIS (Intraday) or CNC (Delivery)
    type: 'LIMIT',      // LIMIT, MARKET, SL-LIMIT, SL-MARKET
    quantity: 1,
    price: 0,
    trigger_price: 0,   // For SL orders
    symbol_display: '', // To show on modal header (e.g. "NIFTY 24000 CE")

    // Smart Order / Robo Fields
    is_robo: false,     // Toggle for Target/SL
    stop_loss: 0,       // Absolute price
    target: 0,
})

// Non-reactive variables
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

/* ---------------- COMPUTED PROPERTIES ---------------- */
const showOptionChain = computed(() => ['index', 'stock'].includes(instrument.value?.category))
const isMarket = computed(() => ['MARKET', 'SL-MARKET'].includes(orderForm.value.type))
const isSL = computed(() => ['SL-LIMIT', 'SL-MARKET'].includes(orderForm.value.type))

const estimatedMargin = computed(() => {
    const price = isMarket.value ? (lastPrice.value) : (orderForm.value.price || 0)
    return (price * (orderForm.value.quantity || 0)).toFixed(2)
})

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

function initSocket(symbol) {
    if (echo && channelName) echo.leave(channelName)

    echo = initEcho()

    if (symbol.includes('-F-')) {
        channelName = `market.futures.${symbol}`
    } else if (symbol.includes('-C-') || symbol.includes('-P-')) {
        channelName = `market.options.${symbol}`
    } else {
        channelName = `market.underlying.${symbol}`
    }

    echo.channel(channelName).listen('.TickUpdated', e => {
        const price = Number(e.price)
        const timestamp = e.timestamp ? Math.floor(new Date(e.timestamp).getTime() / 1000) : Math.floor(Date.now() / 1000)

        const tf = timeframes.find(t => t.value === selectedTimeframe.value)
        const bucketSize = tf ? tf.seconds : 60
        const candleTime = Math.floor(timestamp / bucketSize) * bucketSize

        priceChange.value = price - lastPrice.value
        lastPrice.value = price

        if (candleSeries && !loading.value) {
            if (candleTime > currentCandle.time) {
                currentCandle = { time: candleTime, open: price, high: price, low: price, close: price }
            } else {
                currentCandle.close = price
                if (price > currentCandle.high) currentCandle.high = price
                if (price < currentCandle.low) currentCandle.low = price
            }
            candleSeries.update(currentCandle)
        }
    })
}

/* ---------------- WATCHERS & LIFECYCLE ---------------- */

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

/* ---------------- API ACTIONS: OPTION CHAIN ---------------- */

async function loadOptionChain() {
    if (!showOptionChain.value) return
    try {
        const { data } = await axios.get(`/api/instruments/${props.symbol}/option-chain`, {
            params: { expiry_date: expiryDate.value }
        })
        optionChain.value = Object.values(data).sort((a, b) => a.strike - b.strike)

        // Scroll to ATM after load
        scrollToATM()
    } catch (e) { console.error('Option Chain Error:', e) }
}

function scrollToATM() {
    nextTick(() => {
        const row = document.getElementById('atm-row')
        if (row) row.scrollIntoView({ block: 'center', behavior: 'smooth' })
    })
}

// Helpers for Angel One style shading (ITM vs OTM)
// Call ITM: Strike < Spot (Usually shaded)
// Put ITM: Strike > Spot (Usually shaded)
const isCallITM = (strike) => strike < lastPrice.value
const isPutITM = (strike) => strike > lastPrice.value

/* ---------------- API ACTIONS: ORDER PLACEMENT ---------------- */

// Updated to handle both Main Symbol and Option Chain clicks
function openOrderEntry(side, type = 'Main', optionData = null) {
    orderForm.value.side = side

    if (type === 'Option' && optionData) {
        // From Option Chain
        const price = Number(optionData.last_price || 0)
        orderForm.value.price = price
        orderForm.value.trigger_price = price
        orderForm.value.symbol_display = `${props.symbol} ${optionData.strike} ${optionData.type}`
        orderForm.value.quantity = instrument.value?.lot_size || 1
    } else {
        // From Main Header
        orderForm.value.price = lastPrice.value
        orderForm.value.trigger_price = lastPrice.value
        orderForm.value.symbol_display = props.symbol
        orderForm.value.quantity = instrument.value?.lot_size || 1
    }

    orderForm.value.type = 'LIMIT'
    orderForm.value.is_robo = false
    orderForm.value.product = 'MIS'
    showOrderModal.value = true
}

async function submitOrder() {
    isSubmitting.value = true
    try {
        const payload = {
            symbol: props.symbol, // Backend should handle symbol mapping based on context or add specific option symbol if needed
            side: orderForm.value.side,
            quantity: orderForm.value.quantity,
            product: orderForm.value.product,
            type: orderForm.value.type,
            price: isMarket.value ? 0 : orderForm.value.price,
            trigger_price: isSL.value ? orderForm.value.trigger_price : null,
            is_robo: orderForm.value.is_robo,
            stop_loss: orderForm.value.is_robo ? orderForm.value.stop_loss : null,
            target: orderForm.value.is_robo ? orderForm.value.target : null,
        }

        await axios.post('/api/orders/place', payload)
        alert('Order Placed Successfully')
        showOrderModal.value = false
    } catch (e) {
        alert(e.response?.data?.message || 'Order Failed')
    } finally {
        isSubmitting.value = false
    }
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

    <div v-if="showOptionChain" class="h-2/5 flex flex-col border-t border-[#2a2e39] bg-[#1e222d]">
        <div class="px-4 py-2 bg-[#2a2e39] flex justify-between items-center shrink-0 border-b border-[#363a45]">
          <div class="flex items-center gap-2">
              <span class="text-[10px] font-bold uppercase tracking-widest text-white">Option Chain</span>
              <span class="text-[10px] bg-blue-600/20 text-blue-400 px-1.5 py-0.5 rounded font-mono">{{ expiryDate }}</span>
          </div>
          <div class="text-[10px] text-gray-400">Spot: <span class="text-white font-bold">{{ lastPrice.toFixed(2) }}</span></div>
        </div>

        <div class="grid grid-cols-3 bg-[#131722] border-b border-[#2a2e39] text-[10px] text-gray-500 font-bold uppercase tracking-wide">
            <div class="py-2 text-center border-r border-[#2a2e39]">CALLS (LTP)</div>
            <div class="py-2 text-center border-r border-[#2a2e39]">STRIKE</div>
            <div class="py-2 text-center">PUTS (LTP)</div>
        </div>

        <div class="flex-1 overflow-y-auto custom-scrollbar relative">
          <div v-for="(row, index) in optionChain" :key="row.strike" class="grid grid-cols-3 text-xs border-b border-[#2a2e39]/50 group h-9">

            <div v-if="index > 0 && row.strike > lastPrice && optionChain[index-1].strike <= lastPrice"
                 id="atm-row"
                 class="col-span-3 bg-[#ffb700]/10 border-y border-[#ffb700]/30 flex items-center justify-center h-6 my-0.5">
                 <span class="text-[10px] text-[#ffb700] font-bold tracking-widest uppercase px-2 bg-[#1e222d] border border-[#ffb700]/30 rounded-full">Spot {{ lastPrice.toFixed(2) }}</span>
            </div>

            <div :class="isCallITM(row.strike) ? 'bg-[#1e222d] bg-gradient-to-r from-transparent to-[#2a2e39]/20' : 'bg-[#0b0e14]'"
                 class="flex items-center justify-center border-r border-[#2a2e39] relative cursor-pointer hover:bg-[#2a2e39] transition"
                 @click="openOrderEntry('BUY', 'Option', { ...row.call, strike: row.strike, type: 'CE' })">
                <span class="font-mono" :class="row.call?.optionsState?.last_price ? 'text-white' : 'text-gray-600'">
                    {{ row.call?.optionsState?.last_price || '-' }}
                </span>
                <div class="hidden group-hover:flex absolute inset-0 bg-black/60 items-center justify-center gap-1">
                   <span class="bg-[#089981] text-white text-[8px] px-1.5 py-0.5 rounded">B</span>
                   <span class="bg-[#f23645] text-white text-[8px] px-1.5 py-0.5 rounded">S</span>
                </div>
            </div>

            <div class="bg-[#1e222d] text-gray-300 font-bold flex items-center justify-center border-r border-[#2a2e39] group-hover:text-white transition">
                {{ row.strike }}
            </div>

            <div :class="isPutITM(row.strike) ? 'bg-[#1e222d] bg-gradient-to-l from-transparent to-[#2a2e39]/20' : 'bg-[#0b0e14]'"
                 class="flex items-center justify-center relative cursor-pointer hover:bg-[#2a2e39] transition"
                 @click="openOrderEntry('BUY', 'Option', { ...row.put, strike: row.strike, type: 'PE' })">
                <span class="font-mono" :class="row.put?.optionsState?.last_price ? 'text-white' : 'text-gray-600'">
                    {{ row.put?.optionsState?.last_price || '-' }}
                </span>
                 <div class="hidden group-hover:flex absolute inset-0 bg-black/60 items-center justify-center gap-1">
                   <span class="bg-[#089981] text-white text-[8px] px-1.5 py-0.5 rounded">B</span>
                   <span class="bg-[#f23645] text-white text-[8px] px-1.5 py-0.5 rounded">S</span>
                </div>
            </div>

          </div>
        </div>
    </div>

    <div v-if="showOrderModal" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/80 backdrop-blur-sm p-4 font-sans">
        <div class="bg-[#1e222d] w-full max-w-md rounded-xl border border-[#363a45] shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">

            <div :class="orderForm.side === 'BUY' ? 'bg-[#089981]' : 'bg-[#f23645]'" class="px-6 py-4 flex justify-between items-center shrink-0">
                <div>
                    <h2 class="font-bold text-white text-lg tracking-wide">{{ orderForm.side }} {{ orderForm.symbol_display || symbol }}</h2>
                    <div class="text-xs text-white/80 mt-0.5 flex items-center gap-2">
                        <span class="bg-black/20 px-1.5 rounded">LTP: {{ orderForm.price }}</span>
                    </div>
                </div>
                <button @click="showOrderModal = false" class="text-white hover:bg-white/20 rounded-full w-8 h-8 flex items-center justify-center transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

            <div class="p-6 overflow-y-auto custom-scrollbar space-y-6">

                <div class="bg-[#131722] p-1 rounded-lg flex text-xs font-bold border border-[#2a2e39]">
                    <button @click="orderForm.product = 'MIS'"
                        :class="orderForm.product === 'MIS' ? 'bg-[#2962ff] text-white shadow' : 'text-gray-400 hover:text-gray-200'"
                        class="flex-1 py-2 rounded transition">
                        INTRADAY (MIS)
                    </button>
                    <button @click="orderForm.product = 'CNC'"
                        :class="orderForm.product === 'CNC' ? 'bg-[#2962ff] text-white shadow' : 'text-gray-400 hover:text-gray-200'"
                        class="flex-1 py-2 rounded transition">
                        DELIVERY (CNC)
                    </button>
                </div>

                <div class="grid grid-cols-2 gap-5">
                    <div class="space-y-1.5">
                        <label class="text-[11px] text-gray-400 font-bold uppercase tracking-wider">Quantity / Lots</label>
                        <div class="relative">
                            <input v-model="orderForm.quantity" type="number" class="w-full bg-[#2a2e39] border border-transparent focus:border-[#2962ff] rounded-md px-3 py-2.5 text-sm font-mono text-white outline-none transition placeholder-gray-600">
                            <span class="absolute right-3 top-2.5 text-xs text-gray-500">Lot: {{ instrument?.lot_size || 1 }}</span>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[11px] text-gray-400 font-bold uppercase tracking-wider">Price</label>
                        <div class="relative">
                            <input v-model="orderForm.price" :disabled="isMarket" type="number" step="0.05"
                                class="w-full bg-[#2a2e39] border border-transparent focus:border-[#2962ff] disabled:opacity-50 disabled:cursor-not-allowed rounded-md px-3 py-2.5 text-sm font-mono text-white outline-none transition">
                        </div>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="text-[11px] text-gray-400 font-bold uppercase tracking-wider">Order Type</label>
                    <div class="grid grid-cols-4 gap-2">
                        <button v-for="type in ['MARKET', 'LIMIT', 'SL-LIMIT', 'SL-MARKET']" :key="type"
                            @click="orderForm.type = type"
                            :class="orderForm.type === type ? 'bg-[#2a2e39] border-[#2962ff] text-[#2962ff]' : 'border-[#2a2e39] text-gray-400 hover:border-gray-500'"
                            class="border text-[10px] font-bold py-2 rounded transition uppercase">
                            {{ type.replace('-', ' ') }}
                        </button>
                    </div>
                </div>

                <div v-if="isSL" class="space-y-1.5 animate-fade-in-down">
                    <label class="text-[11px] text-gray-400 font-bold uppercase tracking-wider">Trigger Price</label>
                    <input v-model="orderForm.trigger_price" type="number" step="0.05" class="w-full bg-[#2a2e39] border-l-4 border-l-[#f23645] rounded-r-md px-3 py-2.5 text-sm font-mono text-white outline-none focus:bg-[#2a2e39]/80 transition">
                    <p class="text-[10px] text-gray-500">Order triggers when price hits {{ orderForm.trigger_price }}</p>
                </div>

                <div class="pt-4 border-t border-[#2a2e39]">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-bold text-gray-300">Smart Orders (Stop Loss & Target)</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" v-model="orderForm.is_robo" class="sr-only peer">
                            <div class="w-9 h-5 bg-[#2a2e39] peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#2962ff]"></div>
                        </label>
                    </div>

                    <div v-if="orderForm.is_robo" class="grid grid-cols-2 gap-4 animate-fade-in-up">
                        <div class="space-y-1">
                            <label class="text-[10px] text-[#f23645] font-bold uppercase">Stop Loss Price</label>
                            <input v-model="orderForm.stop_loss" type="number" step="0.05" class="w-full bg-[#2a2e39] border border-[#f23645]/30 focus:border-[#f23645] rounded px-3 py-2 text-sm text-white outline-none transition">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] text-[#089981] font-bold uppercase">Target Price</label>
                            <input v-model="orderForm.target" type="number" step="0.05" class="w-full bg-[#2a2e39] border border-[#089981]/30 focus:border-[#089981] rounded px-3 py-2 text-sm text-white outline-none transition">
                        </div>
                    </div>
                </div>

                <div class="bg-[#2962ff]/10 border border-[#2962ff]/20 rounded p-3 flex justify-between items-center">
                    <span class="text-[10px] text-[#2962ff] font-bold">MARGIN REQUIRED (EST)</span>
                    <span class="text-sm font-mono font-bold text-white">₹ {{ estimatedMargin }}</span>
                </div>
            </div>

            <div class="p-4 border-t border-[#2a2e39] bg-[#1e222d]">
                <button @click="submitOrder" :disabled="isSubmitting"
                    :class="orderForm.side === 'BUY' ? 'bg-[#089981] hover:bg-[#067d69] shadow-[#089981]/20' : 'bg-[#f23645] hover:bg-[#d02e3c] shadow-[#f23645]/20'"
                    class="w-full py-3.5 rounded-lg font-bold text-white text-sm shadow-lg transition-all transform active:scale-[0.98] disabled:opacity-50 disabled:transform-none flex items-center justify-center gap-2">
                    <span v-if="isSubmitting" class="animate-spin h-4 w-4 border-2 border-white/30 border-t-white rounded-full"></span>
                    <span>{{ isSubmitting ? 'PLACING ORDER...' : (orderForm.side + ' ORDER') }}</span>
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

.animate-fade-in-down { animation: fadeInDown 0.2s ease-out; }
.animate-fade-in-up { animation: fadeInUp 0.2s ease-out; }

@keyframes fadeInDown {
    from { opacity: 0; transform: translateY(-5px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(5px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
