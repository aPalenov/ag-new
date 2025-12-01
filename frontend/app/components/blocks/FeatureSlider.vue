<script setup lang="ts">
const props = defineProps<{
  title?: string
  items: Array<{
    icon?: string
    title: string
    description: string
    url?: string
  }>
}>()
</script>

<template>
  <section>
    <SliderWithNav v-bind="props">
      <template #item="{ item }">
        <FeatureCard v-bind="item" />
      </template>
    </SliderWithNav>
  </section>
</template>
