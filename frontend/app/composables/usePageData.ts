import { ref } from 'vue'
import type { Ref } from 'vue'
import { useApiFetch } from '@/composables/useApiFetch'

interface PageProps {
  app: Record<string, unknown>
  meta?: { title?: string; description?: string }
  navigation?: Record<string, unknown>
  pageBuilderData?: Array<{ name: string; data: Record<string, unknown> }>
  [key: string]: unknown
}

interface PagePayload {
  component: string
  props: PageProps
}

const pageRef: Ref<PagePayload | null> = ref(null)
const loadingRef: Ref<boolean> = ref(false)
const errorRef: Ref<string | null> = ref(null)

export function usePageData() {
  const fetchPage = async (path: string) => {
    loadingRef.value = true
    errorRef.value = null

    const normalized = path === '//' ? '/' : path
    const endpoint = `/pages${normalized === '/' ? '' : normalized}`

    try {
      const { data, error } = await useApiFetch<PagePayload>(endpoint, {
        key: `page-${normalized || '/'}`,
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
    } catch (e) {
      const err = e as { data?: { message?: string }; message?: string }
      errorRef.value = err?.data?.message || err?.message || 'Fetch error'
      pageRef.value = null
    } finally {
      loadingRef.value = false
    }
  }

  return { page: pageRef, loading: loadingRef, error: errorRef, fetchPage }
}
