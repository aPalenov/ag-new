<script setup lang="ts">
import type { NavigationItemData } from '@@/types/generated'
import { tv } from 'tailwind-variants'

const props = withDefaults(
  defineProps<{
    items: NavigationItemData[]
    models?: boolean
    class?: any
    ui?: {
      root?: string
    }
  }>(),
  {
    models: false,
  },
)

const previewImageTV = tv({
  slots: {
    root: 'space-y-2',
  },
})

const styles = previewImageTV()

const ui = computed(() => ({
  root: styles.root({ class: [props.ui?.root, props.class] }),
}))

const itemClass = computed(() => {
  return props.models ? 'font-bold text-gray-900' : 'text-gray-600'
})
</script>

<template>
  <ul :class="ui.root">
    <li v-for="(child, childIndex) in props.items" :key="childIndex">
      <NuxtLink
        v-if="child.data?.href"
        :to="child.data.href"
        class="text-sm hover:text-blue-600"
        :class="itemClass"
      >
        {{ child.label }}
      </NuxtLink>
      <span v-else class="text-sm" :class="itemClass">{{ child.label }}</span>
    </li>
  </ul>
</template>
