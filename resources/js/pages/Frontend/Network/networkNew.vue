<script setup>
import { ref, onMounted, computed, watch } from 'vue'
import axios from 'axios'
import { LMap, LTileLayer, LMarker, LPopup } from "@vue-leaflet/vue-leaflet"
import FrontendLayout from '../../../layouts/FrontendLayout.vue'
import "leaflet/dist/leaflet.css"
import L from "leaflet"
import markerIcon from "leaflet/dist/images/marker-icon.png"
import markerShadow from "leaflet/dist/images/marker-shadow.png"

// ✅ Fix marker hilang
L.Icon.Default.mergeOptions({
  iconUrl: markerIcon,
  shadowUrl: markerShadow,
})

const defaultImage = "/images/footer_works.jpg"

// ============================
// STATE
// ============================
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

// ============================
// ICONS
// ============================
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

// ============================
// FETCH DATA
// ============================
const data = ref([])
const loading = ref(true)
const error = ref(null)

const goToContinent = (continent) => {
  selectedContinent.value = continent
  selectedLevel.value = 'subcontinent'
  selectedSubcontinent.value = null
  selectedCountry.value = null
  selectedCity.value = null
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
  try {
    const res = await axios.get("http://127.0.0.1:8000/api/Agents/Network")
    const agents = res.data.data.data

    const groupedByContinent = Object.values(
      agents.reduce((acc, item) => {
        const continentName = item.location.continent
        const subcontinentName = item.location.subcontinent
        const countryName = item.location.country.name
        const cityName = item.location.city
        const lat = parseFloat(item.location.coordinates.lat)
        const lng = parseFloat(item.location.coordinates.lng)

        if (!acc[continentName]) {
          acc[continentName] = { continent: continentName, subcontinents: {} }
        }

        if (!acc[continentName].subcontinents[subcontinentName]) {
          acc[continentName].subcontinents[subcontinentName] = { subcontinent: subcontinentName, countries: {} }
        }

        if (!acc[continentName].subcontinents[subcontinentName].countries[countryName]) {
          acc[continentName].subcontinents[subcontinentName].countries[countryName] = {
            country: countryName,
            flag: item.location.country.flag,
            position: [lat, lng],
            cities: {}
          }
        }

        if (!acc[continentName].subcontinents[subcontinentName].countries[countryName].cities[cityName]) {
          acc[continentName].subcontinents[subcontinentName].countries[countryName].cities[cityName] = {
            city: cityName,
            position: [lat, lng],
            agents: []
          }
        }

        acc[continentName].subcontinents[subcontinentName].countries[countryName].cities[cityName].agents.push({
          id: item.id,
          name: item.name,
          address: item.location.address,
          position: [lat, lng],
          phone: item.contact.phone,
          email: item.contact.email,
          image: item.image || defaultImage,
          city: cityName,
          country: countryName,
          subcontinent: subcontinentName,
          continent: continentName,
        })

        return acc
      }, {})
    ).map(continent => ({
      ...continent,
      subcontinents: Object.values(continent.subcontinents).map(sc => ({
        ...sc,
        countries: Object.values(sc.countries).map(c => ({
          ...c,
          cities: Object.values(c.cities)
        }))
      }))
    }))

    data.value = groupedByContinent

  } catch (err) {
    error.value = "Gagal memuat data"
    console.error(err)
  } finally {
    loading.value = false
  }
}

// ============================
// MAP
// ============================
const onMapReady = (map) => {
  mapInstance.value = map
  console.log("🗺️ Map ready")
}

const zoomTo = (pos, zoom) => {
  if (mapInstance.value) {
    mapInstance.value.setView(pos, zoom)
  }
}

// ============================
// PAGINATION & LIST
// ============================
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
  return selectedCountry.value.cities.slice(start, start + agentListCurrentPage.value)
})

const paginatedAgentRecords = computed(() => {
  if (selectedLevel.value !== 'agent' || !selectedCity.value) return []
  const start = (agentListCurrentPage.value - 1) * agentListItemsPerPage.value
  return selectedCity.value.agents.slice(start, start + agentListCurrentPage.value)
})

const nextAgentListPage = () => agentListCurrentPage.value++
const resetAgentListPagination = () => agentListCurrentPage.value = 1
watch([selectedLevel, selectedCountry, selectedCity], resetAgentListPagination)

onMounted(fetchData)

// ============================
// FLAT AGENT LIST
// ============================
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

// ============================
// FILTER & PAGINATION
// ============================
const filterCountry = ref('')
const itemsPerPage = ref(6)
const currentPage = ref(1)

