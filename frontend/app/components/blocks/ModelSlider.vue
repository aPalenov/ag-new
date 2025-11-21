<script setup lang="ts">
const props = defineProps<{
  title: string
  items: Array<{
    mark: string
    model: string
    subtitle: string
    count: number
    colors: Array<string>
    preview: string
    price: number
    benefit: number
    cta?: {
      label: string
      url: string
    }
  }>
}>()
</script>

<template>
  <section class="py-9">
    <!-- Заголовок -->
    <HeadingSection class="pb-3 text-center" :level="2" :spacing="false">
      {{ props.title }}
    </HeadingSection>

    <!-- Слайдер -->
    <UCarousel
      v-slot="{ item }"
      :items="props.items"
      dots
      loop
      wheel-gestures
      :ui="{
        item: 'basis-1/3',
        dots: 'relative flex inset-0 bottom-0 flex-wrap items-center justify-center gap-3',
        dot: 'relative w-8 h-[3px] rounded bg-black/25 data-[state=active]:bg-black/70 before:absolute before:-inset-1 before:content-[\'\']',
      }"
    >
      <ModelCardDefault v-bind="item" />
    </UCarousel>
  </section>
</template>
