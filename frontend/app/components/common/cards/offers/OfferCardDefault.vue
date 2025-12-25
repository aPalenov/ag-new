<script setup lang="ts">
import type { OfferSliderItemData } from '@@/types/generated'

const props = defineProps<OfferSliderItemData>()

const typeLabel = computed(() => (props.type === 'news' ? 'Новости' : 'Спецпредложение'))
</script>

<template>
  <AppCard class="group flex h-full w-full flex-col border border-[#BFBFBF]">
    <!-- Картинка / заглушка -->
    <PreviewImage
      class="aspect-3/2"
      :to="props.cta?.url"
      :preview="props.preview"
      :title="props.title"
    >
      <AdvertisingPopover
        v-if="props.advertisingMarking"
        :advertising="props.advertisingMarking"
        :ui="{
          button: 'absolute top-4 right-6',
        }"
      />
    </PreviewImage>

    <!-- Контент -->
    <AppCardContent class="flex flex-1 flex-col gap-5 md:gap-6">
      <div class="flex items-center justify-between gap-2">
        <UBadge :color="props.type === 'offer' ? 'primary' : 'secondary'">
          {{ typeLabel }}
        </UBadge>

        <span v-if="props.publishedAt" class="text-right text-[13px] text-[#4C4C51]">
          {{ formatDate(props.publishedAt) }}
        </span>
      </div>

      <div class="space-y-3">
        <h3 class="leading-head text-lg font-bold md:text-xl">
          <NuxtLink :to="props.cta?.url" class="hover:text-brand-accent transition-colors">
            {{ props.title }}
          </NuxtLink>
        </h3>
        <p class="leading-prose text-sm">
          {{ props.description }}
        </p>
      </div>

      <div v-if="props.cta" class="mt-auto">
        <!-- Кнопка -->
        <UButton
          :to="props.cta.url"
          color="secondary"
          variant="outline"
          trailing-icon="ag:arrow-right"
        >
          {{ props.cta.label || 'Подробнее' }}
        </UButton>
      </div>
    </AppCardContent>
  </AppCard>
</template>
