<script setup lang="ts">
const props = defineProps<{
  tabs: Array<{
    type: string
    title: string
    label: string
    filter: object
    cta?: {
      label: string
      url: string
    }
    items: Array<{
      preview?: string
      type: string
      mark: string
      model: string
      complectation?: string
      modification?: string
      color?: {
        name: string
        hex: string
      }
      features?: Array<string>
      price: number
      benefit?: number
      cta?: {
        label: string
        url: string
      }
      secondCta?: {
        label: string
        url: string
      }
    }>
  }>
}>()

const currentTab = ref(props.tabs[0]?.type)

const currentProps = computed(() => {
  return props.tabs.find((tab) => tab.type === currentTab.value) || props.tabs[0]
})

const tabs = computed(() => {
  return props.tabs.map((tab) => ({
    label: tab.label,
    type: tab.type,
  }))
})
</script>

<template>
  <section class="py-9">
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
