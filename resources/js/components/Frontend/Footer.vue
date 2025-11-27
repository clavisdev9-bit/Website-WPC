<template>
  <footer class="footer py-5" style="background: linear-gradient(90deg, #007bff, #0056b3)">
    <div class="container-xl">
      <div class="row mb-4">
        <!-- Subscribe -->
        <div class="col-md-4 mb-3">
          <div class="d-flex">
            <input
              type="email"
              class="form-control me-2"
              :placeholder="$t('footer.subscribePlaceholder')"
            />
            <button class="btn btn-white">{{ $t('footer.subscribeButton') }}</button>
          </div>
        </div>

        <!-- Social Icons -->
        <div class="col-md-8 text-md-end mb-3">
          <a href="#" class="btn btn-outline-light me-1"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="btn btn-outline-light me-1"><i class="fab fa-twitter"></i></a>
          <a href="#" class="btn btn-outline-light me-1"><i class="fab fa-instagram"></i></a>
          <a href="#" class="btn btn-outline-light"><i class="fab fa-linkedin-in"></i></a>
        </div>
      </div>

      <div class="row">
        <!-- Logo & About -->
        <div class="col-md-3 mb-4">
          <img :src="LogoCompany" alt="WPC Logistics" class="mb-3" style="max-width: 100px;">
          <p class="text-white">
            {{ $t('footer.about') }}
          </p>
        </div>

        <!-- Quick Links -->
        <div class="col-md-2 mb-4">
          <h5 class="fw-bold text-white">{{ $t('footer.quickLinks') }}</h5>
          <ul class="list-unstyled">
            <li><a href="#" class="text-white text-decoration-none">{{ $t('footer.home') }}</a></li>
            <li><a href="#" class="text-white text-decoration-none">{{ $t('footer.quotation') }}</a></li>
            <li><a href="#" class="text-white text-decoration-none">{{ $t('footer.schedule') }}</a></li>
            <li><a href="#" class="text-white text-decoration-none">{{ $t('footer.prices') }}</a></li>
            <li><a href="#" class="text-white text-decoration-none">{{ $t('footer.booking') }}</a></li>
            <li><a href="#" class="text-white text-decoration-none">{{ $t('footer.documentation') }}</a></li>
          </ul>
        </div>

        <!-- Contact Info -->
        <div class="col-md-3 mb-4">
          <h5 class="fw-bold text-white">{{ $t('footer.contactInfo') }}</h5>
          <ul class="list-unstyled">
            <li class="text-white">
              <i class="fas fa-map-marker-alt text-white"></i> {{ $t('footer.address') }}
            </li>
            <li class="text-white">
              <i class="fas fa-envelope text-white"></i> inquiry@wpclogistics.com
            </li>
            <li class="text-white">
              <i class="fas fa-phone text-white"></i> {{ $t('footer.phone') }}
            </li>
          </ul>
        </div>

        <!-- Recent Work -->
        <div class="col-md-4 mb-4">
          <h5 class="fw-bold text-white">{{ $t('footer.recentWork') }}</h5>
          <div class="row g-2">
            <div class="col-4" v-for="n in 6" :key="n">
              <img :src="marker" alt="Recent Work" class="img-fluid rounded" />
            </div>
          </div>
        </div>
      </div>

      <!-- Certification Logos -->
      <div class="container text-center">
        <img :src="logoCertifikat" alt="Certification Logos" class="img-fluid" style="max-height:70px;">
      </div>

      <hr class="my-3 border-light" />

      <!-- Bottom -->
      <div class="d-flex justify-content-between align-items-center">
        <small class="text-white">{{ $t('footer.copyright') }}</small>
      </div>
    </div>
  </footer>
</template>

<script setup>
const LogoCompany = '/images/logox.png'
const marker = '/images/banner2.jpg'
const logoCertifikat = '/images/certification-logo.png'
</script>

<style scoped>
.footer a:hover {
  text-decoration: underline;
}

.footer {
  position: relative;
  color: white;
  overflow: hidden;
  background: linear-gradient(270deg, #007bff, #00c2ff, #1e90ff, #0056b3);
  background-size: 400% 400%;
  animation: oceanGradient 8s ease infinite;
  z-index: 1;
}

.footer::before {
  content: "";
  position: absolute;
  bottom: 0;
  left: 0;
  width: 200%;
  height: 100px;
  background: rgba(255, 255, 255, 0.15);
  animation: waveMove 6s linear infinite;
  clip-path: polygon(
    0 60%, 10% 65%, 25% 60%, 40% 65%, 
    55% 60%, 70% 65%, 85% 60%, 100% 65%, 
    100% 100%, 0 100%
  );
  z-index: 0;
}

.footer::after {
  content: "";
  position: absolute;
  bottom: 0;
  left: 0;
  width: 200%;
  height: 120px;
  background: rgba(255, 255, 255, 0.1);
  animation: waveMove 10s linear infinite reverse;
  clip-path: polygon(
    0 70%, 15% 75%, 30% 70%, 50% 75%, 
    65% 70%, 80% 75%, 100% 70%, 100% 100%, 0 100%
  );
  z-index: 0;
}

@keyframes oceanGradient {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

@keyframes waveMove {
  0% { transform: translateX(0); }
  100% { transform: translateX(-50%); }
}

.footer .container-xl {
  position: relative;
  z-index: 2;
}
</style>
