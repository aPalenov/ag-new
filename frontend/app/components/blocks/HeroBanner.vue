<script setup lang="ts">
import type { HeroBannerData } from '@@/types/generated'

const props = defineProps<HeroBannerData>()
</script>

<template>
  <section>
    <UCarousel
      v-slot="{ item }"
      :items="props.items"
      dots
      loop
      wheel-gestures
      class="max-xl:-mx-(--ui-container-px)"
      :ui="{
        container: '-ms-10 md:-ms-6',
        item: 'relative h-[700px]',
        dots: 'relative flex inset-0 bottom-0 flex-wrap items-center justify-center gap-3',
        dot: 'relative w-8 h-[3px] rounded bg-black/25 data-[state=active]:bg-black/70 before:absolute before:-inset-1 before:content-[\'\']',
      }"
    >
      <AppImg
        :src="item.backgroundImageXl"
        :alt="item.title"
        class="absolute inset-0 h-full w-full object-cover"
      />
      <UContainer class="relative z-10 flex h-full flex-col items-start justify-end px-4">
        <AdvertisingPopover v-if="item.advertisingMarking" :advertising="item.advertisingMarking" />

        <div class="text-3xl font-bold">{{ item.title }}</div>
        <div v-if="item.subtitle" class="mt-2 text-gray-600">{{ item.subtitle }}</div>

        <div v-if="item.cta || item.secondCta" class="mt-7 flex justify-center gap-4">
          <UButton v-if="item.cta" :to="item.cta.url" color="primary" variant="solid">
            {{ item.cta.label }}
          </UButton>

          <UButton v-if="item.secondCta" :to="item.secondCta.url" color="tertiary" variant="solid">
            {{ item.secondCta.label }}
          </UButton>
        </div>
      </UContainer>
    </UCarousel>
  </section>
</template>
