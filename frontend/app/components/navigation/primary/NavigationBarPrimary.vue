<script setup lang="ts">
import type { NavigationItemData } from './NavigationItemPrimary.vue'

const props = withDefaults(defineProps<{ items?: NavigationItemData[] }>(), { items: () => [] })
</script>

<template>
  <nav aria-label="Главное меню" class="w-full">
    <ul
      class="flex w-full items-center gap-2 text-xs tracking-[0.18em] whitespace-nowrap text-[#1F273A] uppercase md:text-sm"
    >
      <NavigationItemPrimary v-for="(item, i) in props.items" :key="i" :item="item" />
    </ul>
  </nav>
</template>
