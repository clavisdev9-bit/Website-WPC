<script setup>
import { ref, onMounted, computed, watch } from 'vue'
import axios from 'axios'
import { LMap, LTileLayer, LMarker, LPopup } from "@vue-leaflet/vue-leaflet"
import FrontendLayout from '../../../layouts/FrontendLayout.vue'
import "leaflet/dist/leaflet.css"
import L from "leaflet"
import markerIcon from "leaflet/dist/images/marker-icon.png"
import markerShadow from "leaflet/dist/images/marker-shadow.png"
import { useRouter } from 'vue-router'
import Multiselect from 'vue-multiselect'
import 'vue-multiselect/dist/vue-multiselect.min.css'
const router = useRouter()

const refreshPage = () => {
  router.go(0) // reload 
}

// Fix marker hilang
L.Icon.Default.mergeOptions({
  iconUrl: markerIcon,
  shadowUrl: markerShadow,
})

const defaultImage = "/images/footer_works.jpg"


// STATE
const mapRef = ref(null)
const mapInstance = ref(null)
const zoomLevel = ref(3)
const selectedLevel = ref("continent")
const selectedContinent = ref(null)
const selectedSubcontinent = ref(null)
const selectedCountry = ref(null)
const selectedCity = ref(null)
const showModal = ref(false)
const selectedImage = ref("")
const activeAgent = ref(null)


// ICONS
const defaultIcon = L.icon({
  iconUrl: "https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png",
  iconSize: [25, 41],
  iconAnchor: [12, 41],
})

const activeIcon = L.icon({
  iconUrl: "https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png",
  iconSize: [30, 45],
  iconAnchor: [15, 45],
})


const continentIcon = L.icon({
  iconUrl: '/images/marker.png',
  iconSize: [36, 45],
  iconAnchor: [12, 41],
  className: 'continent-marker'
})



// FETCH DATA
const data = ref([])
const loading = ref(true)
const error = ref(null)

const goToContinent = (continent) => {
  selectedContinent.value = continent
  selectedLevel.value = 'subcontinent'
  selectedSubcontinent.value = null
  selectedCountry.value = null
  selectedCity.value = null

  // Auto zoom to continent bounds
  if (mapInstance.value && continent.subcontinents?.length) {
    // Ambil semua posisi valid (bukan undefined/null)
    const allCoords = continent.subcontinents
      .map(sc => sc.position)
      .filter(pos => Array.isArray(pos) && pos.length === 2 && !isNaN(pos[0]) && !isNaN(pos[1]))

    if (allCoords.length > 0) {
      const bounds = L.latLngBounds(allCoords)
      mapInstance.value.fitBounds(bounds, { padding: [50, 50] })
    } else {
      console.warn('Tidak ada posisi valid untuk sub-benua:', continent.continent)
      // fallback → zoom ke center default
      mapInstance.value.setView([0, 0], 2)
    }
  }
}


const goToSubcontinent = (subcontinent) => {
  selectedSubcontinent.value = subcontinent
  selectedLevel.value = 'country'
  selectedCountry.value = null
  selectedCity.value = null
}

const goToCountry = (country) => {
  selectedCountry.value = country
  selectedLevel.value = 'city'
  selectedCity.value = null
  if (mapInstance.value) mapInstance.value.flyTo(country.position, 5, { duration: 1 })
}

const goToCity = (city) => {
  selectedCity.value = city
  selectedLevel.value = 'agent'
  if (mapInstance.value) mapInstance.value.flyTo(city.position, 8, { duration: 1 })
}

const goToAgent = (agent) => {
  activeAgent.value = agent
  selectedLevel.value = 'agent'
  if (mapInstance.value) mapInstance.value.flyTo(agent.position, 12, { duration: 1.2 })
}

const goToQuotation = (agent) => {
  window.location.href = "/wpc-esys/qoutation-request"
}

const openImage = (img) => {
  selectedImage.value = img
  showModal.value = true
}




