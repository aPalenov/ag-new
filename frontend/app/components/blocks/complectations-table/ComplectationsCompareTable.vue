<script setup lang="ts">
import type { ComplectationItemData } from '@@/types/generated'
import ComplectationsTableHeader from './ComplectationsTableHeader.vue'

defineProps<{
  complectations: ComplectationItemData[]
  options: { [key: string]: { [key: number]: boolean } }
}>()
</script>

<template>
  <div class="spaced-scrollbar overflow-x-auto">
    <table class="w-full border-collapse">
      <ComplectationsTableHeader :complectations="complectations" />
      <tbody>
        <tr
          v-for="(optionValues, optionName) in options"
          :key="optionName"
          class="border-t border-[#c4c4c4] align-middle last:border-b"
        >
          <td class="py-5 pr-8 text-left text-lg text-[#8D8D8D] last:border-r-0">
            {{ optionName }}
          </td>
          <td
            v-for="complectation in complectations"
            :key="complectation.id"
            class="border-l border-[#C4C4C4] px-8 py-7 text-center align-middle"
          >
            <UIcon
              v-if="optionValues[complectation.id]"
              name="ag:checkmark-bold"
              class="text-2xl"
            />
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
