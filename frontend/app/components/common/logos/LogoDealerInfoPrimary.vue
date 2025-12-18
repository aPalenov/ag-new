<script setup lang="ts">
import { tv } from 'tailwind-variants'

const props = defineProps<{
  ui?: {
    link?: string
    icon?: string
    text?: string
  }
}>()

const { page } = usePageData()

const tenant = computed(() => page.value?.app?.tenant)

const logoTV = tv({
  slots: {
    link: 'flex items-center gap-4 no-underline',
    icon: 'h-[18px] text-[#3e3a39]',
    text: 'text-xs leading-tight text-[#333] md:text-[15px]',
  },
})

const styles = logoTV()
</script>

<template>
  <NuxtLink to="/" :class="styles.link({ class: props.ui?.link })">
    <UIcon :name="`ag-logo:${tenant}`" :class="styles.icon({ class: props.ui?.icon })" />
    <div :class="styles.text({ class: props.ui?.text })">
      <div class="font-bold">
        АвтоГЕРМЕС
        <span class="uppercase">{{ tenant }}</span>
      </div>
      <div class="font-normal">официальный дилер</div>
    </div>
  </NuxtLink>
</template>
