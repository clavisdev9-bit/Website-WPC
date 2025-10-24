<template>
  <FrontendLayout>
    <div class="container py-4">
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
            <i class="fa fa-route me-1"></i> {{ $t('schedule.tabs.pointToPoint') }}
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
            <i class="fa-solid fa-ship me-1"></i> {{ $t('schedule.tabs.vessel') }}
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
      </div>
    </div>
  </FrontendLayout>
</template>

<script setup>
import { ref } from "vue";
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