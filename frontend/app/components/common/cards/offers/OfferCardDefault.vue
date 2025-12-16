<script setup lang="ts">
import type { OfferSliderItemData } from '@@/types/generated'

const props = defineProps<OfferSliderItemData>()

const typeLabel = computed(() => (props.type === 'news' ? 'Новости' : 'Спецпредложение'))
</script>

<template>
  <div
    class="group flex h-full w-full flex-col overflow-hidden rounded-(--card-radius) border border-black/25"
  >
    <!-- Картинка / заглушка -->
    <PreviewImage
      class="aspect-3/2"
      :to="props.cta?.url"
      :preview="props.preview"
      :title="props.title"
    >
      <UBadge
        variant="solid"
        color="tertiary"
        class="absolute top-4 right-6 cursor-default"
        size="sm"
        @click.stop.prevent="() => {}"
      >
        Реклама
      </UBadge>
    </PreviewImage>

    <!-- Контент -->
    <div class="flex flex-1 flex-col gap-5 px-(--card-content-px) py-(--card-content-py) md:gap-6">
      <div class="flex items-center justify-between gap-2">
        <UBadge :color="props.type === 'offer' ? 'primary' : 'secondary'">
          {{ typeLabel }}
        </UBadge>

        <span v-if="props.publishedAt" class="text-right text-[13px] text-black/70">
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
    </div>
  </div>
</template>
