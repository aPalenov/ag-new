<script setup lang="ts">
import type { CarSliderData } from '@@/types/generated'

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
  <section v-if="currentProps">
    <SliderWithNav v-bind="currentProps">
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
      <template #item="{ item }">
        <CarCardDefault v-bind="item" />
      </template>
    </SliderWithNav>
  </section>
</template>
