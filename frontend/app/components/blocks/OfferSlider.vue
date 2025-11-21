<script setup lang="ts">
const props = defineProps<{
  title: string
  cta?: {
    label: string
    url: string
  }
  items: Array<{
    preview?: string
    type: string
    title: string
    description?: string
    publishedAt?: string
    cta?: {
      label: string
      url: string
    }
  }>
}>()
</script>

<template>
  <section class="py-9">
    <SliderWithNav v-bind="props">
      <template #item="{ item }">
        <OfferCardDefault v-bind="item" />
      </template>
    </SliderWithNav>
  </section>
</template>
