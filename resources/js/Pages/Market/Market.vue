<template>
  <div class="h-screen bg-gray-950 text-gray-100 flex overflow-hidden">
    <!-- Sidebar - Instrument Selector -->
    <aside class="w-80 border-r border-gray-800 flex flex-col bg-gray-900/50 backdrop-blur-sm">
      <!-- Sidebar Header -->
      <div class="p-6 border-b border-gray-800">
        <div class="flex items-center justify-between">
          <div>
            <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-400 to-cyan-300 bg-clip-text text-transparent">
              Trading Dashboard
            </h1>
            <p class="text-sm text-gray-400 mt-1">Real-time Market Data</p>
          </div>
          <div class="relative">
            <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
            <div class="absolute inset-0 bg-green-400 rounded-full animate-ping opacity-75"></div>
          </div>
        </div>

        <!-- Search -->
        <div class="mt-6">
          <div class="relative">
            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-500"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input
              v-model="searchQuery"
              type="text"
              placeholder="Search instruments..."
              class="w-full pl-10 pr-4 py-2.5 bg-gray-800 border border-gray-700 rounded-lg
                     focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                     placeholder-gray-500 text-sm"
            />
          </div>
        </div>

        <!-- Filter Tabs -->
        <div class="mt-4 flex space-x-1">
          <button
            v-for="tab in filterTabs"
            :key="tab.id"
            @click="activeFilter = tab.id"
            :class="[
              'px-3 py-1.5 text-sm rounded-lg transition-all duration-200',
              activeFilter === tab.id
                ? 'bg-blue-600 text-white'
                : 'text-gray-400 hover:text-white hover:bg-gray-800'
            ]"
          >
            {{ tab.label }}
          </button>
        </div>
      </div>

      <!-- Instruments List -->
      <div class="flex-1 overflow-y-auto">
        <div class="p-4">
          <!-- Category Headers -->
          <template v-for="category in filteredCategories" :key="category.name">
            <div class="mb-4">
              <div class="flex items-center justify-between mb-2 px-2">
                <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider">
                  {{ category.name }}
                </h3>
                <span class="text-xs text-gray-600 bg-gray-800 px-2 py-0.5 rounded">
                  {{ category.instruments.length }}
                </span>
              </div>

              <!-- Instruments in Category -->
              <div class="space-y-1">
                <div
                  v-for="inst in category.instruments"
                  :key="inst.id"
                  @click="switchInstrument(inst)"
                  :class="[
                    'group p-3 rounded-xl cursor-pointer transition-all duration-200',
                    'hover:bg-gray-800/50 hover:shadow-lg',
                    'border border-transparent hover:border-gray-700',
                    inst.symbol === selectedSymbol ?
                      'bg-gradient-to-r from-blue-900/30 to-cyan-900/20 border-blue-500/30 shadow-lg' :
                      'bg-gray-800/30'
                  ]"
                >
                  <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                      <!-- Instrument Icon -->
                      <div :class="[
                        'w-10 h-10 rounded-lg flex items-center justify-center',
                        getInstrumentColor(inst.category)
                      ]">
                        <span class="text-lg font-bold">
                          {{ getInstrumentIcon(inst.category) }}
                        </span>
                      </div>

                      <div>
                        <div class="flex items-center space-x-2">
                          <span class="font-semibold text-white">{{ inst.symbol }}</span>
                          <span :class="[
                            'px-2 py-0.5 text-xs rounded-full',
                            getVolatilityClass(inst.volatility_class)
                          ]">
                            {{ inst.volatility_class }}
                          </span>
                        </div>
                        <p class="text-sm text-gray-400 mt-0.5">{{ inst.sector.replace('_', ' ') }}</p>
                      </div>
                    </div>

                    <!-- Price -->
                    <div class="text-right">
                      <div class="font-mono font-bold text-lg">
                        {{ formatPrice(inst.base_price) }}
                      </div>
                      <div class="text-xs text-gray-400">
                        Lot: {{ inst.lot_size }}
                      </div>
                    </div>
                  </div>

                  <!-- Additional Info -->
                  <div class="mt-2 pt-2 border-t border-gray-800/50 flex items-center justify-between text-xs">
                    <div class="flex items-center space-x-4">
                      <div class="flex items-center space-x-1 text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>{{ inst.session_start.slice(0, 5) }} - {{ inst.session_end.slice(0, 5) }}</span>
                      </div>
                      <div class="flex items-center space-x-1" :class="getNewsSensitivityClass(inst.news_sensitivity)">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                        <span>{{ inst.news_sensitivity }}</span>
                      </div>
                    </div>

                    <!-- Active Indicator -->
                    <div v-if="inst.is_active" class="flex items-center">
                      <div class="w-2 h-2 bg-green-400 rounded-full mr-2"></div>
                      <span class="text-green-400 text-xs">Live</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </template>
        </div>
      </div>

      <!-- Sidebar Footer -->
      <div class="p-4 border-t border-gray-800 bg-gray-900/50">
        <div class="flex items-center justify-between">
          <div class="text-sm text-gray-400">
            {{ filteredInstruments.length }} instruments
          </div>
          <button
            @click="toggleFavoriteView"
            class="p-2 hover:bg-gray-800 rounded-lg transition-colors"
          >
            <svg :class="[
              'w-5 h-5 transition-colors',
              showFavoritesOnly ? 'text-yellow-400' : 'text-gray-400 hover:text-yellow-400'
            ]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
            </svg>
          </button>
        </div>
      </div>
    </aside>

    <!-- Main Content - Chart -->
    <main class="flex-1 flex flex-col overflow-hidden">
      <!-- Top Bar -->
      <div class="border-b border-gray-800 bg-gray-900/50 backdrop-blur-sm">
        <div class="flex items-center justify-between p-6">
          <!-- Selected Instrument Info -->
          <div class="flex items-center space-x-4">
            <div :class="[
              'w-14 h-14 rounded-xl flex items-center justify-center text-2xl',
              selectedInstrument ? getInstrumentColor(selectedInstrument.category) : 'bg-gray-800'
            ]">
              {{ selectedInstrument ? getInstrumentIcon(selectedInstrument.category) : '📊' }}
            </div>

            <div>
              <div class="flex items-center space-x-3">
                <h2 class="text-3xl font-bold">{{ selectedSymbol || 'Select Instrument' }}</h2>
                <div class="flex items-center space-x-2">
                  <span :class="[
                    'px-3 py-1 rounded-full text-sm font-semibold',
                    selectedInstrument ? getVolatilityClass(selectedInstrument.volatility_class) : 'bg-gray-700'
                  ]">
                    {{ selectedInstrument?.volatility_class || '-' }}
                  </span>
                  <span class="px-3 py-1 bg-gray-800 rounded-full text-sm">
                    {{ selectedInstrument?.category?.toUpperCase() || '-' }}
                  </span>
                </div>
              </div>
              <p class="text-gray-400 mt-1">
                {{ selectedInstrument?.sector?.replace('_', ' ') || 'Select an instrument to view chart' }}
              </p>
            </div>
          </div>

          <!-- Market Stats -->
          <div v-if="selectedInstrument" class="text-right">
            <div class="flex items-center space-x-6">
              <div class="text-center">
                <div class="text-2xl font-mono font-bold text-green-400">
                  {{ formatPrice(selectedInstrument.base_price) }}
                </div>
                <div class="text-xs text-gray-400">Base Price</div>
              </div>
              <div class="h-8 w-px bg-gray-700"></div>
              <div class="text-center">
                <div class="text-lg font-mono font-bold">{{ selectedInstrument.lot_size }}</div>
                <div class="text-xs text-gray-400">Lot Size</div>
              </div>
              <div class="h-8 w-px bg-gray-700"></div>
              <div class="text-center">
                <div class="text-lg font-mono font-bold">{{ selectedInstrument.tick_size }}</div>
                <div class="text-xs text-gray-400">Tick Size</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Chart Container -->
      <div class="flex-1 p-6 overflow-hidden">
        <div v-if="selectedSymbol" class="h-full">
          <Chart
            :key="selectedSymbol + expiry"
            :symbol="selectedSymbol"
            :expiry="expiry"
            :instrument="selectedInstrument"
          />
        </div>

        <!-- Empty State -->
        <div v-else class="h-full flex flex-col items-center justify-center text-gray-500">
          <div class="w-24 h-24 mb-6 opacity-50">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
          </div>
          <h3 class="text-2xl font-semibold mb-2">No Instrument Selected</h3>
          <p class="text-gray-400">Select an instrument from the sidebar to view its chart</p>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import Chart from './Chart.vue'

