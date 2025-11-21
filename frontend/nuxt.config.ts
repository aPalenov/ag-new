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
  modules: ['@nuxt/eslint', '@nuxt/ui'],
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
    fonts: false,
    colorMode: false,
  },
  runtimeConfig: {
    // Server-only runtime config (available on server and not exposed to client)
    // Use the internal Docker network to reach Nginx, which forwards /api to PHP-FPM backend
    apiBase: import.meta.env?.NUXT_API_BASE || 'http://nginx/api',
    public: {
      // Client-side base stays relative so the browser hits Nginx at /api
      apiBase: import.meta.env?.NUXT_PUBLIC_API_BASE || '/api',
    },
  },
})
