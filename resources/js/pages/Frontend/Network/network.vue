<script setup>
import { LMap, LTileLayer, LMarker, LPopup } from "@vue-leaflet/vue-leaflet"
import FrontendLayout from '../../../layouts/FrontendLayout.vue'
import "leaflet/dist/leaflet.css"
import { ref } from 'vue'

const defaultImage = "/branch.jpg"

// ============================
// DATA: Negara -> Kota -> Agent
// ============================
const data = [
  {
    country: "Indonesia",
    position: [-2.5489, 118.0149],
    cities: [
      {
        city: "Jakarta",
        position: [-6.200, 106.816],
        agents: [
          { name: "Jakarta Agent 1", position: [-6.200, 106.816] },
          { name: "Jakarta Agent 2", position: [-6.210, 106.830] },
          { name: "Jakarta Agent 3", position: [-6.220, 106.845] }
        ]
      },
      {
        city: "Surabaya",
        position: [-7.250, 112.738],
        agents: [
          { name: "Surabaya Agent 1", position: [-7.250, 112.738] },
          { name: "Surabaya Agent 2", position: [-7.255, 112.740] }
        ]
      },
      {
        city: "Bali",
        position: [-8.650, 115.216],
        agents: [
          { name: "Bali Agent 1", position: [-8.650, 115.216] },
          { name: "Bali Agent 2", position: [-8.655, 115.220] }
        ]
      }
    ]
  },
  {
    country: "Japan",
    position: [36.2048, 138.2529],
    cities: [
      {
        city: "Tokyo",
        position: [35.6895, 139.6917],
        agents: [
          { name: "Tokyo Agent 1", position: [35.6895, 139.6917] },
          { name: "Tokyo Agent 2", position: [35.6938, 139.7034] }
        ]
      }
    ]
  },
  {
    country: "France",
    position: [46.603354, 1.888334],
    cities: [
      {
        city: "Paris",
        position: [48.8566, 2.3522],
        agents: [
          { name: "Paris Agent 1", position: [48.8566, 2.3522] },
          { name: "Paris Agent 2", position: [48.864716, 2.349014] }
        ]
      }
    ]
  },
  {
    country: "USA",
    position: [37.0902, -95.7129],
    cities: [
      {
        city: "New York",
        position: [40.7128, -74.0060],
        agents: [
          { name: "New York Agent 1", position: [40.7128, -74.0060] },
          { name: "New York Agent 2", position: [40.730610, -73.935242] }
        ]
      }
    ]
  },
  {
    country: "South Africa",
    position: [-30.5595, 22.9375],
    cities: [
      {
        city: "Cape Town",
        position: [-33.9249, 18.4241],
        agents: [
          { name: "Cape Town Agent 1", position: [-33.9249, 18.4241] },
          { name: "Cape Town Agent 2", position: [-33.9300, 18.4100] }
        ]
      }
    ]
  }
].map(country => ({
  ...country,
  cities: country.cities.map(city => ({
    ...city,
    agents: city.agents.map(a => ({ ...a, image: defaultImage }))
  }))
}))

const mapRef = ref(null)
const zoomLevel = ref(3)
const selectedLevel = ref("country")
const selectedCountry = ref(null)
const selectedCity = ref(null)

// klik negara
const goToCountry = (country) => {
  selectedCountry.value = country
  selectedLevel.value = "city"
  zoomTo(country.position, 5)
}

// klik kota
const goToCity = (city) => {
  selectedCity.value = city
  selectedLevel.value = "agent"
  zoomTo(city.position, 8)
}

// klik agent
const goToAgent = (agent) => {
  zoomTo(agent.position, 12)
}

// redirect ke quotation
const goToQuotation = () => {
  window.location.href = "/wpc-esys/form-qoutation";
}

const zoomTo = (pos, zoom) => {
  mapRef.value?.mapObject?.setView(pos, zoom)
}

const showModal = ref(false)
const selectedImage = ref("")
const openImage = (img) => {
  selectedImage.value = img
  showModal.value = true
}
</script>

