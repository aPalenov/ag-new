<script setup lang="ts">
import type { MapData } from '@@/types/generated'

const props = defineProps<MapData>()

const activeIndex = ref<number>(-1)
</script>

<template>
  <UContainer as="section">
    <!-- Правая колонка с фото -->
    <div
      class="-mx-(--ui-container-px) grid overflow-hidden rounded-(--card-radius) bg-black/5 sm:mx-0 sm:grid-cols-12"
    >
      <!-- Информация -->
      <div class="p-6 pb-12 sm:col-span-6 md:p-8 xl:col-span-4">
        <HeadingSection>
          {{ props.title }}
        </HeadingSection>

        <ul class="mb-14 space-y-3 text-base lg:text-lg">
          <li v-for="(item, index) in props.items" :key="index" class="flex items-center gap-2">
            <UIcon
              name="ag:map-marker"
              :class="{ 'text-brand-accent': activeIndex === index }"
              class="shrink-0 cursor-pointer text-3xl"
              @click="activeIndex = index"
            />
            <NuxtLink to="#" class="hover:underline" @click="activeIndex = index">
              {{ item.label }}
            </NuxtLink>
          </li>
        </ul>

        <div class="leading-head mb-2 text-2xl font-bold"><AdvPhoneLink /></div>
        <div class="mb-12">Ежедневно с 9:00 до 21:00</div>
        <div><UButton variant="solid" color="primary">Заказать звонок</UButton></div>
      </div>

      <!-- Карта -->
      <div
        class="relative aspect-11/9 bg-black/5 sm:-order-1 sm:col-span-6 sm:aspect-auto xl:col-span-8"
      >
        <YandexMap
          v-model:active-index="activeIndex"
          :center="props.center"
          :zoom="props.zoom"
          :items="props.items"
          class="absolute inset-0"
        />
      </div>
    </div>
  </UContainer>
</template>
