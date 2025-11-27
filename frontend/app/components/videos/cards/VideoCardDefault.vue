<script setup lang="ts">
const props = defineProps<{
  preview?: string
  title: string
  publishedAt?: string
  url: string
}>()
</script>

<template>
  <div class="group flex h-full w-full flex-col overflow-hidden rounded-t-3xl">
    <!-- Картинка / заглушка -->
    <div class="relative mb-7 overflow-hidden bg-black/80 pt-[66.6%]">
      <img
        v-if="props.preview"
        :src="props.preview"
        :alt="props.title"
        class="absolute inset-0 h-full w-full object-cover transition duration-500 group-hover:scale-105"
      />

      <div class="absolute inset-0 flex items-center justify-center">
        <div class="drop-shadow-lg">
          <UIcon name="ag:play-solid" class="text-4xl text-white" />
        </div>
      </div>
    </div>

    <!--  -->
    <h3 class="mb-5 text-xl leading-6 font-bold">
      {{ props.title }}
    </h3>

    <!--  -->
    <div v-if="props.publishedAt" class="text-[13px] text-black/70">
      {{ formatDate(props.publishedAt) }}
    </div>
  </div>
</template>
