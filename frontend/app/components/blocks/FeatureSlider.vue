<script setup lang="ts">
import type { FeatureSliderData, FeatureSliderItemData } from '@@/types/generated'

const props = defineProps<FeatureSliderData>()
</script>

<template>
  <section>
    <SliderWithNav :items="props.items">
      <template #item="{ item }: { item: FeatureSliderItemData }">
        <FeatureCard v-bind="item" />
      </template>
    </SliderWithNav>
  </section>
</template>