const fetchData = async () => {
    loading.value = true
    error.value = null
    
    
    let allAgents = []
    let nextUrl = "/api/Agents/Network" 
    // let nextUrl = "/api/Agents/Network" untuk server 

    try {
        while (nextUrl) {
            const res = await axios.get(nextUrl)
            const responseData = res.data.data

            // Tambahkan agen dari halaman saat ini ke array utama
            allAgents = allAgents.concat(responseData.data)

            // Dapatkan URL halaman berikutnya, jika ada
            nextUrl = responseData.pagination.next_page_url
        }

        //  MULAI LOGIKA GROUPING DENGAN allAgents
        const agents = allAgents
        const continentsMap = {}

        agents.forEach(item => {
            const continentKey = item.location.continent?.trim()?.toLowerCase() || "unknown"
            const continentName = item.location.continent || "Unknown"
            const subKey = item.location.subcontinent?.trim()?.toLowerCase() || "other"
            const subName = item.location.subcontinent || "Other"
            const countryName = item.location.country?.name || "Unknown Country"
            const cityName = item.location.city || "Unknown City"
            const lat = parseFloat(item.location.coordinates?.lat)
            const lng = parseFloat(item.location.coordinates?.lng)
            const flag = item.location.country?.flag || ""

            // Gunakan posisi rata-rata (0,0) atau lainnya jika NaN, agar tidak mengganggu peta.
            const position = (isNaN(lat) || isNaN(lng)) ? [0, 0] : [lat, lng]
            
            
            // === GROUPING CONTINENT ===
            if (!continentsMap[continentKey]) {
                continentsMap[continentKey] = {
                    continent: continentName,
                    subcontinents: {},
                    positions: [],
                    agentCount: 0 
                }
            }
            
            // Hanya tambahkan posisi yang valid ke positions untuk perhitungan rata-rata
            if (!isNaN(lat) && !isNaN(lng)) {
                continentsMap[continentKey].positions.push([lat, lng])
            }
            
            // 💡 Hitungan agentCount bertambah terlepas dari validitas koordinat
            continentsMap[continentKey].agentCount++ 

            // === GROUPING SUBCONTINENT ===
            if (!continentsMap[continentKey].subcontinents[subKey]) {
                continentsMap[continentKey].subcontinents[subKey] = {
                    subcontinent: subName,
                    countries: {}
                }
            }

            // === GROUPING COUNTRY ===
            if (!continentsMap[continentKey].subcontinents[subKey].countries[countryName]) {
                continentsMap[continentKey].subcontinents[subKey].countries[countryName] = {
                    country: countryName,
                    flag: flag,
                    position: position,
                    cities: {}
                }
            }

            // === GROUPING CITY ===
            if (!continentsMap[continentKey].subcontinents[subKey].countries[countryName].cities[cityName]) {
                continentsMap[continentKey].subcontinents[subKey].countries[countryName].cities[cityName] = {
                    city: cityName,
                    position: position,
                    agents: []
                }
            }

            // === AGENT DATA ===
            continentsMap[continentKey]
                .subcontinents[subKey]
                .countries[countryName]
                .cities[cityName]
                .agents.push({
                    id: item.id,
                    name: item.name,
                    address: item.location.address,
                    position: position,
                    phone: item.contact.phone,
                    email: item.contact.email,
                    image: item.image || defaultImage,
                    city: cityName,
                    country: countryName,
                    subcontinent: subName,
                    continent: continentName
                })
        })

        // === CONVERT OBJECTS TO ARRAYS + HITUNG POSISI RATA-RATA ===
        const groupedByContinent = Object.values(continentsMap).map(continent => {
            // Pastikan ada posisi untuk dihitung
            let avgLat = 0
            let avgLng = 0
            if (continent.positions.length > 0) {
                avgLat = continent.positions.reduce((sum, [lat]) => sum + lat, 0) / continent.positions.length
                avgLng = continent.positions.reduce((sum, [, lng]) => sum + lng, 0) / continent.positions.length
            }

            return {
                ...continent,
                position: [avgLat, avgLng],
                subcontinents: Object.values(continent.subcontinents).map(sc => {
                    const allCoords = Object.values(sc.countries).flatMap(c =>
                        Object.values(c.cities).flatMap(city => city.agents.map(a => a.position))
                    ).filter(pos => pos[0] !== 0 || pos[1] !== 0) // Filter posisi [0,0]

                    let scAvgLat = 0
                    let scAvgLng = 0

                    if (allCoords.length > 0) {
                       scAvgLat = allCoords.reduce((sum, [lat]) => sum + lat, 0) / allCoords.length
                       scAvgLng = allCoords.reduce((sum, [, lng]) => sum + lng, 0) / allCoords.length
                    }
                    
                    return {
                        ...sc,
                        position: [scAvgLat, scAvgLng],
                        countries: Object.values(sc.countries).map(c => ({
                            ...c,
                            cities: Object.values(c.cities)
                        }))
                    }
                })
            }
        })

        data.value = groupedByContinent
        // Log ini sekarang akan menunjukkan hitungan yang benar:
        // console.log("✅ Data Benua:", groupedByContinent.map(c => ({
        //     continent: c.continent, 
        //     agents: c.agentCount, 
        //     subcontinents: c.subcontinents.length // Sekarang akan jadi 2 untuk Asia (Tenggara & Timur)
        // })))
        
    } catch (err) {
        error.value = "Gagal memuat data dari API. Cek koneksi atau endpoint."
        console.error("❌ Error fetchData:", err)
    } finally {
        loading.value = false
    }
}




