<script setup lang="ts">
import type { PhoneType } from '@/stores/advPhone'
import { tv } from 'tailwind-variants'

const props = defineProps<{
  withIcon?: boolean
  type?: PhoneType
  staticPhone?: string
  dynamicPhone?: string | null
  dynamicHideAfter?: number
  customPhoneText?: string
  ui?: {
    root?: string
    icon?: string
  }
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

const phoneLinkTV = tv({
  base: 'whitespace-nowrap',
  variants: {
    clickable: {
      true: 'cursor-pointer',
      false: '',
    },
    withIcon: {
      true: 'inline-flex items-center gap-2',
      false: '',
    },
  },
})

const iconTV = tv({ base: '' })

const ui = computed(() => ({
  root: phoneLinkTV({
    clickable: !isDynamicPhoneShow.value,
    withIcon: !!props.withIcon,
    class: props.ui?.root,
  }),
  icon: iconTV({ class: props.ui?.icon }),
}))
</script>

<template>
  <component
    :is="phoneLink ? 'a' : 'span'"
    :href="phoneLink"
    :class="ui.root"
    @click="fetchDynamicPhone"
  >
    <UIcon v-if="props.withIcon" :class="ui.icon" name="ag:phone-fill" />
    {{ phoneText }}
  </component>
</template>
