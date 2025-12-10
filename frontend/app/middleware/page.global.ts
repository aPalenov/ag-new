import { defineNuxtRouteMiddleware, setPageLayout } from '#app'
import { usePageData } from '@/composables/usePageData'

export default defineNuxtRouteMiddleware(async (to) => {
  const { fetchPage, page } = usePageData()

  await fetchPage(to.path)

  setPageLayout(page.value?.theme ?? 'theme-default')
})
