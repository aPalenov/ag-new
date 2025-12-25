<script setup lang="ts">
const props = defineProps<{
  items: any[]
}>()

defineSlots<{
  default(props: { item: any }): void
}>()

const appConfig = useAppConfig()
</script>

<template>
  <UCarousel
    v-slot="{ item }"
    :items="props.items"
    dots
    loop
    wheel-gestures
    :ui="{
      item: 'relative h-[700px]',
      controls: [appConfig.ui.container.base, 'relative'],
      dots: 'absolute flex bottom-[66px] left-auto right-(--ui-container-px) flex-wrap items-center justify-center gap-[6px]',
      dot: 'relative w-8 h-[3px] rounded bg-white data-[state=active]:bg-black/70 before:absolute before:-inset-1',
    }"
  >
    <slot :item="item" />
  </UCarousel>
</template>
