import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
import { fileURLToPath } from 'url'

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/backend.css',
        'resources/js/backend.js',
        //'resources/css/app.css',
        'resources/js/app.js'
      ],
      refresh: true,
    }),
    vue({
      template: {
        transformAssetUrls: {
          base: null,
          includeAbsolute: false
        }
      }
    })
  ],
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./resources/js', import.meta.url)),
      //'vue': 'vue/dist/vue.esm-bundler.js'
    },
  },
  server: {
    port: 5173,
  },
});
