<script setup lang="ts">
const props = defineProps<{ title: string; subtitle?: string; cta?: string }>()
</script>

<template>
  <section class="py-10 text-center">
    <h1 class="text-3xl font-bold">{{ props.title }}</h1>
    <p v-if="props.subtitle" class="mt-2 text-gray-600">{{ props.subtitle }}</p>
    <UButton v-if="props.cta" color="primary" class="mt-4">{{ props.cta }}</UButton>
  </section>
</template>
