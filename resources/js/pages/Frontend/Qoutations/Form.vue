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
                  <i class="fa fa-file-invoice me-1"></i> {{ $t("quotationForm.tabs.form") }}
                </button>
              </li>
              
              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tracking" type="button">
                  <i class="fa fa-search-location me-1"></i> {{ $t("quotationForm.tabs.tracking") }}
                </button>
              </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content">
              
              <!-- Quotation -->
              <div class="tab-pane fade show active" id="quotation">
                <div class="p-3">

                    <ul class="stepper justify-content-center mb-4">
                      <li
                        v-for="(step, index) in steps"
                        :key="index"
                        class="step-item"
                        :class="{ active: currentStep === index, completed: currentStep > index }"
                        @click="goToStep(index)"
                      >
                        <div class="step-circle">{{ index + 1 }}</div>
                        <div class="step-label">{{ $t(`quotationForm.steps.${step}`) }}</div>
                      </li>
                    </ul>



                  <form @submit.prevent="submitQuote">

                    <!-- STEP 1: Personal Information -->
                    <div v-if="currentStep === 0">
                      <h3 class="fw-bold text-primary mb-3 mt-2">
                        {{ $t("quotationForm.steps.personalInfo") }}<i class="fa fa-user"></i>
                      </h3>
                      <div class="row">
                        <div class="col-md-6 mb-3">
                          <label class="form-label fw-bold">{{ $t("quotationForm.labels.whoAreYou") }} <span class="text-danger">*</span></label>
                          <Multiselect
                            v-model="selectedBusinessType"
                            :options="businessTypes"
                            track-by="value"
                            label="label"
                            :placeholder="$t('quotationForm.placeholders.whoAreYou')"
                            @close="validateField('selectedBusinessType')" 
                            :class="errors.selectedBusinessType ? 'is-invalid' : ''"
                          />
                          <small class="text-danger">{{ errors.selectedBusinessType }}</small>
                        </div>

                        <div class="col-md-6 mb-3" v-if="selectedBusinessType?.value === 'I am a business'">
                          <label class="form-label">{{ $t("quotationForm.labels.companyName") }}</label>
                          <input type="text" 
                          :class="['form-control', errors.fullnameOrCompanyName ? 'is-invalid' : '']" 
                          :placeholder=" $t('quotationForm.placeholders.companyName') " 
                          v-model="fullnameOrCompanyName">
                          <small class="text-danger">{{ errors.fullnameOrCompanyName }}</small>
                        </div>

                        <div class="col-md-6 mb-3" v-if="selectedBusinessType?.value === 'I am a freight forwarder'">
                          <label class="form-label">{{ $t("quotationForm.labels.forwarderName") }}</label>
                          <input type="text"
                           :class="['form-control', errors.fullnameOrCompanyName ? 'is-invalid' : '']" 
                           :placeholder="$t('quotationForm.placeholders.forwarderName')" 
                           v-model="fullnameOrCompanyName">
                            <small class="text-danger">{{ errors.fullnameOrCompanyName }}</small>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6 mb-3">
                          <label class="form-label">{{ $t("quotationForm.labels.phone") }} <small class="text-danger">*</small></label>
                          <div class="input-group">
                            <Multiselect
                              v-model="selectedPhoneType"
                              :options="phoneTypes"
                              track-by="value"
                              label="label"
                              :placeholder="$t('quotationForm.placeholders.phoneType')"
                              style="max-width:150px;"
                              @close="validateField('selectedPhoneType')"
                              @select="validateField('selectedPhoneType')"
                              :class="errors.selectedPhoneType ? 'is-invalid' : ''"
                            />
                            <input type="text" 
                            @blur="validateField('phone')"
                            :class="['form-control', errors.phone ? 'is-invalid' : '']"
                             :placeholder="$t('quotationForm.placeholders.phone')" 
                             v-model="phone">
                          </div>
                           <small class="text-danger" v-if="errors.selectedPhoneType">{{ errors.selectedPhoneType }}</small><br v-if="errors.selectedPhoneType && errors.phone">
                           <small class="text-danger">{{ errors.phone }}</small>
                        </div>



                        <div class="col-md-6 mb-3">
                          <label class="form-label">{{ $t("quotationForm.labels.email") }} <small class="text-danger">*</small></label>
                          <div class="input-group">
                            <Multiselect
                              v-model="selectedEmailType"
                              :options="emailTypes"
                              track-by="value"
                              label="label"
                              :placeholder="$t('quotationForm.placeholders.emailType')"
                              style="max-width:150px;"
                              @close="validateField('selectedEmailType')"
                              @select="validateField('selectedEmailType')"
                              :class="errors.selectedEmailType ? 'is-invalid' : ''"
                            />
                            <input type="email" 
                            class="form-control" 
                            :placeholder="$t('quotationForm.placeholders.email')" 
                            v-model="email"
                            @blur="validateField('email')"
                            :class="['form-control', errors.email ? 'is-invalid' : '']"
                            >
                          </div>
                          <small class="text-danger">{{ errors.email }}</small>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6 mb-3">
                          <label class="form-label fw-bold">{{ $t("quotationForm.labels.country") }} <span class="text-danger">*</span></label>
                          <Multiselect
                            v-model="selectedCountry"
                            :options="quotationStore.dataCountry"
                            :track-by="'id'"
                            :label="'name'"
                            :placeholder="$t('quotationForm.placeholders.country')"
                            :custom-label="country => `${country.name} (${country.code})`"
                            @close="validateField('selectedCountry')" 
                            :class="errors.selectedCountry ? 'is-invalid' : ''" 
                          />
                          <small class="text-danger">{{ errors.selectedCountry }}</small>
                        </div>

                        <div class="col-md-6 mb-3">
                          <label class="form-label fw-bold">{{ $t("quotationForm.labels.state") }} <span class="text-danger">*</span></label>
                          <Multiselect
                            v-model="selectedState"
                            :options="quotationStore.dataState"
                            track-by="id"
                            label="name"
                            :placeholder="$t('quotationForm.placeholders.state')"
                            @close="validateField('selectedState')"
                            :class="errors.selectedState ? 'is-invalid' : ''" 
                          />
                          <small class="text-danger">{{ errors.selectedState }}</small>
                        </div>
                      </div>
                    </div>


                    <!-- STEP 2: Cargo Details -->
                    <div v-if="currentStep === 1">
                      <h3 class="fw-bold text-primary mb-3">
                        Cargo Details <i class="fa fa-box"></i>
                      </h3>

                      <div class="row">

                        <div class="col-md-4 mb-3">
                          <label class="form-label">Commodity <small class="text-danger">*</small></label>
                          <Multiselect
                            v-model="selectedCommodity"
                            :options="quotationStore.dataCommodities"
                            track-by="value"
                            label="label"
                            placeholder="Select Commodities"
                            @close="validateField('selectedCommodity')" 
                            @select="validateField('selectedCommodity')"
                            :class="errors.selectedCommodity ? 'is-invalid' : ''"
                          />
                          <small class="text-danger">{{ errors.selectedCommodity }}</small>
                        </div>

                        <div class="col-md-4 mb-3">
                          <label class="form-label">UOM (Unit of Measurement) <small class="text-danger">*</small></label>
                          <Multiselect
                            v-model="selectedUom"
                            :options="quotationStore.dataUoms"
                            track-by="value"
                            label="label"
                            placeholder="Select UOM"
                            @close="validateField('selectedUom')" 
                            @select="validateField('selectedUom')"
                            :class="errors.selectedUom ? 'is-invalid' : ''"
                          />
                          <small class="text-danger">{{ errors.selectedUom }}</small>
                          
                        </div>

                        <!-- Ratio -->
                          <div class="col-md-4 mb-3">
                            <label class="form-label">Ratio <small class="text-danger">* (automatic)</small></label>
                            <input 
                              type="number" 
                              v-model="ratio"
                              step="0.01"
                              :readonly="true"
                              :class="['form-control', errors.ratio ? 'is-invalid' : '']"
                              name="ratio"
                              placeholder="e.g. 1.5"
                            >
                            <small class="text-danger">{{ errors.ratio }}</small>
                          </div>


                        <!-- Quantity -->
                        <div class="col-md-4 mb-3">
                          <label class="form-label">Quantity <small class="text-danger">*</small></label>
                          <input type="number" v-model="qty"
                           :class="['form-control', errors.qty ? 'is-invalid' : '']" 
                            name="qty"
                            placeholder="e.g. 10">
                             <small class="text-danger">{{ errors.qty }}</small>
                        </div>

                        <!-- KGS CHG -->
                        <div class="col-md-4 mb-3">
                          <label class="form-label"> Kilogram Charge (KGS CHG) <small class="text-danger">*</small></label>
                          <input type="number" v-model="kgs_chg"
                             :class="['form-control', errors.kgs_chg ? 'is-invalid' : '']" 
                            name="kgs_chg"
                            placeholder="e.g. 50"
                            >
                             <small class="text-danger">{{ errors.kgs_chg }}</small>
                        </div>

                        <!-- KGS WT -->
                        <div class="col-md-4 mb-3">
                          <label class="form-label">Kilogram Gross Weight (KGS WT) <small class="text-danger">*</small></label>
                          <input type="number"
                           v-model="kgs_wt"
                           :class="['form-control', errors.kgs_wt ? 'is-invalid' : '']"
                           name="kgs_wt" 
                           placeholder="e.g. 75">
                           <small class="text-danger">{{ errors.kgs_wt }}</small>
                        </div>
                      </div>

                      <div class="mb-3">
                        <label class="form-label fw-bold">{{ $t("quotationForm.labels.termsOtherNotes") }} <small class="text-danger">*</small></label>
                        <textarea
                          v-model="termsCondition"
                          :class="['form-control', errors.termsCondition ? 'is-invalid' : '']"
                          :placeholder="$t('quotationForm.placeholders.termsCondition')"
                          rows="4"
                          @blur="validateField('termsCondition')">
                      </textarea>
                       <small class="text-danger">{{ errors.termsCondition }}</small>
                      </div>
                    </div>

                    <!-- STEP 3: Route -->
                    <div v-if="currentStep === 2">
                      <h3 class="fw-bold text-primary mb-3">
                        Route <i class="fa fa-route"></i>
                      </h3> 
                      <div class="row">
                        <div class="col-md-6 mb-3">
                          <label class="form-label fw-bold">{{ $t("quotationForm.labels.transportationMethod") }} <span class="text-danger">*</span></label>
                          <Multiselect
                            v-model="selectedTransportation1"
                            :options="transportationMethods"
                            track-by="value"
                            label="label"
                            :placeholder="$t('quotationForm.labels.transportationMethod')"
                            @close="validateField('selectedTransportation1')" 
                            @select="validateField('selectedTransportation1')"
                            :class="errors.selectedTransportation1 ? 'is-invalid' : ''"
                          />
                          <small class="text-danger">{{ errors.selectedTransportation1 }}</small>
                        </div>

                        <div class="col-md-6 mb-3">
                          <label class="form-label fw-bold">{{ $t("quotationForm.labels.origin") }} <small class="text-danger">*</small></label>
                          <Multiselect
                            v-model="selectedPickupOrigin"
                            :options="quotationStore.dataPickupOrigins"
                            track-by="id"
                            label="name"
                            :placeholder="$t('quotationForm.placeholders.origin')"
                            @close="validateField('selectedPickupOrigin')"
                            @select="validateField('selectedPickupOrigin')"
                            :class="errors.selectedPickupOrigin ? 'is-invalid' : ''"
                          />
                           <small class="text-danger">{{ errors.selectedPickupOrigin }}</small>
                        </div>

                        <div class="col-md-6 mb-3">
                          <label class="form-label fw-bold">{{ $t("quotationForm.labels.transportationMethod") }} <span class="text-danger">*</span></label>
                          <Multiselect
                            v-model="selectedTransportation2"
                            :options="transportationMethods"
                            track-by="value"
                            label="label"
                            :placeholder="$t('quotationForm.labels.transportationMethod')"
                            @close="validateField('selectedTransportation2')" 
                            @select="validateField('selectedTransportation2')"
                            :class="errors.selectedTransportation2 ? 'is-invalid' : ''"
                          />
                          <small class="text-danger">{{ errors.selectedTransportation2 }}</small>
                        </div>

                        <div class="col-md-6 mb-3">
                          <label class="form-label">{{ $t("quotationForm.labels.destination") }} <small class="text-danger">*</small></label>
                          <Multiselect
                            v-model="selectedPickupDestination"
                            :options="quotationStore.dataPickupDestinations"
                            track-by="id"
                            label="name"
                            :placeholder="$t('quotationForm.placeholders.destination')"
                            @close="validateField('selectedPickupDestination')"
                            @select="validateField('selectedPickupDestination')"
                            :class="errors.selectedPickupDestination ? 'is-invalid' : ''"
                          />
                          <small class="text-danger">{{ errors.selectedPickupDestination }}</small>
                        </div>
                      </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="d-flex justify-content-between mt-4">
                      <button
                        type="button"
                        class="btn btn-secondary"
                        v-if="currentStep > 0"
                        @click="prevStep"
                        style="background: linear-gradient(90deg, #6c757d, #495057); border-radius: 12px; border: none;"
                      >
                        <i class="fa fa-arrow-left"></i> {{ $t("quotationForm.buttons.back") }}
                      </button> 

                      <button 
                        type="button"
                        class="btn btn-primary ms-auto"
                        v-if="currentStep < steps.length - 1"
                        @click="nextStep"
                        style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 12px; border: none;"
                      >
                         {{ $t("quotationForm.buttons.next") }} <i class="fa-solid fa-arrow-right"></i>
                      </button>

                      <button
                        type="submit"
                        class="btn btn-success ms-auto"
                        v-if="currentStep === steps.length - 1"
                        style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 12px; border: none;"
                      >
                        <!-- <i class="fa fa-paper-plane"></i> Request Quotation -->
                        <span v-if="!isSubmitting">
                        <i class="fa fa-paper-plane"></i> {{ $t("quotationForm.buttons.submit") }} 
                      </span>
                      <span v-else>
                        <div class="spinner-border spinner-border-sm text-light me-2" role="status"></div>
                          {{ $t("quotationForm.buttons.processing") }}
                      </span>
                      </button>
                    </div>
                  </form>
                </div>
              </div>


              <!-- Tracking Tab -->
              <div class="tab-pane fade" id="tracking" role="tabpanel">
                            <div class="card shadow-sm p-4">
                                <h4 class="fw-bold mb-3">{{ $t("quotationForm.tracking.title") }} </h4>
                                   <div class="alert alert-info ">{{ $t('home.tabs.comingSoon') }}</div>
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label">{{ $t("quotationForm.tracking.label") }}</label>
                                        <input type="text" class="form-control" :placeholder="$t('quotationForm.tracking.placeholder')">
                                    </div>
                                    <button type="submit" class="btn btn-primary" style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 12px; border: none;">{{ $t("quotationForm.tracking.button") }}</button>
                                </form>
              </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

    <div v-if="isSubmitting" class="loading-overlay">
  <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
    <span class="visually-hidden">Loading...</span>
  </div>