<template>
  <FrontendLayout>
    <div class="container-xl mt-4">
      <div class="row">
        <!-- MAP -->
        <div class="col-md-8">
          <div class="card">
            <div class="card-body p-0">
              <LMap ref="mapRef" style="height:500px" :zoom="zoomLevel" :center="[20,0]">
                <LTileLayer url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png" />

                <!-- Negara -->
                <template v-if="selectedLevel==='country'">
                  <LMarker 
                    v-for="(country,i) in data" :key="i" :lat-lng="country.position" 
                    @click="goToCountry(country)"
                  >
                    <LPopup>
                      <b>{{ country.country }}</b> ({{ country.cities.length }} cities)
                    </LPopup>
                  </LMarker>
                </template>

                <!-- Kota -->
                <template v-else-if="selectedLevel==='city'">
                  <LMarker 
                    v-for="(city,i) in selectedCountry.cities" :key="i" :lat-lng="city.position"
                    @click="goToCity(city)"
                  >
                    <LPopup>
                      <b>{{ city.city }}</b> ({{ city.agents.length }} agents)
                    </LPopup>
                  </LMarker>
                </template>

                <!-- Agent -->
                <template v-else-if="selectedLevel==='agent'">
                  <LMarker 
                    v-for="(agent,i) in selectedCity.agents" :key="i" :lat-lng="agent.position"
                    @click="goToAgent(agent)"
                  >
                    <LPopup>
                      <div class="text-center">
                        <h6>{{ agent.name }}</h6>
                        <img :src="agent.image" class="img-fluid rounded mb-2" style="max-width:120px"
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

        <!-- LIST SIDEBAR / TABEL -->
        <div class="col-md-4">
          <div class="card">
            <div class="card-header"><h5 class="mb-0 text-primary">List Agents</h5></div>
            <div class="card-body">
              <ul class="list-group">
                <!-- Negara -->
                <li v-if="selectedLevel==='country'" v-for="(country,i) in data" :key="i"
                  class="list-group-item" @click="goToCountry(country)" style="cursor:pointer">
                  {{ country.country }} ({{ country.cities.length }} cities)
                </li>

                <!-- Kota -->
                <li v-if="selectedLevel==='city'" v-for="(city,i) in selectedCountry.cities" :key="i"
                  class="list-group-item" @click="goToCity(city)" style="cursor:pointer">
                  {{ city.city }} ({{ city.agents.length }} agents)
                </li>

                <!-- Agent -->
                <li v-if="selectedLevel==='agent'" v-for="(agent,i) in selectedCity.agents" :key="i"
                  class="list-group-item d-flex justify-content-between align-items-center">
                  <span @click="goToAgent(agent)" style="cursor:pointer">{{ agent.name }}</span>
                  <button class="btn btn-sm btn-outline-primary" @click="goToQuotation">Get Quote</button>
                </li>
              </ul>

              <button v-if="selectedLevel!=='country'" class="btn btn-sm btn-outline-secondary mt-3"
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


     <div class="page-wrapper">
        <!-- BEGIN PAGE HEADER -->
        <div class="page-header d-print-none" aria-label="Page header">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
               <h2 class="page-title text-primary">Our Branch Gallery</h2>
                    <div class="text-secondary mt-1 text-primary">
                    Discover our global network of offices and trusted partners around the world.
                    </div>
              </div>
              <!-- Page title actions -->
            </div>
          </div>
        </div>
        <!-- END PAGE HEADER -->
        <!-- BEGIN PAGE BODY -->
        <div class="page-body">
          <div class="container-xl">
            <div class="row row-cards">
              <div class="col-sm-6 col-lg-4">
                <div class="card card-sm">
                  <a href="#" class="d-block"
                    ><img :src="defaultImage" class="card-img-top"
                  /></a>
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                      <span class="avatar avatar-2 me-3 rounded"> <i class="fa-solid fa-map-location-dot"></i></span>
                      <div>
                        <div>Jakarta 1</div>
                        <div class="text-secondary">08.00-22.00 WIB</div>
                      </div>
                      <div class="ms-auto">
                        <a href="#" class="text-secondary">
                           <i class="fas fa fa-eye"></i>
                          Total Visit 600 / Month
                        </a>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-sm-6 col-lg-4">
                <div class="card card-sm">
                  <a href="#" class="d-block"><img :src="defaultImage" class="card-img-top" /></a>
                  <div class="card-body">
                     <div class="d-flex align-items-center">
                      <span class="avatar avatar-2 me-3 rounded"> <i class="fa-solid fa-map-location-dot"></i></span>
                      <div>
                        <div>Jakarta 2</div>
                        <div class="text-secondary">08.00-22.00 WIB</div>
                      </div>
                      <div class="ms-auto">
                        <a href="#" class="text-secondary">
                           <i class="fas fa fa-eye"></i>
                          Total Visit 467 / Month
                        </a>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>



              <div class="col-sm-6 col-lg-4">
                <div class="card card-sm">
                  <a href="#" class="d-block"><img :src="defaultImage" class="card-img-top" /></a>
                  <div class="card-body">
                    <div class="d-flex align-items-center">
                       <span class="avatar avatar-2 me-3 rounded"> <i class="fa-solid fa-map-location-dot"></i></span>
                      <div>
                        <div>Jakarta 3</div>
                        <div class="text-secondary">08.00-22.00 WIB</div>
                      </div>
                      <div class="ms-auto">
                        <a href="#" class="text-secondary">
                           <i class="fas fa fa-eye"></i>
                          Total Visit 100 / Month
                        </a>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              </div>
              </div>
              </div>
              </div>




  </FrontendLayout>
</template>
