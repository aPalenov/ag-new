<script setup lang="ts">
import type { ColorData } from '@@/types/generated'

const props = defineProps<{
  items: ColorData[]
  readonly?: boolean
  size?: 'sm' | 'lg'
}>()

const modelValue = defineModel<ColorData | null>({
  default: null,
})

const onSelect = (color: ColorData) => {
  if (props.readonly || modelValue.value?.hex === color.hex) {
    return
  }
  modelValue.value = color
}

const sizeClass = computed(() => {
  if (props.size === 'lg') {
    return 'w-9 lg:w-[60px]'
  }
  return 'w-7 lg:w-8'
})

const gapClass = computed(() => {
  if (props.size === 'lg') {
    return 'gap-3.5 md:gap-6'
  }
  return 'gap-2 lg:gap-2.5'
})
</script>

<template>
  <div class="flex flex-wrap" :class="gapClass">
    <div
      v-for="item in props.items"
      :key="item.hex"
      type="button"
      :title="item.name"
      :aria-label="item.name"
      :aria-pressed="modelValue?.hex === item.hex"
      :disabled="readonly"
      :style="{ backgroundColor: item.hex }"
      class="relative aspect-square overflow-hidden rounded-full border border-[#BFBFBF]"
      :class="[props.readonly ? 'cursor-default' : 'cursor-pointer', sizeClass]"
      @click="onSelect(item)"
    >
      <div
        v-if="modelValue?.hex === item.hex"
        class="absolute inset-0 flex items-center justify-center text-white drop-shadow-[0_0_5px_rgba(0,0,0,0.7)]"
      >
        <UIcon name="ag:checkmark-bold" class="text-2xl" />
      </div>
    </div>
  </div>
</template>
