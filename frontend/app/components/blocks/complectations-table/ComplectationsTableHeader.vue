<script setup lang="ts">
import type { ComplectationItemData } from '@@/types/generated'

defineProps<{
  complectations: ComplectationItemData[]
}>()
</script>

<template>
  <thead>
    <tr>
      <th class="min-w-108 border-t border-r border-[#c4c4c4] p-5"></th>
      <th
        v-for="complectation in complectations"
        :key="complectation.id"
        class="min-w-61 border-t border-r border-[#c4c4c4] p-5 text-center align-top font-normal last:border-r-0"
      >
        <div class="leading-head flex flex-col gap-1">
          <span class="text-[22px] font-bold uppercase">{{ complectation.name }}</span>
          <span class="text-lg">от {{ numberFormat(complectation.prices.price) }} ₽</span>
          <span class="leading-head text-sm">
            {{ complectation.year }}, {{ complectation.engine_volume }} ({{
              complectation.engine_power
            }}
            л.с.), {{ complectation.engine_type }}, {{ complectation.transmission_short }},
            {{ complectation.seats }} мест,
            {{ complectation.drive.toLowerCase() }}
          </span>
        </div>
      </th>
    </tr>
  </thead>
</template>
