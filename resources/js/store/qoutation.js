
import { ref } from "vue";
import { defineStore } from "pinia";
import axios from "axios";

export const useQuotation = defineStore("QuotationFitur", () => {

  // --- API Endpoints ---
  const baseUrlApiExternalCountry = "/api/country";

  // --- States ---
  const dataCountry = ref([]);
  const dataState = ref([]);
  const dataPickupOrigins = ref([]);
  const dataPickupDestinations = ref([]);
  const dataCommodities = ref([]);
  const dataUoms = ref([]);


 // Honeypot (anti bot)
  const honeypot = ref("");  // timestamp trap
  // const formStartTime = ref(Date.now() / 1000); // detik float
const formStartTime = ref(0); // default


  // Loading state per fetch
  const loadingCountries = ref(false);
  const loadingStates = ref(false);
  const loadingOrigins = ref(false);
  const loadingDestinations = ref(false);
  const loadingCommodities = ref(false);
  const loadingUoms = ref(false);

  const error = ref(null);

  // --- Fetch Countries ---
  const fetchCountries = async () => {
    loadingCountries.value = true;
    error.value = null;
    try { 
      const res = await axios.get(`${baseUrlApiExternalCountry}`);
      dataCountry.value = res.data?.data || [];
    } catch (err) {
      console.error("Error fetching countries:", err);
      dataCountry.value = [];
      error.value = err.message || "Failed to fetch countries";
    } finally {
      loadingCountries.value = false;
    }
  };

  // --- Fetch States by Country ---
  const fetchStatesByCountry = async (countryId) => {
    if (!countryId) {
      dataState.value = [];
      return;
    }
    loadingStates.value = true;
    error.value = null;
    try {
      const res = await axios.get(`/api/states/country/${countryId}`);
      dataState.value = res.data?.data || [];
    } catch (err) {
      console.error("Error fetching states:", err);
      dataState.value = [];
      error.value = err.message || "Failed to fetch states";
    } finally {
      loadingStates.value = false;
    }
  };

  // --- Fetch Commodities ---
  const fetchCommodities = async () => {
    loadingCommodities.value = true;
    error.value = null;
    try {
      const { data } = await axios.get(`/api/master-local-commodities`);
      if (!data?.data) throw new Error("No commodities found");
      dataCommodities.value = data.data.map(item => ({
        value: String(item.id), // pastikan type string
        label: item.name,
      }));
    } catch (err) {
      console.error("Error fetching commodities:", err);
      dataCommodities.value = [];
      error.value = err.response?.data?.message || err.message || "Failed to fetch commodities";
    } finally {
      loadingCommodities.value = false;
    }
  };

  // --- Fetch UOMs ---
  const fetchUoms = async () => {
    loadingUoms.value = true;
    error.value = null;
    try {
      const { data } = await axios.get(`/api/master-local-uoms`);
      if (!data?.data) throw new Error("No UOMs found");
      dataUoms.value = data.data.map(item => ({
        value: String(item.id),
        label: item.name,
        factor: Number(item.factor) || 0, // pastikan factor number
      }));
    } catch (err) {
      console.error("Error fetching uoms:", err);
      dataUoms.value = [];
      error.value = err.response?.data?.message || err.message || "Failed to fetch UOMs";
    } finally {
      loadingUoms.value = false;
    }
  };

  // --- Fetch Pickup Origins ---
  const fetchPickupOrigins = async (transportation) => {
    if (!transportation) {
      dataPickupOrigins.value = [];
      return;
    }
    loadingOrigins.value = true;
    error.value = null;
    try {
      const res = await axios.get(`/api/pickup-origins`, { params: { transportation } });
      dataPickupOrigins.value = res.data?.data || [];
    } catch (err) {
      console.error("Error fetching origins:", err);
      dataPickupOrigins.value = [];
      error.value = err.message || "Failed to fetch origins";
    } finally {
      loadingOrigins.value = false;
    }
  };

  // --- Fetch Pickup Destinations ---
  const fetchPickupDestinations = async (transportation) => {
    loadingDestinations.value = true;
    try {
      const res = await axios.get(`/api/pickup-destinations`, { params: { transportation } });
      if (res.data?.success) dataPickupDestinations.value = res.data.data;
      else dataPickupDestinations.value = [];
    } catch (err) {
      console.error("Error fetching destinations:", err);
      dataPickupDestinations.value = [];
      error.value = err.message || "Failed to fetch destinations";
    } finally {
      loadingDestinations.value = false;
    }
  };

  // --- Create Quote ---
  // const createQuote = async (payload) => {

  //   // === Honeypot detection (frontend) ===
  //   if (honeypot.value.length > 0) {
  //     console.warn("BOT DETECTED: honeypot terisi");
  //     throw new Error("Bot detected");
  //   }

  //   // === Timestamp trap: form disubmit < 1.2 detik = bot ===
  //   const now = Date.now();
  //   if (now - formStartTime.value < 1200) {
  //     console.warn("BOT DETECTED: Form too fast");
  //     throw new Error("Bot detected");
  //   }


  //   try {
  //     const res = await axios.post("/api/quote/create", payload);
  //     const data = res?.data;
  //     if (data?.success) return data;
  //     throw new Error(data?.message || "Failed to create quote");
  //   } catch (err) {
  //     const errorMessage = err?.response?.data?.message || err?.message || "Error while creating quote";
  //     console.error("Error creating quote:", errorMessage);
  //     throw new Error(errorMessage);
  //   }
  // };

  const createQuote = async (payload) => {

  // Frontend anti-bot
  if (honeypot.value.length > 0) {
    console.warn("BOT DETECTED: honeypot terisi");
    throw new Error("Bot detected");
  }

  // Pastikan timestamp detik float
  const now = Date.now() / 1000;
  if (now - formStartTime.value < 1.2) {
    console.warn("BOT DETECTED: Form too fast");
    throw new Error("Bot detected");
  }

  // Kirim timestamp ke backend
  payload.timestamp = formStartTime.value;
  payload.extra_field = honeypot.value;

  try {
    const res = await axios.post("/api/quote/create", payload);
    return res.data;
  } catch (err) {
    const errorMessage = err?.response?.data?.message || err.message;
    console.error("Error creating quote:", errorMessage);
    throw new Error(errorMessage);
  }
};


  return {
    // states
    dataCountry,
    dataState,
    dataPickupOrigins,
    dataPickupDestinations,
    dataCommodities,
    dataUoms,
    loadingCountries,
    loadingStates,
    loadingOrigins,
    loadingDestinations,
    loadingCommodities,
    loadingUoms,
    error,
    honeypot,
    formStartTime,

    // actions
    fetchCountries,
    fetchStatesByCountry,
    fetchPickupOrigins,
    fetchPickupDestinations,
    fetchCommodities,
    fetchUoms,
    createQuote,
  };
});
