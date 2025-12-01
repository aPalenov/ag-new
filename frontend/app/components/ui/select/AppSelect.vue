<script setup lang="ts">
import { tv } from 'tailwind-variants'
import type { AvatarProps, SelectProps } from '@nuxt/ui'
import type { HTMLAttributes, InputHTMLAttributes } from 'vue'
import { getDisplayValue, isArrayOfArray } from '@nuxt/ui/runtime/utils/index.js'

defineOptions({ inheritAttrs: false })

const appConfig = useAppConfig()
const _selectConfig = appConfig.ui?.select

type SizeKey = keyof typeof _selectConfig.variants.size
type VariantKey = keyof typeof _selectConfig.variants.variant
type ColorKey = keyof typeof _selectConfig.variants.color

export interface AppSelectProps {
  id?: string
  label?: string
  clearable?: boolean
  placeholder?: string
  color?: ColorKey
  variant?: VariantKey
  size?: SizeKey
  trailingIcon?: string
  selectedIcon?: string
  content?: SelectProps['content']
  arrow?: SelectProps['arrow']
  portal?: SelectProps['portal']
  valueKey?: SelectProps['valueKey']
  labelKey?: SelectProps['labelKey']
  descriptionKey?: SelectProps['descriptionKey']
  items?: SelectProps['items']
  modelValue?: SelectProps['modelValue']
  defaultValue?: SelectProps['defaultValue']
  multiple?: boolean
  highlight?: boolean
  autofocus?: boolean
  autofocusDelay?: number
  disabled?: boolean
  open?: boolean
  defaultOpen?: boolean
  autocomplete?: InputHTMLAttributes['autocomplete']
  name?: string
  required?: boolean
  icon?: string
  avatar?: AvatarProps
  leadingIcon?: string
  loading?: boolean
  loadingIcon?: string
  class?: HTMLAttributes['class']
  ui?: SelectProps['ui']
}

const props = withDefaults(defineProps<AppSelectProps>(), {
  clearable: false,
  portal: true,
  defaultOpen: false,
  valueKey: 'value',
  labelKey: 'label',
})

const emit = defineEmits<{
  (e: 'update:modelValue', value: string | number | null): void
  (e: 'update:open', value: boolean): void
}>()

const modelValue = useVModel(props, 'modelValue', emit, {
  defaultValue: props.defaultValue,
  passive: true,
})
const modelOpen = useVModel(props, 'open', emit, {
  defaultValue: props.defaultOpen,
  passive: true,
})

// Access slots to detect if named slots are provided
const slots = useSlots()

// Flags based on provided props or named slots to know if we have leading / trailing visuals
const hasLeading = computed(
  () => !!props.icon || !!props.leadingIcon || !!props.avatar || !!props.loading || !!slots.leading,
)
const hasTrailing = computed(() => !!props.trailingIcon || !!slots.trailing)

// Size-aware token suffix helper (md / lg)
const sizeSuffix = computed(() => (props.size === 'lg' ? 'lg' : 'md'))

// Flatten items and compute display label similar to USelect
const groups = computed(() =>
  props.items?.length ? (isArrayOfArray(props.items) ? props.items : [props.items]) : [],
)

const groupItems = computed(() => groups.value.flatMap((group) => group))

const displayValue = computed((): string | undefined => {
  if (props.multiple && Array.isArray(modelValue.value)) {
    const displayedValues = modelValue.value
      .map((item) =>
        getDisplayValue(groupItems.value, item, {
          labelKey: props.labelKey,
          valueKey: props.valueKey,
        }),
      )
      .filter((v) => v != null && v !== '')
    return displayedValues.length > 0 ? displayedValues.join(', ') : void 0
  }

  return getDisplayValue(groupItems.value, modelValue.value, {
    labelKey: props.labelKey,
    valueKey: props.valueKey,
  })
})

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
      { size: 'md', label: true, class: 'pt-(--select-pt-md) pb-(--select-pb-md)' },
      { size: 'md', label: false, class: 'py-(--select-py-md)' },
      { size: 'lg', label: true, class: 'pt-(--select-pt-lg) pb-(--select-pb-lg)' },
      { size: 'lg', label: false, class: 'py-(--select-py-lg)' },
    ],
    defaultVariants: {
      size: 'md',
      label: false,
    },
  })({
    size: sizeSuffix.value,
    label: !!props.label,
  }),
)

const isFilled = computed(
  () =>
    modelValue.value !== undefined &&
    modelValue.value !== null &&
    !(Array.isArray(modelValue.value) && modelValue.value.length === 0),
)

