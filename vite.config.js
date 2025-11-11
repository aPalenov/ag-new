import { defineConfig, loadEnv } from 'vite'
import path from 'node:path'
import { fileURLToPath } from 'node:url'
import { dirname } from 'node:path'
import laravel from 'laravel-vite-plugin'
import viteCompression from 'vite-plugin-compression'
import vue from '@vitejs/plugin-vue'
import tailwindcss from '@tailwindcss/vite'
import { fantasticon } from '@palenov/vite-plugin-fantasticon'

const __filename = fileURLToPath(import.meta.url)
const __dirname = dirname(__filename)

// https://vitejs.dev/config/
export default defineConfig(({ mode }) => {
  const env = loadEnv(mode, __dirname, '')

  return {
    server: {
      host: '0.0.0.0',
      hmr: { host: 'localhost', clientPort: Number(env.DOCKER_BACKEND_HMR_PORT) },
      cors: true,
    },
    resolve: {
      alias: {
        '@': path.join(__dirname, 'resources/js'),
        '@fonts': path.join(__dirname, 'resources/fonts'),
        '@css': path.join(__dirname, 'resources/css'),
        '@public': path.join(__dirname, 'public'),
      },
    },
    plugins: [
      laravel({
        input: ['resources/css/app.css', 'resources/js/app.ts'],
        refresh: true,
      }),
      vue(),
      tailwindcss(),
      fantasticon({
        inputDir: './resources/icons',
        outputDir: './resources/fonts/icons',
        fontsUrl: '@fonts/icons',
        prefix: 'fs-icon',
      }),
      viteCompression(),
    ],
  }
})
