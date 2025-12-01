<script setup lang="ts">
const props = defineProps<{
  mark: string
  model: string
  subtitle: string
  count: number
  colors: Array<{
    name: string
    hex: string
  }>
  preview: string
  price: number
  benefit: number
  cta?: {
    label: string
    url: string
  }
}>()
</script>

<template>
  <div class="group flex w-full flex-col items-center pb-11 text-center">
    <!-- Картинка авто -->
    <NuxtLink :to="props.cta?.url" class="block aspect-3/2">
      <img
        :src="props.preview"
        :alt="`${props.mark} ${props.model}`"
        class="h-auto w-full transition duration-500 group-hover:scale-105"
      />
    </NuxtLink>

    <!-- Заголовок -->
    <HeadingSection class="text-center" :level="3" :spacing="false">
      <NuxtLink :to="props.cta?.url" class="hover:text-brand-accent transition-colors">
        {{ props.mark }}
        <span class="text-brand-accent">{{ props.model }}</span>
      </NuxtLink>
    </HeadingSection>

    <!-- Подзаголовок -->
    <div class="mb-2 text-black/25">{{ props.subtitle }}</div>

    <!-- Чип с количеством авто -->
    <UBadge variant="solid" color="tertiary" class="mb-6">
      {{ props.count }}
      {{ declensionByNumber(props.count, ['автомобиль', 'автомобиля', 'автомобилей']) }} в наличии
    </UBadge>

    <!-- Цвета -->
    <CarColorPalette :items="props.colors" readonly class="mb-5.5" />

    <!-- Цены -->
    <div class="mb-6 flex w-full max-w-[348px] justify-between gap-8 text-left">
      <div>
        <div>Цена от</div>
        <div class="text-2xl font-bold">{{ numberFormat(props.price) }} ₽</div>
      </div>
      <div>
        <div>Выгода до</div>
        <div class="text-brand-accent text-2xl font-bold">{{ numberFormat(props.benefit) }} ₽</div>
      </div>
    </div>

    <!-- Кнопка -->
    <UButton
      v-if="props.cta"
      :to="props.cta.url"
      color="secondary"
      variant="outline"
      trailing-icon="ag:arrow-right"
    >
      {{ props.cta.label || 'Подробнее' }}
    </UButton>
  </div>
</template>
