<script setup lang="ts">
import NavigationItemPrimary from './NavigationItemPrimary.vue'
import type { NavigationItemData } from './NavigationItemPrimary.vue'

const _props = withDefaults(defineProps<{ items?: NavigationItemData[] }>(), { items: () => [] })
</script>

<template>
  <nav aria-label="Footer">
    <ul class="flex flex-wrap gap-2 text-sm text-gray-600">
      <NavigationItemPrimary v-for="(item, i) in items" :key="i" :item="item" />
    </ul>
  </nav>
</template>