const onMapReady = (map) => {
  mapInstance.value = map
  // console.log(" Map ready")

  // Setelah data terload, fokuskan ke area dunia (berdasarkan semua benua)
  watch(data, (val) => {
    if (val.length > 0) {
      const allCoords = val.flatMap(c => c.positions)
      const bounds = L.latLngBounds(allCoords)
      map.fitBounds(bounds, { padding: [50, 50] })
    }
  }, { immediate: true })
}


const zoomTo = (pos, zoom) => {
  if (mapInstance.value) {
    mapInstance.value.setView(pos, zoom)
  }
}


// PAGINATION & LIST

const agentListItemsPerPage = ref(10)
const agentListCurrentPage = ref(1)

const paginatedAgentCountries = computed(() => {
  if (selectedLevel.value !== 'country') return []
  const start = (agentListCurrentPage.value - 1) * agentListItemsPerPage.value
  return data.value.slice(start, start + agentListItemsPerPage.value)
})


const paginatedAgentCities = computed(() => {
  if (selectedLevel.value !== 'city' || !selectedCountry.value) return []
  const start = (agentListCurrentPage.value - 1) * agentListItemsPerPage.value
  const end = start + agentListItemsPerPage.value
  // safety: ensure cities array exists
  const cities = selectedCountry.value?.cities || []
  return cities.slice(start, end)
})

const paginatedAgentRecords = computed(() => {
  if (selectedLevel.value !== 'agent' || !selectedCity.value) return []
  const start = (agentListCurrentPage.value - 1) * agentListItemsPerPage.value
  const end = start + agentListItemsPerPage.value
  // safety: ensure agents array exists
  const agents = selectedCity.value?.agents || []
  return agents.slice(start, end)
})



const nextAgentListPage = () => agentListCurrentPage.value++
const resetAgentListPagination = () => agentListCurrentPage.value = 1
watch([selectedLevel, selectedCountry, selectedCity], resetAgentListPagination)

onMounted(fetchData)


// FLAT AGENT LIST
const flatAgents = computed(() => {
  if (!data.value?.length) return []
  return data.value.flatMap(continent =>
    (continent.subcontinents || []).flatMap(sc =>
      (sc.countries || []).flatMap(c =>
        (c.cities || []).flatMap(city =>
          city.agents.map(agent => ({
            ...agent,
            country: c.country,
            city: city.city,
          }))
        )
      )
    )
  )
})


// FILTER & PAGINATION
const filterCountry = ref('')
const searchQuery = ref('')
const itemsPerPage = ref(6)
const currentPage = ref(1)

// FILTERED AGENTS
const filteredAgents = computed(() => {
  let agents = flatAgents.value

  // Filter by country
  if (filterCountry.value) {
    agents = agents.filter(a => a.country === filterCountry.value)
  }

  // Filter by search query
  if (searchQuery.value) {
    const query = searchQuery.value.toLowerCase()
    agents = agents.filter(a =>
      (a.name && a.name.toLowerCase().includes(query)) ||
      (a.city && a.city.toLowerCase().includes(query)) ||
      (a.address && a.address.toLowerCase().includes(query))
    )
  }
  return agents
})

// PAGINATION
const paginatedAgents = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage.value
  return filteredAgents.value.slice(start, start + itemsPerPage.value)
})

const loadMore = () => {
  if (currentPage.value * itemsPerPage.value < filteredAgents.value.length) {
    currentPage.value++
  }
}

// Reset pagination when filters change
watch([filterCountry, searchQuery], () => {
  currentPage.value = 1
})


// DETAIL MODAL
const showDetailModal = ref(false)
const openDetail = (agent) => {
  activeAgent.value = agent
  showDetailModal.value = true
}

