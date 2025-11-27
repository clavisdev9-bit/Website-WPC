<template>
  <FrontendLayout fluid>
    <div
      class="position-relative card shadow-lg mt-0 pt-0"
      style="height: 100vh; background: url('/images/corousel.jpg') no-repeat center center/cover;"
    >
      <div class="container h-100 d-flex align-items-center">
        <div class="row w-100">
          <div class="col-lg-6">
            <!-- Card Search -->
            <div class="card shadow-lg border-0 p-4">
              <!-- Tabs -->
              <ul class="nav nav-tabs mb-3" role="tablist">
                <li class="nav-item">
                  <a
                    class="nav-link fw-bold active"
                    data-bs-toggle="tab"
                    href="#tracking"
                    role="tab"
                  >
                    {{ $t('home.tabs.tracking') }}
                  </a>
                </li>

                <li class="nav-item">
                  <RouterLink
                    to="/wpc-esys/schedule"
                    class="nav-link fw-bold"
                    active-class="active"
                  >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <i class="nav-icon fa fa-map-location-dot"></i>
                    </span>
                    <span class="nav-link-title">{{ $t('home.tabs.schedule') }}</span>
                  </RouterLink>
                </li>

                <li class="nav-item">
                  <RouterLink
                    to="/wpc-esys/qoutation-request"
                    class="nav-link fw-bold"
                    active-class="active"
                  >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <i class="nav-icon fa fa-file-invoice fa-lg"></i>
                    </span>
                    <span class="nav-link-title">{{ $t('home.buttons.quotation') }}</span>
                  </RouterLink>
                </li>
              </ul>

              <!-- Tab content -->
              <div class="tab-content">
                <!-- Tracking -->
                <div class="tab-pane fade show active" id="tracking" role="tabpanel">

                   
                  <div class="alert alert-info ">{{ $t('home.tabs.comingSoon') }}</div>
       
                  <form>
                    <div class="mb-3">
                      <label class="form-label">{{ $t('home.form.tracking_label') }}</label>
                      <input
                        type="text"
                        class="form-control"
                        :placeholder="$t('home.form.tracking_placeholder')"
                      />
                    </div>
                    <div class="text-end">
                      <button
                        type="submit"
                        class="btn btn-primary"
                        style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 12px; border: none;"
                      >
                        {{ $t('home.form.track_button') }}
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- Buttons -->
            <div class="d-flex justify-content-between mt-4">
              <router-link
                to="/wpc-esys/login"
                class="btn btn-info w-100 me-2"
                style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 12px; border: none;"
              >
                <i class="fa fa-user"></i> {{ $t('home.buttons.login') }}
              </router-link>

              <router-link
                to="/wpc-esys/registration"
                class="btn btn-info w-100 me-2"
                style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 12px; border: none;"
              >
                <i class="fa fa-user-plus"></i> {{ $t('home.buttons.register') }}
              </router-link>

              

            </div>
          </div>

          <!-- Carousel / Right Content -->
          <div class="col-lg-6 d-none d-lg-block">
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="card bg-dark text-white border-0">
                    <div class="position-relative">
                      <img :src="bg" class="card-img" alt="..." style="opacity: 0.6;" />
                    </div>

                    <div class="card-img-overlay d-flex align-items-center">
                      <div>
                        <h3 class="fw-bold">{{ $t('home.carousel.title') }}</h3>
                        <p>{{ $t('home.carousel.desc') }}</p>
                        <a
                          href="#"
                          class="btn btn-primary"
                          style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 12px; border: none;"
                        >
                          {{ $t('home.carousel.discover') }}
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Tambah slide lain -->
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
const bg = "/images/Banner1.jpg";
</script>
