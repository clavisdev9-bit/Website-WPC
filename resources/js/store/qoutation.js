import { ref } from "vue";
import { defineStore } from "pinia";
import axios from "axios";

export const useQuotation = defineStore("QuotationFitur", () => {

    // code untuk ambil data country
  const baseUrlApiExternalCountry ="/api/country";
  // state
  const dataCountry = ref([]);
  const dataState = ref([]);
  const dataPickupOrigins = ref([]);
  const dataPickupDestinations = ref([]);
  const loading = ref(false);
  const error = ref(null);

  // action untuk fetch data
  const fetchCountries = async () => {
    loading.value = true;
    error.value = null;
    try {
      const res = await axios.get(baseUrlApiExternalCountry);
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
    loading,
    error,
    fetchCountries,
    fetchStatesByCountry,
    fetchPickupOrigins,
    fetchPickupDestinations,
    createQuote
  };
});
