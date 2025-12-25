<script setup lang="ts">
import type { ModelSliderData } from '@@/types/generated'

const props = defineProps<ModelSliderData>()
</script>

<template>
  <UContainer as="section">
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
        container: '-ms-10 md:-ms-6',
        item: 'basis-77.5 md:basis-1/2 xl:basis-1/3 ps-10 md:ps-6',
        dots: 'relative flex inset-0 bottom-0 flex-wrap items-center justify-center gap-3',
        dot: 'relative w-8 h-[3px] rounded bg-[#BDBDBD] data-[state=active]:bg-[#333333] before:absolute before:-inset-1',
      }"
      class="select-none"
    >
      <ModelCardDefault v-bind="item" />
    </UCarousel>
  </UContainer>
</template>
