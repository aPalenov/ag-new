<script setup lang="ts">
import { NuxtLink } from '#components'

const props = defineProps<{
  preview?: string
  title: string
  to?: string
  bgClass?: string
}>()

const component = props.to ? NuxtLink : 'div'
</script>

<template>
  <component
    :is="component"
    :to="props.to"
    class="relative w-full overflow-hidden"
    :class="props.bgClass || 'bg-black/80'"
  >
    <AppImg
      v-if="props.preview"
      :src="props.preview"
      :alt="props.title"
      class="absolute inset-0 h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
    />
    <slot />
  </component>
</template>
