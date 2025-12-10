<script setup lang="ts">
import type { PhoneType } from '@/stores/advPhone'

const props = defineProps<{
  withIcon?: boolean
  type?: PhoneType
  staticPhone?: string
  dynamicPhone?: string | null
  dynamicHideAfter?: number
  customPhoneText?: string
  iconClass?: string
}>()

const store = useAdvPhoneStore()
store.setInit({
  type: props.type,
  staticPhone: props.staticPhone,
  dynamicPhone: props.dynamicPhone ?? null,
  dynamicHideAfter: props.dynamicHideAfter,
})

const isLoading = computed(() => store.isLoading)
const isDynamic = computed(() => store.isDynamic)
const isDynamicPhoneShow = computed(() => store.isDynamicPhoneShow)
const phoneFormatter = computed(() => store.phoneFormatter)
const phoneLink = computed(() => store.phoneLink)

const phoneText = computed(() => {
  if (isLoading.value) {
    return 'Загрузка...'
  }

  if (isDynamic.value && !isDynamicPhoneShow.value) {
    return props.customPhoneText || 'Показать номер'
  }

  return phoneFormatter.value
})

function fetchDynamicPhone() {
  if (isDynamic.value && !isDynamicPhoneShow.value) {
    store.fetch()
  }
}
</script>

<template>
  <component
    :is="phoneLink ? 'a' : 'span'"
    :href="phoneLink"
    class="whitespace-nowrap"
    :class="{
      'cursor-pointer': !isDynamicPhoneShow,
      'inline-flex items-center gap-2': props.withIcon,
    }"
    @click="fetchDynamicPhone"
  >
    <UIcon v-if="props.withIcon" :class="props.iconClass" name="ag:phone-fill" />
    {{ phoneText }}
  </component>
</template>
