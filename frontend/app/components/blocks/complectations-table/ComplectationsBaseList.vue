<script setup lang="ts">
defineProps<{
  baseOptions: { [key: string]: string[] }
}>()
</script>

<template>
  <div class="space-y-6 py-4 lg:columns-2">
    <div
      v-for="(items, category) in baseOptions"
      :key="category"
      class="break-inside-avoid space-y-3"
    >
      <div class="text-lg font-semibold">{{ category }}</div>
      <ul class="list-inside list-disc space-y-1">
        <li v-for="item in items" :key="item">{{ item }}</li>
      </ul>
    </div>
  </div>
</template>