// BACK BUTTON
const goBack = () => {
  if (selectedLevel.value === 'subcontinent') {
    selectedLevel.value = 'continent'
    selectedContinent.value = null
  } else if (selectedLevel.value === 'country') {
    selectedLevel.value = 'subcontinent'
    selectedSubcontinent.value = null
  } else if (selectedLevel.value === 'city') {
    selectedLevel.value = 'country'
    selectedCountry.value = null
  } else if (selectedLevel.value === 'agent') {
    selectedLevel.value = 'city'
    selectedCity.value = null
  }
}

// ANIMASI LIST AGENTS
const texts = [
  "Find our list of agents worldwide",
  "Find our list of partners worldwide",
  "Find our list of distributors worldwide"
]

const displayedText = ref('')
const typingSpeed = 100   
const deletingSpeed = 50  
const delayBetweenTexts = 1200 
let textIndex = 0
let charIndex = 0
let isDeleting = false

onMounted(() => {
  typeEffect()
})

function typeEffect() {
  const currentText = texts[textIndex]

  if (!isDeleting && charIndex < currentText.length) {
    displayedText.value += currentText.charAt(charIndex)
    charIndex++
    setTimeout(typeEffect, typingSpeed)
  } 
  else if (isDeleting && charIndex > 0) {
    displayedText.value = currentText.substring(0, charIndex - 1)
    charIndex--
    setTimeout(typeEffect, deletingSpeed)
  } 
  else {
    if (!isDeleting) {
      isDeleting = true
      setTimeout(typeEffect, delayBetweenTexts)
    } else {
      isDeleting = false
      textIndex = (textIndex + 1) % texts.length
      setTimeout(typeEffect, typingSpeed)
    }
  }
}
</script>

