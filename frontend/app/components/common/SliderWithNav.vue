<script setup lang="ts">
const props = withDefaults(
  defineProps<{
    title?: string
    titleLevel?: number
    cta?: {
      label: string
      url: string
    }
    items: object[]
    align?: 'start' | 'center' | 'end'
    perView?: number
  }>(),
  {
    title: undefined,
    titleLevel: 2,
    cta: undefined,
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
      return 'md:basis-[354px] lg:basis-1/3 xl:basis-1/4'
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
        <HeadingNavigation :cta="props.cta" @prev="prev" @next="next" />
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
      class="max-xl:-mx-(--ui-container-px)"
      :ui="{
        viewport: 'max-xl:px-(--ui-container-px)',
        item: `${perViewClass} self-stretch`,
      }"
    >
      <slot name="item" :item="item" />
    </UCarousel>
  </div>
</template>
