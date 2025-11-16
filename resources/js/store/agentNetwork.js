import { defineStore } from 'pinia'
import { ref, computed, watch } from 'vue'
import axios from 'axios'

export const useAgentNetworkStore = defineStore('agentNetwork', () => {
  const defaultImage = "/images/footer_works.jpg"

  // =========================
  // STATE DASAR
  // =========================
  const mapRef = ref(null)
  const zoomLevel = ref(3)
  const selectedLevel = ref("country")
  const selectedCountry = ref(null)
  const selectedCity = ref(null)
  const showModal = ref(false)
  const selectedImage = ref("")

  // =========================
  // DATA DARI API
  // =========================
  const data = ref([])
  const loading = ref(true)
  const error = ref(null)

  const fetchData = async () => {
    loading.value = true
    try {
      const res = await axios.get("/api/Agents/Network")
      const agents = res.data.data.data

      const grouped = Object.values(
        agents.reduce((acc, item) => {
          if (!acc[item.name_country]) {
            acc[item.name_country] = {
              country: item.name_country,
              position: [parseFloat(item.lat), parseFloat(item.lng)],
              cities: {}
            }
          }
          if (!acc[item.name_country].cities[item.name_city]) {
            acc[item.name_country].cities[item.name_city] = {
              city: item.name_city,
              position: [parseFloat(item.lat), parseFloat(item.lng)],
              agents: []
            }
          }
          acc[item.name_country].cities[item.name_city].agents.push({
            id: item.id,
            name: item.name,
            address: item.address,
            position: [parseFloat(item.lat), parseFloat(item.lng)],
            phone: item.phone,
            email: item.email,
            image: item.image || defaultImage
          })
          return acc
        }, {})
      ).map(country => ({
        ...country,
        cities: Object.values(country.cities)
      }))

      data.value = grouped
    } catch (err) {
      error.value = "Gagal memuat data"
      console.error(err)
    } finally {
      loading.value = false
    }
  }

  // =========================
  // MAP FUNCTION
  // =========================
  const zoomTo = (pos, zoom) => {
    mapRef.value?.mapObject?.setView(pos, zoom)
  }

  const goToCountry = (country) => {
    selectedCountry.value = country
    selectedLevel.value = "city"
    zoomTo(country.position, 5)
  }

  const goToCity = (city) => {
    selectedCity.value = city
    selectedLevel.value = "agent"
    zoomTo(city.position, 8)
  }

  const goToAgent = (agent) => {
    zoomTo(agent.position, 12)
  }

  const goToQuotation = () => {
    window.location.href = "/wpc-esys/qoutation-request"
  }

  const openImage = (img) => {
    selectedImage.value = img
    showModal.value = true
  }

  // =========================
  // PAGINATION (List Sidebar)
  // =========================
  const agentListItemsPerPage = ref(10)
  const agentListCurrentPage = ref(1)

  const paginatedAgentCountries = computed(() => {
    if (selectedLevel.value !== 'country') return []
    const start = (agentListCurrentPage.value - 1) * agentListItemsPerPage.value
    return data.value.slice(start, start + agentListItemsPerPage.value)
  })

  const paginatedAgentCities = computed(() => {
    if (selectedLevel.value !== 'city' || !selectedCountry.value) return []
    const start = (agentListCurrentPage.value - 1) * agentListItemsPerPage.value
    return selectedCountry.value.cities.slice(start, start + agentListItemsPerPage.value)
  })

  const paginatedAgentRecords = computed(() => {
    if (selectedLevel.value !== 'agent' || !selectedCity.value) return []
    const start = (agentListCurrentPage.value - 1) * agentListItemsPerPage.value
    return selectedCity.value.agents.slice(start, start + agentListItemsPerPage.value)
  })

  const nextAgentListPage = () => {
    agentListCurrentPage.value++
  }

  const resetAgentListPagination = () => {
    agentListCurrentPage.value = 1
  }

  watch(selectedLevel, resetAgentListPagination)
  watch(selectedCountry, resetAgentListPagination)
  watch(selectedCity, resetAgentListPagination)

  // =========================
  // FLAT AGENTS UNTUK GALLERY
  // =========================
  const flatAgents = computed(() => {
    if (!data.value?.length) return []
    return data.value.flatMap(country =>
      country.cities.flatMap(city =>
        city.agents.map(agent => ({
          ...agent,
          country: country.country,
          city: city.city,
        }))
      )
    )
  })

  // =========================
  // FILTER & PAGINATION GALLERY
  // =========================
  const filterCountry = ref('')
  const itemsPerPage = ref(6)
  const currentPage = ref(1)

  const filteredAgents = computed(() => {
    if (!filterCountry.value) return flatAgents.value
    return flatAgents.value.filter(a => a.country === filterCountry.value)
  })

  const paginatedAgents = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage.value
    return filteredAgents.value.slice(start, start + itemsPerPage.value)
  })

  const loadMore = () => {
    if (currentPage.value * itemsPerPage.value < filteredAgents.value.length) {
      currentPage.value++
    }
  }

  watch(filterCountry, () => {
    currentPage.value = 1
  })

  // =========================
  // RETURN
  // =========================
  return {
    // state
    mapRef,
    zoomLevel,
    selectedLevel,
    selectedCountry,
    selectedCity,
    showModal,
    selectedImage,
    data,
    loading,
    error,

    // pagination
    agentListItemsPerPage,
    agentListCurrentPage,
    paginatedAgentCountries,
    paginatedAgentCities,
    paginatedAgentRecords,
    nextAgentListPage,

    // gallery
    filterCountry,
    itemsPerPage,
    currentPage,
    filteredAgents,
    paginatedAgents,
    loadMore,

    // actions
    fetchData,
    zoomTo,
    goToCountry,
    goToCity,
    goToAgent,
    goToQuotation,
    openImage,
  }
})
