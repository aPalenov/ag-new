<script setup lang="ts">
import { computed } from 'vue'
import HeroBanner from './blocks/HeroBanner.vue'
import FeatureList from './blocks/FeatureList.vue'
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
  FeatureList,
  TextBlock,
  ServiceGrid,
}

const resolveComponent = (name: string) => registry[name] || 'div'
</script>

<template>
  <div>
    <component
      :is="resolveComponent(block.name)"
      v-for="(block, i) in blocks"
      :key="i"
      v-bind="block.data"
    />
  </div>
</template>
