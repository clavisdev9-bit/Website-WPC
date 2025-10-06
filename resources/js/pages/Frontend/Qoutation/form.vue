<template>
  <FrontendLayout>
    <div class="bg-light py-5">
      <div class="container">
        <div class="card shadow-lg border-0 rounded-3">
          <div class="card-body p-4">

            <!-- Tabs -->
            <ul class="nav nav-tabs mb-4" id="quotationTabs" role="tablist">
              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#quotation" type="button">
                  <i class="fa fa-file-invoice me-1"></i> Quotation
                </button>
              </li>
              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#point-to-point" type="button">
                  <i class="fa fa-route me-1"></i> Point to Point
                </button>
              </li>
              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tracking" type="button">
                  <i class="fa fa-search-location me-1"></i> Tracking
                </button>
              </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content">
              
              <!-- Quotation -->
              <div class="tab-pane fade show active" id="quotation">
                <div class="p-3">
                  <h4 class="fw-bold text-primary mb-4">Request Quotation</h4>

                  <form @submit.prevent="submitQuote">
                    <!-- Personal Information -->
                    <h5 class="fw-bold text-primary mb-3">
                      Personal Information <i class="fa fa-user"></i>
                    </h5>
                     <div class="row">

                     <div class="col-md-6 mb-3">
                      <label class="form-label fw-bold">
                        Who are you? <span class="text-danger">*</span>
                      </label>
                        <Multiselect
                          v-model="selectedBusinessType"
                          :options="businessTypes"
                          track-by="value"
                          label="label"
                          placeholder="Who are you"
                        />
                      </div>

                  <!-- if pilih "I am a business" -->
                  <div class="col-md-6 mb-3" v-if="selectedBusinessType?.value === 'I am a business'">
                    <label class="form-label">Company Name / Full Name</label>
                    <input type="text" class="form-control" placeholder="Enter company name" v-model="fullnameOrCompanyName">
                  </div>

                  <!-- if pilih "I am a freight forwarder" -->
                  <div class="col-md-6 mb-3" v-if="selectedBusinessType?.value === 'I am a freight forwarder'">
                    <label class="form-label">Forwarder Name</label>
                    <input type="text" class="form-control" placeholder="Enter forwarder name" v-model="fullnameOrCompanyName">
                  </div>


                    </div> 

                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Phone</label>
                        <div class="input-group">
                          <Multiselect
                            v-model="selectedPhoneType"
                            :options="phoneTypes"
                            track-by="value"
                            label="label"
                            placeholder="Select type"
                            style="max-width:150px;"
                          />
                          <input type="text" class="form-control" placeholder="Enter your phone number" v-model="phone">
                        </div>
                      </div>


                      <div class="col-md-6 mb-3">
                          <label class="form-label">Email</label>
                          <div class="input-group">
                            <Multiselect
                              v-model="selectedEmailType"
                              :options="emailTypes"
                              track-by="value"
                              label="label"
                              placeholder="Select type"
                              style="max-width:150px;"
                            />
                            <input type="email" class="form-control" placeholder="Enter your email" v-model="email">
                          </div>
                        </div>
                    </div>

                    <div class="row">


                    <div class="col-md-6 mb-3">
                      <label class="form-label fw-bold">Country <span class="text-danger">*</span></label>
                      <Multiselect
                        v-model="selectedCountry"
                        :options="quotationStore.dataCountry"
                        :track-by="'id'"
                        :label="'name'"
                        placeholder="Select Country"
                        :custom-label="country => `${country.name} (${country.code})`"
                      />
                      <div v-if="quotationStore.error" class="text-danger mt-1">
                        Error: {{ quotationStore.error }}
                      </div>
                  </div>
                     

                    <div class="col-md-6 mb-3">
                      <label class="form-label fw-bold">
                        State <span class="text-danger">*</span>
                      </label>
                      <Multiselect
                        v-model="selectedState"
                        :options="quotationStore.dataState"
                        track-by="id"
                        label="name"
                        placeholder="Select State"
                        :custom-label="state => `${state.name}`"
                      />
                    </div>


                      
                    </div>

                    <!-- Cargo Details -->
                    <h5 class="fw-bold text-primary mt-4 mb-3">
                      Cargo Details <i class="fa fa-box"></i>
                    </h5>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Terms & Conditions</label>
                        <textarea
                          v-model="termsCondition"
                          class="form-control"
                          placeholder="Enter Your terms & conditions example Pieces, weights, dimensions, special handling or etc..."
                          rows="4"
                        ></textarea>
                      </div>

                    <div class="row">
                      <div class="col-md-4 mb-3">
                        <label class="form-label">Pieces</label>
                        <input type="number" class="form-control" placeholder="e.g. 10">
                      </div>
                      <div class="col-md-4 mb-3">
                        <label class="form-label">Weight (kg)</label>
                        <input type="number" class="form-control" placeholder="e.g. 500">
                      </div>
                      <div class="col-md-4 mb-3">
                        <label class="form-label">Volume (CBM)</label>
                        <input type="number" class="form-control" placeholder="e.g. 2.5">
                      </div>
                    </div>

                    <!-- Route -->
                    <h5 class="fw-bold text-primary mt-4 mb-3">
                      Route <i class="fa fa-route"></i>
                    </h5>

                    <div class="row">

                    <div class="col-md-6 mb-3">
                      <label class="form-label fw-bold">
                        Transportation Method <span class="text-danger">*</span>
                      </label>
                      <Multiselect
                        v-model="selectedTransportation1"
                        :options="transportationMethods"
                        track-by="value"
                        label="label"
                        placeholder="Select method"
                      />
                    </div>



                      <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Origin</label>
                       <Multiselect
                          v-model="selectedPickupOrigin"
                          :options="quotationStore.dataPickupOrigins"
                          track-by="id"
                          label="name"
                          placeholder="Select Origin"
                        />
                      </div>


                      <div class="col-md-6 mb-3">
                      <label class="form-label fw-bold">
                      Transportation Method <span class="text-danger">*</span>
                      </label>
                      <Multiselect
                        v-model="selectedTransportation2"
                        :options="transportationMethods"
                        track-by="value"
                        label="label"
                        placeholder="Select method"
                      />
                    </div>

                      
                      <div class="col-md-6 mb-3">
                        <label class="form-label">Destination</label>
                        <Multiselect
                          v-model="selectedPickupDestination"
                          :options="quotationStore.dataPickupDestinations"
                          track-by="id"
                          label="name"
                          placeholder="Select Destination"
                        />
                      </div>
                    </div>

                    <div class="text-end mt-3">
                     <button type="reset" class="btn btn-primary me-2"  @click="resetForm"
                            style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 12px; border: none;">
                      <i class="fa fa-eraser"></i> Clear
                     </button>

                      
                     <button type="submit" class="btn btn-primary" 
                            style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 12px; border: none;">
                      <i class="fa fa-paper-plane"></i> Request Quotation
                    </button>

                    </div>
                  </form>
                </div>
              </div>



               <!-- Point to Point Tab -->
                        <div class="tab-pane fade" id="point-to-point" role="tabpanel">
                            <div class="card shadow-sm p-4">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h4 class="fw-bold">Point to Point Search</h4>
                                    <div>
                                        <button class="btn btn-outline-secondary btn-sm">List</button>
                                        <button class="btn btn-outline-secondary btn-sm">Calendar</button>
                                    </div>
                                </div>

                                <form>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Origin</label>
                                            <input type="text" class="form-control" placeholder="Input up to 3 Origins">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Destination</label>
                                            <input type="text" class="form-control" placeholder="Input up to 3 Destinations">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Date</label>
                                            <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Next</label>
                                            <select class="form-select">
                                                <option>1 Week</option>
                                                <option selected>2 Weeks</option>
                                                <option>1 Month</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Cargo Type</label>
                                            <select class="form-select">
                                                <option>Dry/General</option>
                                                <option>Reefer</option>
                                                <option>Dangerous Goods</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="humanCheck">
                                            <label class="form-check-label" for="humanCheck">I am human</label>
                                        </div>
                                    </div>

                                    <div class="text-end mt-3">
                                        <button type="reset" class="btn btn-secondary me-1" style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 12px; border: none;">Clear</button>
                                        <button type="submit" class="btn btn-primary" style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 12px; border: none;">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>



                         <!-- Tracking Tab -->
                        <div class="tab-pane fade" id="tracking" role="tabpanel">
                            <div class="card shadow-sm p-4">
                                <h4 class="fw-bold mb-3">Track Your Shipment</h4>
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label">Tracking Number / Container Number</label>
                                        <input type="text" class="form-control" placeholder="Enter your tracking number">
                                    </div>
                                    <button type="submit" class="btn btn-primary" style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 12px; border: none;">Track Now</button>
                                </form>
                            </div>
                        </div>
            
            </div>
          </div>
        </div>
      </div>
    </div>
  </FrontendLayout>
