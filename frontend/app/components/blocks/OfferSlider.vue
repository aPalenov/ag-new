<script setup lang="ts">
import type { OfferSliderData } from '@@/types/generated'

const props = defineProps<OfferSliderData>()
</script>

<template>
  <section>
    <SliderWithNav v-bind="props">
      <template #item="{ item }">
        <OfferCardDefault v-bind="item" />
      </template>
    </SliderWithNav>
  </section>
</template>
