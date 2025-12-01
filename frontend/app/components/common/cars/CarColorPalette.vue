<script setup lang="ts">
interface ColorItem {
  name: string
  hex: string
}

const props = defineProps<{
  items: ColorItem[]
  readonly?: boolean
}>()

const modelValue = defineModel<ColorItem | null>({
  default: null,
})

const onSelect = (color: ColorItem) => {
  if (props.readonly || modelValue.value?.hex === color.hex) {
    return
  }
  modelValue.value = color
}
</script>

<template>
  <div class="flex items-center justify-center gap-2 lg:gap-2.5">
    <div
      v-for="item in props.items"
      :key="item.hex"
      type="button"
      :title="item.name"
      :aria-label="item.name"
      :aria-pressed="modelValue?.hex === item.hex"
      :disabled="readonly"
      :style="{ backgroundColor: item.hex }"
      class="aspect-square w-7 rounded-full border lg:w-8"
      :class="[
        modelValue?.hex === item.hex ? 'border-black/50' : 'border-black/25',
        props.readonly ? 'cursor-default' : 'cursor-pointer',
      ]"
      @click="onSelect(item)"
    />
  </div>
</template>
