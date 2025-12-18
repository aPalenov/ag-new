<script setup lang="ts">
withDefaults(
  defineProps<{
    as?: string
  }>(),
  {
    as: 'div',
  },
)
</script>

<template>
  <component :is="as" class="px-[25px] pt-5 pb-9">
    <slot />
  </component>
</template>
