<template>
  <FrontendLayout>

     <div class="container my-4">
    <div class="alert alert-warning alert-dismissible fade show rounded-3 shadow-sm d-flex align-items-center" role="alert">
      <i class="fa-solid fa-circle-info me-2 fs-5"></i>
      <div>
        <strong>⚙️ Currently under development.</strong> This feature will be available soon!
      </div>
      <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  </div>


    <div class="container py-4">
      <ul class="nav nav-tabs mb-4" id="scheduleTabs" role="tablist">

        <li class="nav-item" role="presentation">
          <button
            class="nav-link active"
            id="vessel-tab"
            data-bs-toggle="tab"
            data-bs-target="#vessel"
            type="button"
            role="tab"
          >
            <i class="fa-solid fa-ship me-1"></i> {{ $t('schedule.tabs.vessel') }}
          </button>
        </li>


        <li class="nav-item" role="presentation">
          <button
            class="nav-link"
            id="vessel-lists-tab"
            data-bs-toggle="tab"
            data-bs-target="#vesselLists"
            type="button"
            role="tab"
          >
            <i class="fa-solid fa-ship me-1"></i> List vessel
          </button>
        </li>


        <li class="nav-item" role="presentation">
          <button
            class="nav-link"
            id="point-tab"
            data-bs-toggle="tab"
            data-bs-target="#point-to-point"
            type="button"
            role="tab"
          >
            <i class="fa fa-route me-1"></i> {{ $t('schedule.tabs.pointToPoint') }}
          </button>
        </li>
        
        <li class="nav-item" role="presentation">
          <button
            class="nav-link"
            id="port-tab"
            data-bs-toggle="tab"
            data-bs-target="#port"
            type="button"
            role="tab"
          >
            <i class="fa-solid fa-anchor me-1"></i> {{ $t('schedule.tabs.port') }}
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button
            class="nav-link"
            id="long-tab"
            data-bs-toggle="tab"
            data-bs-target="#long-range"
            type="button"
            role="tab"
          >
            <i class="fa-solid fa-clock-rotate-left me-1"></i> {{ $t('schedule.tabs.longRange') }}
          </button>
        </li>
      </ul>

      <div class="tab-content" id="scheduleTabsContent">
        <div
          class="tab-pane fade"
          id="point-to-point"
          role="tabpanel"
          aria-labelledby="point-tab"
        >
          <div class="card shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h4 class="fw-bold">{{ $t('schedule.pointToPoint.title') }}</h4>
            </div>

            <form>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">{{ $t('schedule.pointToPoint.origin') }}</label>
                  <input
                    type="text"
                    class="form-control"
                    :placeholder="$t('schedule.pointToPoint.originPlaceholder')"
                  />
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">{{ $t('schedule.pointToPoint.destination') }}</label>
                  <input
                    type="text"
                    class="form-control"
                    :placeholder="$t('schedule.pointToPoint.destinationPlaceholder')"
                  />
                </div>
              </div>

              <div class="row">
                <div class="col-md-4 mb-3">
                  <label class="form-label">{{ $t('schedule.pointToPoint.date') }}</label>
                  <input type="date" class="form-control" />
                </div>
                <div class="col-md-4 mb-3">
                  <label class="form-label">{{ $t('schedule.pointToPoint.next') }}</label>
                  <select class="form-select">
                    <option>{{ $t('schedule.pointToPoint.nextOptions.oneWeek') }}</option>
                    <option selected>{{ $t('schedule.pointToPoint.nextOptions.twoWeeks') }}</option>
                    <option>{{ $t('schedule.pointToPoint.nextOptions.oneMonth') }}</option>
                  </select>
                </div>
                <div class="col-md-4 mb-3">
                  <label class="form-label">{{ $t('schedule.pointToPoint.cargoType') }}</label>
                  <select class="form-select">
                    <option>{{ $t('schedule.pointToPoint.cargoOptions.dryGeneral') }}</option>
                    <option>Reefer</option>
                    <option>{{ $t('schedule.pointToPoint.cargoOptions.dangerousGoods') }}</option>
                  </select>
                </div>
              </div>

              <div class="mb-3">
                <div class="form-check">
                  <input
                    type="checkbox"
                    class="form-check-input"
                    id="humanCheck"
                  />
                  <label class="form-check-label" for="humanCheck">
                    {{ $t('schedule.pointToPoint.humanCheck') }}
                  </label>
                </div>
              </div>

              <div class="text-end mt-3">
                <button
                  type="reset"
                  class="btn btn-secondary me-1 btn-gradient-secondary"
                >
                  <i class="fa-solid fa-rotate"></i> {{ $t('schedule.pointToPoint.clear') }}
                </button>
                <button
                  type="submit"
                  class="btn btn-primary btn-gradient"
                >
                  <i class="fa-solid fa-magnifying-glass"></i> {{ $t('schedule.pointToPoint.search') }}
                </button>
              </div>
            </form>
          </div>
        </div>

        <div
          class="tab-pane fade show active"
          id="vessel"
          role="tabpanel"
          aria-labelledby="vessel-tab"
        >
          <div class="card shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h4 class="fw-bold">{{ $t('schedule.vessel.title') }}</h4>
            </div>

            <form @submit.prevent="searchVessel">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label fw-semibold">{{ $t('schedule.vessel.vesselName') }}</label>
                  <div class="input-group">
                    <span class="input-group-text bg-light">
                      <i class="fa-solid fa-ship"></i>
                    </span>
                    <input
                      type="text"
                      class="form-control"
                      :placeholder="$t('schedule.vessel.vesselPlaceholder')"
                      v-model="vesselName"
                    />
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label fw-semibold">{{ $t('schedule.vessel.cargoType') }}</label>
                  <select class="form-select" v-model="cargoType">
                    <option>{{ $t('schedule.vessel.cargoOptions.dryGeneral') }}</option>
                    <option>Reefer</option>
                    <option>{{ $t('schedule.vessel.cargoOptions.hazardous') }}</option>
                  </select>
                </div>
              </div>

              <div class="mb-3">
                <div class="form-check">
                  <input
                    type="checkbox"
                    class="form-check-input"
                    id="confirmCheck"
                    v-model="confirmed"
                  />
                  <label class="form-check-label" for="confirmCheck">
                    {{ $t('schedule.vessel.confirmCheck') }}
                  </label>
                </div>
              </div>

              <div class="text-end mt-3">
                <button
                  type="reset"
                  class="btn btn-gradient-secondary me-2"
                  @click="clearForm"
                >
                  <i class="fa-solid fa-rotate"></i> {{ $t('schedule.vessel.clear') }}
                </button>
                <button
                  type="submit"
                  class="btn btn-primary btn-gradient"
                  :disabled="!confirmed"
                >
                  <i class="fa-solid fa-magnifying-glass me-1"></i> {{ $t('schedule.vessel.search') }}
                </button>
              </div>
            </form>
          </div>

          <div v-if="vessel" class="card shadow-sm p-4 mt-4">
            <div
              class="d-flex justify-content-between align-items-center mb-3"
            >
              <h5 class="fw-bold text-primary mb-0">{{ vessel.name }}</h5>
              <span class="badge bg-info text-dark">
                {{ $t('schedule.vessel.result.service') }}: {{ vessel.service }}
              </span>
            </div>
            <p class="text-muted mb-3 small">
              {{ $t('schedule.vessel.result.status') }} {{ vessel.status.substring(vessel.status.indexOf('from') + 5) }}
            </p>
            <hr />
            <h6 class="fw-semibold mb-3">
              {{ $t('schedule.vessel.result.totalPorts', { count: vessel.ports.length }) }}
            </h6>

            <div class="vstack gap-3">
              <div
                v-for="(port, index) in vessel.ports"
                :key="index"
                class="border rounded-3 p-3 bg-light"
              >
                <div
                  class="d-flex justify-content-between align-items-center mb-2"
                >
                  <h6 class="mb-0">
                    {{ port.port }}
                    <span
                      v-if="port.current"
                      class="badge bg-primary ms-2"
                    >
                      {{ $t('schedule.vessel.result.currentPort') }}
                    </span>
                  </h6>
                  <small class="text-muted">
                    {{ $t('schedule.vessel.result.voyage') }}: {{ port.voyage }}
                  </small>
                </div>
                <p class="text-muted small mb-1">
                  {{ $t('schedule.vessel.result.terminal') }}: {{ port.terminal }}
                </p>
                <div class="row small text-muted">
                  <div class="col-md-6">
                    {{ $t('schedule.vessel.result.arrival') }}: <strong>{{ port.arrival }}</strong>
                  </div>
                  <div class="col-md-6">
                    {{ $t('schedule.vessel.result.departure') }}: <strong>{{ port.departure }}</strong>
                    <button class="btn btn-sm btn-outline-secondary ms-2">
                      {{ $t('schedule.vessel.result.cutOff') }}
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div
          class="tab-pane fade"
          id="port"
          role="tabpanel"
          aria-labelledby="port-tab"
        >
          <div class="alert alert-info">
            {{ $t('schedule.placeholder.portComingSoon') }}
          </div>
        </div>


        <div
          class="tab-pane fade"
          id="long-range"
          role="tabpanel"
          aria-labelledby="long-tab"
          >
          <div class="alert alert-info">
            {{ $t('schedule.placeholder.longRangeComingSoon') }}
          </div>
        </div>



        <div
          class="tab-pane fade"
          id="vesselLists"
          role="tabpanel"
          aria-labelledby="long-tab"
          >
          
          <div class="container my-4">
    <div class="card shadow-lg border-0 rounded-4">
      <!-- Header -->
      <div class="card-header bg-primary text-white rounded-top-4 py-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
          <i class="fa-solid fa-ship"></i> List Vessel Schedule
        </h5>
        <div class="position-relative" style="max-width: 250px;">

          <input
            type="text"
            v-model="searchQuery"
            placeholder="Search vessel..."
            class="form-control search-input"
          />
        </div>
      </div>

      <!-- Table -->
      <div class="table-responsive">
        <table class="table align-middle table-hover mb-0">
          <thead class="table-light text-center">
            <tr>
              <th>Vessel Name</th>
              <th>Voyage</th>
              <th>Arrival</th>
              <th>Berthing</th>
              <th>Departure</th>
              <th>Closing</th>
              <th>Terminal</th>
              <th>Status</th>
              <th>Open Stack</th>
            </tr>
          </thead>
          <tbody class="text-center">
            <tr v-for="(item, index) in paginatedData" :key="index">
              <td><strong>{{ item.vessel }}</strong></td>
              <td>{{ item.voyage }}</td>
              <td>
                {{ item.arrival.date }}<br />
                <small class="text-muted">{{ item.arrival.time }}</small>
              </td>
              <td>
                {{ item.berthing.date }}<br />
                <small class="text-muted">{{ item.berthing.time }}</small>
              </td>
              <td>
                {{ item.departure.date }}<br />
                <small class="text-muted">{{ item.departure.time }}</small>
              </td>
              <td>{{ item.closing }}</td>
              <td><span class="badge bg-primary text-light">{{ item.terminal }}</span></td>
              <td>-</td>
              <td>{{ item.openStack }}</td>
            </tr>
            <tr v-if="paginatedData.length === 0">
              <td colspan="9" class="text-muted py-4">No matching vessels found</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Footer -->
      <div class="card-footer bg-light d-flex justify-content-between align-items-center">
        <small class="text-muted">
          Showing {{ startRow + 1 }} to {{ endRow }} of {{ filteredData.length }} entries
        </small>
        <nav>
          <ul class="pagination pagination-sm mb-0">
            <li
              class="page-item"
              :class="{ disabled: currentPage === 1 }"
              @click="prevPage"
            >
              <a class="page-link" href="#">Prev</a>
            </li>
            <li
              v-for="page in totalPages"
              :key="page"
              class="page-item"
              :class="{ active: currentPage === page }"
              @click="goToPage(page)"
            >
              <a class="page-link" href="#">{{ page }}</a>
            </li>
            <li
              class="page-item"
              :class="{ disabled: currentPage === totalPages }"
              @click="nextPage"
            >
              <a class="page-link" href="#">Next</a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>




        </div>
      </div>
    </div>









    <div class="container my-5">
    <div class="row g-4">
      <!-- 🟦 Card 1 -->
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

      <!-- 🟣 Card 2 -->
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
  </FrontendLayout>
