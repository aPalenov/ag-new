<script setup lang="ts">
const props = defineProps<{
  title?: string
  columns?: number
  text: string
  cta?: {
    label: string
    url: string
  }
}>()

const columnClass = computed(() => {
  switch (props.columns) {
    case 2:
      return 'md:columns-2'
    case 3:
      return 'md:columns-3'
    case 4:
      return 'md:columns-4'
    default:
      return ''
  }
})
</script>

<template>
  <section>
    <!-- Заголовок -->
    <HeadingSection v-if="props.title" :level="2">{{ props.title }}</HeadingSection>

    <!-- Контент -->
    <div class="prose max-w-none gap-6 text-lg leading-6.5" :class="columnClass">
      <div v-html="props.text" />
    </div>

    <!-- Кнопка -->
    <div v-if="props.cta" class="mt-9 flex justify-center">
      <UButton :to="props.cta.url" color="secondary" class="" variant="outline">
        {{ props.cta.label }}
      </UButton>
    </div>
  </section>
</template>
