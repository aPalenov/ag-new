<script setup lang="ts">
const props = defineProps<{
  title: string
  cta?: {
    label: string
    url: string
  }
  items: Array<{
    preview?: string
    title: string
    publishedAt?: string
    url: string
  }>
}>()
</script>

<template>
  <section class="py-9">
    <SliderWithNav v-bind="props">
      <template #item="{ item }">
        <VideoCardDefault v-bind="item" />
      </template>
    </SliderWithNav>
  </section>
</template>
