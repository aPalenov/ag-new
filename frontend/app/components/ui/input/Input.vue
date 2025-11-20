<script setup lang="ts">
import type { InputProps } from '@nuxt/ui'

type Props = InputProps & {
  label?: string
  placeholder?: string
}

const props = withDefaults(defineProps<Props>(), {
  label: '',
  placeholder: '',
})

const propsUI = {
  ...props,
  placeholder: '',
  ui: {
    ...(props.ui ?? {}),
    base: ['peer', props.ui?.base].filter(Boolean).join(' '),
  },
}
</script>

<template>
  <UInput v-bind="propsUI">
    <label
      class="text-highlighted peer-focus:text-highlighted peer-placeholder-shown:text-dimmed pointer-events-none absolute -top-2.5 left-0 px-1.5 text-xs font-medium transition-all peer-placeholder-shown:top-1.5 peer-placeholder-shown:text-sm peer-placeholder-shown:font-normal peer-focus:-top-2.5 peer-focus:text-xs peer-focus:font-medium"
    >
      <span class="bg-default inline-flex px-1">{{ props.label }}</span>
    </label>
    <span
      v-if="props.placeholder"
      class="pointer-events-none absolute origin-left scale-0 text-nowrap text-gray-300 transition-transform select-none peer-focus:peer-placeholder-shown:scale-100"
    >
      {{ props.placeholder }}
    </span>
    <slot />
  </UInput>
</template>
