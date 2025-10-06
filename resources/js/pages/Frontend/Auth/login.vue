<template>
    <AuthLayout>
        <div class="background-container">
            <div class="content-area row align-items-center justify-content-between g-0">
                <div class="col-12 col-lg-7 shipping-text p-4">
                    <h1 class="text-light display-3 fw-bold mb-3">WPC LOGISTIC</h1>
                    <p class="text-light lead">Your Trusted Partner in Global Shipping.</p>
                    <p class="text-light h5">Simplify your shipping with us, **effortlessly**.</p>
                </div>

                <div class="col-12 col-lg-5 d-flex justify-content-lg-end justify-content-center p-4" >
                    <div class="card login-card p-4" style="width: 100%; max-width: 400px;">
                        <div class="card-body">
                            <h2 class="card-title text-center mb-4 fw-bold">Login</h2>

                            <form @submit.prevent="handleLogin">
                                <div class="mb-3">
                                    <input type="text" class="form-control" v-model="userId" placeholder="User ID" required>
                                </div>
                                
                                <div class="mb-3 input-group">
                                    <input :type="passwordFieldType" class="form-control" v-model="password" placeholder="Input password" required>
                                    <span class="input-group-text bg-white border-start-0" @click="togglePasswordVisibility" style="cursor: pointer;">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                </div>
                                
                                <div class="text-end mb-4">
                                    <a href="#" class="text-decoration-none" @click.prevent="forgotPassword">Forgot your password?</a>
                                </div>

                                <div class="d-grid mb-3">
                                    <button type="submit" class="btn btn-sm btn-lg text-white" style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 12px; border: none;">Sign In</button>
                                </div>
                            </form>

                            <div class="text-center mt-3">
                            <small class="text-muted">
                                Not a member? 
                                <router-link to="/wpc-esys/registration">
                                Sign up for an account!
                               </router-link>
                            </small>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import FrontendLayout from "../../../layouts/FrontendLayout.vue"; // Pastikan path ini benar
import AuthLayout from '../../../layouts/AuthLayout.vue';

// --- Data (State) ---
const userId = ref('');
const password = ref('');
const isPasswordVisible = ref(false);

// --- Computed Properties ---
const passwordFieldType = computed(() => {
    return isPasswordVisible.value ? 'text' : 'password';
});

const passwordIconClass = computed(() => {
    // Memerlukan Bootstrap Icons
    return isPasswordVisible.value ? 'bi bi-eye-slash' : 'bi bi-eye'; 
});

// --- Methods (Logika) ---
const togglePasswordVisibility = () => {
    isPasswordVisible.value = !isPasswordVisible.value;
};

const handleLogin = () => {
    // Implementasi logika login, misalnya:
    // Panggil API, validasi data
    console.log('Login attempt:', { userId: userId.value, password: password.value });
    alert(`Attempting login for User: ${userId.value}`);
};

const forgotPassword = () => {
    // Implementasi navigasi ke halaman lupa password
    console.log('Navigating to forgot password page');
};

const signUp = () => {
    // Implementasi navigasi ke halaman pendaftaran
    console.log('Navigating to sign up page');
};
</script>

<style scoped>
/* 1. Kontainer Latar Belakang Penuh */
.background-container {
    height: 100vh; /* Memastikan div menempati seluruh tinggi viewport */
    width: 100%;
    /* Ganti dengan URL gambar kapal Anda */
    background: url('/images/bgloginvue.jpg') no-repeat center center; 
    background-size: cover;
    display: flex;
    align-items: center; /* Memusatkan secara vertikal */
    padding: 20px;
}

/* 2. Area Konten Utama */
.content-area {
    width: 100%;
    max-width: 1200px; /* Opsional: Batas lebar konten */
    margin: 0 auto;
}

/* 3. Gaya Teks Kiri */
.shipping-text {
    color: white; /* Teks harus putih untuk kontras */
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.5); /* Memberi sedikit bayangan agar lebih terbaca */
}
.shipping-text h1 {
    font-size: 2.8rem;
    font-weight: 700;
}
.shipping-text p {
    font-size: 1.5rem;
}

/* 4. Gaya Card Login */
.login-card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15); /* Bayangan lebih halus */
}

/* 5. Gaya Tombol Pink Kustom */
.btn-custom-pink {
    background-color: #d81b60; /* Warna pink dari gambar */
    border-color: #d81b60;
    color: white;
    font-weight: 600;
}

.btn-custom-pink:hover {
    background-color: #b71550; /* Sedikit lebih gelap saat hover */
    border-color: #b71550;
}

/* Penyesuaian Input Group agar ikon mata terlihat rapi */
.input-group-text {
    /* Menghilangkan border dan membuat latar belakang transparan/putih solid */
    border-color: #ced4da; 
}

.shipping-text {
    color: white !important; 
    /* Tambahkan shadow untuk kontras yang lebih baik pada gambar */
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7); 
}

/* Pastikan judul tetap besar pada semua ukuran layar (opsional) */
.shipping-text h1.display-3 {
    font-size: 3.5rem; /* Ukuran default untuk layar besar */
}
/* Media query untuk layar lebih kecil */
@media (max-width: 992px) {
    .shipping-text h1.display-3 {
        font-size: 2.5rem; 
    }
}
</style>