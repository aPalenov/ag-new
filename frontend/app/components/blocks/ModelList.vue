<script setup lang="ts">
import type { ModelSliderData } from '@@/types/generated'

const props = defineProps<ModelSliderData>()
</script>

<template>
  <section>
    <!-- Заголовок -->
    <HeadingSection class="pb-3 text-center" :level="2" :spacing="false">
      {{ props.title }}
    </HeadingSection>

    <!-- Слайдер -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 md:grid-cols-3 md:gap-3 lg:gap-5">
      <template v-for="(item, index) in props.items" :key="index">
        <ModelCardDefault v-bind="item" />
      </template>
    </div>
  </section>
</template>
