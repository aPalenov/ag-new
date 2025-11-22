<script setup lang="ts">
const props = defineProps<{
  preview?: string
  type: string
  title: string
  description?: string
  publishedAt?: string
  cta?: {
    label: string
    url: string
  }
}>()

const typeLabel = computed(() => (props.type === 'news' ? 'Новости' : 'Спецпредложение'))
</script>

<template>
  <div class="flex h-full w-full flex-col overflow-hidden rounded-3xl border-1 border-black/25">
    <!-- Картинка / заглушка -->
    <div class="relative w-full bg-black/80 pt-[66.6%]">
      <img
        v-if="props.preview"
        :src="props.preview"
        :alt="props.title"
        class="absolute inset-0 h-full w-full object-cover"
      />
      <UBadge variant="solid" color="tertiary" class="absolute top-4 right-6" size="sm">
        Реклама
      </UBadge>
    </div>

    <!-- Контент -->
    <div class="flex flex-1 flex-col gap-6 px-6 pt-4 pb-9">
      <div class="flex items-center justify-between gap-2">
        <UBadge :color="props.type === 'offer' ? 'primary' : 'secondary'">
          {{ typeLabel }}
        </UBadge>

        <span class="text-[13px] text-black/70">
          {{ formatDate(props.publishedAt) }}
        </span>
      </div>

      <div class="space-y-3">
        <h3 class="text-xl leading-6 font-bold">
          {{ props.title }}
        </h3>
        <p class="text-sm leading-snug">
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