</div>
</FrontendLayout>
</template>



 <script setup>
import FrontendLayout from "../../../layouts/FrontendLayout.vue";
import { ref, onMounted, watch } from "vue";
import Multiselect from 'vue-multiselect';
import 'vue-multiselect/dist/vue-multiselect.min.css';
import { useQuotation } from '@/store/qoutation'
import { useToast } from 'vue-toastification'

const toast = useToast();
const quotationStore = useQuotation();

// --- Stepper Control ---
const currentStep = ref(0);
// const steps = ["Personal Information", "Cargo Details", "Route"];
const steps = ['personalInfo', 'cargoDetails', 'route']

// animation spinner
const isSubmitting = ref(false);

// reset form before succes or err
const resetForm = () => {
  fullnameOrCompanyName.value = "";
  email.value = "";
  phone.value = "";
  selectedBusinessType.value = null;
  selectedCountry.value = null;
  selectedState.value = null;
  selectedEmailType.value = null;
  selectedPhoneType.value = null;
  selectedTransportation1.value = null;
  selectedTransportation2.value = null;
  selectedPickupOrigin.value = null;
  selectedPickupDestination.value = null;
  termsCondition.value = "";
  selectedCommodity.value = null;
  selectedUom.value = null;
  ratio.value = "";
  qty.value = "";
  kgs_chg.value = "";
  kgs_wt.value = "";
  currentStep.value = 0; 
};



