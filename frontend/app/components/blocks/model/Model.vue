<script setup lang="ts">
import type { ModelData } from '@@/types/generated'

const props = defineProps<ModelData>()

const currentColor = ref(props.colors?.[0] ?? null)
</script>

<template>
  <UContainer as="section" class="-mt-14 grid items-start gap-6 pb-4 md:-mt-18 lg:grid-cols-12">
    <!-- Car -->
    <div class="lg:col-span-7">
      <div class="relative aspect-3/2">
        <img
          :src="props.preview"
          :alt="props.title"
          class="h-full w-full object-contain select-none"
          draggable="false"
        />
        <!-- 360 -->
        <div v-if="props.images_360" class="absolute -bottom-5 left-0 w-full text-center">
          <UIcon name="ag:arrows-360" class="text-[80px]" />
        </div>
      </div>
    </div>

    <!-- Info -->
    <div class="lg:col-span-5 lg:pt-33">
      <!-- Price -->
      <div class="mb-5 flex items-end gap-3">
        <HeadingSection class="leading-none" :level="0" :spacing="false">
          от {{ numberFormat(props.price_from) }} ₽
        </HeadingSection>
        <UIcon name="ag:info" class="mb-2 text-lg text-[#bdbdbd]" />
      </div>

      <!-- Actions -->
      <div class="mb-14 flex max-w-96 flex-col gap-5 sm:flex-row sm:flex-wrap">
        <UButton v-if="props.trade_in" color="secondary">Трейд-ин</UButton>
        <UButton v-if="props.credit_payment_per_month" color="secondary">
          в кредит от {{ numberFormat(props.credit_payment_per_month) }} ₽/мес.
        </UButton>
        <UButton color="primary">Заказать звонок</UButton>
      </div>

      <!--  -->
      <div class="mb-5 text-[22px]">Цвет: {{ currentColor?.name }}</div>
      <CarColorPalette v-model="currentColor" :items="props.colors" size="lg" class="max-w-lg" />
    </div>
  </UContainer>
</template>
