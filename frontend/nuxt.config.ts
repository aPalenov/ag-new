// https://nuxt.com/docs/api/configuration/nuxt-config
// Declare Node process for TS without adding @types/node
// eslint-disable-next-line @typescript-eslint/no-explicit-any
declare const process: any
console.log(process.env?.NUXT_API_BASE)

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
  pages: true,
  compatibilityDate: '2025-07-15',
  devtools: {
    enabled: true,

    timeline: {
      enabled: true,
    },
  },
  modules: ['@nuxt/eslint', '@nuxt/ui'],
  runtimeConfig: {
    // Server-only runtime config (available on server and not exposed to client)
    // Use the internal Docker network to reach Nginx, which forwards /api to PHP-FPM backend
    apiBase: process.env?.NUXT_API_BASE || 'http://nginx/api',
    public: {
      // Client-side base stays relative so the browser hits Nginx at /api
      apiBase: process.env?.NUXT_PUBLIC_API_BASE || '/api',
    },
  },
})