// --- Form Data ---
const fullnameOrCompanyName = ref("");
const email = ref("");
const phone = ref("");
const selectedBusinessType = ref(null);
const selectedCountry = ref(null);
const selectedState = ref(null);
const selectedEmailType = ref(null);
const selectedPhoneType = ref(null);
const selectedTransportation1 = ref(null); 
const selectedTransportation2 = ref(null);
const selectedPickupOrigin = ref(null);
const selectedPickupDestination = ref(null);
const termsCondition = ref("");
const selectedCommodity = ref(null); 
const selectedUom = ref(null); 
const ratio = ref("");
const qty = ref("");
const kgs_chg = ref("");
const kgs_wt = ref("");


// --- Error per field ---
const errors = ref({
  fullnameOrCompanyName: '',
  email: '',
  phone: '',
  selectedBusinessType: '',
  selectedCountry: '',
  selectedState: '',
  termsCondition: '',
  selectedTransportation1: '',
  selectedTransportation2: '',
  selectedPickupOrigin: '',
  selectedPickupDestination: '',
  ratio: '',
  qty:'',
  kgs_chg:'',
  kgs_wt:'',
});



// untuk Error per field  
const validateField = (name) => {
  switch (name) {
    case 'fullnameOrCompanyName':
      errors.value.fullnameOrCompanyName = fullnameOrCompanyName.value ? '' : 'Name is required';
      break;
    case 'email':
      if (!email.value) errors.value.email = 'Email is required';
      else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) errors.value.email = 'Invalid email format';
      else errors.value.email = '';
      break;
    case 'phone':
      if (!phone.value) {
        errors.value.phone = 'Phone number is required';
      } else if (!/^\+?\d{9,15}$/.test(phone.value)) {
        errors.value.phone = 'Invalid phone number format';
      } else {
        errors.value.phone = '';
      }
      break;
    case 'selectedBusinessType':
      errors.value.selectedBusinessType = selectedBusinessType.value ? '' : 'Select Who Are You';
      break;
    case 'selectedCountry':
      errors.value.selectedCountry = selectedCountry.value ? '' : 'Country is required';
      break;
    case 'selectedState':
      errors.value.selectedState = selectedState.value ? '' : 'State is required';
      break;


      case 'selectedCommodity':
      errors.value.selectedCommodity = selectedCommodity.value ? '' : 'Commodity is Required ';
      break;

       case 'selectedUom':
      errors.value.selectedUom = selectedUom.value ? '' : 'UOM is Required ';
      break;


    case 'ratio':
    if (!ratio.value) {
      errors.value.ratio = 'Ratio is required';
    } else if (isNaN(ratio.value)) {
      errors.value.ratio = 'Ratio must be a number';
    } else {
      errors.value.ratio = '';
    }
    break;

    case 'qty':
    if (!qty.value) {
      errors.value.qty = 'Quantity is required';
    } else if (isNaN(ratio.value)) {
      errors.value.qty = 'Quantity must be a number';
    } else {
      errors.value.qty = '';
    }
    break;


    case 'kgs_chg':
    if (!kgs_chg.value) {
      errors.value.kgs_chg = 'Chargeable Weight (KGS) is required';
    } else if (isNaN(ratio.value)) {
      errors.value.kgs_chg = 'Chargeable Weight (KGS) must be a number';
    } else {
      errors.value.kgs_chg = '';
    }
    break;


    case 'kgs_wt':
    if (!kgs_wt.value) {
      errors.value.kgs_wt = 'Actual Weight (KGS) is required';
    } else if (isNaN(ratio.value)) {
      errors.value.kgs_wt = 'Actual Weight (KGS) must be a number';
    } else {
      errors.value.kgs_wt = '';
    }
    break;


    case 'termsCondition':
      if (!termsCondition.value || termsCondition.value.trim() === '') {
        errors.value.termsCondition = 'Other Notes cannot be empty';
      } else if (termsCondition.value.trim().length < 10) {
        errors.value.termsCondition = 'Please enter at least 10 characters';
      } else if (termsCondition.value.trim().length > 800) {
        errors.value.termsCondition = 'Too long, maximum 800 characters allowed';
      } else {
        errors.value.termsCondition = '';
      }
      break;

     


    case 'selectedTransportation1':
      errors.value.selectedTransportation1 = selectedTransportation1.value ? '' : 'Required';
      break;
    case 'selectedTransportation2':
      errors.value.selectedTransportation2 = selectedTransportation2.value ? '' : 'Required';
      break;
    case 'selectedPickupOrigin':
      errors.value.selectedPickupOrigin = selectedPickupOrigin.value ? '' : 'Required';
      break;
    case 'selectedPickupDestination':
      errors.value.selectedPickupDestination = selectedPickupDestination.value ? '' : 'Required';
      break;
  }
};