const props = defineProps({
  instruments: Array,
  instrument: Object,
  symbol: String,
  expiry: String
})

// Refs
const searchQuery = ref('')
const activeFilter = ref('all')
const selectedSymbol = ref(props.symbol || props.instrument?.symbol)
const selectedInstrument = ref(props.instrument)
const showFavoritesOnly = ref(false)

// Filter Tabs
const filterTabs = [
  { id: 'all', label: 'All' },
  { id: 'index', label: 'Indices' },
  { id: 'stock', label: 'Stocks' },
  { id: 'commodity', label: 'Commodities' }
]

// Computed: Filtered instruments
const filteredInstruments = computed(() => {
  let filtered = props.instruments || []

  // Apply search filter
  if (searchQuery.value) {
    const query = searchQuery.value.toLowerCase()
    filtered = filtered.filter(inst =>
      inst.symbol.toLowerCase().includes(query) ||
      inst.sector.toLowerCase().includes(query)
    )
  }

  // Apply category filter
  if (activeFilter.value !== 'all') {
    filtered = filtered.filter(inst => inst.category === activeFilter.value)
  }

  // Apply favorites filter (if enabled)
  if (showFavoritesOnly.value) {
    filtered = filtered.filter(inst => inst.is_favorite)
  }

  return filtered
})

