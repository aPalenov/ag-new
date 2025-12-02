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
    <PreviewImage class="aspect-3/2" :to="props.url" :preview="props.preview" :title="props.title">
      <div class="absolute inset-0 flex items-center justify-center">
        <div class="drop-shadow-lg">
          <UIcon name="ag:play-solid" class="text-4xl text-white" />
        </div>
      </div>
    </PreviewImage>

    <!--  -->
    <h3 class="mt-6 mb-4 text-lg leading-[1.2] font-bold md:mt-7 md:mb-5 md:text-xl">
      <NuxtLink :to="props.url" class="hover:text-brand-accent transition-colors">
        {{ props.title }}
      </NuxtLink>
    </h3>

    <!--  -->
    <div v-if="props.publishedAt" class="text-[13px] text-black/70">
      {{ formatDate(props.publishedAt) }}
    </div>
  </div>
</template>