// --- Options ---
const businessTypes = [
  { value: "I am a business", label: "I am a business" },
  { value: "I am a freight forwarder", label: "I am a freight forwarder" }
];
const emailTypes = [
  { value: "personal", label: "Personal" },
  { value: "company", label: "Company" },
  { value: "office", label: "Office" },
  { value: "other", label: "Other" }
];
const phoneTypes = [
  { value: "personal", label: "Personal" },
  { value: "office", label: "Office" },
  { value: "whatsapp", label: "WhatsApp" },
  { value: "other", label: "Other" }
];
const transportationMethods = [
  { value: "Air", label: "Air" },
  { value: "Ocean", label: "Ocean" }
];

// data sementara Uom
const uomDataSelected = [
  { value: "Days", label: "Days" },
  { value: "Hour", label: "Hour" }
];

const validateStep = (step) => {
  let valid = true;

  if (step === 0) {
    ['selectedBusinessType', 'fullnameOrCompanyName', 'email', 'phone', 'selectedCountry', 'selectedState']
      .forEach((f) => {
        validateField(f);
        if (errors.value[f]) valid = false;
      });
  }

  if (step === 1) {
    ['termsCondition', 'ratio','qty','kgs_chg','kgs_wt','selectedCommodity','selectedUom']
      .forEach((f) => {
        validateField(f);
        if (errors.value[f]) valid = false;
      });
  }


  if (step === 2) {
    ['selectedTransportation1', 'selectedTransportation2', 'selectedPickupOrigin', 'selectedPickupDestination']
      .forEach((f) => {
        validateField(f);
        if (errors.value[f]) valid = false;
      });
  }

  if (!valid) toast.error("Please fix the highlighted fields before continuing.");
  return valid;
};