<template>
  <FrontendLayout>
    <div class="container-xl mt-4">
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-body p-0" style="min-height:500px">
              <div v-if="loading" class="text-center py-5 text-dark fw-bold"> {{ $t('map.loadingMap') }} </div>
              <div v-else>
                <LMap
                  ref="mapRef"
                  style="height:500px"
                  :zoom="zoomLevel"
                  :center="[20,0]"
                  @ready="onMapReady"
                >
                  <LTileLayer url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png" />

                  <template v-if="selectedLevel==='continent'">
                    <LMarker
                        v-for="(continent, i) in data"
                        :key="i"
                        :lat-lng="continent.position"
                        :icon="continentIcon"
                        @click="goToContinent(continent)"
                    >
                        <LPopup>
                        <b>{{ continent.continent }}</b>
                        <div>({{ continent.subcontinents.length }} subcontinents)</div>
                        </LPopup>
                    </LMarker>
                    </template>

                    <template v-else-if="selectedLevel==='subcontinent' && selectedContinent">
                        <LMarker
                        v-for="(sub,i) in selectedContinent.subcontinents || []"
                        :key="i"
                        :lat-lng="sub.position"
                        :icon="continentIcon"
                        class="pulse"
                        @click="goToSubcontinent(sub)"
                        >
                        <LPopup>
                            <b>{{ sub.subcontinent }}</b><br />
                            ({{ sub.countries.length }} countries)
                        </LPopup>
                        </LMarker>
                    </template>

                    <template v-if="selectedLevel==='country'">
                      <LMarker 
                        v-for="(country,i) in selectedSubcontinent?.countries || []" :key="i" 
                        :lat-lng="country.position"
                        :icon="continentIcon"
                        @click="goToCountry(country)">
                        <LPopup>
                          <b>{{ country.country }}</b> ({{ country.cities.length }} cities)
                        </LPopup>
                      </LMarker>
                    </template>

                    <template v-else-if="selectedLevel==='city'">
                      <LMarker 
                        v-for="(city,i) in selectedCountry?.cities || []" :key="i" 
                        :lat-lng="city.position"
                        :icon="continentIcon"
                        @click="goToCity(city)">
                        <LPopup>
                          <b>{{ city.city }}</b> ({{ city.agents.length }} agents)
                        </LPopup>
                      </LMarker>
                    </template>

                  <template v-else-if="selectedLevel==='agent' && selectedCity?.agents">
                    <LMarker 
                      v-for="(agent,i) in selectedCity.agents" :key="i"
                      :lat-lng="agent.position"
                      @click="goToAgent(agent)"
                      :icon="continentIcon && continentIcon.id === agent.id ? continentIcon : continentIcon"
                    >
                      <LPopup>
                        <div class="text-center" style="min-width: 160px;">
                          <img :src="agent.image || defaultImage" alt="Agent" width="100" class="rounded mb-2 border shadow-sm">
                          <div class="fw-bold text-primary"><i class="fa-solid fa-building"></i> {{ agent.name }}</div>
                          <small class="text-muted d-block mb-3"><i class="fa-solid fa-map-pin"></i>{{ agent.country }} | {{ agent.city }}</small>
                          <div class="d-flex justify-content-center gap-2">
                            <button class="btn btn-sm text-white" style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 10px;" @click="openDetail(agent)">{{ $t('map.detailsAgent') }}</button>
                            <button class="btn btn-sm text-white" style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 10px;" @click="goToQuotation(agent)">{{ $t('map.getQuotation') }}</button>
                          </div>
                        </div>
                      </LPopup>
                    </LMarker>
                  </template>
                </LMap>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4 mt-2">
          <div class="card">
            <div class="card-header list-agents-card">
              <h3 class="text-primary mb-0">{{ displayedText }}</h3>
            </div>
            <div class="card-body">
              <ul class="list-group">
                

              <li 
                  v-if="selectedLevel==='continent'" 
                  v-for="(continent,i) in data" 
                  :key="i" 
                  @click="goToContinent(continent)"
                  class="list-group-item list-group-item-action d-flex justify-content-between align-items-center cursor-pointer"
              >
                  {{ continent.continent }}
                  <span class="badge bg-primary rounded-pill text-light">{{ continent.subcontinents.length }}</span> 
              </li>

              <li 
                v-if="selectedLevel==='subcontinent' && selectedContinent" 
                v-for="(sub,i) in selectedContinent.subcontinents || []" 
                :key="i" 
                @click="goToSubcontinent(sub)"
                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center cursor-pointer"
              >
                {{ sub.subcontinent }}
                <span class="badge bg-primary rounded-pill text-light">{{ sub.countries.length }}</span>
              </li>


            <li
                    v-if="selectedLevel === 'country' && selectedSubcontinent"
                    v-for="(country, i) in selectedSubcontinent.countries || []"
                    :key="i"
                    @click="goToCountry(country)"
                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center cursor-pointer"
                    >
                    <div class="d-flex align-items-center gap-2">
                       
                        <img
                        v-if="country.flag"
                        :src="country.flag"
                        alt="Flag"
                        style="width: 24px; height: 16px; object-fit: cover; border-radius: 2px;"
                        />

                        
                        <span>{{ country.country }}</span>
                    </div>

                   
                    <span class="badge bg-primary rounded-pill text-light">
                        {{ country.cities.length }}
                    </span>
                    </li>


                <li
                  v-if="selectedLevel === 'city' && selectedCountry"
                  v-for="(city, i) in selectedCountry.cities || []"
                  :key="i"
                  @click="goToCity(city)"
                  class="list-group-item list-group-item-action d-flex justify-content-between align-items-center cursor-pointer"
                >
                  <div class="d-flex align-items-center gap-2">
                    <img
                      v-if="selectedCountry.flag"
                      :src="selectedCountry.flag"
                      alt="Flag"
                      style="width: 24px; height: 16px; object-fit: cover; border-radius: 2px;"
                    />

                    <span>{{ city.city }}</span>
                  </div>

                  <span class="badge bg-primary rounded-pill text-light">
                    {{ city.agents.length }}
                  </span>
                </li>


                <li v-if="selectedLevel==='agent' && selectedCity?.agents" v-for="(agent,i) in paginatedAgentRecords" :key="`agent-${i}`" class="list-group-item d-flex align-items-center justify-content-between">
                  <div class="d-flex align-items-center" style="cursor:pointer" @click="goToAgent(agent)">
                    <img :src="agent.image || defaultImage" alt="" width="40" height="40" class="rounded me-2 border">
                    <span :class="{ 'text-primary fw-bold': activeAgent && activeAgent.id === agent.id }">{{ agent.name }}</span>
                  </div>
                  <button class="btn btn-outline-primary" @click="goToQuotation"> {{ $t('map.getQuotation') }}</button>
                </li>
              </ul>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <button
                    v-if="selectedLevel !== 'continent'"
                    class="btn btn-outline-secondary"
                    @click="goBack"
                >
                    <i class="fa-solid fa-arrow-left"></i> {{ $t('map.back') }}
                </button>

                <button
                    class="btn btn-outline-secondary"
                    @click="refreshPage"
                >
                    <i class="fa-solid fa-refresh"></i> {{ $t('map.refresh') }}
                </button>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="page-body mt-5">
  <div class="container-xl">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
      <div>
        <h2 class="text-primary fw-bold mb-1">🌍 {{ $t('map.globalLocations') }} </h2>
        <p class="text-muted small mb-0">
          {{ $t('map.connectingText') }}
        </p>
      </div>
      <div class="mt-2 mt-sm-0">
       
        <div class="mt-2 mt-sm-0 d-flex gap-2">
        <select
          v-model="filterCountry"
          class="form-select shadow-sm border-primary"
          style="min-width: 200px; border-radius: 10px;"
        >
          <option value="">🌐 {{ $t('map.allCountries') }}</option>
          <option
            v-for="c in data.flatMap(cont => (cont.subcontinents || []).flatMap(sc => (sc.countries || [])))"
            :key="c.country"
            :value="c.country"
          >
            {{ c.country }}
          </option>
        </select>

      
      <input
  type="text"
  v-model="searchQuery"
  :placeholder="$t('map.searchAgent')"
  class="form-control rounded-3 shadow-sm border-primary"
