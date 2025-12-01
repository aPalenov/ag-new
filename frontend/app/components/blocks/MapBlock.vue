<script setup lang="ts">
const props = defineProps<{
  title: string
  center: [number, number]
  zoom: number
  items: Array<{
    label: string
    coordinates: [number, number]
  }>
}>()

const activeIndex = ref<number>(-1)
</script>

<template>
  <section>
    <!-- Правая колонка с фото -->
    <div class="grid grid-cols-12 overflow-hidden rounded-3xl bg-black/5">
      <!-- Карта -->
      <div class="relative bg-black/5 lg:col-span-6 xl:col-span-8">
        <YandexMap v-bind="props" v-model:active-index="activeIndex" class="absolute inset-0" />
      </div>

      <!-- Левая колонка -->
      <div class="p-8 pb-12 lg:col-span-6 xl:col-span-4">
        <h2 class="mb-10 text-[40px] font-bold">
          {{ props.title }}
        </h2>

        <ul class="mb-14 space-y-3 text-lg">
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

        <div class="mb-2 text-2xl leading-tight font-bold"><AdvPhone /></div>
        <div class="mb-12">Ежедневно с 9:00 до 21:00</div>
        <div><UButton variant="solid" color="primary">Заказать звонок</UButton></div>
      </div>
    </div>
  </section>
</template>
