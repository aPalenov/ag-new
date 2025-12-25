<script setup lang="ts">
import type { TextContentData } from '@@/types/generated'

const props = defineProps<TextContentData>()

const columnClass = computed(() => {
  switch (props.columns) {
    case 2:
      return 'lg:columns-2'
    case 3:
      return 'md:columns-2 lg:columns-3'
    case 4:
      return 'sm:columns-2 md:columns-3 lg:columns-4'
    default:
      return ''
  }
})
</script>

<template>
  <UContainer as="section">
    <!-- Заголовок -->
    <HeadingSection v-if="props.title" :level="2">{{ props.title }}</HeadingSection>

    <!-- Контент -->
    <div
      class="prose leading-prose line-clamp-11 w-full gap-6 text-ellipsis lg:text-lg"
      :class="columnClass"
    >
      <div v-html="props.text" />
    </div>

    <!-- Кнопка -->
    <div v-if="props.cta" class="mt-9 flex justify-center">
      <UButton :to="props.cta.url" color="secondary" class="" variant="outline">
        {{ props.cta.label }}
      </UButton>
    </div>
  </UContainer>
</template>