</template>

<script setup>
import FrontendLayout from "../../../layouts/FrontendLayout.vue";
import { ref, onMounted, computed, watch} from "vue";
import Multiselect from 'vue-multiselect';
import 'vue-multiselect/dist/vue-multiselect.min.css';
import { useQuotation } from '@/store/qoutation'
import { useToast } from 'vue-toastification'
const toast = useToast();
const fullName = ref("");
const company = ref("");
const email = ref("");
const phone = ref("");

const quotationStore = useQuotation();
const selectedCountry = ref(null);
const selectedState = ref(null);
const selectedEmailType = ref(null);
const selectedPhoneType = ref(null);
const selectedTransportation1 = ref(null); 
const selectedTransportation2 = ref(null);

const selectedPickupOrigin = ref(null);
const selectedPickupDestination = ref(null);

const selectedBusinessType = ref(null);
const fullnameOrCompanyName = ref("");
const termsCondition = ref("")

const businessTypes = [
  { value: "I am a business", label: "I am a business" },
  { value: "I am a freight forwarder", label: "I am a freight forwarder" }
];


// for static email type
const emailTypes = [
  { value: "personal", label: "Personal" },
  { value: "company", label: "Company" },
  { value: "office", label: "Office" },
  { value: "other", label: "Other" }
];

