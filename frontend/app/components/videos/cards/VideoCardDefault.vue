<script setup lang="ts">
const props = defineProps<{
  preview?: string
  title: string
  publishedAt?: string
  url: string
}>()
</script>

<template>
  <div class="flex h-full w-full flex-col overflow-hidden rounded-[26px_26px_0_0]">
    <!-- Картинка / заглушка -->
    <div class="relative mb-7 bg-black/80 pt-[66.6%]">
      <img
        v-if="props.preview"
        :src="props.preview"
        :alt="props.title"
        class="absolute inset-0 h-full w-full object-cover"
      />

      <div class="absolute inset-0 flex items-center justify-center">
        <UIcon name="ag:play-solid" class="text-2xl text-white/90" />
      </div>
    </div>

    <!--  -->
    <h3 class="mb-5 text-xl leading-6 font-bold">
      {{ props.title }}
    </h3>

    <!--  -->
    <div class="text-[13px] text-black/70">
      {{ formatDate(props.publishedAt) }}
    </div>
  </div>
</template>
