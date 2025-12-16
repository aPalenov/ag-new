<script setup lang="ts">
const props = defineProps<{
  linkClass?: string
  iconClass?: string
  textClass?: string
}>()

const { page } = usePageData()

const tenant = computed(() => page.value?.app?.tenant)
</script>

<template>
  <NuxtLink to="/" :class="props.linkClass ?? 'flex items-center gap-4 no-underline'">
    <UIcon :name="`ag-logo:${tenant}`" :class="props.iconClass ?? 'h-[18px] text-[#3e3a39]'" />
    <div :class="props.textClass ?? 'text-xs leading-tight text-[#333] md:text-[15px]'">
      <div class="font-bold">
        АвтоГЕРМЕС
        <span class="uppercase">{{ tenant }}</span>
      </div>
      <div class="font-normal">официальный дилер</div>
    </div>
  </NuxtLink>
</template>
