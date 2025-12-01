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
  <section>
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
      class="max-xl:-mx-(--ui-container-px)"
      :ui="{
        viewport: 'max-xl:px-(--ui-container-px)',
        item: 'md:basis-1/2 xl:basis-1/3',
        dots: 'relative flex inset-0 bottom-0 flex-wrap items-center justify-center gap-3',
        dot: 'relative w-8 h-[3px] rounded bg-black/25 data-[state=active]:bg-black/70 before:absolute before:-inset-1 before:content-[\'\']',
      }"
    >
      <ModelCardDefault class="min-w-2xs" v-bind="item" />
    </UCarousel>
  </section>
</template>
