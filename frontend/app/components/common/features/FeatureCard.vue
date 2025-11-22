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
    class="relative flex h-full flex-col rounded-3xl bg-black/5 px-8 pt-6 pb-8"
    :class="{ 'cursor-pointer': props.url }"
    @click="props.url && navigateTo(props.url)"
  >
    <UIcon v-if="props.icon" :name="props.icon" size="60" class="text-brand-accent mb-5" />

    <div class="max-w-[280px] pb-3 text-[28px] leading-[1.14] font-bold">
      {{ props.title }}
    </div>
    <div class="text-lg leading-snug">{{ props.description }}</div>

    <NuxtLink v-if="props.url" :to="props.url" class="mt-auto ml-auto">
      <UIcon name="ag:arrow-right" size="36" class="-mt-1 -mb-3 text-black/25" />
    </NuxtLink>
  </div>
</template>
