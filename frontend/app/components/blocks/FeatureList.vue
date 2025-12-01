<script setup lang="ts">
const props = defineProps<{
  title?: string
  columns?: number
  items: Array<{
    type: string
    icon?: string
    title: string
    description: string
    url?: string
  }>
}>()

const columnsClass = computed(() => {
  const cols = props.columns || 3
  switch (cols) {
    case 2:
      return 'grid-cols-1 md:grid-cols-2'
    case 3:
      return 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-3'
    case 4:
      return 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-4'
    default:
      return ''
  }
})
</script>

<template>
  <section>
    <!-- Заголовок -->
    <HeadingSection v-if="props.title" :level="2">
      {{ props.title }}
    </HeadingSection>

    <!-- Список -->
    <div class="grid gap-x-6 gap-y-5" :class="columnsClass">
      <template v-for="(item, i) in props.items" :key="i">
        <!-- С фоном -->
        <FeatureCard v-if="item.type === 'feature'" v-bind="item" />

        <!-- Только заголовок -->
        <div
          v-else-if="item.type === 'heading'"
          class="self-center text-[32px] leading-[1.18] font-bold"
        >
          {{ item.title }}
        </div>
      </template>
    </div>
  </section>
</template>
