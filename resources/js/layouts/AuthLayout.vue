<template>
    <Header/>
     <div>
          <slot />
    </div>
    <Footer/>
</template>

<script setup>
 import Footer from '../components/Auths/Footer.vue';
 import Header from '../components/Auths/Header.vue';
</script>