</template>

<script setup>
import { ref, computed } from "vue";
import FrontendLayout from "../../../layouts/FrontendLayout.vue";
// NOTE: Jika Anda menggunakan setup script, Anda mungkin tidak perlu mengimpor useI18n
// karena properti global $t harusnya tersedia secara otomatis di template.

const vesselName = ref("");
const cargoType = ref("Dry/General");
const confirmed = ref(false);

const vessel = ref(null);

const clearForm = () => {
  vesselName.value = "";
  cargoType.value = "Dry/General";
  confirmed.value = false;
  vessel.value = null;
};

const searchVessel = () => {
  // Data mock (contoh hasil pencarian)
  vessel.value = {
    name: "CAROLINE MAERSK (CINT)",
    service: "SX2",
    status:
      "Departed from SHEKOU, GUANGDONG (CCT CHIWAN CONTAINER TERMINAL) at 2020-03-18 20:00",
    ports: [
      {
        port: "HONG KONG",
        voyage: "012S",
        terminal: "HIT (HONGKONG INTERNATIONAL TERMINALS)",
        arrival: "2020-03-16 16:10",
        departure: "2020-03-17 02:05",
        current: false,
      },
      {
        port: "SHEKOU, GUANGDONG",
        voyage: "012S",
        terminal: "CCT (CHIWAN CONTAINER TERMINAL)",
        arrival: "2020-03-18 02:17",
        departure: "2020-03-18 20:00",
        current: true,
      },
    ],
  };
};





