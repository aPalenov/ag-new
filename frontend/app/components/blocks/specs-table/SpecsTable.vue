<script setup lang="ts">
import type { SpecsTableData, SpecsTableRowData } from '@@/types/generated'
import type { AccordionItem } from '@nuxt/ui'
import SpecsTableGroup from './SpecsTableGroup.vue'

type ExtendedAccordionItem = AccordionItem & {
  rows: SpecsTableRowData[]
}

const props = defineProps<SpecsTableData>()

// Преобразуем группы в формат AccordionItem
const accordionItems = computed<ExtendedAccordionItem[]>(() => {
  return props.groups.map((group, index) => ({
    label: group.label,
    slot: `group-${index}` as const,
    trailingIcon: 'ag:add',
    // Добавляем данные группы для использования в слоте
    rows: group.rows as SpecsTableRowData[],
  }))
})

// Контроль открытого элемента
const active = ref<string[]>([props.opened_index !== undefined ? String(props.opened_index) : '-1'])
</script>

<template>
  <UContainer as="section">
    <HeadingSection v-if="props.title && props.title.length" :level="2">
      {{ props.title }}
    </HeadingSection>

    <UAccordion
      v-model="active"
      :items="accordionItems"
      :unmount-on-hide="false"
      type="multiple"
      :ui="{
        root: 'rounded-2xl bg-[#f5f5f5] px-9',
        item: 'border-b border-[#C4C4C4] last:border-b-0',
        trigger: 'py-7.5 gap-4 cursor-pointer',
        label: 'text-[22px] font-bold leading-head',
        trailingIcon: 'size-9 transition-transform group-data-[state=open]:rotate-45',
        body: '',
      }"
    >
      <!-- Группы -->
      <template
        v-for="(group, index) in props.groups"
        :key="index"
        #[`group-${index}`]="slotProps: { item: ExtendedAccordionItem }"
      >
        <SpecsTableGroup
          :rows="slotProps.item.rows"
          :class="{ 'mb-6': index === props.groups.length - 1 }"
        />
      </template>
    </UAccordion>
  </UContainer>
</template>
