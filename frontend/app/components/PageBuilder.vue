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
import MapContacts from '@/components/blocks/map-contacts/MapContacts.vue'
import TextContent from '@/components/blocks/text-content/TextContent.vue'
import ServiceGrid from '@/components/blocks/service-grid/ServiceGrid.vue'
import ModelList from '@/components/blocks/model-list/ModelList.vue'
import ModelGeneral from '@/components/blocks/model-general/ModelGeneral.vue'
import SpecsShort from '@/components/blocks/specs-short/SpecsShort.vue'
import SpecsTable from '@/components/blocks/specs-table/SpecsTable.vue'
import ComplectationsTable from '@/components/blocks/complectations-table/ComplectationsTable.vue'
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
  MapContacts,
  TextContent,
  ServiceGrid,
  ModelList,
  ModelGeneral,
  SpecsShort,
  SpecsTable,
  ComplectationsTable,
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