// Computed: Group by category
const filteredCategories = computed(() => {
  const categories = {}

  filteredInstruments.value.forEach(inst => {
    if (!categories[inst.category]) {
      categories[inst.category] = []
    }
    categories[inst.category].push(inst)
  })

  return Object.entries(categories).map(([name, instruments]) => ({
    name: name.charAt(0).toUpperCase() + name.slice(1),
    instruments: instruments.sort((a, b) => a.symbol.localeCompare(b.symbol))
  }))
})

// Helper functions
function getInstrumentColor(category) {
  const colors = {
    index: 'bg-gradient-to-br from-blue-500/20 to-blue-600/20 text-blue-300',
    stock: 'bg-gradient-to-br from-green-500/20 to-emerald-600/20 text-green-300',
    commodity: 'bg-gradient-to-br from-yellow-500/20 to-amber-600/20 text-yellow-300',
    default: 'bg-gradient-to-br from-gray-500/20 to-gray-600/20 text-gray-300'
  }
  return colors[category] || colors.default
}

function getInstrumentIcon(category) {
  const icons = {
    index: '📈',
    stock: '💹',
    commodity: '⚖️',
    default: '📊'
  }
  return icons[category] || icons.default
}

function getVolatilityClass(volatility) {
  const classes = {
    low: 'bg-green-900/30 text-green-400 border border-green-500/20',
    medium: 'bg-yellow-900/30 text-yellow-400 border border-yellow-500/20',
    high: 'bg-red-900/30 text-red-400 border border-red-500/20',
    very_high: 'bg-purple-900/30 text-purple-400 border border-purple-500/20',
    default: 'bg-gray-900/30 text-gray-400 border border-gray-500/20'
  }
  return classes[volatility] || classes.default
}

function getNewsSensitivityClass(sensitivity) {
  const classes = {
    low: 'text-gray-400',
    medium: 'text-yellow-400',
    high: 'text-orange-400',
    very_high: 'text-red-400'
  }
  return classes[sensitivity] || classes.low
}

function formatPrice(price) {
  if (!price) return '-'
  const num = parseFloat(price)
  return num.toLocaleString('en-IN', {
    minimumFractionDigits: 2,
    maximumFractionDigits: 2
  })
}

function switchInstrument(inst) {
  selectedSymbol.value = inst.symbol
  selectedInstrument.value = inst
}

function toggleFavoriteView() {
  showFavoritesOnly.value = !showFavoritesOnly.value
}

// Lifecycle
onMounted(() => {
  if (!selectedInstrument.value && filteredInstruments.value.length > 0) {
    selectedInstrument.value = filteredInstruments.value[0]
    selectedSymbol.value = selectedInstrument.value.symbol
  }
})
</script>

<style scoped>
/* Custom scrollbar */
::-webkit-scrollbar {
  width: 6px;
  height: 6px;
}

::-webkit-scrollbar-track {
  background: rgba(255, 255, 255, 0.05);
  border-radius: 3px;
}

::-webkit-scrollbar-thumb {
  background: rgba(255, 255, 255, 0.1);
  border-radius: 3px;
}

::-webkit-scrollbar-thumb:hover {
  background: rgba(255, 255, 255, 0.2);
}

/* Smooth transitions */
.group {
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Gradient borders */
.hover\:border-gradient {
  border-image: linear-gradient(45deg, #3b82f6, #06b6d4) 1;
}

/* Glass effect */
.glass {
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
}
</style>