/>


    </div>
  </div>
    </div>

    <transition-group
      name="fade"
      tag="div"
      class="row g-4"
      appear
    >
      <div
        v-for="(agent, i) in paginatedAgents"
        :key="agent.id || i"
        class="col-12 col-sm-6 col-lg-4"
      >
        <div class="card border-0 shadow-sm h-100 hover-card transition-all">
          <div class="position-relative overflow-hidden rounded-top" style="height: 200px;">
            <img
              :src="defaultImage"
              class="w-100 h-100"
              style="object-fit: cover;"
              @click.prevent="openImage(agent.image)"
              alt="Agent Image"
            />
            <div class="position-absolute top-0 start-0 m-2 px-3 py-1 bg-primary text-white rounded-pill text-xs fw-semibold">
              {{ agent.country }}
            </div>
          </div>

          <div class="card-body">
            <div class="d-flex align-items-start mb-2">
               <i class="fa-solid fa-building-circle-check me-1 text-primary"></i>
              <div>
                <div class="fw-bold text-dark mb-0">{{ agent.name }}</div>
                <div class="text-secondary small">{{ agent.city }}</div>
              </div>
            </div>

            <div class="small text-muted mb-3">
              <i class="fa-solid fa-location-dot me-1 text-primary"></i>
              {{ agent.address }}
            </div>

            <div class="d-flex justify-content-between align-items-center">
              <button
                class="btn btn-primary px-3 shadow-sm"
                style="border-radius: 8px; background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 12px; border: none;"
                @click="goToQuotation(agent)"
              >
              {{ $t('map.getQuotation') }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </transition-group>

    <div v-if="loading" class="col-12 text-center text-secondary py-5 fw-semibold">
      <i class="fa-solid fa-spinner fa-spin me-2"></i> Loading branch gallery...
    </div>

    <div v-if="!loading && filteredAgents.length === 0" class="col-12 text-center text-muted py-5 fw-semibold">
      <i class="fa-solid fa-circle-exclamation text-primary me-2"></i>
        {{ $t('map.loadingGallery') }}
    </div>

    <div class="text-center mt-4">
      <button
        v-if="currentPage * itemsPerPage < filteredAgents.length"
        class="btn btn-outline-primary px-4 py-2 fw-semibold shadow-sm"
        style="border-radius: 10px;"
        @click="loadMore"
      >
        <i class="fa-solid fa-plus me-2"></i> {{ $t('map.refresh') }}
      </button>
    </div>
  </div>
</div>



<div 
  v-if="showDetailModal" 
  class="modal fade show d-block" 
  style="background: rgba(0,0,0,0.6);" 
  @click.self="showDetailModal=false"
>
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content p-4">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold text-primary mb-0">{{ activeAgent.name }}</h5>
        <button type="button" class="btn-close" @click="showDetailModal=false"></button>
      </div>
      <img 
        :src="activeAgent.image || defaultImage" 
        class="img-fluid rounded mb-3"
        alt="Agent"
      >
      <p><i class="fa-solid fa-city text-primary"> </i> {{ activeAgent.country }} | {{ activeAgent.city }}</p>
      <p><i class="fa-solid fa-location-dot text-primary"></i> {{ activeAgent.address }}</p>
      <div class="text-end">
        <button 
          class="btn btn-primary"
          @click="goToQuotation(activeAgent)"
        >
          {{ $t('map.getQuotation') }}
        </button>
      </div>
    </div>
  </div>
</div>

  </FrontendLayout>
</template>







<style scoped>
.card {
  border-radius: 1rem;
  transition: transform 0.25s, box-shadow 0.25s;
}
.card:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
}
.card-img-top {
  border-top-left-radius: 1rem;
  border-top-right-radius: 1rem;
}
.text-xs {
  font-size: 0.75rem;
}
.hover-shadow:hover {
  box-shadow: 0 0 12px rgba(47, 111, 235, 0.3);
}

