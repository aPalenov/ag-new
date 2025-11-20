<script setup lang="ts">
const props = withDefaults(
  defineProps<{
    level?: number
    bottomSpace?: boolean
  }>(),
  {
    level: 1,
    bottomSpace: false,
  },
)
const component = computed(() => `h${props.level}` as keyof HTMLElementTagNameMap)
</script>

<template>
  <component
    :is="component"
    :class="{ 'pb-10': props.bottomSpace }"
    class="text-[40px] leading-12 font-bold"
  >
    <slot />
  </component>
</template>
