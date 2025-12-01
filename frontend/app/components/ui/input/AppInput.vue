<script setup lang="ts">
import { tv } from 'tailwind-variants'
import type { InputProps } from '@nuxt/ui'
import type { HTMLAttributes, InputHTMLAttributes } from 'vue'

defineOptions({ inheritAttrs: false })

const appConfig = useAppConfig()
const _inputConfig = appConfig.ui?.input

type SizeKey = keyof typeof _inputConfig.variants.size
type VariantKey = keyof typeof _inputConfig.variants.variant
type ColorKey = keyof typeof _inputConfig.variants.color

export interface AppInputProps {
  id?: string
  label?: string
  name?: string
  type?: InputHTMLAttributes['type']
  placeholder?: string
  color?: ColorKey
  variant?: VariantKey
  size?: SizeKey
  required?: boolean
  autocomplete?: InputHTMLAttributes['autocomplete']
  autofocus?: boolean
  autofocusDelay?: number
  disabled?: boolean
  highlight?: boolean
  modelValue?: InputProps['modelValue']
  defaultValue?: InputProps['defaultValue']
  icon?: string
  avatar?: InputProps['avatar']
  leadingIcon?: string
  trailingIcon?: string
  loading?: boolean
  loadingIcon?: string
  list?: InputHTMLAttributes['list']
  max?: InputHTMLAttributes['max']
  maxlength?: InputHTMLAttributes['maxlength']
  min?: InputHTMLAttributes['min']
  pattern?: InputHTMLAttributes['pattern']
  readonly?: InputHTMLAttributes['readonly']
  step?: InputHTMLAttributes['step']
  class?: HTMLAttributes['class']
}

const props = defineProps<AppInputProps>()

const emit = defineEmits<{
  (e: 'update:modelValue', value: string | number | null): void
}>()

const modelValue = useVModel(props, 'modelValue', emit, {
  defaultValue: props.defaultValue,
  passive: true,
})

// Access slots to detect if named slots are provided
const slots = useSlots()

// Flags based on provided props or named slots to know if we have leading / trailing visuals
const hasLeading = computed(
  () => !!props.icon || !!props.leadingIcon || !!props.avatar || !!slots.leading,
)
const hasTrailing = computed(() => !!props.trailingIcon || !!slots.trailing)

// Size-aware token suffix helper (md / lg)
const sizeSuffix = computed(() => (props.size === 'lg' ? 'lg' : 'md'))

// tv config for label & placeholder slots with size / leading / trailing variants
const ui = computed(() =>
  tv({
    slots: {
      label:
        'text-(--input-label-color-active) peer-focus:text-(--input-label-color-inactive) peer-placeholder-shown:text-(--input-label-color-active) pointer-events-none absolute left-0 text-(length:--input-label-text-active) font-(--input-label-font-weight-active) transition-all peer-placeholder-shown:text-(length:--input-label-text-inactive) peer-placeholder-shown:font-(--input-label-font-weight-inactive) peer-focus:text-(length:--input-label-text-active) peer-focus:font-(--input-label-font-weight-active) peer-hover:text-(--input-label-color-hover) peer-disabled:text-(--input-label-color-active)',
      placeholder:
        'pointer-events-none absolute left-0 w-full origin-bottom scale-0 truncate text-nowrap text-(--input-placeholder-color) transition-transform select-none peer-focus:peer-placeholder-shown:scale-100',
    },
    variants: {
      size: {
        md: {
          label:
            'top-(--input-label-top-active-md) px-(--input-label-padding-x-md) peer-placeholder-shown:top-(--input-label-top-inactive-md) peer-focus:top-(--input-label-top-active-md) leading-(--input-line-height)',
          placeholder:
            'top-(--input-pt-md) px-(--input-placeholder-px-md) text-(length:--input-text-md) leading-(--input-line-height)',
        },
        lg: {
          label:
            'top-(--input-label-top-active-lg) px-(--input-label-padding-x-lg) peer-placeholder-shown:top-(--input-label-top-inactive-lg) peer-focus:top-(--input-label-top-active-lg) leading-(--input-line-height)',
          placeholder:
            'top-(--input-pt-lg) px-(--input-placeholder-px-lg) text-(length:--input-text-lg) leading-(--input-line-height)',
        },
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

const basePadding = computed(() =>
  tv({
    variants: {
      size: {
        md: {},
        lg: {},
      },
      label: {
        true: {},
        false: {},
      },
    },
    compoundVariants: [
      { size: 'md', label: true, class: 'pt-(--input-pt-md) pb-(--input-pb-md)' },
      { size: 'md', label: false, class: 'py-(--input-py-md)' },
      { size: 'lg', label: true, class: 'pt-(--input-pt-lg) pb-(--input-pb-lg)' },
      { size: 'lg', label: false, class: 'py-(--input-py-lg)' },
    ],
    defaultVariants: {
      size: 'md',
      label: false,
    },
  })({
    size: sizeSuffix.value as 'md' | 'lg',
    label: !!props.label,
  }),
)

// Build UI prop passed to underlying UInput; keep peer for sibling selectors
const propsUI = {
  ...props,
  placeholder: props.label ? '' : props.placeholder,
  ui: {
    base: ['peer', basePadding.value].filter(Boolean).join(' '),
  },
}
</script>

<template>
  <UInput v-bind="propsUI" v-model="modelValue">
    <!-- Dynamically forward all named slots except default -->
    <template v-for="(_, slotName) of $slots" #[slotName]="scope">
      <slot :name="slotName" v-bind="scope" />
    </template>
    <label :class="ui.label()">{{ props.label }}</label>
    <span v-if="props.label && props.placeholder" :class="ui.placeholder()">
      {{ props.placeholder }}
    </span>
  </UInput>
</template>
