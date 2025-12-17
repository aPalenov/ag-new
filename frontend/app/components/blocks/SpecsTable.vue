<script setup lang="ts">
import type { SpecsTableData, SpecsTableRowData } from '@@/types/generated'
import type { AccordionItem } from '@nuxt/ui'

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

// Объединяет подряд идущие одинаковые значения в ячейки с colspan
function normalizeRow(row: SpecsTableRowData): Array<{
  value: unknown
  colspan: number
}> {
  const items = Array.isArray(row.items) ? row.items : []
  const result: Array<{ value: unknown; colspan: number }> = []

  result.push({ value: row.label, colspan: 1 })

  for (let index = 0; index < items.length; index++) {
    const value = items[index]
    const lastCell = result[result.length - 1]

    if (lastCell && lastCell.value === value) {
      lastCell.colspan++
    } else {
      result.push({ value, colspan: 1 })
    }
  }

  return result
}
</script>

<template>
  <section>
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
        <!-- Таблица -->
        <table
          class="w-full table-fixed border-collapse"
          :class="{ 'mb-6': index === props.groups.length - 1 }"
        >
          <template v-if="slotProps.item.rows?.length">
            <tbody>
              <!-- Строки -->
              <tr v-for="(row, rowIndex) in slotProps.item.rows" :key="rowIndex">
                <!-- Ячейки -->
                <td
                  v-for="(cell, cellIndex) in normalizeRow(row)"
                  :key="cellIndex"
                  :colspan="cell.colspan"
                  class="border-t border-r border-[#c4c4c4] px-8 py-7 text-center first:pl-0 first:text-left first:text-[#8d8d8d] last:border-r-0 last:pr-0"
                >
                  {{ cell.value }}
                </td>
              </tr>
            </tbody>
          </template>
        </table>
      </template>
    </UAccordion>
  </section>
</template>
