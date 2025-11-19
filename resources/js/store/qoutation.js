// import { ref } from "vue";
// import { defineStore } from "pinia";
// import axios from "axios";

// export const useQuotation = defineStore("QuotationFitur", () => {

//     // code url Api
//   const baseUrlApiExternalCountry ="/api/country";
//   // const baseUrlApiExternalCommodity ="/api/master/commodities";
//   // const baseUrlApiExternalUom ="/api/master/uom";

//   // state
//   const dataCountry = ref([]);
//   const dataState = ref([]);
//   const dataPickupOrigins = ref([]);
//   const dataPickupDestinations = ref([]);
//   const loading = ref(false);
//   const error = ref(null);
//   const dataCommodities = ref([]);
//   const dataUoms = ref([]);




//   // action untuk fetch data
//   const fetchCountries = async () => {
//     loading.value = true;
//     error.value = null;
//     try {
//       const res = await axios.get(`${baseUrlApiExternalCountry}`);
//       dataCountry.value = res.data?.data || []; // sesuaikan struktur response API kamu
//     } catch (err) {
//       console.error("Error fetching countries:", err);
//       error.value = err.message;
//     } finally {
//       loading.value = false;
//     }
//   };


//   const fetchStatesByCountry = async (countryId) => {
//     if (!countryId) {
//       dataState.value = [];
//       return;
//     }
//     loading.value = true;
//     error.value = null;
//     try {
//       const res = await axios.get(`/api/states/country/${countryId}`);
//       dataState.value = res.data?.data || [];
//     } catch (err) {
//       console.error("Error fetching states:", err);
//       error.value = err.message;
//     } finally {
//       loading.value = false;
//     }
//   };



//   // fetch commodities
//   const fetchCommodities = async () => {
//   loading.value = true;
//   error.value = null;
//   try {
//     const { data } = await axios.get(`/api/master/commodities`);
//     // const { data } = await axios.get(`${baseUrlApiExternalCommodity}`);
//     dataCommodities.value = (data?.data ?? []).map(item => ({
//       value: item.id,                
//       label: item.name,  
//     }));

//   } catch (err) {
//     console.error("Error fetching commodities:", err);
//     error.value = err.response?.data?.message || err.message || "Unknown error";
//   } finally {
//     loading.value = false;
//   }
// };


//   // fetch Uoms
// const fetchUoms = async () => {
//   loading.value = true;
//   error.value = null;

//   try {
//     const { data } = await axios.get(`/api/master/units-of-measure`);

//     dataUoms.value = (data?.data ?? []).map(item => ({
//       value: item.id,
//       label: item.name,
//       factor: item.factor,
//     }));
//   } catch (err) {
//     console.error("Error fetching uoms:", err);
//     error.value = err.response?.data?.message || err.message || "Unknown error";
//   } finally {
//     loading.value = false;
//   }
// };



//   const fetchPickupOrigins = async (transportation) => {
//     if (!transportation) {
//       dataPickupOrigins.value = [];
//       return;
//     }
//     loading.value = true;
//     error.value = null;
//     try {
//       const res = await axios.get(`/api/pickup-origins`, {
//         params: { transportation }
//       });
//       dataPickupOrigins.value = res.data?.data || [];
//     } catch (err) {
//       error.value = err.message;
//     } finally {
//       loading.value = false;
//     }
//   };


//   const fetchPickupDestinations = async (transportation) => {
//   try {
//     const res = await axios.get(`/api/pickup-destinations`, {
//       params: { transportation }
//     });
//     if (res.data.success) {
//       dataPickupDestinations.value = res.data.data;
//     } else {
//       dataPickupDestinations.value = [];
//     }
//   } catch (err) {
//     console.error("Error fetching destinations:", err);
//     dataPickupDestinations.value = [];
//   }
// };




// const createQuote = async (payload) => {
//   try {
//     const res = await axios.post("/api/quote/create", payload);

//     const data = res?.data;

//     if (data?.success) {
//       console.log("Quote created:", data);
//       return data;
//     }

//     throw new Error(data?.message || "Failed to create quote");
//   } catch (err) {
//     // Ambil pesan dari server jika ada
//     const errorMessage =
//       err?.response?.data?.message ||
//       err?.message ||
//       "Error while creating quote";

//     console.error("Error creating quote:", errorMessage);

//     // lempar ulang dengan pesan yang rapi
//     throw new Error(errorMessage);
//   }
// };


//   return {
//     dataCountry,
//     dataState,
//     dataPickupOrigins,
//     dataPickupDestinations,
//     dataCommodities,
//     dataUoms,
//     loading,
//     error,
//     fetchCountries,
//     fetchStatesByCountry,
//     fetchPickupOrigins,
//     fetchPickupDestinations,
//     fetchCommodities,
//     fetchUoms,
//     createQuote
//   };
// });



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
  const createQuote = async (payload) => {
    try {
      const res = await axios.post("/api/quote/create", payload);
      const data = res?.data;
      if (data?.success) return data;
      throw new Error(data?.message || "Failed to create quote");
    } catch (err) {
      const errorMessage = err?.response?.data?.message || err?.message || "Error while creating quote";
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
