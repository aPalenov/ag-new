<script setup lang="ts">
import type { NavigationItemData } from '@@/types/generated'

type NavigationItemProps = {
  list: NavigationItemData[]
  level?: number
  open?: boolean
}

withDefaults(defineProps<NavigationItemProps>(), {
  level: 0,
  open: false,
})
</script>

<template>
  <ul
    v-if="level === 0 || open"
    class="md:flex"
    :class="{
      'h-full': level === 0,
      'flex-col shadow-sm md:absolute md:w-[220px] md:bg-white/50': level > 0,
      'top-0 left-full': level > 1,
    }"
  >
    <NavigationMainItemDefault v-for="(item, i) in list" :key="i" :item="item" :level="level" />
  </ul>
</template>
