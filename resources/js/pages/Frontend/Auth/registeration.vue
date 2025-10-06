<template>
    <div class="registration-page">
        <header class="navbar navbar-expand-lg navbar-light header-custom px-4 py-2" style="background: linear-gradient(90deg, #007bff, #0056b3)">
            <div class="container-fluid">
                <a class="navbar-brand logo-text d-flex align-items-center" href="#">
  <!-- <img :src="logo" alt="ONE Logo" class="me-2 logo-small" style="height: 20%; weight:20%"> -->
  <span class="logo-text-small">WPC Logistic</span>
</a>

                <div class="d-flex align-items-center">
                    <span class="me-4 text-white d-none d-md-block">WPC Solutions</span>
                    <span class="me-4 text-white d-none d-md-block">Support</span>
                    <div class="dropdown">
                        <button class="btn btn-outline-light dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            English
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                            <li><a class="dropdown-item" href="#">Bahasa</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <div class="container py-5 mb-5">
            <h2 class="mb-4 text-center text-md-start">Welcome to WPC Registration</h2>
            
            <div class="stepper-container mb-5">
                <div class="row text-center">
                    <div v-for="(step, index) in steps" :key="index" :class="['col', 'step-item', { 'active': currentStep === index + 1, 'completed': currentStep > index + 1 }]">
                        <div class="step-circle mx-auto d-flex align-items-center justify-content-center mb-2">
                            {{ index + 1 }}
                        </div>
                        <span class="step-text">{{ step }}</span>
                    </div>
                </div>
            </div>

            <div class="card shadow-lg p-md-5 p-3 form-card-custom">
                <h3 class="mb-4">{{ steps[currentStep - 1] }}</h3>
                
                <form @submit.prevent="nextStep">
                    <div v-if="currentStep === 1">
                        <div class="row">
                            <div class="col-md-6 border-end-md pe-md-4">
                                <h4 class="mb-4 title-section">User Information</h4>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="First Name" v-model="form.firstName" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Last Name" v-model="form.lastName" required>
                                </div>
                                <div class="mb-3">
                                    <select class="form-select" v-model="form.jobTitle" required>
                                        <option value="" disabled selected>Job Title</option>
                                        <option value="Manager">Top Management <small>(CXO, MD)</small></option>
                                        <option value="Manager">Middle Management (Department Head)</option>
                                        <option value="Manager">Operative Management (Manager)</option>
                                        <option value="Manager">Non-Managerial (Associate)</option>
                                        <option value="Staff">Staff</option>
                                    </select>
                                    



                                </div>
                                <div class="mb-3 row g-2">
                                    <label class="form-label">Phone Number</label>
                                    <div class="col-4">
                                        <select class="form-select" v-model="form.phonePrefix" required>
                                            <option value="+62">Phone Prefix</option>
                                            <option value="+62">+62</option>
                                            <option value="+1">+1</option>
                                        </select>
                                    </div>
                                    <div class="col-8">
                                        <input type="tel" class="form-control" placeholder="Phone Number" v-model="form.phoneNumber" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 ps-md-4">
                                <h4 class="mb-4 title-section">Account Information</h4>
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Business Email" v-model="form.businessEmail" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="User ID" v-model="form.userId" required>
                                </div>
                                <div class="mb-3 input-group">
                                    <input :type="passwordFieldType" class="form-control" placeholder="Password" v-model="form.password" required>
                                    <span class="input-group-text bg-white" @click="togglePasswordVisibility" style="cursor: pointer;">
                                       <i class="fa fa-eye"></i>
                                    </span>
                                </div>
                                <div class="mb-3 input-group">
                                    <input :type="passwordFieldType" class="form-control" placeholder="Confirm Password" v-model="form.confirmPassword" required>
                                    <span class="input-group-text bg-white" @click="togglePasswordVisibility" style="cursor: pointer;">
                                      <i class="fa fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <input class="form-check-input me-2" type="checkbox" id="consentCheck" v-model="form.consent" required>
                            <label class="form-check-label small" for="consentCheck">
                                I hereby give my consent for the collection, use, or disclosure of my personal data... <a href="#">Terms of Service</a> & <a href="#">Indemnity Agreement</a>.
                            </label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-2">
                        <button type="button" class="btn btn-secondary me-2" v-if="currentStep > 1" @click="prevStep">Back</button>
                        <button type="submit" class="btn next-button text-light" style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 12px; border: none;">
                            {{ currentStep < steps.length ? 'Next' : 'Register' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

       
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
const logo = '/logo.png'

// --- State Management ---
const currentStep = ref(1);
const steps = ['User & Account Information', 'Company Information', 'Additional Information', 'Review Registration'];
const isPasswordVisible = ref(false);

const form = ref({
    // Step 1 Data
    firstName: '',
    lastName: '',
    jobTitle: '',
    phonePrefix: '+62',
    phoneNumber: '',
    businessEmail: '',
    userId: '',
    password: '',
    confirmPassword: '',
    consent: false,
    // Data untuk steps berikutnya bisa ditambahkan di sini
});

// --- Computed Properties ---
const passwordFieldType = computed(() => {
    return isPasswordVisible.value ? 'text' : 'password';
});

const passwordIconClass = computed(() => {
    // Memerlukan Bootstrap Icons (bi)
    return isPasswordVisible.value ? 'bi bi-eye-slash' : 'bi bi-eye'; 
});

// --- Methods (Logika) ---
const togglePasswordVisibility = () => {
    isPasswordVisible.value = !isPasswordVisible.value;
};

const nextStep = () => {
    if (currentStep.value < steps.length) {
        // Logika validasi data step saat ini harus dilakukan di sini
        if (form.value.password !== form.value.confirmPassword) {
             alert('Password dan Confirm Password tidak sama!');
             return;
        }

        currentStep.value++;
        // Scroll ke atas
        window.scrollTo(0, 0);
    } else {
        // Final Registration Logic
        console.log('Final Registration Data:', form.value);
        alert('Registration Complete!');
    }
};

const prevStep = () => {
    if (currentStep.value > 1) {
        currentStep.value--;
    }
};
</script>

<style scoped>
/* Warna Kustom ONE Pink */
:root {
    --one-pink: #0015ff; /* Warna pink utama */
    --one-dark: #343a40; /* Warna gelap untuk teks */
}

/* 1. Header dan Footer */
.header-custom {
    background-color: var(--one-pink);
    border-bottom: 5px solid #0015ff;
}
.header-custom .logo-text {
    color: white;
    font-weight: bold;
    font-size: 1.5rem;
}
.footer-illustration {
    /* Hanya sebagai visual, biasanya menggunakan background-image atau SVG */
    /* Untuk contoh ini, kita biarkan kosong atau gunakan placeholder */
}

/* 2. Stepper/Progress Bar */
.stepper-container {
    max-width: 800px;
    margin: 0 auto;
}
.step-item {
    position: relative;
    color: #ced4da; /* Warna non-aktif */
}
.step-circle {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    background-color: #e9ecef;
    color: var(--one-dark);
    font-weight: bold;
    z-index: 10;
    position: relative;
}
.step-text {
    font-size: 0.85rem;
    display: block;
    font-weight: 500;
}

/* Garis penghubung antar step */
.step-item:not(:last-child)::after {
    content: '';
    position: absolute;
    width: 100%;
    height: 2px;
    background: #e9ecef;
    top: 17px;
    left: 50%;
    z-index: 0;
}

/* Step AKTIF */
.step-item.active .step-circle {
    background-color: var(--one-pink);
    color: rgb(0, 0, 0);
    box-shadow: 0 0 0 4px rgba(0, 108, 241, 0.995); /* Ring untuk fokus */
}
.step-item.active .step-text {
    color: var(--one-dark);
}

/* Step SELESAI */
.step-item.completed .step-circle {
    background-color: var(--one-pink);
    color: white;
}
.step-item.completed::after {
    background: var(--one-pink); /* Garis menjadi pink jika sudah selesai */
}

/* 3. Form Card dan Konten */
.form-card-custom {
    border-radius: 10px;
}
.title-section {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--one-dark);
}
/* Garis pemisah vertikal di tengah form untuk tampilan desktop */
@media (min-width: 768px) {
    .border-end-md {
        border-right: 1px solid #dee2e6 !important;
    }
}

/* 4. Tombol Kustom */
.btn-custom-pink {
    background-color: var(--one-pink);
    border-color: var(--one-pink);
    color: white;
    font-weight: 600;
}
.btn-custom-pink:hover {
    background-color: #0015ff;
    border-color: #0015ff;
}
</style>