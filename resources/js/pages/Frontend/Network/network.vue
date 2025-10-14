<script setup>
import { ref, onMounted, computed, watch } from 'vue'
import axios from 'axios'
import { LMap, LTileLayer, LMarker, LPopup } from "@vue-leaflet/vue-leaflet"
import FrontendLayout from '../../../layouts/FrontendLayout.vue'
import "leaflet/dist/leaflet.css"

const defaultImage = "/images/footer_works.jpg"

// ============================
// STATE
// ============================
const mapRef = ref(null)
const zoomLevel = ref(3)
const selectedLevel = ref("country")
const selectedCountry = ref(null)
const selectedCity = ref(null)
const showModal = ref(false)
const selectedImage = ref("")

// ============================
// DATA DARI API
// ============================
const data = ref([]) // struktur: [ { country, cities: [ { city, agents: [...] } ] } ]
const loading = ref(true)
const error = ref(null)

// Ambil data dari API dan bentuk struktur nested
const fetchData = async () => {
  try {
    const res = await axios.get("http://127.0.0.1:8000/api/Agents/Network")
    const agents = res.data.data.data

    // Group by country -> city -> agent
    const grouped = Object.values(
      agents.reduce((acc, item) => {
        if (!acc[item.name_country]) {
          acc[item.name_country] = {
            country: item.name_country,
            position: [parseFloat(item.lat), parseFloat(item.lng)], // sementara ambil dari agent pertama
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
          image: item.image || defaultImage
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
// MAP FUNCTION
// ============================
const zoomTo = (pos, zoom) => {
  mapRef.value?.mapObject?.setView(pos, zoom)
}

const goToCountry = (country) => {
  selectedCountry.value = country
  selectedLevel.value = "city"
  zoomTo(country.position, 5)
}

const goToCity = (city) => {
  selectedCity.value = city
  selectedLevel.value = "agent"
  zoomTo(city.position, 8)
}

const goToAgent = (agent) => {
  zoomTo(agent.position, 12)
}

const goToQuotation = () => {
  window.location.href = "/wpc-esys/qoutation-request"
}

const openImage = (img) => {
  selectedImage.value = img
  showModal.value = true
}


// ==============================
// PAGINATION UNTUK LIST AGENTS PANEL
// ==============================
const agentListItemsPerPage = ref(10)
const agentListCurrentPage = ref(1)

// Negara
const paginatedAgentCountries = computed(() => {
  if (selectedLevel.value !== 'country') return []
  const start = (agentListCurrentPage.value - 1) * agentListItemsPerPage.value
  return data.value.slice(start, start + agentListItemsPerPage.value)
})

// Kota
const paginatedAgentCities = computed(() => {
  if (selectedLevel.value !== 'city' || !selectedCountry.value) return []
  const start = (agentListCurrentPage.value - 1) * agentListItemsPerPage.value
  return selectedCountry.value.cities.slice(start, start + agentListItemsPerPage.value)
})

// Agent
const paginatedAgentRecords = computed(() => {
  if (selectedLevel.value !== 'agent' || !selectedCity.value) return []
  const start = (agentListCurrentPage.value - 1) * agentListItemsPerPage.value
  return selectedCity.value.agents.slice(start, start + agentListItemsPerPage.value)
})

// Pagination control
const nextAgentListPage = () => {
  agentListCurrentPage.value++
}

const resetAgentListPagination = () => {
  agentListCurrentPage.value = 1
}

// Reset otomatis setiap ganti level, negara, atau kota
watch(selectedLevel, resetAgentListPagination)
watch(selectedCountry, resetAgentListPagination)
watch(selectedCity, resetAgentListPagination)





// Fetch saat komponen siap
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
                <LMap ref="mapRef" style="height:500px" :zoom="zoomLevel" :center="[20,0]">
                  <LTileLayer url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png" />

                  <!-- Negara -->
                  <template v-if="selectedLevel==='country'">
                    <LMarker 
                      v-for="(country,i) in data" :key="i" :lat-lng="country.position" 
                      @click="goToCountry(country)">
                      <LPopup>
                        <b>{{ country.country }}</b> ({{ country.cities.length }} cities)
                      </LPopup>
                    </LMarker>
                  </template>

                  <!-- Kota -->
                  <template v-else-if="selectedLevel==='city'">
                    <LMarker 
                      v-for="(city,i) in selectedCountry.cities" :key="i" :lat-lng="city.position"
                      @click="goToCity(city)">
                      <LPopup>
                        <b>{{ city.city }}</b> ({{ city.agents.length }} agents)
                      </LPopup>
                    </LMarker>
                  </template>

                  <!-- Agent -->
                  <template v-else-if="selectedLevel==='agent'">
                    <LMarker 
                      v-for="(agent,i) in selectedCity.agents" :key="i" :lat-lng="agent.position"
                      @click="goToAgent(agent)">
                      <LPopup>
                        <div class="text-center">
                          <h6>{{ agent.name }}</h6>
                          <img :src="defaultImage" class="img-fluid rounded mb-2" style="max-width:120px"
                            @click="openImage(agent.image)" />
                          <div>
                            <button class="btn btn-sm btn-primary w-100" @click="goToQuotation">
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
              <h5 class="mb-0 text-primary">List Agents</h5>
            </div>
            <div class="card-body">


             <ul class="list-group">
  <!-- Negara -->
  <li v-if="selectedLevel==='country'" 
      v-for="(country, i) in paginatedAgentCountries" :key="`country-${i}`"
      class="list-group-item" 
      @click="goToCountry(country)" 
      style="cursor:pointer">
    {{ country.country }} ({{ country.cities.length }} cities)
  </li>

  <!-- Kota -->
  <li v-if="selectedLevel==='city'" 
      v-for="(city, i) in paginatedAgentCities" :key="`city-${i}`"
      class="list-group-item" 
      @click="goToCity(city)" 
      style="cursor:pointer">
    {{ city.city }} ({{ city.agents.length }} agents)
  </li>

  <!-- Agent -->
  <li v-if="selectedLevel==='agent'" 
      v-for="(agent, i) in paginatedAgentRecords" :key="`agent-${i}`"
      class="list-group-item d-flex justify-content-between align-items-center">
    <span @click="goToAgent(agent)" style="cursor:pointer">{{ agent.name }}</span>
    <button class="btn btn-outline-primary" @click="goToQuotation">
      Get Quote
    </button>
  </li>
</ul>

<!-- Tombol Load More -->
<div v-if="selectedLevel==='country' && data.length > agentListCurrentPage * agentListItemsPerPage" class="text-center mt-3">
  <button class="btn btn-outline-primary w-100" @click="nextAgentListPage">
    Load More Countries
  </button>
</div>

<div v-if="selectedLevel==='city' && selectedCountry.cities.length > agentListCurrentPage * agentListItemsPerPage" class="text-center mt-3">
  <button class="btn btn-sm btn-outline-primary w-100" @click="nextAgentListPage" style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 12px; border: none;">
    Load More Cities
  </button>
</div>

<div v-if="selectedLevel==='agent' && selectedCity.agents.length > agentListCurrentPage * agentListItemsPerPage" class="text-center mt-3">
  <button class="btn btn-sm btn-outline-primary w-100" @click="nextAgentListPage">
    Load More Agents
  </button>
</div>




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

    <!-- Modal Image -->
    <div class="modal fade" :class="{ show: showModal }" v-show="showModal">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body p-0">
            <img :src="selectedImage" class="img-fluid w-100"/>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" @click="showModal=false">Close</button>
          </div>
        </div>
      </div>
      <div class="modal-backdrop fade show" @click="showModal=false"></div>
    </div>


   <hr>


    <!-- BEGIN PAGE BODY -->
<div class="page-body">
  <div class="container-xl">
    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">
      <div>
        <h4 class="text-primary mb-1 fw-bold">Our Branch Gallery</h4>
        <p class="text-secondary small mb-0">
          Discover our global network of offices and trusted partners around the world.
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
                Get Quote
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