// --- Navigation ---
const nextStep = () => {
  if (validateStep(currentStep.value)) {
    if (currentStep.value < steps.length - 1) currentStep.value++;
  }
};
const prevStep = () => {
  if (currentStep.value > 0) currentStep.value--;
};
const goToStep = (index) => {
  if (index > currentStep.value) {
    for (let i = 0; i <= index - 1; i++) {
      if (!validateStep(i)) return;
    }
  }
  currentStep.value = index;
};

// --- Load data ---
onMounted(() => {
  quotationStore.fetchCountries();
  quotationStore.fetchCommodities();
  quotationStore.fetchUoms();
});

watch(selectedUom, (uom) => {
  ratio.value = uom?.factor ?? "";
});



watch(selectedCountry, (newCountry) => {
  if (newCountry) {
    quotationStore.fetchStatesByCountry(newCountry.id);
    selectedState.value = null;
  } else {
    quotationStore.dataState = [];
    selectedState.value = null;
  }
});

watch(selectedTransportation1, (newVal) => {
  if (newVal) {
    quotationStore.fetchPickupOrigins(newVal.value);
    selectedPickupOrigin.value = null;
  } else {
    quotationStore.dataPickupOrigins = [];
    selectedPickupOrigin.value = null;
  }
});


watch(selectedTransportation2, (newVal) => {
  if (newVal) {
    quotationStore.fetchPickupDestinations(newVal.value);
    selectedPickupDestination.value = null;
  } else {
    quotationStore.dataPickupDestinations = [];
    selectedPickupDestination.value = null;
  }
});


  

