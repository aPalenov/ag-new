<script setup lang="ts">
const props = withDefaults(
  defineProps<{
    level?: number
    spacing?: boolean
  }>(),
  {
    level: 1,
    spacing: true,
  },
)

const slots = useSlots()

const component = computed(
  () => (props.level ? `h${props.level}` : 'div') as keyof HTMLElementTagNameMap,
)
</script>

<template>
  <div
    :class="{
      'pb-10': props.spacing,
      'flex flex-wrap items-center justify-between gap-6': slots.navigation,
    }"
  >
    <component :is="component" class="text-[40px] leading-12 font-bold">
      <slot />
    </component>
    <slot name="navigation" />
  </div>
</template>
