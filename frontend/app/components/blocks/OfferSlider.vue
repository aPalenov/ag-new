<script setup lang="ts">
import type { OfferSliderData, OfferSliderItemData } from '@@/types/generated'

const props = defineProps<OfferSliderData>()
</script>

<template>
  <section>
    <SliderWithNav v-bind="props">
      <template #item="{ item }">
        <OfferCardDefault v-bind="item as OfferSliderItemData" />
      </template>
    </SliderWithNav>
  </section>
</template>
