<script setup lang="ts">
const props = defineProps<{
  cta: {
    label: string
    url: string
  }
}>()

const emit = defineEmits<{
  next: []
  prev: []
}>()
</script>

<template>
  <div class="flex gap-4">
    <UButton :to="props.cta.url" color="secondary" variant="outline">
      {{ props.cta.label }}
    </UButton>
    <UButton
      color="secondary"
      variant="outline"
      trailing-icon="ag:arrow-left"
      @click="emit('prev')"
    />
    <UButton
      color="secondary"
      variant="outline"
      trailing-icon="ag:arrow-right"
      @click="emit('next')"
    />
  </div>
</template>
