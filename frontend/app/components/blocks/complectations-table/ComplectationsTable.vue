<script setup lang="ts">
import type { ComplectationsTableData, ComplectationItemData } from '@@/types/generated'
import type { AccordionItem } from '@nuxt/ui'
import ComplectationsCompareTable from './ComplectationsCompareTable.vue'
import ComplectationsBaseList from './ComplectationsBaseList.vue'

interface CompareAccordionItem extends AccordionItem {
  category: string
  options: { [key: string]: { [key: number]: boolean } }
  isBase?: false
}

interface BaseAccordionItem extends AccordionItem {
  category: string
  isBase: true
}

type ExtendedAccordionItem = CompareAccordionItem | BaseAccordionItem

const props = defineProps<ComplectationsTableData>()

// Флаг: добавлять в фильтр только значения, по которым есть различия между комплектациями
const onlyDiffFilterValues = false

// Активные фильтры (выбранные значения)
const activeFilters = ref<Set<string>>(new Set())

// Кнопки фильтров
const filterButtons = computed(() => {
  if (!props.filter_keys.length) {
    return []
  }

  const values = [] as string[]

  props.filter_keys.forEach((key: string) => {
    const uniqueValuesForKey = new Set<string>()

    props.complectations.forEach((complectation: ComplectationItemData) => {
      const value = (complectation as Record<string, any>)[key]
      uniqueValuesForKey.add(value)
    })

    if (uniqueValuesForKey.size > (onlyDiffFilterValues ? 1 : 0)) {
      uniqueValuesForKey.forEach((value) => {
        if (!values.includes(value)) {
          values.push(value)
        }
      })
    }
  })

  return values
})

// Переключение фильтра
function toggleFilter(value: string) {
  if (activeFilters.value.has(value)) {
    activeFilters.value.delete(value)
  } else {
    activeFilters.value.add(value)
  }
  // Триггерим реактивность
  activeFilters.value = new Set(activeFilters.value)
}

// Проверка активности фильтра
function isFilterActive(value: string): boolean {
  return activeFilters.value.has(value)
}

// Отфильтрованные комплектации
const filteredComplectations = computed(() => {
  if (activeFilters.value.size === 0) {
    return props.complectations
  }

  return props.complectations.filter((complectation: ComplectationItemData) => {
    // Комплектация проходит фильтр, если хотя бы один из её filter_keys значений
    // соответствует одному из активных фильтров
    return props.filter_keys.some((key: string) => {
      const value = (complectation as Record<string, any>)[key]
      return activeFilters.value.has(value)
    })
  })
})

// Элементы аккордиона для compare блоков
const accordionItems = computed<ExtendedAccordionItem[]>(() => {
  const items: ExtendedAccordionItem[] = []

  // Добавляем категории compare
  if (props.options?.compare) {
    Object.entries(props.options.compare).forEach(([category, options], index) => {
      // Пропускаем пустые категории
      if (Object.keys(options).length === 0) {
        return
      }

      items.push({
        value: `compare-${index}`,
        label: category,
        trailingIcon: 'ag:add',
        category,
        options,
        isBase: false,
      })
    })
  }

  // Добавляем базовые характеристики в конец
  if (props.options?.base && Object.keys(props.options.base).length > 0) {
    items.push({
      value: 'base',
      label: 'Основные характеристики',
      trailingIcon: 'ag:add',
      category: 'base',
      isBase: true,
    })
  }

  return items
})

// Контроль открытого элемента - первый по умолчанию открыт
const active = ref<string[]>(
  accordionItems.value.length > 0 && accordionItems.value[0]?.value
    ? [accordionItems.value[0].value]
    : [],
)
</script>

<template>
  <UContainer as="section">
    <HeadingSection v-if="props.title && props.title.length" class="text-center" :level="2">
      {{ props.title }}
    </HeadingSection>

    <div v-if="filterButtons.length" class="mb-10 flex flex-wrap justify-center gap-4">
      <UButton
        v-for="(button, index) in filterButtons"
        :key="index"
        color="secondary"
        :variant="isFilterActive(button) ? 'solid' : 'outline'"
        @click="toggleFilter(button)"
      >
        {{ button }}
      </UButton>
    </div>

    <UAccordion
      v-if="accordionItems.length"
      v-model="active"
      :items="accordionItems"
      :unmount-on-hide="false"
      type="multiple"
      :ui="{
        item: 'rounded-2xl bg-[#f5f5f5] px-9 mb-6 last:mb-0',
      }"
    >
      <template #body="{ item }">
        <!-- Compare table -->
        <ComplectationsCompareTable
          v-if="!item.isBase"
          :complectations="filteredComplectations"
          :options="(item as CompareAccordionItem).options"
        />

        <!-- Base list (не таблица, просто список) -->
        <ComplectationsBaseList v-else :base-options="props.options.base" />
      </template>
    </UAccordion>
  </UContainer>
</template>
