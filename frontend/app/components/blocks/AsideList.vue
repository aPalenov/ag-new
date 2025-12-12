<script setup lang="ts">
import type { AsideListData } from '@@/types/generated'

const props = defineProps<AsideListData>()
</script>

<template>
  <section>
    <div
      class="-mx-(--ui-container-px) grid overflow-hidden rounded-3xl bg-neutral-600 sm:mx-0 sm:grid-cols-12"
    >
      <!-- Левая колонка -->
      <div
        class="bg-neutral-700 px-8 pt-9 pb-16 text-white sm:col-span-6 lg:col-span-5 xl:col-span-4"
      >
        <h2 class="leading-head mb-6 text-[32px] font-bold">{{ props.title }}</h2>

        <div class="space-y-8 md:space-y-10">
          <div
            v-for="item in props.items"
            :key="item.title"
            class="cursor-pointer"
            @click="navigateTo(item.url)"
          >
            <div class="flex flex-col items-start gap-6 sm:flex-row sm:items-center">
              <div class="flex-1">
                <h3 class="text-lg font-bold">
                  {{ item.title }}
                </h3>
                <p class="leading-prose mt-1 text-base">
                  {{ item.description }}
                </p>
              </div>

              <UButton
                :to="item.url"
                color="tertiary"
                variant="outline"
                trailing-icon="ag:arrow-right"
              />
            </div>
          </div>
        </div>
      </div>

      <!-- Правая колонка с фото -->
      <div class="relative aspect-3/2 sm:col-span-6 sm:aspect-auto lg:col-span-7 xl:col-span-8">
        <img
          :src="props.photo"
          :alt="props.title"
          class="absolute h-full w-full object-cover"
          loading="lazy"
        />
      </div>
    </div>
  </section>
</template>
