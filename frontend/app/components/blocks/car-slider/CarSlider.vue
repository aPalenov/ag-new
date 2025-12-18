<script setup lang="ts">
import type { CarSliderData, CarSliderItemData } from '@@/types/generated'

const props = defineProps<CarSliderData>()

const currentTab = ref(props.tabs[0]?.type)

const currentProps = computed(
  () => props.tabs.find((tab) => tab.type === currentTab.value) || props.tabs[0],
)

const tabs = computed(() => {
  return props.tabs.map((tab) => ({
    label: tab.label,
    type: tab.type,
  }))
})
</script>

<template>
  <UContainer v-if="currentProps" as="section">
    <CarouselWithNav
      :title="currentProps.title"
      :cta="currentProps.cta"
      :items="currentProps.items"
    >
      <template #tabs>
        <UButton
          v-for="tab in tabs"
          :key="tab.type"
          :value="tab.type"
          :color="currentTab === tab.type ? 'secondary' : 'tertiary'"
          variant="solid"
          @click="currentTab = tab.type"
        >
          {{ tab.label }}
        </UButton>
      </template>
      <template #item="{ item }: { item: CarSliderItemData }">
        <CarCardDefault v-bind="item" />
      </template>
    </CarouselWithNav>
  </UContainer>
</template>
