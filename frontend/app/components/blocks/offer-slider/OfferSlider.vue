<script setup lang="ts">
import type { OfferSliderData, OfferSliderItemData } from '@@/types/generated'

const props = defineProps<OfferSliderData>()
</script>

<template>
  <UContainer as="section">
    <CarouselWithNav v-bind="props">
      <template #item="{ item }: { item: OfferSliderItemData }">
        <OfferCardDefault v-bind="item" />
      </template>
    </CarouselWithNav>
  </UContainer>
</template>