const filteredAgents = computed(() => {
  if (!filterCountry.value) return flatAgents.value
  return flatAgents.value.filter(a => a.country === filterCountry.value)
})

const paginatedAgents = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage.value
  return filteredAgents.value.slice(start, start + itemsPerPage.value)
})

const loadMore = () => {
  if (currentPage.value * itemsPerPage.value < filteredAgents.value.length) {
    currentPage.value++
  }
}

watch(filterCountry, () => {
  currentPage.value = 1
})

// ============================
// DETAIL MODAL
// ============================
const showDetailModal = ref(false)
const openDetail = (agent) => {
  activeAgent.value = agent
  showDetailModal.value = true
}

// ============================
// BACK BUTTON
// ============================
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
const typingSpeed = 100   // kecepatan mengetik (ms)
const deletingSpeed = 50  // kecepatan menghapus
const delayBetweenTexts = 1200 // jeda sebelum teks dihapus
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
        <!-- MAP -->
        <div class="col-md-8">
          <div class="card">
            <div class="card-body p-0" style="min-height:500px">
              <div v-if="loading" class="text-center py-5 text-dark fw-bold">Loading map data...</div>
              <div v-else>
                <LMap
                  ref="mapRef"
                  style="height:500px"
                  :zoom="zoomLevel"
                  :center="[20,0]"
                  @ready="onMapReady"
                >
                  <LTileLayer url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png" />

                  <!-- NEGARA -->
                  <template v-if="selectedLevel==='country'">
                    <LMarker 
                      v-for="(country,i) in selectedSubcontinent?.countries || []" :key="i" 
                      :lat-lng="country.position"
                      :icon="defaultIcon"
                      @click="goToCountry(country)">
                      <LPopup>
                        <b>{{ country.country }}</b> ({{ country.cities.length }} cities)
                      </LPopup>
                    </LMarker>
                  </template>

                  <!-- KOTA -->
                  <template v-else-if="selectedLevel==='city'">
                    <LMarker 
                      v-for="(city,i) in selectedCountry?.cities || []" :key="i" 
                      :lat-lng="city.position"
                      :icon="defaultIcon"
                      @click="goToCity(city)">
                      <LPopup>
                        <b>{{ city.city }}</b> ({{ city.agents.length }} agents)
                      </LPopup>
                    </LMarker>
                  </template>

                  <!-- AGENT -->
                  <template v-else-if="selectedLevel==='agent' && selectedCity?.agents">
                    <LMarker 
                      v-for="(agent,i) in selectedCity.agents" :key="i"
                      :lat-lng="agent.position"
                      @click="goToAgent(agent)"
                      :icon="activeAgent && activeAgent.id === agent.id ? activeIcon : defaultIcon"
                    >
                      <LPopup>
                        <div class="text-center" style="min-width: 160px;">
                          <img :src="defaultImage" alt="Agent" width="100" class="rounded mb-2 border shadow-sm">
                          <div class="fw-bold text-primary"><i class="fa-solid fa-building"></i> {{ agent.name }}</div>
                          <small class="text-muted d-block mb-3"><i class="fa-solid fa-map-pin"></i>{{ agent.country }} | {{ agent.city }}</small>
                          <div class="d-flex justify-content-center gap-2">
                            <button class="btn btn-sm text-white" style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 10px;" @click="openDetail(agent)">Details Agent</button>
                            <button class="btn btn-sm text-white" style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 10px;" @click="goToQuotation(agent)">Get Quotation</button>
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

        <!-- LIST SIDEBAR -->
        <div class="col-md-4">
          <div class="card">
            <div class="card-header list-agents-card">
              <!-- <h3 class="mb-0 text-primary">find our list of agents worldwide</h3> -->
              <h3 class="text-primary mb-0">{{ displayedText }}</h3>
            </div>
            <div class="card-body">
              <ul class="list-group">
                <!-- CONTINENT -->
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

              <!-- SUBCONTINENT -->
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

            <!-- COUNTRY -->
            <li 
              v-if="selectedLevel==='country' && selectedSubcontinent" 
              v-for="(country,i) in selectedSubcontinent.countries || []" 
              :key="i" 
              @click="goToCountry(country)"
              class="list-group-item list-group-item-action d-flex justify-content-between align-items-center cursor-pointer"
            >
              {{ country.country }}
              <span class="badge bg-primary rounded-pill text-light">{{ country.cities.length }}</span>
            </li>

                <!-- CITY -->
                <li 
                  v-if="selectedLevel==='city' && selectedCountry" 
                  v-for="(city,i) in selectedCountry.cities || []" 
                  :key="i" 
                  @click="goToCity(city)"
                  class="list-group-item list-group-item-action d-flex justify-content-between align-items-center cursor-pointer"
                >
                  {{ city.city }}
                  <span class="badge bg-primary rounded-pill text-light">{{ city.agents.length }}</span>
                </li>

                <!-- AGENT -->
                <li v-if="selectedLevel==='agent' && selectedCity?.agents" v-for="(agent,i) in paginatedAgentRecords" :key="`agent-${i}`" class="list-group-item d-flex align-items-center justify-content-between">
                  <div class="d-flex align-items-center" style="cursor:pointer" @click="goToAgent(agent)">
                    <img :src="defaultImage" alt="" width="40" height="40" class="rounded me-2 border">
                    <span :class="{ 'text-primary fw-bold': activeAgent && activeAgent.id === agent.id }">{{ agent.name }}</span>
                  </div>
                  <button class="btn btn-outline-primary" @click="goToQuotation">Get Quotation</button>
                </li>
              </ul>

              <button v-if="selectedLevel!=='continent'" class="btn btn-outline-secondary mt-3" @click="goBack">
                ← Back
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- PAGE BODY & AGENT GRID -->
    <div class="page-body mt-5">
      <div class="container-xl">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div>
            <h2 class="text-primary mb-1 fw-bold"> Global Locations </h2>
            <p class="text-secondary small mb-0">Connecting you through our network of international branches and partners.</p>
          </div>
          <div>
            <select v-model="filterCountry" class="form-select form-select shadow-sm">
              <option value="">🌍All Countries</option>
              <option v-for="c in data.flatMap(cont => (cont.subcontinents || []).flatMap(sc => (sc.countries || [])))" :key="c.country" :value="c.country">
                {{ c.country }}
              </option>
            </select>
          </div>
        </div>

        <div class="row row-cards">
          <div v-for="(agent, i) in paginatedAgents" :key="i" class="col-sm-6 col-lg-4">
            <div class="card card-sm shadow-sm hover-shadow transition-all duration-200 border-0">
              <a href="#" class="d-block position-relative" @click.prevent="openImage(agent.image)">
                <img :src="defaultImage" class="card-img-top" style="height:200px; object-fit:cover;" />
                <div class="position-absolute top-0 start-0 m-2 px-2 py-1 bg-primary text-white rounded-pill text-xs">
                  {{ agent.country }}
                </div>
              </a>
              <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                  <span class="avatar avatar-2 me-3 rounded bg-outline-primary bg-opacity-10">
                    <i class="fa-solid fa-map"></i>
                  </span>
                  <div>
                    <div class="fw-bold text-dark">{{ agent.name }}</div>
                    <div class="text-secondary small">{{ agent.city }}</div>
                  </div>
                </div>
                <div class="small text-muted mb-2">
                  <i class="fa-solid fa-location-dot me-1 text-primary"></i> {{ agent.address }}
                </div>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="text-secondary small"></div>
                  <button class="btn btn-outline-primary text-white" @click="goToQuotation" style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 12px; border: none;">
                    Get Quotation
                  </button>
                </div>
              </div>
            </div>
          </div>

          <div v-if="loading" class="text-center text-secondary py-5">Loading branch gallery...</div>
          <div v-if="!loading && filteredAgents.length === 0" class="text-center text-secondary py-5">
            No branches found.
          </div>
        </div>

        <div class="text-center mt-4">
          <button v-if="currentPage * itemsPerPage < filteredAgents.length" class="btn btn-outline-primary" @click="loadMore">Load More</button>
        </div>
      </div>
    </div>

    <!-- Modal Detail -->
    <div v-if="showDetailModal" class="modal fade show d-block" style="background: rgba(0,0,0,0.6);" @click.self="showDetailModal=false">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content p-4">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold text-primary mb-0">{{ activeAgent.name }}</h5>
            <button type="button" class="btn-close" @click="showDetailModal=false"></button>
          </div>
          <img :src="activeAgent.image || defaultImage" class="img-fluid rounded mb-3" alt="Agent">
          <p><i class="fa-solid fa-city text-primary"> </i> {{ activeAgent.country }} | {{ activeAgent.city }}</p>
          <p><i class="fa-solid fa-location-dot text-primary"></i> {{ activeAgent.address }}</p>
          <p><i class="fa-solid fa-phone text-primary"></i> {{ activeAgent.phone || 'N/A' }}</p>
          <div class="text-end">
            <button class="btn btn-primary" @click="goToQuotation(activeAgent)">Get Quotation</button>
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
</style>
