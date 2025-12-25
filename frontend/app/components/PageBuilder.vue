<script setup lang="ts">
import { computed } from 'vue'
import HeroBanner from '@/components/blocks/hero-banner/HeroBanner.vue'
import ModelSlider from '@/components/blocks/model-slider/ModelSlider.vue'
import OfferSlider from '@/components/blocks/offer-slider/OfferSlider.vue'
import VideoSlider from '@/components/blocks/video-slider/VideoSlider.vue'
import CarSlider from '@/components/blocks/car-slider/CarSlider.vue'
import AsideList from '@/components/blocks/aside-list/AsideList.vue'
import FeatureList from '@/components/blocks/feature-list/FeatureList.vue'
import FeatureSlider from '@/components/blocks/feature-slider/FeatureSlider.vue'
import Map from '@/components/blocks/map/Map.vue'
import Text from '@/components/blocks/text/Text.vue'
import ServiceGrid from '@/components/blocks/service-grid/ServiceGrid.vue'
import ModelList from '@/components/blocks/model-list/ModelList.vue'
import Model from '@/components/blocks/model/Model.vue'
import SpecsShort from '@/components/blocks/specs-short/SpecsShort.vue'
import SpecsTable from '@/components/blocks/specs-table/SpecsTable.vue'
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
  ModelList,
  Model,
  SpecsShort,
  SpecsTable,
}

const resolveComponent = (name: string) => registry[name] || 'div'
</script>

<template>
  <div class="space-y-14 md:space-y-18 md:pb-22">
    <component
      :is="resolveComponent(block.name)"
      v-for="(block, i) in blocks"
      :key="i"
      v-bind="block.data"
    />
  </div>
</template>
