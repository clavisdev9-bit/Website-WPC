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
const selectedLevel = ref("country")
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

const fetchData = async () => {
  try {
    const res = await axios.get("http://127.0.0.1:8000/api/Agents/Network")
    const agents = res.data.data.data

    // Group by country → city → agent
    const grouped = Object.values(
      agents.reduce((acc, item) => {
        if (!acc[item.name_country]) {
          acc[item.name_country] = {
            country: item.name_country,
            position: [parseFloat(item.lat), parseFloat(item.lng)],
            cities: {}
          }
        }

        if (!acc[item.name_country].cities[item.name_city]) {
          acc[item.name_country].cities[item.name_city] = {
            city: item.name_city,
            position: [parseFloat(item.lat), parseFloat(item.lng)],
            agents: []
          }
        }

        acc[item.name_country].cities[item.name_city].agents.push({
          id: item.id,
          name: item.name,
          address: item.address,
          position: [parseFloat(item.lat), parseFloat(item.lng)],
          phone: item.phone,
          email: item.email,
          // ✅ semua agent sementara pakai defaultImage
          image: defaultImage,
          city: item.name_city,
          country: item.name_country,
        })

        return acc
      }, {})
    ).map(country => ({
      ...country,
      cities: Object.values(country.cities)
    }))

    data.value = grouped
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

const goToCountry = (country) => {
  selectedCountry.value = country
  selectedLevel.value = "city"
  if (mapInstance.value) mapInstance.value.flyTo(country.position, 5, { duration: 1 })
}

const goToCity = (city) => {
  selectedCity.value = city
  selectedLevel.value = "agent"
  if (mapInstance.value) mapInstance.value.flyTo(city.position, 8, { duration: 1 })
}

const goToAgent = (agent) => {
  activeAgent.value = agent
  selectedLevel.value = 'agent'
  if (mapInstance.value) mapInstance.value.flyTo(agent.position, 12, { duration: 1.2 })
}

const goToQuotation = () => {
  window.location.href = "/wpc-esys/qoutation-request"
}

const openImage = (img) => {
  selectedImage.value = img
  showModal.value = true
}

// ============================
// PAGINATION
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
  return selectedCountry.value.cities.slice(start, start + agentListItemsPerPage.value)
})

const paginatedAgentRecords = computed(() => {
  if (selectedLevel.value !== 'agent' || !selectedCity.value) return []
  const start = (agentListCurrentPage.value - 1) * agentListItemsPerPage.value
  return selectedCity.value.agents.slice(start, start + agentListItemsPerPage.value)
})

const nextAgentListPage = () => agentListCurrentPage.value++
const resetAgentListPagination = () => agentListCurrentPage.value = 1
watch(selectedLevel, resetAgentListPagination)
watch(selectedCountry, resetAgentListPagination)
watch(selectedCity, resetAgentListPagination)

onMounted(fetchData)


// code list branch
const flatAgents = computed(() => {
  if (!data.value?.length) return []
  return data.value.flatMap(country =>
    country.cities.flatMap(city =>
      city.agents.map(agent => ({
        ...agent,
        country: country.country,
        city: city.city,
      }))
    )
  )
})


// ============================
// FILTER & PAGINATION
// ============================
const filterCountry = ref('')
const itemsPerPage = ref(6)
const currentPage = ref(1)

// Filter berdasarkan country
const filteredAgents = computed(() => {
  if (!filterCountry.value) return flatAgents.value
  return flatAgents.value.filter(a => a.country === filterCountry.value)
})

// Pagination (Load More)
const paginatedAgents = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage.value
  return filteredAgents.value.slice(start, start + itemsPerPage.value)
})

const loadMore = () => {
  if (currentPage.value * itemsPerPage.value < filteredAgents.value.length) {
    currentPage.value++
  }
}

// Reset page saat filter berubah
watch(filterCountry, () => {
  currentPage.value = 1
})


