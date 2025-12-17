<script setup lang="ts">
import { tv } from 'tailwind-variants'
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

const ulTV = tv({
  base: 'md:flex',
  variants: {
    root: {
      true: 'h-full',
      false: '',
    },
    nested: {
      true: 'flex-col md:absolute md:z-10 md:w-[220px] md:bg-[#f5f5f5] md:shadow-sm',
      false: '',
    },
    deep: {
      true: 'top-0 left-full',
      false: '',
    },
  },
})
</script>

<template>
  <Transition name="fade">
    <slot>
      <ul
        v-if="props.level === 0 || props.open"
        :id="props.id"
        :class="
          ulTV({
            root: props.level === 0,
            nested: props.level > 0,
            deep: props.level > 1,
          })
        "
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