// code list


const searchQuery = ref("");
const currentPage = ref(1);
const rowsPerPage = 3;

// Data tabel statis
const vessels = ref([
  {
    vessel: "SONGA SUCCESS",
    voyage: "0041N",
    arrival: { date: "31/10/2025", time: "07:00" },
    berthing: { date: "31/10/2025", time: "09:30" },
    departure: { date: "01/11/2025", time: "11:30" },
    closing: "-",
    terminal: "T1",
    openStack: "-",
  },
  {
    vessel: "WAN HAI 377",
    voyage: "W015",
    arrival: { date: "31/10/2025", time: "03:00" },
    berthing: { date: "31/10/2025", time: "06:30" },
    departure: { date: "01/11/2025", time: "07:30" },
    closing: "-",
    terminal: "T1",
    openStack: "-",
  },
  {
    vessel: "SPIL KARTINI",
    voyage: "009N",
    arrival: { date: "30/10/2025", time: "18:00" },
    berthing: { date: "30/10/2025", time: "19:00" },
    departure: { date: "01/11/2025", time: "09:00" },
    closing: "-",
    terminal: "T1",
    openStack: "-",
  },
  {
    vessel: "XIN FANG CHENG",
    voyage: "298N",
    arrival: { date: "30/10/2025", time: "06:00" },
    berthing: { date: "30/10/2025", time: "15:00" },
    departure: { date: "01/11/2025", time: "05:00" },
    closing: "-",
    terminal: "T1",
    openStack: "-",
  },
  {
    vessel: "CNC PANTHER",
    voyage: "0K80AN",
    arrival: { date: "29/10/2025", time: "00:00" },
    berthing: { date: "29/10/2025", time: "20:00" },
    departure: { date: "31/10/2025", time: "00:00" },
    closing: "-",
    terminal: "T1",
    openStack: "-",
  },
]);

