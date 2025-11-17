<script setup lang="ts">
import type { NavigationItemData } from './NavigationItemPrimary.vue'

const props = withDefaults(
  defineProps<{
    items?: NavigationItemData[]
  }>(),
  {
    items: () => [],
  },
)
</script>

<template>
  <nav aria-label="Section">
    <ul class="space-y-1">
      <NavigationItemPrimary v-for="(item, i) in props.items" :key="i" :item="item" />
    </ul>
  </nav>
</template>
