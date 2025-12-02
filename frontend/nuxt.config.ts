// https://nuxt.com/docs/api/configuration/nuxt-config

export default defineNuxtConfig({
  devServer: {
    host: '0.0.0.0',
    port: 3000,
  },
  vite: {
    server: {
      hmr: {
        host: 'localhost',
        clientPort: 3000,
      },
      allowedHosts: true,
    },
  },
  components: [
    {
      path: '~/components',
      pathPrefix: false,
    },
  ],
  pages: true,
  compatibilityDate: '2025-07-15',
  devtools: {
    enabled: true,

    timeline: {
      enabled: true,
    },
  },
  modules: ['@nuxt/eslint', '@nuxt/ui', '@vueuse/nuxt', '@pinia/nuxt'],
  css: ['~/assets/css/app.css'],
  icon: {
    customCollections: [
      {
        prefix: 'ag',
        dir: './app/assets/icons',
      },
      {
        prefix: 'ag-logo',
        dir: './app/assets/icons/logos',
      },
    ],
  },
  ui: {
    colorMode: false,
    fonts: false,
  },
  runtimeConfig: {
    // Server-only runtime config (available on server and not exposed to client)
    // Use the internal Docker network to reach Nginx, which forwards /api to PHP-FPM backend
    apiBase: import.meta.env?.NUXT_API_BASE || 'http://nginx/api',
    public: {
      // Client-side base stays relative so the browser hits Nginx at /api
      apiBase: import.meta.env?.NUXT_PUBLIC_API_BASE || '/api',
      ymapsApiKey:
        import.meta.env?.NUXT_PUBLIC_YMAPS_API_KEY || 'a8b82efc-e7d3-428b-9395-1b4ee45175be',
    },
  },
})