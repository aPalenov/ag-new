import { computed, type ComputedRef } from 'vue'
import { usePageData } from '@/composables/usePageData'

export function useCurrentTheme(): ComputedRef<string> {
  const { page } = usePageData()

  return computed<string>(() => {
    const theme = (page.value?.props as { theme?: string } | undefined)?.theme
    return theme || 'primary'
  })
}
