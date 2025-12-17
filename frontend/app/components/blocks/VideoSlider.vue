<script setup lang="ts">
import type { VideoSliderData, VideoSliderItemData } from '@@/types/generated'

const props = defineProps<VideoSliderData>()
</script>

<template>
  <section>
    <UContainer>
      <SliderWithNav v-bind="props">
        <template #item="{ item }: { item: VideoSliderItemData }">
          <VideoCardDefault v-bind="item" />
        </template>
      </SliderWithNav>
    </UContainer>
  </section>
</template>
