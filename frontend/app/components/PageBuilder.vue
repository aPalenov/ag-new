<script setup lang="ts">
import { computed } from 'vue'
import HeroBanner from '@/components/blocks/HeroBanner.vue'
import ModelSlider from '@/components/blocks/ModelSlider.vue'
import OfferSlider from '@/components/blocks/OfferSlider.vue'
import VideoSlider from '@/components/blocks/VideoSlider.vue'
import CarSlider from '@/components/blocks/CarSlider.vue'
import AsideList from '@/components/blocks/AsideList.vue'
import FeatureList from '@/components/blocks/FeatureList.vue'
import FeatureSlider from '@/components/blocks/FeatureSlider.vue'
import Map from '@/components/blocks/Map.vue'
import Text from '@/components/blocks/Text.vue'
import ServiceGrid from '@/components/blocks/ServiceGrid.vue'
import type { PageBuilderBlockData } from '@@/types/generated'

const props = defineProps<{ blocks: PageBuilderBlockData[] | undefined }>()

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
  Map,
  Text,
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
