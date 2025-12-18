<script setup lang="ts">
const props = defineProps<{ services: Array<{ title: string }> }>()
</script>

<template>
  <UContainer as="section">
    <h2 class="mb-4 text-xl font-semibold">Услуги</h2>
    <ul class="grid grid-cols-2 gap-2">
      <li v-for="(s, i) in props.services" :key="i" class="rounded border p-2">{{ s.title }}</li>
    </ul>
  </UContainer>
</template>
