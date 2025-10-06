<template>
  <FrontendLayout fluid>
    
      <div class="position-relative card shadow-lg mt-0 pt-0" style="height: 100vh; background: url('/images/corousel.jpg')  no-repeat center center/cover;">
    <div class="container h-100 d-flex align-items-center">
        <div class="row w-100">
            <div class="col-lg-6">
                <!-- Card Search -->
                <div class="card shadow-lg border-0 p-4">
                    
                    <!-- Tabs -->
                    <ul class="nav nav-tabs mb-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active fw-bold" data-bs-toggle="tab" href="#schedule" role="tab">Check Schedule</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold" data-bs-toggle="tab" href="#tracking" role="tab">Tracking</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <!-- Schedule -->
                        <div class="tab-pane fade show active" id="schedule" role="tabpanel">
                            <ul class="nav nav-pills mb-3">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="pill" href="#point">Point to Point</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="pill" href="#vessel">Vessel</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="pill" href="#port">Port</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="pill" href="#longrange">Long Range</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <!-- Point to Point Form -->
                                <div class="tab-pane fade show active" id="point">
                                    <form>
                                        <div class="mb-3">
                                            <label class="form-label">Origin</label>
                                            <input type="text" class="form-control" placeholder="Input Origin">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Destination</label>
                                            <input type="text" class="form-control" placeholder="Input Destination">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Date</label>
                                                <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Next</label>
                                                <select class="form-select">
                                                    <option>1 Week</option>
                                                    <option selected>2 Weeks</option>
                                                    <option>1 Month</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <button type="reset" class="btn btn-secondary me-1" style="border-radius: 12px; border: none;">Clear</button>
                                           <a 
                                            href="javascript:void(0)" 
                                            class="btn btn-primary ripple" 
                                            style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 12px; border: none;"
                                            @click="$emit('openComingSoon')"
                                            >
                                            Search
                                            </a>


                                        </div>
                                    </form>
                                </div>

                                <!-- Vessel -->
                                <div class="tab-pane fade" id="vessel">
                                    <p class="text-muted">Vessel search coming soon...</p>
                                </div>

                                <!-- Port -->
                                <div class="tab-pane fade" id="port">
                                    <p class="text-muted">Port search coming soon...</p>
                                </div>

                                <!-- Long Range -->
                                <div class="tab-pane fade" id="longrange">
                                    <p class="text-muted">Long range search coming soon...</p>
                                </div>
                            </div>
                        </div>

                        <!-- Tracking -->
                        <div class="tab-pane fade" id="tracking" role="tabpanel">
                            <form>
                                <div class="mb-3">
                                    <label class="form-label">Tracking Number / Container</label>
                                    <input type="text" class="form-control" placeholder="Enter tracking number">
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary" style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 12px; border: none;">Track</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-between mt-4">
                <router-link to="/wpc-esys/login" class="btn btn-info w-100 me-2" style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 12px; border: none;">
                    <i class="fa fa-user"></i> LOG IN
                </router-link>

                <router-link to="/wpc-esys/registration" class="btn btn-info w-100 me-2" style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 12px; border: none;">
                    <i class="fa fa-user-plus"></i> CREATE ACCOUNT
                </router-link>

                <router-link to="/wpc-esys/form-qoutation" class="btn btn-info w-100" style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 12px; border: none;">
                    <i class="fa fa-calendar"></i> GET QOUTATION
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
                                    <img :src="bg" class="card-img" alt="..." style="opacity: 0.6;">
                                    <div class="card-img-overlay d-flex align-items-center justify-content-center">
                                       
                                    </div>
                                </div>

                                <div class="card-img-overlay d-flex align-items-center">
                                    <div>
                                        <h3 class="fw-bold">New Shipping Instructions</h3>
                                        <p>Experience a streamlined process from SI submission to BL approval.</p>
                                        <a href="#" class="btn btn-primary" style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius: 12px; border: none;">Discover</a>
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
const bg = '/images/card_corousel.jpg'
</script>