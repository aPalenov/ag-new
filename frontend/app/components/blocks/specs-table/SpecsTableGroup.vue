<script setup lang="ts">
import type { SpecsTableRowData } from '@@/types/generated'

const props = defineProps<{
  rows: SpecsTableRowData[]
}>()

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
  <table class="w-full table-fixed border-collapse">
    <template v-if="props.rows?.length">
      <tbody>
        <!-- Строки -->
        <tr v-for="(row, rowIndex) in props.rows" :key="rowIndex">
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