const submitQuote = async () => {
  if (!validateStep(2)) return;
    const selectedCommodityValue = selectedCommodity.value;
    const selectedUomValue = selectedUom.value;
  isSubmitting.value = true; 
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
      commodity_id: selectedCommodityValue.value || null,
      uom_id: selectedUomValue.value || null,
      qty: qty.value,
      kgs_chg: kgs_chg.value,
      kgs_wt: kgs_wt.value,
    };

    const res = await quotationStore.createQuote(payload);
    toast.success(`Quote created successfully & Your Code Request: ${res.data.sales_order.name}`, {
      timeout: 4000,
      position: 'top-right',
      style: { background: '#007bff', color: '#fff' }
    });
    resetForm();
  } catch (err) {
    toast.error(`Failed to create quote: ${err.message}`, {
      timeout: 4000,
      position: 'top-right'
    });
  } finally {
    isSubmitting.value = false; 
  }
};
</script> 




<style>
.nav-pills .nav-link.disabled {
  pointer-events: none;
  opacity: 0.5;
}
.stepper {
  display: flex;
  justify-content: center;
  align-items: center;
  list-style: none;
  padding: 0;
  margin: 0 auto;
  max-width: 800px; /* biar nggak kepanjangan */
}

.step-item {
  flex: 1;
  text-align: center;
  position: relative;
}