// Filter pencarian
const filteredData = computed(() => {
  if (!searchQuery.value) return vessels.value;
  return vessels.value.filter((v) =>
    Object.values(v)
      .join(" ")
      .toLowerCase()
      .includes(searchQuery.value.toLowerCase())
  );
});

// Pagination
const totalPages = computed(() =>
  Math.ceil(filteredData.value.length / rowsPerPage)
);
const startRow = computed(() => (currentPage.value - 1) * rowsPerPage);
const endRow = computed(() =>
  Math.min(startRow.value + rowsPerPage, filteredData.value.length)
);
const paginatedData = computed(() =>
  filteredData.value.slice(startRow.value, endRow.value)
);

function nextPage() {
  if (currentPage.value < totalPages.value) currentPage.value++;
}
function prevPage() {
  if (currentPage.value > 1) currentPage.value--;
}
function goToPage(page) {
  currentPage.value = page;
}
</script>

<style scoped>
.card {
  border-radius: 14px;
}

.text-gradient {
  background: linear-gradient(90deg, #007bff, #00b3ff);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.text-shadow {
  text-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
}

.btn-gradient {
  background: linear-gradient(90deg, #007bff, #0056b3);
  border: none;
  transition: all 0.3s ease;
  border-radius: 12px;
}

.btn-gradient:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 14px rgba(0, 123, 255, 0.3);
}

.btn-gradient-secondary {
  background: linear-gradient(90deg, #6c757d, #495057); /* abu ke abu tua */
  color: #fff;
  border: none;
  transition: all 0.3s ease;
  border-radius: 12px;
}

.btn-gradient-secondary:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 14px rgba(108, 117, 125, 0.4); /* shadow abu-abu */
}


.card {
  transition: all 0.3s ease;
  cursor: pointer;
}

.card:hover {
  transform: translateY(-6px) scale(1.05);
  box-shadow: 0 8px 20px rgba(0, 123, 255, 0.15);
}


.search-input {
  border-radius: 10px;
  border: 1px solid #d0d7de;
  padding-left: 40px;
}
.search-icon {
  position: absolute;
  left: 15px;
  top: 10px;
  color: #6c757d;
}
.table thead th {
  background-color: #f1f3f6;
  font-weight: 600;
}
.table-hover tbody tr:hover {
  background-color: #f9fbff;
  transition: all 0.2s;
}
.pagination .page-link {
  border-radius: 8px;
  margin: 0 3px;
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