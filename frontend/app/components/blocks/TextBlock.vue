<script setup lang="ts">
const props = defineProps<{ text: string }>()
</script>

<template>
  <section class="prose max-w-none py-6">
    <p>{{ props.text }}</p>
  </section>
</template>