const placeholderTV = computed(() =>
  tv({
    base: 'pointer-events-none absolute text-left left-0 w-full origin-bottom truncate text-nowrap transition-transform select-none text-(--select-placeholder-color)',
    variants: {
      size: {
        md: 'top-(--select-pt-md) px-(--select-placeholder-px-md) text-(length:--select-text-md)',
        lg: 'top-(--select-pt-lg) px-(--select-placeholder-px-lg) text-(length:--select-text-lg)',
      },
      leading: {
        true: '',
        false: '',
      },
      trailing: {
        true: '',
        false: '',
      },
      label: {
        true: '',
        false: '',
      },
      // один флаг видимости вместо open/filled
      visible: {
        true: 'scale-100',
        false: 'scale-0',
      },
    },
    compoundVariants: [
      // если НЕТ label — сдвигаем placeholder вниз (по size)
      {
        size: 'md',
        label: false,
        class: 'top-(--select-py-md)',
      },
      {
        size: 'lg',
        label: false,
        class: 'top-(--select-py-lg)',
      },

      // leading
      {
        size: 'md',
        leading: true,
        class: 'ps-(--select-compound-leading-ps-md)',
      },
      {
        size: 'lg',
        leading: true,
        class: 'ps-(--select-compound-leading-ps-lg)',
      },

      // trailing
      {
        size: 'md',
        trailing: true,
        class: 'pe-(--select-compound-trailing-pe-md)',
      },
      {
        size: 'lg',
        trailing: true,
        class: 'pe-(--select-compound-trailing-pe-lg)',
      },
    ],
  })({
    size: sizeSuffix.value,
    leading: hasLeading.value,
    trailing: hasTrailing.value,
    label: !!props.label,
    visible: !isFilled.value && (!props.label || modelOpen.value),
  }),
)

const labelTV = computed(() =>
  tv({
    base: 'pointer-events-none absolute left-0 transition-all text-(--select-label-color-active)',
    variants: {
      size: {
        md: {
          class: 'px-(--select-label-padding-x-md)',
        },
        lg: {
          class: 'px-(--select-label-padding-x-lg)',
        },
      },
      leading: {
        true: '',
        false: '',
      },
      trailing: {
        true: '',
        false: '',
      },
      active: {
        true: 'text-(length:--select-label-text-active) font-(--select-label-font-weight-active)',
        false:
          'text-(length:--select-label-text-inactive) font-(--select-label-font-weight-inactive)',
      },
    },
    compoundVariants: [
      // top по size + active
      {
        size: 'md',
        active: false,
        class: 'top-(--select-label-top-inactive-md)',
      },
      {
        size: 'lg',
        active: false,
        class: 'top-(--select-label-top-inactive-lg)',
      },
      {
        size: 'md',
        active: true,
        class: 'top-(--select-label-top-active-md)',
      },
      {
        size: 'lg',
        active: true,
        class: 'top-(--select-label-top-active-lg)',
      },

      // leading
      {
        size: 'md',
        leading: true,
        class: 'ps-(--select-compound-leading-ps-md)',
      },
      {
        size: 'lg',
        leading: true,
        class: 'ps-(--select-compound-leading-ps-lg)',
      },

      // trailing
      {
        size: 'md',
        trailing: true,
        class: 'pe-(--select-compound-trailing-pe-md)',
      },
      {
        size: 'lg',
        trailing: true,
        class: 'pe-(--select-compound-trailing-pe-lg)',
      },
    ],
  })({
    size: sizeSuffix.value,
    leading: hasLeading.value,
    trailing: hasTrailing.value,
    active: modelOpen.value || isFilled.value,
  }),
)

// Build UI prop passed to underlying UInput; keep peer for sibling selectors
const propsUI = {
  ...props,
  placeholder: props.label ? '' : props.placeholder,
  content: { bodyLock: false, sideOffset: 0, ...(props.content ?? {}) },
  ui: {
    base: basePadding.value,
  },
}
</script>

<template>
  <USelect v-bind="propsUI" v-model="modelValue" v-model:open="modelOpen">
    <!-- Dynamically forward all named slots except default -->
    <template v-for="(_, slotName) of $slots" #[slotName]="scope">
      <slot :name="slotName" v-bind="scope" />
    </template>

    <template v-if="isFilled && props.clearable" #trailing>
      <UButton
        as="span"
        color="neutral"
        variant="link"
        icon="ag:cancel"
        class="p-0 py-3 pl-2"
        @pointerdown.prevent.stop="modelValue = null"
      />
    </template>

    <template #default="{ ui: slotUI }">
      <!-- Drive animation by whether a value is selected -->
      <span v-if="props.label" :class="labelTV">
        {{ props.label }}
      </span>
      <span v-if="props.placeholder" :class="placeholderTV">
        {{ props.placeholder }}
      </span>
      <span v-if="isFilled" :class="slotUI.value({ class: props.ui?.value })">
        {{ displayValue }}
      </span>
      <span v-else>&nbsp;</span>
    </template>
  </USelect>
</template>