.step-circle {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  border: 2px solid #d6d6d6;
  background: #fff;
  color: #999;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 6px;
  z-index: 2;
  position: relative;
}

.step-label {
  font-size: 14px;
  color: #777;
}

/* Garis antar step */
.step-item::after {
  content: "";
  position: absolute;
  top: 20px; /* sejajar dengan tengah lingkaran */
  left: 50%; /* mulai dari tengah lingkaran */
  width: 100%; /* sampai ke tengah lingkaran berikutnya */
  height: 2px;
  background: #d6d6d6;
  z-index: 1;
}

.step-item:last-child::after {
  display: none;
}

/* Step aktif */
.step-item.active .step-circle {
  border-color: #007bff;
  color: #007bff;
  background: #fff;
}

/* Step selesai */
.step-item.completed .step-circle {
  background: #007bff;
  color: #fff;
  border-color: #007bff;
}

/* Garis jadi biru kalau completed */
.step-item.completed::after {
  background: #007bff;
}

/* untuk spinner  */
.loading-overlay {
  position: fixed;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background: rgba(255,255,255,0.8);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1050;
}

/* untuk validasi per field */
input.is-invalid, .multiselect.is-invalid .multiselect__tags {
  border-color: #dc3545 !important;
  box-shadow: 0 0 0 0.15rem rgba(220,53,69,0.25);
}



</style>