// for static phone number type
const phoneTypes = [
  { value: "personal", label: "Personal" },
  { value: "office", label: "Office" },
  { value: "whatsapp", label: "WhatsApp" },
  { value: "other", label: "Other" }
];

// for transpor metode 
const transportationMethods = [
  { value: "Air", label: "Air" },
  { value: "Ocean", label: "Ocean" }
];

// for country
onMounted(() => {
  quotationStore.fetchCountries();
});

//   for state
watch(selectedCountry, (newCountry) => {
  if (newCountry) {
    quotationStore.fetchStatesByCountry(newCountry.id);
    selectedState.value = null; // reset state kalau ganti country
  } else {
    quotationStore.dataState = [];
    selectedState.value = null;
  }
});


// Watch Transportation -> fetch origins
watch(selectedTransportation1, (newVal) => {
  if (newVal) {
    quotationStore.fetchPickupOrigins(newVal.value);
    selectedPickupOrigin.value = null; // reset origin kalau transportasi ganti
  } else {
    quotationStore.dataPickupOrigins = [];
    selectedPickupOrigin.value = null;
  }
});

// Watch Transportation2 -> fetch destinations
watch(selectedTransportation2, (newVal) => {
  if (newVal) {
    quotationStore.fetchPickupDestinations(newVal.value);
    selectedPickupDestination.value = null; // reset kalau transportasi ganti
  } else {
    quotationStore.dataPickupDestinations = [];
    selectedPickupDestination.value = null;
  }
});


const submitQuote = async () => {
  try {
    const payload = {
      name: fullnameOrCompanyName.value,
      email: email.value,
      phone: phone.value,
      x_studio_your_business: selectedBusinessType.value?.value || null,  
      country_id: selectedCountry.value?.id,
      state_id: selectedState.value?.id,
      pickup_origin_id: selectedPickupOrigin.value?.id,
      pickup_destination_id: selectedPickupDestination.value?.id,
      terms_condition: termsCondition.value,
      transportation_method: selectedTransportation1.value?.value,
    };

    const res = await quotationStore.createQuote(payload);
    // alert("Quote created successfully: " + res.data.sales_order.name);
    // Toast sukses
    toast.success(`Quote created successfully & Your Code Request: ${res.data.sales_order.name}`, {
      timeout: 4000,
      position: 'top-right',
      style: {
        background: '#007bff', // biru
        color: '#fff'
      }
    });

  } catch (err) {
    // alert("Failed to create quote: " + err.message);
    // Toast error
    toast.error(`Failed to create quote: ${err.message}`, {
      timeout: 4000,
      position: 'top-right'
    });
  }
};

// button reset
const resetForm = () => {
  fullnameOrCompanyName.value = "";
  email.value = "";
  phone.value = "";
  selectedBusinessType.value = null;
  selectedCountry.value = null;
  selectedState.value = null;
  selectedPickupOrigin.value = null;
  selectedPickupDestination.value = null;
  selectedTransportation1.value = null;
  selectedTransportation2.value = null;
  termsCondition.value = "";
};



</script>
