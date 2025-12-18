<script setup lang="ts">
import type { FeatureSliderItemData } from '@@/types/generated'

const props = defineProps<FeatureSliderItemData>()
</script>

<template>
  <AppCard
    class="group relative flex h-full flex-col bg-black/5 p-5 md:px-8 md:pt-6 md:pb-8"
    :class="{ 'cursor-pointer transition-colors hover:bg-black/10': props.url }"
    @click="props.url && navigateTo(props.url)"
  >
    <UIcon
      v-if="props.icon"
      :name="props.icon"
      size="60"
      class="text-brand-accent mb-5"
      :class="{ 'transition-transform duration-300 group-hover:scale-105': props.url }"
    />

    <!-- title -->
    <div class="leading-head max-w-[280px] pb-2 font-bold md:pb-3 md:text-lg md:text-[28px]">
      {{ props.title }}
    </div>

    <!-- description -->
    <div v-if="props.description" class="leading-prose text-base md:text-lg">
      {{ props.description }}
    </div>

    <NuxtLink
      v-if="props.url"
      :to="props.url"
      class="mt-auto ml-auto md:pb-2"
      :class="{ 'transition-transform duration-300 group-hover:translate-x-2': props.url }"
    >
      <UIcon name="ag:arrow-right" size="36" class="-mt-1 -mb-3 text-black/25" />
    </NuxtLink>
  </AppCard>
</template>
