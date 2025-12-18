<script setup lang="ts">
const props = withDefaults(
  defineProps<{
    src: string
    noLazy?: boolean
    showLoadingAnimation?: boolean
  }>(),
  {
    noLazy: false,
    showLoadingAnimation: false,
  },
)

const isLoaded = ref(!props.showLoadingAnimation)

watch(
  () => [props.src, props.showLoadingAnimation],
  () => {
    isLoaded.value = !props.showLoadingAnimation
  },
)
</script>

<template>
  <img
    :src="props.src"
    :loading="!props.noLazy ? 'lazy' : undefined"
    :class="{ 'animate-pulse bg-[#333333]': props.showLoadingAnimation && !isLoaded }"
    @load="isLoaded = true"
    @error="isLoaded = true"
  />
</template>
