<script setup lang="ts">
interface AsideItem {
  title: string
  description: string
  url: string
}

const props = defineProps<{
  title: string
  photo: string
  items: AsideItem[]
}>()
</script>

<template>
  <section class="py-9">
    <div class="grid grid-cols-6 overflow-hidden rounded-3xl bg-neutral-600">
      <!-- Левая колонка -->
      <div class="col-span-2 bg-neutral-700 px-8 pt-9 pb-16 text-white">
        <h2 class="mb-6 text-[32px] font-bold">
          {{ props.title }}
        </h2>

        <div class="space-y-10">
          <div
            v-for="item in props.items"
            :key="item.title"
            class="cursor-pointer"
            @click="navigateTo(item.url)"
          >
            <div class="flex items-center gap-6">
              <div class="flex-1">
                <h3 class="text-lg font-bold">
                  {{ item.title }}
                </h3>
                <p class="mt-1 text-base leading-snug">
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
      <div class="relative col-span-4">
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
