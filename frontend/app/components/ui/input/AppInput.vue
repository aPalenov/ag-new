<script setup lang="ts">
import { tv } from 'tailwind-variants'
import type { InputProps } from '@nuxt/ui'

type Props = InputProps & {
  label?: string
  placeholder?: string
}

const props = withDefaults(defineProps<Props>(), {
  label: '',
  placeholder: '',
})

// Flags based on provided props to know if we have leading / trailing visuals
const hasLeading = computed(
  () => !!props.icon || !!props.leadingIcon || props.leading || !!props.avatar,
)
const hasTrailing = computed(() => !!props.trailingIcon || props.trailing)

// Size-aware token suffix helper (md / lg)
const sizeSuffix = computed(() => (props.size === 'lg' ? 'lg' : 'md'))

// tv config for label & placeholder slots with size / leading / trailing variants
const ui = computed(() =>
  tv({
    slots: {
      label:
        'text-(--input-label-color-active) peer-focus:text-(--input-label-color-inactive) peer-placeholder-shown:text-(--input-label-color-active) pointer-events-none absolute top-(--input-label-top-active) left-0 px-(--input-label-padding-x) text-(length:--input-label-text-active) font-(--input-label-font-weight-active) transition-all peer-placeholder-shown:top-(--input-label-top-inactive) peer-placeholder-shown:text-(length:--input-label-text-inactive) peer-placeholder-shown:font-(--input-label-font-weight-inactive) peer-focus:top-(--input-label-top-active) peer-focus:text-(length:--input-label-text-active) peer-focus:font-(--input-label-font-weight-active)',
      placeholder:
        'pointer-events-none absolute w-full origin-left scale-0 truncate text-nowrap text-(--input-placeholder-color) transition-transform select-none peer-focus:peer-placeholder-shown:scale-100',
    },
    variants: {
      size: {
        md: { label: 'px-(--input-px-md)', placeholder: 'px-(--input-px-md)' },
        lg: { label: 'px-(--input-px-lg)', placeholder: 'px-(--input-px-lg)' },
      },
      leading: {
        true: { label: '', placeholder: '' },
        false: { label: '', placeholder: '' },
      },
      trailing: {
        true: { placeholder: '' },
        false: { placeholder: '' },
      },
    },
    compoundVariants: [
      {
        size: 'md',
        leading: true,
        class: {
          label: 'ps-(--input-compound-leading-ps-md)',
          placeholder: 'ps-(--input-compound-leading-ps-md)',
        },
      },
      {
        size: 'lg',
        leading: true,
        class: {
          label: 'ps-(--input-compound-leading-ps-lg)',
          placeholder: 'ps-(--input-compound-leading-ps-lg)',
        },
      },
      {
        size: 'md',
        trailing: true,
        class: {
          placeholder: 'pe-(--input-compound-trailing-pe-md)',
        },
      },
      {
        size: 'lg',
        trailing: true,
        class: {
          placeholder: 'pe-(--input-compound-trailing-pe-lg)',
        },
      },
    ],
  })({
    size: sizeSuffix.value as 'md' | 'lg',
    leading: hasLeading.value,
    trailing: hasTrailing.value,
  }),
)

// Build UI prop passed to underlying UInput; keep peer for sibling selectors
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
    <label :class="ui.label()">{{ props.label }}</label>
    <span v-if="props.placeholder" :class="ui.placeholder()">
      {{ props.placeholder }}
    </span>
    <slot />
  </UInput>
</template>
