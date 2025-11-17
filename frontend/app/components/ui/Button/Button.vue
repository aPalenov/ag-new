<script setup lang="ts">
import type { ButtonProps } from '@nuxt/ui'

const props = defineProps<ButtonProps>()
const theme = useCurrentTheme()
const buttonMap = {
  primary: {
    base: ['rounded-full'],
  },
}

const buttonProps = computed(() => ({ ...props, ui: buttonMap[theme.value] }))
</script>

<template>
  <UButton v-bind="buttonProps"><slot /></UButton>
</template>
