<template>
<div class="page">
  <div class="page-wrapper">
    <!-- Header trigger modal -->
      <Header @openComingSoon="showComingSoon = true" />

    <!-- <Header /> -->
    <div class="page-body">
      <!-- <div class="container-xl"> -->
         <div :class="fluid ? 'container-fluid p-0 m-0' : 'container-xl'">
        <slot />
      </div>
    </div>
    <Footer />
  </div>


   <!-- Modal "Coming Soon" -->
    <div
      class="modal fade"
      tabindex="-1"
      :class="{ show: showComingSoon }"
      style="display: block;"
      v-if="showComingSoon"
    >
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content border-0 shadow-lg">
      <!-- Header merah -->
      <div class="modal-header bg-info text-white">
        <h2 class="modal-title">⚠ Info</h2>
        <button 
          type="button" 
          class="btn-close btn-close-white" 
          @click="showComingSoon = false">
        </button>
      </div>
      <div class="modal-body bg-light text-center">
        <img
        :src="imageCommingSoon"
        alt="Coming Soon"
        class="img-fluid mx-auto d-block rounded"
        style="max-width: 280px;"
       />
       <h1 class="text-danger fw-bold w-100">Sorry, the Menu feature you clicked is not yet available <i class="fa-regular fa-face-sad-tear"></i></h1>
        <div class="mb-3">
          <span class="d-block text-danger fw-bold fs-5 w-100">
            Maaf, fitur <b>Menu yang Anda klik</b> belum tersedia <i class="fa-regular fa-face-sad-tear"></i>
          </span>
        </div>
      </div>
      <div class="modal-footer bg-info">
        <button 
          type="button" 
          class="btn btn-light fw-bold" 
          @click="showComingSoon = false">
          Close
        </button>
      </div>
    </div>
  </div>
</div>
     <!-- End Modal-->


</div>

</template>

<script setup>
// import Navbar from '../components/Frontend/Navbar.vue';
// import Footer from '../components/Frontend/Footer.vue';
import { ref } from 'vue';
import Header from '../components/Frontend/Header.vue';
import Footer from '../components/Frontend/Footer.vue';
const showComingSoon = ref(false)
const imageCommingSoon = '/images/maintenance.png'

const props = defineProps({
  fluid: {
    type: Boolean,
    default: false
  }
})
</script>