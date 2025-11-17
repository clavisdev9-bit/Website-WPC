import './bootstrap';
import '../css/app.css'


// ✅ Definisikan jQuery dulu
import $ from 'jquery'
window.$ = $;
window.jQuery = $;
// import 'datatables.net-dt'
// import 'datatables.net-dt/css/dataTables.dataTables.css'
import 'datatables.net-bs5'
import 'datatables.net-responsive-bs5'
import 'datatables.net-bs5/css/dataTables.bootstrap5.css'
import 'datatables.net-responsive-bs5/css/responsive.bootstrap5.css'

// ini untuk js blade
import './costums/blogs';
import './costums/alerts'
import './costums/scriptDelete'
import './costums/quotations'
import './costums/menu'
import './costums/submenus'
import './costums/role'
import './costums/accessMenu'
import './costums/users'
import './costums/accessSubMenu'
import './costums/requestContact'
import './costums/CategoryBlogs'
import './costums/syncContact.js'
import './costums/syncContactLog.js'
import './costums/agentCountryNetwork.js'
import './costums/agentCityNetwork.js'
import './costums/agentNetwork.js'
import './costums/ContinentNetwork.js'
import './costums/SubContinentNetwork.js'
import '../css/chat.css';
import './chat.js';
import { createChat } from './chat.js';

window.createChat = createChat;

import '@fortawesome/fontawesome-free/css/all.min.css'

// ini untuk vue 
import './bootstrap';
import '../css/app.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router'
import { createI18n } from 'vue-i18n'

// Import Tabler JS from the new location in 'resources/vendor'
import '../vendor/dist/js/tabler.min.js';
import '../vendor/dist/js/demo.min.js';
import '../vendor/dist/libs/select2/js/select2.full.min.js';

// import '../vendor/dist/libs/apexcharts/dist/apexcharts.min.js';
// import '../vendor/dist/libs/jsvectormap/dist/jsvectormap.min.js';
// import '../vendor/dist/libs/jsvectormap/dist/maps/world.js';
// import '../vendor/dist/libs/jsvectormap/dist/maps/world-merc.js';

// Import Vue Toastification
import Toast, { POSITION } from 'vue-toastification'
import 'vue-toastification/dist/index.css'

import 'select2';
import 'select2/dist/css/select2.css';


// Import semua file bahasa
import en from './locales/en.json'
import id from './locales/id.json'
import ar from './locales/ar.json'
import cn from './locales/cn.json'
import ja from './locales/ja.json'

// code untuk bahasa
const userLang = navigator.language.split('-')[0]
const availableLangs = ['en', 'id', 'ar', 'cn', 'ja']
const defaultLang = availableLangs.includes(userLang) ? userLang : 'en'
const i18n = createI18n({
  legacy: false, 
  locale: defaultLang, 
  fallbackLocale: 'en',
  messages: {
    en,
    id,
    ar,
    cn,
    ja
  }
})

const app = createApp(App)

// Konfigurasi global toast
app.use(Toast, {
 position: "top-right",
  timeout: 5000,
  closeOnClick: true,
  pauseOnFocusLoss: true,
  pauseOnHover: true,
  draggable: true,
  draggablePercent: 0.6,
  showCloseButtonOnHover: false,
  hideProgressBar: true,
  closeButton: "button",
  icon: "fas fa-rocket",
  rtl: false
})

// code lib leaflet
import L from "leaflet"
import "leaflet/dist/leaflet.css"
delete L.Icon.Default.prototype._getIconUrl;
L.Icon.Default.mergeOptions({
  iconRetinaUrl: "https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png",
  iconUrl: "https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png",
  shadowUrl: "https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png",
});

const pinia = createPinia()   
app.use(pinia)                
app.use(i18n)
app.use(router)
app.mount('#app')


