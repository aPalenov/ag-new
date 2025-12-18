<script setup lang="ts">
import type { SpecsShortData } from '@@/types/generated'

const props = defineProps<SpecsShortData>()
</script>

<template>
  <UContainer as="section">
    <!-- TTH -->
    <div class="mx-auto max-w-275">
      <HeadingSection class="text-center" :level="2">
        {{ props.title }}
      </HeadingSection>

      <!-- Icons -->
      <div class="mb-9 flex items-center justify-between gap-10">
        <div v-for="item in props.first_specs" :key="item.label" class="flex items-center gap-8">
          <UIcon :name="item.icon" class="text-[80px] text-[#C4C4C4]" />
          <div class="-mt-2">
            <div class="text-xs">
              {{ item.label }}
            </div>
            <div class="text-5xl font-light tracking-tight text-zinc-900">
              {{ item.value }}
            </div>
          </div>
        </div>
      </div>

      <!-- Black bar -->
      <div class="flex justify-between gap-4 rounded-xl bg-[#3e3a39] px-11 py-5 text-white">
        <div v-for="item in props.second_specs" :key="item.label" class="text-[22px]">
          <span>{{ item.label }}&nbsp;</span>
          <span class="font-bold">{{ item.value }}</span>
        </div>
      </div>
    </div>
  </UContainer>
</template>
