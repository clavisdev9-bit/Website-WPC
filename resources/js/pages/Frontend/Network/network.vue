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
                        <div class="text-center">
                          <!-- ✅ semua pakai defaultImage -->
                          <img :src="defaultImage" alt="Agent" width="100" class="rounded mb-2 border">
                          <div><b>{{ agent.name }}</b></div>
                          <small>{{ agent.city }}</small>
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
              <h5 class="mb-0 text-primary">List Agents</h5>
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
                    <!-- ✅ semua pakai defaultImage -->
                    <img :src="defaultImage" alt="" width="40" height="40" class="rounded-circle me-2 border">
                    <span :class="{ 'text-primary fw-bold': activeAgent && activeAgent.id === agent.id }">
                      {{ agent.name }}
                    </span>
                  </div>

                  <button class="btn btn-outline-primary btn-sm" @click="goToQuotation">
                    Get Quote
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

      <!-- MODAL GAMBAR -->
      <div v-if="showModal" class="modal fade show d-block" style="background:rgba(0,0,0,0.6)" @click.self="showModal=false">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <img :src="defaultImage" class="img-fluid rounded">
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
</style>
