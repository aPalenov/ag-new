<script setup lang="ts">
import { computed } from 'vue'
import HeroBanner from './blocks/HeroBanner.vue'
import ModelSlider from './blocks/ModelSlider.vue'
import OfferSlider from './blocks/OfferSlider.vue'
import VideoSlider from './blocks/VideoSlider.vue'
import CarSlider from './blocks/CarSlider.vue'
import AsideList from './blocks/AsideList.vue'
import FeatureList from './blocks/FeatureList.vue'
import FeatureSlider from './blocks/FeatureSlider.vue'
import MapBlock from './blocks/MapBlock.vue'
import TextBlock from './blocks/TextBlock.vue'
import ServiceGrid from './blocks/ServiceGrid.vue'

interface BlockDef {
  name: string
  data: Record<string, unknown>
}

const props = defineProps<{ blocks: BlockDef[] | undefined }>()

const blocks = computed(() => props.blocks || [])

type CompLike = unknown | string
const registry: Record<string, CompLike> = {
  HeroBanner,
  ModelSlider,
  OfferSlider,
  VideoSlider,
  CarSlider,
  FeatureList,
  FeatureSlider,
  AsideList,
  MapBlock,
  TextBlock,
  ServiceGrid,
}

const resolveComponent = (name: string) => registry[name] || 'div'
</script>

<template>
  <div class="space-y-14 md:space-y-18">
    <component
      :is="resolveComponent(block.name)"
      v-for="(block, i) in blocks"
      :key="i"
      v-bind="block.data"
    />
  </div>
</template>
