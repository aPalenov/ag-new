<script setup lang="ts">
import { NuxtLink } from '#components'
import { tv } from 'tailwind-variants'

const props = defineProps<{
  preview?: string
  title: string
  to?: string
  ui?: {
    root?: string
  }
}>()

const component = props.to ? NuxtLink : 'div'

const previewImageTV = tv({
  slots: {
    root: 'relative w-full overflow-hidden bg-black/80',
  },
})

const styles = previewImageTV()
</script>

<template>
  <component :is="component" :to="props.to" :class="styles.root({ class: props.ui?.root })">
    <AppImg
      v-if="props.preview"
      :src="props.preview"
      :alt="props.title"
      class="absolute inset-0 h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
    />
    <slot />
  </component>
</template>
