<script setup lang="ts">
import type { VideoSliderData } from '@@/types/generated'

const props = defineProps<VideoSliderData>()
</script>

<template>
  <section>
    <SliderWithNav v-bind="props">
      <template #item="{ item }">
        <VideoCardDefault v-bind="item" />
      </template>
    </SliderWithNav>
  </section>
</template>
