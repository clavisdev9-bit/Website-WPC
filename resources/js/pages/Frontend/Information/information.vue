<template>
  <FrontendLayout>
    <!--  FEATURE CARDS -->
    <div class="container my-5">
      <div class="row g-4">
        <!--  Card 1 -->
        <div class="col-12 col-md-6">
          <div
            class="card text-white border-0 shadow-sm rounded-4 modern-bg-1 p-4 h-100"
          >
            <div
              class="row align-items-center text-center text-md-start flex-column flex-md-row"
            >
              <div class="col">
                <h2 class="h4 fw-bold mb-2">Want to make fast delivery?</h2>
                <p class="mb-3 mb-md-0 text-white">
                  We send your package quickly and it will arrive safely at its
                  destination!
                </p>
              </div>
              <div class="col-auto">
                <RouterLink
                  to="/wpc-esys/qoutation-request"
                  class="btn btn-light fw-semibold px-4 py-2 rounded-pill"
                >
                  Make a Quotation Offer Now
                </RouterLink>
              </div>
            </div>
          </div>
        </div>

        <!--  Card 2 -->
        <div class="col-12 col-md-6">
          <div
            class="card text-white border-0 shadow-sm rounded-4 modern-bg-2 p-4 h-100"
          >
            <div
              class="row align-items-center text-center text-md-start flex-column flex-md-row"
            >
              <div class="col">
                <h2 class="h4 fw-bold mb-2">
                  Want to Check Shipping Schedule?
                </h2>
                <p class="mb-3 mb-md-0 text-white">
                  Easily find the latest shipping schedules to ensure your
                  deliveries are always on time and efficiently managed!
                </p>
              </div>
              <div class="col-auto">
                <RouterLink
                  to="/wpc-esys/schedule"
                  class="btn btn-light fw-semibold px-4 py-2 rounded-pill"
                >
                  Check Schedule Now
                </RouterLink>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--  NEWS SECTION -->
    <div class="container py-5">
      <h2 class="fw-bold mb-5 text-center">What's New? Latest Updates</h2>

      <div class="row g-4">
        <div
          v-for="(article, index) in articles"
          :key="index"
          class="col-12 col-sm-6 col-lg-4 d-flex"
        >
          <div
            class="card news-card border-0 shadow-sm rounded-4 flex-fill h-100"
          >
            <img
              :src="article.image"
              :alt="article.title"
              class="card-img-top rounded-top-4 object-fit-cover"
              height="180"
            />
            <div class="card-body p-4 d-flex flex-column">
              <div
                class="d-flex align-items-center gap-2 small mb-2 text-muted flex-wrap"
              >
                <span>{{ article.date }}</span>
                <span
                  class="badge bg-light text-primary fw-semibold border rounded-pill px-2"
                >
                  {{ article.category }}
                </span>
              </div>

              <h5 class="fw-bold mb-2 text-dark">{{ article.title }}</h5>
              <p class="text-muted small mb-4 flex-grow-1">
                {{ article.description }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--  CTA CARD -->
    <div class="container mb-5">
      <div
        class="card card-md text-white border-0 shadow-sm rounded-4 modern-bg p-4"
      >
        <div
          class="row align-items-center text-center text-md-start flex-column flex-md-row"
        >
          <div class="col">
            <h2 class="h4 fw-bold mb-2">Want to make fast delivery?</h2>
            <p class="mb-3 mb-md-0 text-white">
              We send your package quickly and it will arrive safely at its
              destination!
            </p>
          </div>
          <div class="col-auto">
            <RouterLink
              to="/wpc-esys/qoutation-request"
              class="btn btn-light fw-semibold px-4 py-2 rounded-pill"
            >
              Make a Quotation Offer Now
            </RouterLink>
          </div>
        </div>
      </div>
    </div>
  </FrontendLayout>
</template>

<script setup>
import FrontendLayout from "../../../layouts/FrontendLayout.vue";
import { ref } from "vue";

const articles = ref([
  {
    date: "Sept 15 2025",
    category: "NEW FEATURE",
    title: "Request Quotation",
    description:
      "Experience the newly enhanced quotation request feature, with a cleaner layout and streamlined workflow for faster customer response times.",
    image: "/images/information.png",
  },
  {
    date: "Okt 15 2025",
    category: "NEW FEATURE",
    title: "Latest Check Agent",
    description:
      "Enjoy a simpler, faster, and smarter agent verification process with our new Latest Check Agent feature, ensuring accurate and up-to-date data across all platforms.",
    image: "/images/information.png",
  },
  {
    date: "Nov 11 2025",
    category: "NEW FEATURE",
    title: "Check Schedule",
    description:
      "Experience a new look and improved scheduling interface with our latest Check Schedule feature. From planning to booking, enjoy a smoother and more intuitive process for managing your shipments.",
    image: "/images/information.png",
  },
]);
</script>

<style scoped>
/*  General Responsive Card Effects */
.news-card {
  transition: transform 0.25s ease, box-shadow 0.25s ease;
}
.news-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
}

.card-img-top {
  object-fit: cover;
  height: 180px;
}

.badge {
  font-size: 0.75rem;
}

/*  Modern Gradient Styles */
.modern-bg,
.modern-bg-1,
.modern-bg-2 {
  position: relative;
  overflow: hidden;
  color: white;
}

.modern-bg {
  background: linear-gradient(135deg, #036fc7, #0d6efd);
}
.modern-bg::before {
  content: "";
  position: absolute;
  top: -20%;
  left: -10%;
  width: 150%;
  height: 150%;
  background: radial-gradient(
    circle at 30% 30%,
    rgba(255, 255, 255, 0.2),
    transparent 70%
  );
  filter: blur(60px);
}

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
  background: radial-gradient(
    circle at 30% 30%,
    rgba(255, 255, 255, 0.2),
    transparent 70%
  );
  filter: blur(60px);
}

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
  background: radial-gradient(
    circle at 60% 60%,
    rgba(255, 255, 255, 0.25),
    transparent 70%
  );
  filter: blur(60px);
}

/* Pastikan layer efek tidak menutupi konten */
.modern-bg::before,
.modern-bg-1::before,
.modern-bg-2::before {
  z-index: 0;
}

/* Pastikan konten di atas efek background */
.modern-bg > *,
.modern-bg-1 > *,
.modern-bg-2 > * {
  position: relative;
  z-index: 1;
}

/* Tombol tetap bisa diklik di atas semua layer */
.btn {
  position: relative;
  z-index: 2;
}


/* Card Hover Transition */
.card {
  transition: all 0.3s ease;
}
.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

/*  Responsive Adjustments */
@media (max-width: 768px) {
  .container {
    padding: 0 1rem;
  }

  h2.h4 {
    font-size: 1.1rem;
  }

  .btn {
    font-size: 0.9rem;
    padding: 0.5rem 1.25rem;
  }

  .news-card {
    margin-bottom: 1rem;
  }
}
</style>
