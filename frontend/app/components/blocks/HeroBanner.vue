<script setup lang="ts">
import type { HeroBannerData } from '@@/types/generated'

const props = defineProps<HeroBannerData>()
</script>

<template>
  <section class="text-center">
    <h1 class="text-3xl font-bold">{{ props.title }}</h1>
    <p v-if="props.subtitle" class="mt-2 text-gray-600">{{ props.subtitle }}</p>
  </section>
</template>
