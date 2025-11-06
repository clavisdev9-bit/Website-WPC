<template>
    <FrontendLayout>

        

    <div class="container my-5">
    <div class="row g-4">
      <!--  Card 1 -->
      <div class="col-12 col-md-6">
        <div class="card text-white border-0 shadow-sm rounded-4 modern-bg-1 p-4 h-100">
          <div class="row align-items-center">
            <div class="col">
              <h2 class="h4 fw-bold mb-2">Want to make fast delivery?</h2>
              <p class="mb-0 text-white">
                We send your package quickly and it will arrive at its destination safely!
              </p>
            </div>
            <div class="col-auto">
              <RouterLink
                to="/wpc-esys/qoutation-request"
                class="btn btn-light fw-semibold px-4 rounded-pill"
              >
                Make a Quotation Offer Now
              </RouterLink>
            </div>
          </div>
        </div>
      </div>

      <!--  Card 2 -->
      <div class="col-12 col-md-6">
        <div class="card text-white border-0 shadow-sm rounded-4 modern-bg-2 p-4 h-100">
          <div class="row align-items-center">
            <div class="col">
              <h2 class="h4 fw-bold mb-2">Want to Check Shipping Schedule?</h2>
              <p class="mb-0 text-white">
                Easily find the latest shipping schedules to ensure your deliveries are always on time and efficiently managed!
              </p>
            </div>
            <div class="col-auto">
              <RouterLink
                to="/check-schedule"
                class="btn btn-light fw-semibold px-4 rounded-pill"
              >
                Check Schedule Now
              </RouterLink>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


    <div class="container py-5">
    <div class="row g-4">
      <!-- 🧭 Left Card - User Guide Kirim Quotation -->
      <div class="col-12 col-md-6">
        <div class="card shadow-sm border-0 rounded-4 h-100">
          <div class="card-header bg-light border-0 py-3">
            <h4 class="fw-bold mb-0 text-primary">
              <i class="fa-solid fa-paper-plane me-2"></i> User Guide — Kirim Quotation
            </h4>
          </div>
          <div class="card-body">
            <div class="accordion" id="accordionQuotation">
              <div class="accordion-item border-0 mb-2 rounded-3 overflow-hidden">
                <h2 class="accordion-header">
                  <button
                    class="accordion-button fw-semibold"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#guideOne"
                  >
                    Step 1 — Masuk ke Halaman Quotation Request
                  </button>
                </h2>
                <div
                  id="guideOne"
                  class="accordion-collapse collapse show"
                  data-bs-parent="#accordionQuotation"
                >
                  <div class="accordion-body">
                    Klik menu <strong>“Quotation Request”</strong> pada dashboard utama, lalu pilih opsi 
                    <em>“Create New Quotation”</em> untuk memulai pengiriman penawaran baru.
                  </div>
                </div>
              </div>

              <div class="accordion-item border-0 mb-2 rounded-3 overflow-hidden">
                <h2 class="accordion-header">
                  <button
                    class="accordion-button collapsed fw-semibold"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#guideTwo"
                  >
                    Step 2 — Lengkapi Detail Pengiriman
                  </button>
                </h2>
                <div
                  id="guideTwo"
                  class="accordion-collapse collapse"
                  data-bs-parent="#accordionQuotation"
                >
                  <div class="accordion-body">
                    Isi semua kolom wajib seperti <strong>asal, tujuan, jenis barang, berat, dan volume</strong>.
                    Pastikan semua data sudah benar agar penawaran akurat.
                  </div>
                </div>
              </div>

              <div class="accordion-item border-0 mb-2 rounded-3 overflow-hidden">
                <h2 class="accordion-header">
                  <button
                    class="accordion-button collapsed fw-semibold"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#guideThree"
                  >
                    Step 3 — Kirim dan Tunggu Konfirmasi
                  </button>
                </h2>
                <div
                  id="guideThree"
                  class="accordion-collapse collapse"
                  data-bs-parent="#accordionQuotation"
                >
                  <div class="accordion-body">
                    Setelah data lengkap, klik <strong>“Submit Quotation”</strong>.  
                    Sistem akan memproses dan mengirimkan konfirmasi melalui email atau dashboard Anda.
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- ❓ Right Card - FAQ -->
      <div class="col-12 col-md-6">
        <div class="card shadow-sm border-0 rounded-4 h-100">
          <div class="card-header bg-light border-0 py-3">
            <h4 class="fw-bold mb-0 text-primary">
              <i class="fa-solid fa-circle-question me-2"></i> Frequently Asked Questions
            </h4>
          </div>
          <div class="card-body">
            <div class="accordion" id="accordionFAQ">
              <div class="accordion-item border-0 mb-2 rounded-3 overflow-hidden">
                <h2 class="accordion-header">
                  <button
                    class="accordion-button fw-semibold"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#faqOne"
                  >
                    Apakah saya bisa mengedit quotation setelah dikirim?
                  </button>
                </h2>
                <div
                  id="faqOne"
                  class="accordion-collapse collapse show"
                  data-bs-parent="#accordionFAQ"
                >
                  <div class="accordion-body">
                    Tidak bisa langsung diedit, namun Anda dapat membuat revisi baru dengan menyalin data dari quotation sebelumnya.
                  </div>
                </div>
              </div>

              <div class="accordion-item border-0 mb-2 rounded-3 overflow-hidden">
                <h2 class="accordion-header">
                  <button
                    class="accordion-button collapsed fw-semibold"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#faqTwo"
                  >
                    Berapa lama proses konfirmasi quotation?
                  </button>
                </h2>
                <div
                  id="faqTwo"
                  class="accordion-collapse collapse"
                  data-bs-parent="#accordionFAQ"
                >
                  <div class="accordion-body">
                    Biasanya memakan waktu kurang dari <strong>24 jam</strong>. Anda akan mendapat notifikasi otomatis begitu statusnya berubah.
                  </div>
                </div>
              </div>

              <div class="accordion-item border-0 mb-2 rounded-3 overflow-hidden">
                <h2 class="accordion-header">
                  <button
                    class="accordion-button collapsed fw-semibold"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#faqThree"
                  >
                    Apakah saya bisa membatalkan quotation?
                  </button>
                </h2>
                <div
                  id="faqThree"
                  class="accordion-collapse collapse"
                  data-bs-parent="#accordionFAQ"
                >
                  <div class="accordion-body">
                    Ya, Anda dapat membatalkan sebelum quotation dikonfirmasi oleh tim admin.
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

