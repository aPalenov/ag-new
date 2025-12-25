<script setup lang="ts">
import { tv } from 'tailwind-variants'

const props = defineProps<{
  class?: any
  ui?: {
    root?: string
    icon?: string
    text?: string
  }
}>()

const { page } = usePageData()

const tenant = computed(() => page.value?.app?.tenant)

const logoTV = tv({
  slots: {
    root: 'flex items-center gap-9 no-underline',
    icon: 'text-[18px] text-[#3e3a39]',
    text: 'text-xs leading-tight text-[#333] md:text-[15px]',
  },
})

const styles = logoTV()

const ui = computed(() => ({
  root: styles.root({ class: [props.ui?.root, props.class] }),
  icon: styles.icon({ class: props.ui?.icon }),
  text: styles.text({ class: props.ui?.text }),
}))
</script>

<template>
  <NuxtLink to="/" :class="ui.root">
    <UIcon :name="`ag-logo:${tenant}`" :class="ui.icon" />
    <div :class="ui.text">
      <div class="font-bold">
        АвтоГЕРМЕС
        <span class="uppercase">{{ tenant }}</span>
      </div>
      <div class="font-normal">официальный дилер</div>
    </div>
  </NuxtLink>
</template>
