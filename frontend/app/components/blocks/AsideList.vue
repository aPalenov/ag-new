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
  <section>
    <div class="grid grid-cols-12 overflow-hidden rounded-3xl bg-neutral-600">
      <!-- Левая колонка -->
      <div class="bg-neutral-700 px-8 pt-9 pb-16 text-white lg:col-span-5 xl:col-span-4">
        <h2 class="mb-6 text-[32px] leading-[1.2] font-bold">
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
      <div class="relative lg:col-span-7 xl:col-span-8">
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
