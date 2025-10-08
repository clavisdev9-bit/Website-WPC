<template>
     <div class="page">
      <!-- BEGIN NAVBAR  -->
      <!-- <header class="navbar navbar-expand-md d-print-none" style="background: #0077B5;"> -->
      <header class="navbar navbar-expand-md d-print-none" style="background: linear-gradient(90deg, #007bff, #0056b3)">

        <div class="container-xl">
          <!-- BEGIN NAVBAR TOGGLER -->
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbar-menu"
            aria-controls="navbar-menu"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <!-- END NAVBAR TOGGLER -->
        
       <div class="navbar-brand d-flex align-items-center">
  <img :src="LogoCompany" class="navbar-brand-image logo-large me-2" alt="WPC Logo">

  <div class="d-flex flex-column align-items-start brand-text">
    <small class="brand-subtitle main-tagline">Driven by Reliability</small>
    <small class="brand-subtitle sub-tagline">Fast. Safe. On Time.</small>
  </div>
</div>





          <!-- END NAVBAR LOGO -->
          <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item d-none d-md-flex me-3">
              <div class="btn-list">
                <a href="" class="btn btn-primary btn-5" target="_blank" rel="noreferrer" style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 12px; border: none;">
                  <i class="fa-solid fa-headset"> </i>
                 Support
                </a>

                <a href="" class="btn btn-primary btn-6" target="_blank" rel="noreferrer" style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 12px; border: none;">
                  <i class="fa-solid fa-book"> </i>
                  User Guide
                </a>

                <div class="dropdown">
                <a class="btn btn-primary btn-6 dropdown-toggle" href="#" role="button"  style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 12px; border: none;"
                  id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa-solid fa-language"> </i>
                    Languange
                </a>

                <ul class="dropdown-menu" aria-labelledby="languageDropdown" style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 12px; border: none;">
                  <li><a class="dropdown-item" href="?lang=id">🇮🇩 Indonesia</a></li>
                  <li><a class="dropdown-item" href="?lang=en">🇬🇧 English</a></li>
                  <li><a class="dropdown-item" href="?lang=fr">🇫🇷 Français</a></li>
                  <li><a class="dropdown-item" href="?lang=zh">🇨🇳 中文</a></li>
                </ul>
              </div>

              </div>
            </div>
           
            <div class="nav-item dropdown">


              <a href="#" class="nav-link d-flex lh-1 p-0 px-2" data-bs-toggle="dropdown" aria-label="Open user menu">
                  <img  :src="profileStatic" 
                  class="avatar avatar-sm rounded-circle"  style="background-image" alt="">
                      <div class="d-none d-xl-block ps-2">
                        <div class="text-light">Name Users</div>
                    <div class="mt-1 small text-light">xxxxx</div>
                      </div>
              </a>


              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <a href="" class="dropdown-item">Profile</a>
                <div class="dropdown-divider"></div>
                 <a href="#" @click.prevent="logout" class="dropdown-item">Logout</a>
              </div>
            </div>
          </div>
        </div>
      </header>


      <header class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
          <div class="navbar">
            <div class="container-xl">
              <div class="row flex-column flex-md-row flex-fill align-items-center">
                <div class="col">
                  <!-- BEGIN NAVBAR MENU -->
                <ul class="navbar-nav">

                  <li class="nav-item">
                    <RouterLink 
                      to="/wpc-esys/home" 
                      class="nav-link ripple" 
                      active-class="active-link"
                    >
                      <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <i class="nav-icon fa fa-home fa-lg"></i>
                      </span>
                      <span class="nav-link-title">Home</span>
                    </RouterLink>
                  </li>

                  

                  <li class="nav-item">
                    <RouterLink 
                      to="/wpc-esys/qoutation-request" 
                      class="nav-link ripple" 
                      active-class="active-link"
                    >
                      <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <i class="nav-icon fa fa-file-invoice fa-lg"></i>
                      </span>
                      <span class="nav-link-title">Quotation</span>
                    </RouterLink>
                  </li>


                  <li class="nav-item">
                    <RouterLink 
                      to="/wpc-esys/network" 
                      class="nav-link ripple" 
                      active-class="active-link"
                    >
                      <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <i class="nav-icon fa fa-map-location-dot"></i>
                      </span>
                      <span class="nav-link-title">Network</span>
                    </RouterLink>
                  </li>


                <li class="nav-item">
                  <a 
                    href="javascript:void(0)" 
                    class="nav-link ripple"
                    @click="$emit('openComingSoon')"
                  >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <i class="nav-icon fa fa-calendar-days fa-lg"></i>
                    </span>
                    <span class="nav-link-title">Schedule</span>
                  </a>
                </li>




                <li class="nav-item">
                  <a 
                    href="javascript:void(0)" 
                    class="nav-link ripple"
                    @click="$emit('openComingSoon')"
                  >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                       <i class="nav-icon fa fa-money-bill-wave fa-lg"></i>
                    </span>
                    <span class="nav-link-title">Prices</span>
                  </a>
                </li>


                 <li class="nav-item">
                   <a 
                    href="javascript:void(0)" 
                    class="nav-link ripple"
                    @click="$emit('openComingSoon')"
                  >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <i class="nav-icon fas fa-receipt fa-lg"></i>
                    </span>
                    <span class="nav-link-title">Booking</span>
                  </a>
                </li>


                 <li class="nav-item">
                   <a 
                    href="javascript:void(0)" 
                    class="nav-link ripple"
                    @click="$emit('openComingSoon')"
                  >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <i class="nav-icon fas fa-book fa-lg"></i> 
                    </span>
                    <span class="nav-link-title">Documentation</span>
                  </a>
                </li>
  

                 <li class="nav-item">
                    <a href="/" class="nav-link ripple">
                        <span class="nav-link-icon d-md-none d-lg-inline-block text-secondary">
                          <i class="nav-icon fas fa-arrow-up-right-from-square"></i>
                        </span>
                        <span class="nav-link-title text-secondary">Back To Landing Page</span>
                    </a>
                </li>

              </ul>
                  <!-- END NAVBAR MENU -->
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </header>
      </div>
      <!-- END NAVBAR  -->
