<script setup lang="ts">
const props = defineProps<{
  preview?: string
  type: string
  mark: string
  model: string
  complectation?: string
  modification?: string
  color?: {
    name: string
    hex: string
  }
  features?: Array<string>
  price: number
  benefit?: number
  cta?: {
    label: string
    url: string
  }
  secondCta?: {
    label: string
    url: string
  }
}>()
</script>

<template>
  <div class="flex h-full w-full flex-col overflow-hidden rounded-3xl border border-black/25">
    <!-- Картинка / заглушка -->
    <div class="relative w-full bg-black/5 pt-[66.6%]">
      <img
        v-if="props.preview"
        :src="props.preview"
        :alt="`${props.mark} ${props.model}`"
        class="absolute inset-0 h-full w-full object-cover"
      />
    </div>

    <div class="flex flex-1 flex-col px-6 pt-6 pb-9">
      <h3 class="text-2xl font-bold">
        {{ props.mark }}
        <span class="text-brand-accent">{{ props.model }}</span>
      </h3>

      <!--  -->
      <div class="mb-4 flex justify-between gap-4">
        <span v-if="props.complectation">{{ props.complectation }}</span>
        <div v-if="props.color" class="flex items-center gap-2 text-sm">
          <div :style="{ backgroundColor: props.color.hex }" class="h-5 w-5 rounded-full border" />
          <span>{{ props.color.name }}</span>
        </div>
      </div>

      <!--  -->
      <div v-if="props.modification" class="mb-5 text-sm leading-tight">
        {{ props.modification }}
      </div>

      <!--  -->
      <div v-if="props.features?.length" class="mb-4 flex flex-wrap gap-2.5">
        <UBadge v-for="feature in props.features" :key="feature" color="tertiary" variant="solid">
          {{ feature }}
        </UBadge>
      </div>

      <!-- Цены -->
      <div class="mt-auto mb-5 flex max-w-[260px] justify-between gap-8 text-left text-sm">
        <div>
          <div>Цена от</div>
          <div class="text-lg font-bold">{{ numberFormat(props.price) }} ₽</div>
        </div>
        <div>
          <div>Выгода до</div>
          <div class="text-brand-accent text-lg font-bold">{{ numberFormat(props.benefit) }} ₽</div>
        </div>
      </div>

      <!-- Кнопка -->
      <div v-if="props.cta">
        <UButton :to="props.cta.url" color="primary" variant="solid">
          {{ props.cta.label || 'Подробнее' }}
        </UButton>
      </div>

      <!-- Кнопка -->
      <div v-if="props.secondCta" class="mt-4">
        <NuxtLink
          :to="props.secondCta.url"
          class="hover:text-brand-accent text-sm uppercase underline"
        >
          {{ props.secondCta.label || 'Подробнее' }}
        </NuxtLink>
      </div>
    </div>
  </div>
</template>
