<template>
  <FrontendLayout>

    <!-- Documentation Header -->
    <div class="py-5 bg-light border-bottom">
      <div class="container">
        <h1 class="fw-bold text-primary mb-2">Quotation Request Documentation</h1>
        <p class="text-muted mb-0">
          A complete guide to creating and submitting a request for quotation in the ESYS WPC system. You can download this PDF file for reference, or read the rules below.
        </p>
         <button class="btn btn-danger"> <i class="fa-solid fa-file-pdf"> </i> Download PDF Quotation Request</button>
      </div>
    </div>

    <!-- Documentation Content -->
    <div class="container my-5">
      <div class="row justify-content-center">
        <div class="col-12 col-lg-10">

          <!-- Intro Card -->
          <div class="card shadow-sm border-0 rounded-4 mb-4">
            <div class="card-body p-4">
              <h4 class="fw-bold text-primary mb-3">
                <i class="fa-solid fa-circle-info me-2"></i> Introduction
              </h4>
              <p class="mb-0">
                The Quotation Request feature allows users to send price inquiries for shipments quickly and safely.
                Follow the steps below to submit a quotation correctly.
              </p>
            </div>
          </div>

          <!-- User Documentation Accordion -->
          <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-light py-3 border-0">
              <h4 class="fw-bold text-primary mb-0">
                <i class="fa-solid fa-book me-2"></i> Documentation — Send Quotation
              </h4>
            </div>

            <div class="card-body p-4">
              <div class="accordion" id="documentationAccordion">

                <!-- Step 1 -->
                <div class="accordion-item border-0 mb-3 rounded-3 overflow-hidden">
                  <h2 class="accordion-header">
                    <button
                      class="accordion-button fw-semibold"
                      type="button"
                      data-bs-toggle="collapse"
                      data-bs-target="#docStep1"
                    >
                      Step 1 — Go to the Quotation Request Page
                    </button>
                  </h2>
                  <div
                    id="docStep1"
                    class="accordion-collapse collapse show"
                    data-bs-parent="#documentationAccordion"
                  >
                    <div class="accordion-body">
                      Click the <strong>“Quotation Request”</strong> menu on the main dashboard,
                      then select <em>“Create New Quotation”</em> to start sending a new quotation.
                    </div>
                  </div>
                </div>

                <!-- Step 2 (contoh kosong, tinggal isi) -->
                <div class="accordion-item border-0 mb-3 rounded-3 overflow-hidden">
                  <h2 class="accordion-header">
                    <button
                      class="accordion-button collapsed fw-semibold"
                      type="button"
                      data-bs-toggle="collapse"
                      data-bs-target="#docStep2"
                    >
                      Step 2 — complete your personal data (personal information)
                    </button>
                  </h2>
                  <div
                    id="docStep2"
                    class="accordion-collapse collapse"
                    data-bs-parent="#documentationAccordion"
                  >
                    <div class="accordion-body">
                       you will see a page to fill in your personal/company data such as "company name or your name, phone number, email, country, and state"
                    </div>
                  </div>
                </div>


                <div class="accordion-item border-0 mb-3 rounded-3 overflow-hidden">
                  <h2 class="accordion-header">
                    <button
                      class="accordion-button collapsed fw-semibold"
                      type="button"
                      data-bs-toggle="collapse"
                      data-bs-target="#docStep3"
                    >
                      Step 3 — complete cargo Details
                    </button>
                  </h2>
                  <div
                    id="docStep3"
                    class="accordion-collapse collapse"
                    data-bs-parent="#documentationAccordion"
                  >
                    <div class="accordion-body">
                       on the next page you will see a page to fill in cargo details such as
                        "commodity,uom,rasio,qty,Kilogram Charge (KGS CHG),Kilogram Gross Weight (KGS WT),Other Notes.
                    </div>
                  </div>
                </div>



                <div class="accordion-item border-0 mb-3 rounded-3 overflow-hidden">
                  <h2 class="accordion-header">
                    <button
                      class="accordion-button collapsed fw-semibold"
                      type="button"
                      data-bs-toggle="collapse"
                      data-bs-target="#docStep4"
                    >
                      Step 4 — complete Route Details 
                    </button>
                  </h2>
                  <div
                    id="docStep4"
                    class="accordion-collapse collapse"
                    data-bs-parent="#documentationAccordion"
                  >
                    <div class="accordion-body">
                        on the next page you will see a page to fill in route details such as
                        "Origin,Destination" after everything is filled in, don't forget to verify by pressing and sliding the verification button
                        and finally press the "Submit Quotation Request" button to send your quotation request.
                    </div>
                  </div>
                </div>


                <div class="accordion-item border-0 mb-3 rounded-3 overflow-hidden">
                  <h2 class="accordion-header">
                    <button
                      class="accordion-button collapsed fw-semibold"
                      type="button"
                      data-bs-toggle="collapse"
                      data-bs-target="#docStep5"
                    >
                      Step 5 — wait for confirmation from WPC
                    </button>
                  </h2>
                  <div
                    id="docStep5"
                    class="accordion-collapse collapse"
                    data-bs-parent="#documentationAccordion"
                  >
                    <div class="accordion-body">
                          after you press the "Submit Quotation Request" button
                          you just need to wait for confirmation from WPC via
                          the email or phone number you registered previously.
                          within 24 hours we will confirm and send the best price offer for your shipment.
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
import FrontendLayout from "../../../layouts/FrontendLayout.vue";
</script>

<style scoped>
.accordion-button {
  background-color: #f8f9fa;
  transition: 0.3s ease;
}
.accordion-button:not(.collapsed) {
  background-color: #e7f1ff;
  color: #0d6efd;
}
</style>