</template>

<script setup>
const LogoCompany = '/images/logox.png'
const profileStatic = '/images/profile.png'
</script>

<style scoped>
 /* Ripple effect */
.ripple {
  position: relative;
  overflow: hidden;
  transition: color 0.3s, background 0.3s;
}

.ripple::after {
  content: "";
  position: absolute;
  background: rgba(0, 30, 255, 0.1);
  border-radius: 50%;
  transform: scale(0);
  width: 100px;
  height: 100px;
  opacity: 0;
  pointer-events: none;
  transition: transform 0.5s, opacity 1s;
}

.ripple:active::after {
  transform: scale(2);
  opacity: 1;
  transition: 0s;
}

/* Default link */
.nav-link {
  color: #6c757d; /* abu-abu */
  display: flex;
  align-items: center;
  gap: 6px;
  padding: 10px 15px;
  border-radius: 8px;
}

.nav-link .nav-icon {
  color: #6c757d;
  transition: color 0.3s;
}

/* Hover efek */
.nav-link:hover {
  background: rgba(0, 0, 0, 0.05);
  color: #0d6efd;
}

.nav-link:hover .nav-icon {
  color: #0d6efd;
}

/* Active link */
.active-link {
  color: #0d6efd !important;
  font-weight: bold;
  background: rgba(13, 110, 253, 0.15); /* highlight biru muda */
}

.active-link .nav-icon {
  color: #0d6efd !important;
}

.active-link {
  color: #0d6efd !important;
  font-weight: bold;
  background: rgba(13, 110, 253, 0.15);
  border-radius: 8px;
}

.active-link .nav-icon {
  color: #f9fbfc !important;
}

/* .active-link {
  position: relative;
  color: white !important;
  font-weight: bold;
  border-radius: 8px;
  background: linear-gradient(270deg, #0d6efd, #00c2ff, #1e90ff, #20b2aa);
  background-size: 400% 400%;
  animation: oceanGradient 6s ease infinite;
}

@keyframes oceanGradient {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
} */


/* Menu aktif */
.active-link {
  position: relative;
  color: white !important;
  font-weight: bold;
  border-radius: 10px;
  overflow: hidden;
  background: linear-gradient(270deg, #0d6efd, #00c2ff, #1e90ff, #20b2aa);
  background-size: 400% 400%;
  animation: oceanGradient 6s ease infinite;
  z-index: 0;
}

/* Ombak bergerak */
.active-link::before {
  content: "";
  position: absolute;
  inset: 0;
  background: linear-gradient(90deg, #00c2ff, #1e90ff, #20b2aa, #0d6efd);
  background-size: 200% 100%;
  animation: waveMove 4s linear infinite;
  clip-path: polygon(
    0 70%, 20% 75%, 40% 70%, 60% 75%, 80% 70%, 100% 75%,
    100% 100%, 0% 100%
  );
  opacity: 0.5;
  z-index: -1;
  border-radius: inherit;
}

/* Animasi gradient dasar */
@keyframes oceanGradient {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

/* Animasi gelombang */
@keyframes waveMove {
  0% { background-position: 0 0; }
  100% { background-position: 200% 0; }
}



/*  Logo styling */
.navbar-brand-image {
  object-fit: contain;
  height: 55px;
  width: auto;
}

.logo-large {
  height: 58px !important;
  margin-right: 6px; /* lebih dekat ke teks, tapi tetap lega */
}

/* 🔹 Container teks */
.brand-text {
  line-height: 1.1;
}

/* 🔹 Tagline utama */
.main-tagline {
  font-family: "Poppins", sans-serif;
  font-size: 0.95rem;
  font-weight: 600;
  color: #ffffff;
  letter-spacing: 0.5px;
  margin-bottom: 2px;
}

/* 🔹 Tagline kedua */
.sub-tagline {
  font-family: "Poppins", sans-serif;
  font-size: 0.85rem;
  font-style: italic;
  color: #bfbfbf;
  letter-spacing: 0.3px;
}

/* 🔹 General subtitle fallback */
.brand-subtitle {
  margin: 0;
}

</style>