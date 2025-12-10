<script setup lang="ts">
import type { NavigationItemData } from '@@/types/generated'

const props = withDefaults(
  defineProps<{
    id?: string
    list: NavigationItemData[]
    level?: number
    open?: boolean
  }>(),
  {
    level: 0,
    open: false,
  },
)
</script>

<template>
  <Transition name="fade">
    <slot>
      <ul
        :id="props.id"
        v-if="props.level === 0 || props.open"
        class="md:flex"
        :class="{
          'h-full': props.level === 0,
          'flex-col md:absolute md:z-10 md:w-[220px] md:bg-[#f5f5f5] md:shadow-sm': props.level > 0,
          'top-0 left-full': props.level > 1,
        }"
      >
        <NavigationMainItemDefault
          v-for="(item, i) in props.list"
          :key="i"
          :item="item"
          :level="props.level"
        />
      </ul>
    </slot>
  </Transition>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition:
    opacity 0.25s ease,
    transform 0.25s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  transform: translateY(-10px);
}
</style>
