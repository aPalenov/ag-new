<script setup lang="ts">
const props = defineProps<{
  title: string
  items: Array<{
    prev: string
    mark_name: string
    model_name: string
    subtitle?: string
    count?: number
    colors?: string[]
    cta?: string
  }>
}>()
</script>

<template>
  <section class="py-9">
    <HeadingSection class="pb-3 text-center" :level="2">{{ props.title }}</HeadingSection>

    <UCarousel
      v-slot="{ item }"
      :items="props.items"
      dots
      loop
      wheel-gestures
      class="w-full"
      :ui="{
        item: 'basis-1/3',
        dots: 'relative flex inset-0 bottom-0 flex-wrap items-center justify-center gap-3',
        dot: 'relative w-8 h-[3px] rounded bg-neutral-300 data-[state=active]:bg-black/70 before:absolute before:-inset-1 before:content-[\'\']',
      }"
    >
      <ModelCardDefault v-bind="item" />
    </UCarousel>
  </section>
</template>
