<script setup lang="ts">
import type {
  CarSliderItemData,
  CtaData,
  FeatureSliderItemData,
  OfferSliderItemData,
  VideoSliderItemData,
} from '@@/types/generated'

type SliderItem =
  | CarSliderItemData
  | FeatureSliderItemData
  | OfferSliderItemData
  | VideoSliderItemData

defineSlots<{
  item(props: { item: SliderItem }): void
  tabs(): void
}>()

const props = withDefaults(
  defineProps<{
    title?: string
    titleLevel?: number
    cta?: CtaData
    items: SliderItem[]
    align?: 'start' | 'center' | 'end'
    perView?: number
  }>(),
  {
    titleLevel: 2,
    align: 'start',
    perView: 4,
  },
)

const perViewClass = computed(() => {
  switch (props.perView) {
    case 2:
      return 'basis-1 lg:basis-1/2'
    case 3:
      return 'basis-1 lg:basis-1/2 xl:basis-1/3'
    case 4:
      return 'basis-[330px] md:basis-[354px] lg:basis-1/3 xl:basis-1/4'
    case 5:
      return 'md:basis-1/2.5 lg:basis-1/4 xl:basis-1/5'
    case 6:
      return 'md:basis-1/3 lg:basis-1/5 xl:basis-1/6'
  }
  return `basis-1`
})

const { carouselRef, next, prev } = useCarousel()

const slots = useSlots()
</script>

<template>
  <div>
    <!-- Заголовок -->
    <HeadingSection v-if="props.title" class="pb-3" :level="titleLevel ?? 2">
      <template #default>
        {{ props.title }}
      </template>
      <template v-if="props.cta" #navigation>
        <HeadingNavigation class="hidden md:flex" :cta="props.cta" @prev="prev" @next="next" />
      </template>
    </HeadingSection>

    <div v-if="slots.tabs" class="-mt-5 mb-9 flex gap-4">
      <slot name="tabs" />
    </div>

    <!-- Слайдер -->
    <UCarousel
      ref="carouselRef"
      v-slot="{ item }"
      :items="props.items"
      :align="align || 'start'"
      loop
      wheel-gestures
      :ui="{
        item: `${perViewClass} self-stretch`,
      }"
      class="select-none"
    >
      <slot name="item" :item="item" />
    </UCarousel>

    <!-- Кнопка призыва к действию -->
    <div v-if="props.cta" class="mt-8 flex justify-center md:hidden">
      <UButton :to="props.cta.url" color="tertiary" variant="solid">
        {{ props.cta.label }}
      </UButton>
    </div>
  </div>
</template>
