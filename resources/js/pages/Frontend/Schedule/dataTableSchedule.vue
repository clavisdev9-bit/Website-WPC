<template>
  <FrontendLayout>
    <div class="container py-4">
      <!-- Tabs -->
      <ul class="nav nav-tabs mb-4" id="scheduleTabs" role="tablist">
        <li class="nav-item" role="presentation">
          <button
            class="nav-link"
            id="point-tab"
            data-bs-toggle="tab"
            data-bs-target="#point-to-point"
            type="button"
            role="tab"
          >
            <i class="fa fa-route me-1"></i> Schedule Point to Point
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button
            class="nav-link active"
            id="vessel-tab"
            data-bs-toggle="tab"
            data-bs-target="#vessel"
            type="button"
            role="tab"
          >
            <i class="fa-solid fa-ship me-1"></i> Vessel
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
            <i class="fa-solid fa-anchor me-1"></i> Port
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
            <i class="fa-solid fa-clock-rotate-left me-1"></i> Long Range
          </button>
        </li>
      </ul>

      <!-- Tab Contents -->
      <div class="tab-content" id="scheduleTabsContent">
        <!-- Point to Point -->
        <div
          class="tab-pane fade"
          id="point-to-point"
          role="tabpanel"
          aria-labelledby="point-tab"
        >
          <div class="card shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h4 class="fw-bold">Point to Point Search Schedule</h4>
            </div>

            <form>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">Origin</label>
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Input up to 3 Origins"
                  />
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Destination</label>
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Input up to 3 Destinations"
                  />
                </div>
              </div>

              <div class="row">
                <div class="col-md-4 mb-3">
                  <label class="form-label">Date</label>
                  <input type="date" class="form-control" />
                </div>
                <div class="col-md-4 mb-3">
                  <label class="form-label">Next</label>
                  <select class="form-select">
                    <option>1 Week</option>
                    <option selected>2 Weeks</option>
                    <option>1 Month</option>
                  </select>
                </div>
                <div class="col-md-4 mb-3">
                  <label class="form-label">Cargo Type</label>
                  <select class="form-select">
                    <option>Dry/General</option>
                    <option>Reefer</option>
                    <option>Dangerous Goods</option>
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
                  <label class="form-check-label" for="humanCheck"
                    >I am human</label
                  >
                </div>
              </div>

              <div class="text-end mt-3">
                <button
                  type="reset"
                  class="btn btn-secondary me-1 btn-gradient-secondary"
                >
                  <i class="fa-solid fa-rotate"></i> Clear
                </button>
                <button
                  type="submit"
                  class="btn btn-primary btn-gradient"
                >
                  <i class="fa-solid fa-magnifying-glass"></i> Search
                </button>
              </div>
            </form>
          </div>
        </div>

        <!-- Vessel Tab -->
        <div
          class="tab-pane fade show active"
          id="vessel"
          role="tabpanel"
          aria-labelledby="vessel-tab"
        >
          <div class="card shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h4 class="fw-bold">Vessel Schedule Search</h4>
            </div>

            <form @submit.prevent="searchVessel">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label fw-semibold">Vessel Name</label>
                  <div class="input-group">
                    <span class="input-group-text bg-light">
                      <i class="fa-solid fa-ship"></i>
                    </span>
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Enter vessel name"
                      v-model="vesselName"
                    />
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label fw-semibold">Cargo Type</label>
                  <select class="form-select" v-model="cargoType">
                    <option>Dry/General</option>
                    <option>Reefer</option>
                    <option>Hazardous</option>
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
                  <label class="form-check-label" for="confirmCheck"
                    >I confirm vessel name is correct</label
                  >
                </div>
              </div>

              <div class="text-end mt-3">
                <button
                  type="reset"
                  class="btn btn-gradient-secondary me-2"
                  @click="clearForm"
                >
                  <i class="fa-solid fa-rotate"></i> Clear
                </button>
                <button
                  type="submit"
                  class="btn btn-primary btn-gradient"
                  :disabled="!confirmed"
                >
                  <i class="fa-solid fa-magnifying-glass me-1"></i> Search
                </button>
              </div>
            </form>
          </div>

          <!-- Result -->
          <div v-if="vessel" class="card shadow-sm p-4 mt-4">
            <div
              class="d-flex justify-content-between align-items-center mb-3"
            >
              <h5 class="fw-bold text-primary mb-0">{{ vessel.name }}</h5>
              <span class="badge bg-info text-dark"
                >Service: {{ vessel.service }}</span
              >
            </div>
            <p class="text-muted mb-3 small">{{ vessel.status }}</p>
            <hr />
            <h6 class="fw-semibold mb-3">
              Total: {{ vessel.ports.length }} Calling Ports
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
                      Current Port
                    </span>
                  </h6>
                  <small class="text-muted">Voyage: {{ port.voyage }}</small>
                </div>
                <p class="text-muted small mb-1">
                  Terminal: {{ port.terminal }}
                </p>
                <div class="row small text-muted">
                  <div class="col-md-6">
                    Arrival: <strong>{{ port.arrival }}</strong>
                  </div>
                  <div class="col-md-6">
                    Departure: <strong>{{ port.departure }}</strong>
                    <button class="btn btn-sm btn-outline-secondary ms-2">
                      Cut off
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Placeholder for Port & Long Range -->
        <div
          class="tab-pane fade"
          id="port"
          role="tabpanel"
          aria-labelledby="port-tab"
        >
          <div class="alert alert-info">Port schedule coming soon...</div>
        </div>
        <div
          class="tab-pane fade"
          id="long-range"
          role="tabpanel"
          aria-labelledby="long-tab"
        >
          <div class="alert alert-info">Long range schedule coming soon...</div>
        </div>
      </div>
    </div>
  </FrontendLayout>
</template>

<script setup>
import { ref } from "vue";
import FrontendLayout from "../../../layouts/FrontendLayout.vue";

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
</style>
