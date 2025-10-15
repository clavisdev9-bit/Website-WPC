

import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
  plugins: [
    laravel({
      input: 'resources/js/app.js',
      refresh: true,
    }),
    vue(),
  ],
  resolve: {
    alias: {
      '@': '/resources/js',
    },
  },
})


// untuk akses dari luar di lokal

// import { defineConfig } from 'vite'
// import laravel from 'laravel-vite-plugin'
// import vue from '@vitejs/plugin-vue'

// export default defineConfig({
//   server: {
//     host: '0.0.0.0', // biar bisa diakses dari device lain
//     port: 5173,      // kamu bisa ubah kalau perlu
//     hmr: {
//       host: '192.168.132.12', // ganti dengan IP lokal kamu
//     },
//   },
//   plugins: [
//     laravel({
//       input: 'resources/js/app.js',
//       refresh: true,
//     }),
//     vue(),
//   ],
//   resolve: {
//     alias: {
//       '@': '/resources/js',
//     },
//   },
// })
