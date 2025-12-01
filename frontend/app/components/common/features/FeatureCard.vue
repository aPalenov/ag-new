<script setup lang="ts">
const props = defineProps<{
  icon?: string
  title: string
  description: string
  url?: string
}>()
</script>

<template>
  <div
    class="group relative flex h-full flex-col rounded-3xl bg-black/5 p-5 md:px-8 md:pt-6 md:pb-8"
    :class="{ 'cursor-pointer transition-colors hover:bg-black/10': props.url }"
    @click="props.url && navigateTo(props.url)"
  >
    <UIcon
      v-if="props.icon"
      :name="props.icon"
      size="60"
      class="text-brand-accent mb-5"
      :class="{ 'transition-transform duration-300 group-hover:scale-105': props.url }"
    />

    <!-- title -->
    <div class="max-w-[280px] pb-2 leading-[1.14] font-bold md:pb-3 md:text-lg md:text-[28px]">
      {{ props.title }}
    </div>

    <!-- description -->
    <div class="text-base leading-[1.444] md:text-lg">{{ props.description }}</div>

    <NuxtLink
      v-if="props.url"
      :to="props.url"
      class="mt-auto ml-auto md:pb-2"
      :class="{ 'transition-transform duration-300 group-hover:translate-x-2': props.url }"
    >
      <UIcon name="ag:arrow-right" size="36" class="-mt-1 -mb-3 text-black/25" />
    </NuxtLink>
  </div>
</template>
