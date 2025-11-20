<script setup lang="ts">
interface ColorItem {
  name: string
  code: string
}

const props = defineProps<{
  items: ColorItem[]
  readonly?: boolean
}>()

const modelValue = defineModel<ColorItem | null>({
  default: null,
})

const onSelect = (color: ColorItem) => {
  if (props.readonly || modelValue.value?.code === color.code) {
    return
  }
  modelValue.value = color
}
</script>

<template>
  <div class="flex items-center justify-center gap-2.5">
    <div
      v-for="item in props.items"
      :key="item.code"
      type="button"
      :title="item.name"
      :aria-label="item.name"
      :aria-pressed="modelValue?.code === item.code"
      :disabled="readonly"
      :style="{ backgroundColor: item.code }"
      class="h-8 w-8 rounded-full border"
      :class="[
        modelValue?.code === item.code ? 'border-neutral-600' : 'border-neutral-400',
        props.readonly ? 'cursor-default' : 'cursor-pointer',
      ]"
      @click="onSelect(item)"
    />
  </div>
</template>