// code untuk detail
const showDetailModal = ref(false)
const openDetail = (agent) => {
  activeAgent.value = agent
  showDetailModal.value = true
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
              <div v-if="loading" class="text-center py-5">Loading map data...</div>
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
                      v-for="(country,i) in data" :key="i" 
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
                      v-for="(city,i) in selectedCountry.cities" :key="i" 
                      :lat-lng="city.position"
                      :icon="defaultIcon"
                      @click="goToCity(city)">
                      <LPopup>
                        <b>{{ city.city }}</b> ({{ city.agents.length }} agents)
                      </LPopup>
                    </LMarker>
                  </template>

                  <!-- AGENT -->
                  <template v-else-if="selectedLevel==='agent' && selectedCity && selectedCity.agents">
                    <LMarker 
                      v-for="(agent,i) in selectedCity.agents" :key="i"
                      :lat-lng="agent.position"
                      @click="goToAgent(agent)"
                      :icon="activeAgent && activeAgent.id === agent.id ? activeIcon : defaultIcon"
                    >
                <LPopup>
                  <div class="text-center" style="min-width: 160px;">
                    <img 
                      :src="defaultImage" 
                      alt="Agent" 
                      width="100" 
                      class="rounded mb-2 border shadow-sm"
                    >
                    <div class="fw-bold text-primary"><i class="fa-solid fa-building"></i> {{ agent.name }}</div>
                    <small class="text-muted d-block mb-3"><i class="fa-solid fa-map-pin"></i>{{ agent.country }} | {{ agent.city }}</small>

                    <div class="d-flex justify-content-center gap-2">
                      <button 
                        class="btn btn-sm text-white"
                        style="background: linear-gradient(90deg, #007bff, #0056b3); border: none; border-radius: 10px;"
                        @click="openDetail(agent)"
                      >
                        Details Agent
                      </button>
                      <button 
                        class="btn btn-sm text-white"
                        style="background: linear-gradient(90deg, #007bff, #0056b3); border: none; border-radius: 10px;"
                        @click="goToQuotation(agent)"
                      >
                        Get Quotation
                      </button>
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
            <div class="card-header">
              <h3 class="mb-0 text-primary">List Agents</h3>
            </div>
            <div class="card-body">
              <ul class="list-group">
                <!-- NEGARA -->
                <li v-if="selectedLevel==='country'" 
                    v-for="(country, i) in paginatedAgentCountries" :key="`country-${i}`"
                    class="list-group-item" 
                    @click="goToCountry(country)" 
                    style="cursor:pointer">
                  {{ country.country }} ({{ country.cities.length }} cities)
                </li>

                <!-- KOTA -->
                <li v-if="selectedLevel==='city'" 
                    v-for="(city, i) in paginatedAgentCities" :key="`city-${i}`"
                    class="list-group-item" 
                    @click="goToCity(city)" 
                    style="cursor:pointer">
                  {{ city.city }} ({{ city.agents.length }} agents)
                </li>

                <!-- AGENT -->
                <li v-if="selectedLevel==='agent' && selectedCity && selectedCity.agents"
                    v-for="(agent, i) in paginatedAgentRecords" :key="`agent-${i}`"
                    class="list-group-item d-flex align-items-center justify-content-between">
                  
                  <div class="d-flex align-items-center" style="cursor:pointer" @click="goToAgent(agent)">
                    <!--semua pakai defaultImage -->
                    <img :src="defaultImage" alt="" width="40" height="40" class="rounded me-2 border">
                    <span :class="{ 'text-primary fw-bold': activeAgent && activeAgent.id === agent.id }">
                      {{ agent.name }}
                    </span>
                    
                  </div>

                  <button class="btn btn-outline-primary" @click="goToQuotation">
                    Get Quotation
                  </button>
                </li>
              </ul>

              <button v-if="selectedLevel!=='country'" 
                class="btn btn-outline-secondary mt-3"
                @click="selectedLevel='country'; selectedCountry=null; selectedCity=null; zoomTo([20,0],3)">
                ← Back
              </button>
            </div>
          </div>
        </div>
      </div>


    </div>

 


<!-- Garis pembatas -->
<hr class="blue-light mx-auto my-5" />

    <!-- BEGIN PAGE BODY -->
<div class="page-body">
  <div class="container-xl">
    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">
      <div>
        <h2 class="text-primary mb-1 fw-bold"> Global Locations </h2>
        <p class="text-secondary small mb-0">
        Connecting you through our network of international branches and partners.
        </p>
      </div>
      <div>
        <select v-model="filterCountry" class="form-select form-select shadow-sm">
          <option value="">🌍All Countries</option>
          <option v-for="c in data" :key="c.country" :value="c.country">
            {{ c.country }}
          </option>
        </select>
      </div>
    </div>

    <!-- GRID -->
    <div class="row row-cards">
      <div 
        v-for="(agent, i) in paginatedAgents" 
        :key="i"
        class="col-sm-6 col-lg-4"
      >
        <div class="card card-sm shadow-sm hover-shadow transition-all duration-200 border-0">
          <a href="#" class="d-block position-relative" @click.prevent="openImage(agent.image)">
            <img :src="defaultImage" class="card-img-top" style="height:200px; object-fit:cover;" />
            <div class="position-absolute top-0 start-0 m-2 px-2 py-1 bg-primary text-white rounded-pill text-xs" style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 12px; border: none;">
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
              <div class="text-secondary small">
                <!-- <i class="fa-solid fa-phone me-1 text-primary"></i> {{ agent.phone }} -->
              </div>
              <button class="btn btn-outline-primary text-white" @click="goToQuotation"  style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 12px; border: none;">
                Get Quotation
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- LOADING & EMPTY STATES -->
      <div v-if="loading" class="text-center text-secondary py-5">Loading branch gallery...</div>
      <div v-if="!loading && filteredAgents.length === 0" class="text-center text-secondary py-5">
        No branches found.
      </div>
    </div>

    <!-- LOAD MORE BUTTON -->
    <div class="text-center mt-4">
      <button 
        v-if="currentPage * itemsPerPage < filteredAgents.length"
        class="btn btn-outline-primary"
        @click="loadMore">
        Load More
      </button>
    </div>
  </div>
</div>
<!-- END PAGE BODY -->

<!-- Modal Detail -->
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
      <p><i class="fa-solid fa-phone text-primary"></i> {{ activeAgent.phone || 'N/A' }}</p>
      <div class="text-end">
        <button 
          class="btn btn-primary"
          @click="goToQuotation(activeAgent)"
        >
          Get Quotation
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



/* Background gelap */
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

/* Animasi fade-in latar belakang */
@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

/* Efek zoom masuk pada konten */
.modal-animate {
  animation: zoomIn 0.35s ease forwards;
  transform: scale(0.8);
}

@keyframes zoomIn {
  from { transform: scale(0.8); opacity: 0; }
  to { transform: scale(1); opacity: 1; }
}

/* Tambahkan sedikit bayangan pada gambar */
.modal-image {
  box-shadow: 0 0 25px rgba(0, 0, 0, 0.5);
  border-radius: 1rem;
  transition: transform 0.25s ease;
}

.modal-image:hover {
  transform: scale(1.03);
}



.blue-light {
  border: 0;
  height: 3px;
  background: linear-gradient(90deg, #007bff, #00bfff);
  width: 80%;
  border-radius: 2px;
}

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
</style>