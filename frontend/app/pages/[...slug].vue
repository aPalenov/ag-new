<script setup lang="ts">
import { usePageData } from '@/composables/usePageData'

defineOptions({ name: 'CatchAllPage' })

const { page, loading, error } = usePageData()

useHead(() => ({
  title: page.value?.meta?.title || 'АвтоГермес',
  meta: [
    { name: 'viewport', content: 'width=device-width, initial-scale=1, maximum-scale=1' },
    { name: 'description', content: page.value?.meta?.description || '' },
  ],
}))
</script>

<template>
  <div>
    <div v-if="loading">Загрузка...</div>
    <div v-else-if="error" class="text-red-600">Ошибка: {{ error }}</div>
    <template v-else-if="page">
      <PageBuilder :blocks="page.page.pageBuilderData" />
    </template>
  </div>
</template>
