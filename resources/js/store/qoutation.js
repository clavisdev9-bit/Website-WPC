import { ref } from "vue";
import { defineStore } from "pinia";
import axios from "axios";

export const useQuotation = defineStore("QuotationFitur", () => {

    // code url Api
  // const baseUrlApiExternalCountry ="/api/country";
  // const baseUrlApiExternalCommodity ="/api/master/commodities";
  // const baseUrlApiExternalUom ="/api/master/uom";

  // state
  const dataCountry = ref([]);
  const dataState = ref([]);
  const dataPickupOrigins = ref([]);
  const dataPickupDestinations = ref([]);
  const loading = ref(false);
  const error = ref(null);
  const dataCommodities = ref([]);
  const dataUoms = ref([]);


  // fetch commodities
  const fetchCommodities = async () => {
  loading.value = true;
  error.value = null;
  try {
    const { data } = await axios.get(`/api/master/commodities`);
    // const { data } = await axios.get(`${baseUrlApiExternalCommodity}`);
    dataCommodities.value = (data?.data ?? []).map(item => ({
      value: item.id,                
      label: item.name,  
    }));

  } catch (err) {
    console.error("Error fetching commodities:", err);
    error.value = err.response?.data?.message || err.message || "Unknown error";
  } finally {
    loading.value = false;
  }
};


  // fetch Uoms
const fetchUoms = async () => {
  loading.value = true;
  error.value = null;

  try {
    const { data } = await axios.get(`/api/master/uom`);

    dataUoms.value = (data?.data ?? []).map(item => ({
      value: item.id,
      label: item.name,
      factor: item.factor,
    }));
  } catch (err) {
    console.error("Error fetching uoms:", err);
    error.value = err.response?.data?.message || err.message || "Unknown error";
  } finally {
    loading.value = false;
  }
};



  // action untuk fetch data
  const fetchCountries = async () => {
    loading.value = true;
    error.value = null;
    try {
      const res = await axios.get(`/api/country`);
      dataCountry.value = res.data?.data || []; // sesuaikan struktur response API kamu
    } catch (err) {
      console.error("Error fetching countries:", err);
      error.value = err.message;
    } finally {
      loading.value = false;
    }
  };


  const fetchStatesByCountry = async (countryId) => {
    if (!countryId) {
      dataState.value = [];
      return;
    }
    loading.value = true;
    error.value = null;
    try {
      const res = await axios.get(`/api/states/country/${countryId}`);
      dataState.value = res.data?.data || [];
    } catch (err) {
      console.error("Error fetching states:", err);
      error.value = err.message;
    } finally {
      loading.value = false;
    }
  };


  const fetchPickupOrigins = async (transportation) => {
    if (!transportation) {
      dataPickupOrigins.value = [];
      return;
    }
    loading.value = true;
    error.value = null;
    try {
      const res = await axios.get(`/api/pickup-origins`, {
        params: { transportation }
      });
      dataPickupOrigins.value = res.data?.data || [];
    } catch (err) {
      error.value = err.message;
    } finally {
      loading.value = false;
    }
  };


  const fetchPickupDestinations = async (transportation) => {
  try {
    const res = await axios.get(`/api/pickup-destinations`, {
      params: { transportation }
    });
    if (res.data.success) {
      dataPickupDestinations.value = res.data.data;
    } else {
      dataPickupDestinations.value = [];
    }
  } catch (err) {
    console.error("Error fetching destinations:", err);
    dataPickupDestinations.value = [];
  }
};


const createQuote = async (payload) => {
  try {
    const res = await axios.post("/api/quote/create", payload);
    if (res.data.success) {
      console.log("Quote created:", res.data);
      return res.data;
    } else {
      throw new Error(res.data.message || "Failed to create quote");
    }
  } catch (err) {
    console.error("Error creating quote:", err);
    throw err;
  }
};

  return {
    dataCountry,
    dataState,
    dataPickupOrigins,
    dataPickupDestinations,
    dataCommodities,
    dataUoms,
    loading,
    error,
    fetchCountries,
    fetchStatesByCountry,
    fetchPickupOrigins,
    fetchPickupDestinations,
    fetchCommodities,
    fetchUoms,
    createQuote
  };
});
