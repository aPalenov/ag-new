<script setup lang="ts">
const props = withDefaults(
  defineProps<{
    title: string
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
    titleLevel: 2,
    cta: undefined,
    align: 'start',
    perView: 4,
  },
)

const perViewClass = computed(() => {
  switch (props.perView) {
    case 2:
      return 'basis-1/2'
    case 3:
      return 'basis-1/3'
    case 4:
      return 'basis-1/4'
    case 5:
      return 'basis-1/5'
    case 6:
      return 'basis-1/6'
  }
  return `basis-1`
})

const { carouselRef, next, prev } = useCarousel()

const slots = useSlots()
</script>

<template>
  <div>
    <!-- Заголовок -->
    <HeadingSection class="pb-3" :level="titleLevel || 2">
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
      :ui="{
        item: `${perViewClass} self-stretch`,
      }"
    >
      <slot name="item" :item="item" />
    </UCarousel>
  </div>
</template>
