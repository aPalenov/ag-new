<script setup lang="ts">
import type { NavigationCarSelectionDefaultTemplateData } from '@@/types/generated'

const props = defineProps<NavigationCarSelectionDefaultTemplateData>()
</script>

<template>
  <div class="min-w-[320px] px-5 py-4">
    <div class="mb-3 font-semibold">{{ props.title }}</div>
    <ul class="grid grid-cols-1 gap-2.5">
      <li
        v-for="it in props.items"
        :key="`${it.mark}${it.model}`"
        class="flex items-end gap-2 border-b border-gray-200 py-2 last:border-b-0"
      >
        <div class="text-lg font-bold">
          <span class="mr-1.5 text-[#333]">{{ it.mark }}</span>
          <span class="text-brand-accent">{{ it.model }}</span>
        </div>
        <div v-if="it.price" class="mb-0.5 font-medium text-[#777]">
          от {{ numberFormat(it.price) }} ₽
        </div>
      </li>
    </ul>
  </div>
</template>
