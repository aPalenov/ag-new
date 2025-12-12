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
      'pb-7 md:pb-10': props.spacing,
      'flex items-center justify-between gap-6': slots.navigation,
    }"
  >
    <component :is="component" class="leading-head text-[32px] font-bold lg:text-[40px]">
      <slot />
    </component>
    <slot name="navigation" />
  </div>
</template>
