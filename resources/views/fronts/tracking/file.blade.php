@extends('frontend.layouts.app')
@section('content')


  <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb-tracking">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Tracking</h4>
                <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    <li class="breadcrumb-item text-light fw-bolder"><a href="">Home</a></li>
                    <li class="breadcrumb-item active text-primary">Tracking</li>
                </ol>    
                 <small class="text-white fw-bolder">Tracking Your Logistic-shipping</small>
            </div>
        </div>
        <!-- Header End -->

<div class="container-fluid py-5" style="background-color: #fff;">
  <div class="container">
    <div class="row align-items-center g-5">
      
      <!-- Kiri: Form Tracking -->
      <div class="col-lg-6">
        <div class="card border-0 shadow rounded-4 p-4 p-md-5">
          <h3 class="fw-bold text-primary mb-4">Track Your Shipment</h3>
          <form id="trackingForm">
            <div class="mb-3">
              <label for="trackingNumber" class="form-label fw-semibold">Tracking Number <span class="text-danger">*</span></label>
              <input type="text" class="form-control rounded-pill px-3 py-2" id="trackingNumber" placeholder="Example: ABJ-123-145-153535JK">
            </div>
            <small class="d-block mb-3 text-muted">Need help? Contact our support team below.</small>
            <button type="submit" class="btn btn-danger rounded-pill px-4 py-2 fw-bold">Track Now</button>
          </form>

          <!-- Tracking Result (hidden by default) -->
          <div id="trackingResult" class="mt-5 d-none">
            <h5 class="fw-bold text-secondary mb-3">Tracking Result</h5>
            
            <!-- Timeline -->
            <ul class="timeline list-unstyled position-relative ps-4">
              <li class="mb-4 d-flex position-relative">
                <div class="me-3 text-primary"><i class="bi bi-check-circle-fill"></i></div>
                <div>
                  <strong>Shipment Created</strong> <br>
                  <small class="text-muted">Jakarta Warehouse - Jan 15, 2025</small>
                </div>
              </li>
              <li class="mb-4 d-flex position-relative">
                <div class="me-3 text-primary"><i class="bi bi-truck"></i></div>
                <div>
                  <strong>In Transit</strong> <br>
                  <small class="text-muted">Surabaya Hub - Jan 17, 2025</small>
                </div>
              </li>
              <li class="mb-4 d-flex position-relative">
                <div class="me-3 text-warning"><i class="bi bi-airplane"></i></div>
                <div>
                  <strong>Departed by Air</strong> <br>
                  <small class="text-muted">Singapore - Jan 18, 2025</small>
                </div>
              </li>
              <li class="d-flex position-relative">
                <div class="me-3 text-success"><i class="bi bi-box-seam"></i></div>
                <div>
                  <strong>Out for Delivery</strong> <br>
                  <small class="text-muted">Customer Address - Est. Jan 20, 2025</small>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Kanan: Card Support -->
      <div class="col-lg-5">
        <div class="card border-0 shadow rounded-4 overflow-hidden">
          <!-- Gambar Background -->
          <img src="{{ asset('assets/frontend/img/support.jpg') }}" class="card-img" alt="Support">

          <!-- Overlay -->
          <div class="card-img-overlay d-flex flex-column justify-content-center text-white text-center p-4" 
               style="background: rgba(0,0,0,0.5); backdrop-filter: blur(4px);">
            <h4 class="fw-bold mb-2">HAVING TROUBLE?</h4>
            <p class="mb-3">Please, feel free to contact us</p>
            <p class="mb-1"><i class="bi bi-envelope me-2"></i> info@inquiry@wpclogistics.com.com</p>
            <p><i class="bi bi-telephone me-2"></i> +62 21 3450605 </p>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>



<!-- Certification Logos Section -->
<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="card border-0 shadow rounded-4 p-4 text-center">
        <h5 class="fw-bold mb-4" style="color:#002147;">Our Certifications</h5>
        <img src="{{ asset('assets/frontend/img/certification-logo.png') }}" 
             alt="Certifications" 
             class="img-fluid"
             style="max-height: 80px; object-fit: contain;">
      </div>
    </div>
  </div>
</div>



<!-- CSS tambahan untuk timeline -->
<style>
/* Timeline garis */
.timeline {
  border-left: 2px solid #2b2b31; /* garis utama */
}

.timeline li {
  position: relative;
  padding-left: 1rem;
}

.timeline li::before {
  content: "";
  position: absolute;
  left: -9px; /* posisinya sejajar dengan ikon */
  top: 0;
  bottom: 0;
  width: 2px;
  background: #a7020a;
}

.timeline li:last-child::before {
  bottom: 50%; /* berhenti sebelum item terakhir */
}
</style>

<!-- Script untuk demo tracking -->
<script>
document.getElementById("trackingForm").addEventListener("submit", function(e){
  e.preventDefault();
  document.getElementById("trackingResult").classList.remove("d-none");
});
</script>

@endsection