/* Background gelap untuk modal */
.modal-backdrop-custom {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  background: rgba(0, 0, 0, 0.85);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1050;
  animation: fadeIn 0.3s ease forwards;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

/* Efek zoom masuk pada konten modal */
.modal-animate {
  animation: zoomIn 0.35s ease forwards;
  transform: scale(0.8);
}

@keyframes zoomIn {
  from { transform: scale(0.8); opacity: 0; }
  to { transform: scale(1); opacity: 1; }
}

/* Tambahkan sedikit bayangan pada gambar modal */
.modal-image {
  box-shadow: 0 0 25px rgba(0, 0, 0, 0.5);
  border-radius: 1rem;
  transition: transform 0.25s ease;
}

.modal-image:hover {
  transform: scale(1.03);
}

/* Garis pembatas biru */
.blue-light {
  border: 0;
  height: 3px;
  background: linear-gradient(90deg, #007bff, #00bfff);
  width: 80%;
  border-radius: 2px;
}

.list-agents-card {
  border: 1px solid #e0e0e0;
  border-radius: 12px;
  padding: 16px;
  background: #fff;
  box-shadow: 0 2px 6px rgba(0,0,0,0.05);
  transition: transform 0.2s, box-shadow 0.2s;
}
.list-agents-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 12px rgba(0,0,0,0.1);
}
.list-agents-card h3 {
  font-size: 1.1rem;
  color: #007bff;
  margin-bottom: 12px;
}
.list-agents-card ul {
  list-style: none;
  padding: 0;
  margin: 0;
}
.list-agents-card li {
  padding: 8px 0;
  border-bottom: 1px solid #f0f0f0;
  cursor: pointer;
  transition: color 0.2s;
}
.list-agents-card li:last-child {
  border-bottom: none;
}
.list-agents-card li:hover {
  color: #0056b3;
  font-weight: 500;
}

h3 {
  font-weight: 600;
  white-space: nowrap;
  overflow: hidden;
  border-right: 3px solid #0d6efd; /* efek kursor */
  animation: blink 0.7s step-end infinite;
}

@keyframes blink {
  50% {
    border-color: transparent;
  }
}

/* Efek Pulse lembut untuk marker */
.leaflet-marker-icon.pulse {
  position: relative;
  animation: pulseMarker 1.6s ease-in-out infinite;
  transform-origin: center;
}

@keyframes pulseMarker {
  0% {
    transform: scale(1);
    filter: brightness(1);
  }
  50% {
    transform: scale(1.15);
    filter: brightness(1.3);
  }
  100% {
    transform: scale(1);
    filter: brightness(1);
  }
}


.continent-marker img {
  animation: pulse 2s infinite;
}

@keyframes pulse {
  0% { transform: scale(1); opacity: 0.9; }
  50% { transform: scale(1.1); opacity: 1; }
  100% { transform: scale(1); opacity: 0.9; }
}

.hover-card {
  transition: transform 0.25s ease, box-shadow 0.25s ease;
}
.hover-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 10px 20px rgba(0, 123, 255, 0.15);
}

.text-xs {
  font-size: 0.75rem;
  letter-spacing: 0.3px;
}

/* Fade-in animation for transition-group */
.fade-enter-active, .fade-leave-active {
  transition: all 0.5s ease;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
  transform: translateY(15px);
}


.list-agents-card h3 {
  min-height: 1.5em; /* cukup untuk 1 baris teks */
  display: flex;
  align-items: center; /* biar teks tetap di tengah vertikal */
}

</style>
