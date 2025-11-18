<script setup lang="ts">
import PageBuilder from '@/components/PageBuilder.vue'
import { usePageData } from '@/composables/usePageData'

defineOptions({ name: 'CatchAllPage' })

const route = useRoute()
const path = computed(() => {
  const slug = (route.params.slug as string[] | undefined) || []
  const p = '/' + slug.join('/')
  return p === '//' ? '/' : p
})

const { page, loading, error } = usePageData()

useHead(() => ({
  title: page.value?.props?.meta?.title || 'Страница',
  meta: [{ name: 'description', content: page.value?.props?.meta?.description || '' }],
}))
</script>

<template>
  <div>
    <div class="py-4 text-sm text-gray-500">Path: {{ path }}</div>
    <div v-if="loading">Загрузка...</div>
    <div v-else-if="error" class="text-red-600">Ошибка: {{ error }}</div>
    <template v-else>
      <PageBuilder :blocks="page?.props?.pageBuilderData" />
    </template>
  </div>
</template>
