
<template>
  <div class="dropdown">
    <a
      class="btn btn-gradient dropdown-toggle text-light"
      href="#"
      id="languageDropdown"
      data-bs-toggle="dropdown"
      aria-expanded="false"
    >
      <i class="fa-solid fa-language"> </i> {{ $t('language') }}
    </a>

    <ul class="dropdown-menu" aria-labelledby="languageDropdown">
      <li><a class="dropdown-item" href="#" @click="changeLang('id')">🇮🇩 Indonesia</a></li>
      <li><a class="dropdown-item" href="#" @click="changeLang('en')">🇬🇧 English</a></li>
      <li><a class="dropdown-item" href="#" @click="changeLang('cn')">🇨🇳 中文</a></li>
      <li><a class="dropdown-item" href="#" @click="changeLang('ar')">🇸🇦 العربية</a></li>
      <!-- <li><a class="dropdown-item" href="#" @click="changeLang('ja')">ja 日本語</a></li> -->
        <li><a class="dropdown-item" href="#" @click="changeLang('ja')">🇯🇵 日本語</a></li>

    </ul>
  </div>
</template>

<script setup>
import { useI18n } from 'vue-i18n'

const { locale } = useI18n()

function changeLang(lang) {
  locale.value = lang
  localStorage.setItem('lang', lang)
}

</script>


<style scoped>
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
</style>