import { setPageLayout } from '#app'
import { useApiFetch } from '@/composables/useApiFetch'
import type { UseFetchOptions } from 'nuxt/app'

// Ensure the correct layout is selected BEFORE the page renders
export default defineNuxtRouteMiddleware(async (to) => {
  // Normalize path like in usePageData
  const normalized = to.path === '//' ? '/' : to.path
  const endpoint = `/pages${normalized === '/' ? '' : normalized}`
  const key = `page-${normalized || '/'}`

  // Fetch page payload early; page code will reuse this cached result via the same key
  type PagePayloadLite = { props?: { layout?: { name?: string } } }
  const { data, error } = await useApiFetch<PagePayloadLite>(endpoint, {
    key,
    immediate: true,
  } as UseFetchOptions<PagePayloadLite>)

  if (!error.value) {
    setPageLayout(data.value?.props?.theme)
  }
})
