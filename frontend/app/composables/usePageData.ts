import { useState } from '#app'
import { useApiFetch } from '@/composables/useApiFetch'
import type { SharedData } from '~~/types/generated'

export function usePageData() {
  const pageRef = useState<SharedData | null>('page-data', () => null)
  const loadingRef = useState<boolean>('page-loading', () => false)
  const errorRef = useState<string | null>('page-error', () => null)

  const fetchPage = async (path: string) => {
    loadingRef.value = true
    errorRef.value = null

    try {
      const { data, error } = await useApiFetch<SharedData>(`/pages${path}`, {
        key: `page-${path || '/'}`,
        immediate: true,
      })

      if (error.value) {
        const msg =
          (error.value as unknown as { data?: { message?: string }; message?: string })?.data
            ?.message ||
          (error.value as unknown as { message?: string }).message ||
          'Fetch error'

        errorRef.value = msg
        pageRef.value = null

        // On server, propagate 404 to Nuxt error page
        if (import.meta.server) {
          const { createError } = await import('h3')
          throw createError({ statusCode: 404, statusMessage: 'Page Not Found' })
        }
      } else {
        pageRef.value = data.value ?? null
      }
    } catch (error) {
      const err = error as { data?: { message?: string }; message?: string }
      errorRef.value = err?.data?.message || err?.message || 'Fetch error'
      pageRef.value = null
    } finally {
      loadingRef.value = false
    }
  }

  return {
    page: pageRef,
    loading: loadingRef,
    error: errorRef,
    fetchPage,
  }
}
