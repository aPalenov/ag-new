<script setup lang="ts">
import type { VideoSliderData, VideoSliderItemData } from '@@/types/generated'

const props = defineProps<VideoSliderData>()
</script>

<template>
  <section>
    <UContainer>
      <CarouselWithNav v-bind="props">
        <template #item="{ item }: { item: VideoSliderItemData }">
          <VideoCardDefault v-bind="item" />
        </template>
      </CarouselWithNav>
    </UContainer>
  </section>
</template>