<script setup>
import { ref, computed } from "vue";
import FrontendLayout from "../../../layouts/FrontendLayout.vue";
</script>


<style scoped>
.card {
  transition: all 0.3s ease;
  border-radius: 1rem;
}
.card:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
}
.accordion-button {
  background-color: #f8f9fa;
  transition: all 0.3s ease;
}
.accordion-button:not(.collapsed) {
  background-color: #e7f1ff;
  color: #0d6efd;
}
.accordion-item {
  border-radius: 12px;
  overflow: hidden;
}
.accordion-body {
  background-color: #fff;
}
.card-header {
  border-bottom: 1px solid #eee;
}
@media (max-width: 768px) {
  .card {
    margin-bottom: 1rem;
  }
}




.card {
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
}

.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

/* 🩵 Modern Gradient Blue */
.modern-bg-1 {
  background: linear-gradient(135deg, #4f46e5, #0ea5e9);
}
.modern-bg-1::before {
  content: "";
  position: absolute;
  top: -20%;
  left: -10%;
  width: 150%;
  height: 150%;
  background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.2), transparent 70%);
  filter: blur(60px);
  z-index: 0;
}

/* 💜 Modern Gradient Purple-Pink */
.modern-bg-2 {
  background: linear-gradient(135deg, #9333ea, #ec4899);
}
.modern-bg-2::before {
  content: "";
  position: absolute;
  top: -20%;
  left: -10%;
  width: 150%;
  height: 150%;
  background: radial-gradient(circle at 60% 60%, rgba(255, 255, 255, 0.25), transparent 70%);
  filter: blur(60px);
  z-index: 0;
}

/* Pastikan konten dan tombol di atas efek */
.modern-bg-1 > *,
.modern-bg-2 > * {
  position: relative;
  z-index: 1;
}

.btn {
  position: relative;
  z-index: 2;
}

/* Responsif untuk mobile */
@media (max-width: 768px) {
  .row {
    flex-direction: column;
  }
  .card {
    text-align: center;
  }
  .col-auto {
    margin-top: 1rem;
  }
}

</style>
