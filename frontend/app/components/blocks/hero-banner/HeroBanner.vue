<script setup lang="ts">
import type { HeroBannerData } from '@@/types/generated'
import HeroBannerImage from './HeroBannerImage.vue'

const props = defineProps<HeroBannerData>()
</script>

<template>
  <section>
    <CarouselMain v-slot="{ item }" :items="props.items">
      <HeroBannerImage
        :src-xl="item.backgroundImageXl"
        :src-xs="item.backgroundImageXs"
        :alt="item.title"
        class="absolute inset-0 h-full w-full object-cover"
      />
      <UContainer class="h-full">
        <div class="relative flex h-full items-end justify-start select-none">
          <AdvertisingPopover
            v-if="item.advertisingMarking"
            :advertising="item.advertisingMarking"
            :ui="{
              button: 'absolute top-3 right-0',
            }"
          />
          <div class="mb-15">
            <div class="text-4xl font-bold text-white">{{ item.title }}</div>
            <div v-if="item.subtitle" class="mt-2 text-xl text-white">{{ item.subtitle }}</div>

            <div v-if="item.cta || item.secondCta" class="mt-7 flex gap-4">
              <UButton v-if="item.cta" :to="item.cta.url" size="lg" color="primary" variant="solid">
                {{ item.cta.label }}
              </UButton>

              <UButton
                v-if="item.secondCta"
                :to="item.secondCta.url"
                size="lg"
                color="tertiary"
                variant="solid"
              >
                {{ item.secondCta.label }}
              </UButton>
            </div>
          </div>
        </div>
      </UContainer>
    </CarouselMain>
  </section>
</template>
