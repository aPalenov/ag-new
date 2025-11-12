<script setup lang="ts">
const props = defineProps<{ items: Array<{ icon?: string; title: string; text?: string }> }>()
</script>

<template>
  <section class="py-8">
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
      <div v-for="(it, i) in props.items" :key="i" class="rounded border p-4">
        <strong class="block">{{ it.title }}</strong>
        <p class="text-gray-600">{{ it.text }}</p>
      </div>
    </div>
  </section>
</template>
