<script setup lang="ts">
import type { SelectMenuItem } from '@nuxt/ui'
import { brands } from '../../../tailwind.branding'

const appConfig = useAppConfig()
const inputConfig = appConfig.ui?.input

// Derive keys from typed app config (augmented in types/app-config.d.ts)
type SizeKey = keyof typeof inputConfig.variants.size
type VariantKey = keyof typeof inputConfig.variants.variant
type ColorKey = keyof typeof inputConfig.variants.color

// Derive sizes from app config
const sizes = Object.keys(inputConfig?.variants?.size || {}) as SizeKey[]

// Showcase states (not in config; keep explicit)
const states = ['default', 'error', 'disabled']
// Derive variants from app config
const result = inputConfig?.compoundVariants.reduce<Record<VariantKey, ColorKey[]>>(
  (acc, { variant, color }) => {
    if (!variant || !color) {
      return acc
    }

    ;(acc[variant] ??= []).push(color)
    return acc
  },
  {} as Record<VariantKey, ColorKey[]>,
)

const brandItems: SelectMenuItem[] = Object.keys(brands).map((brand) => ({
  label: brand,
}))

const inputList = [
  {
    label: 'default',
  },
  {
    label: 'label',
    props: {
      label: 'Email address',
    },
  },
  {
    label: 'label + icon',
    props: {
      icon: 'ag:search',
      label: 'Email address',
    },
  },
  {
    label: 'label + trailing-icon',
    props: {
      trailingIcon: 'ag:info',
      label: 'Email address',
    },
  },
  {
    label: 'label + icon + button (trailing-icon)',
    btn: true,
    props: {
      icon: 'ag:search',
      label: 'Email address',
    },
  },
  {
    label: 'label + help',
    help: 'This is some help text',
    props: {
      icon: 'ag:search',
      label: 'Email address',
    },
  },
]

const selectList = [
  {
    label: 'default',
  },
]

const selectItems = ref<SelectMenuItem[]>([
  [
    { label: 'Поиск', value: 'poisk', icon: 'ag:search' },
    { label: 'Информация', value: 'informaciya', icon: 'ag:info' },
    {
      label: 'Длинный элемент списка для теста отображения',
      value: 'dlinnyy-element-spiska',
    },
    { label: 'Тег', value: 'teg' },
    { label: 'Палитра (недоступно)', value: 'palitra', disabled: true },
    { label: 'Настройки', value: 'nastroyki' },
  ],
  [
    { label: 'Маска', value: 'maska' },
    { label: 'Вектор', value: 'vector' },
    { label: 'Графика', value: 'grafika' },
    { label: 'Подсказка (недоступно)', value: 'podskazka', disabled: true },
    { label: 'Кисть', value: 'kist' },
  ],
])

const brandValue = ref<SelectMenuItem>(brandItems[0] as SelectMenuItem)

const label = ref('ПОДРОБНЕЕ')
</script>

<template>
  <USelectMenu v-model="brandValue" :items="brandItems" class="w-48" />
  <UInput v-model="label" placeholder="Enter your label" label="Label" />
  <section class="grid grid-cols-[repeat(auto-fill,minmax(1200px,1fr))] gap-5 space-y-10">
    <!-- Per-size sections -->
    <div v-for="size in sizes" :key="size" class="h-full rounded-lg border border-dashed p-5">
      <div class="mb-4 text-sm font-semibold">
        size:
        <span class="text-xl uppercase">{{ size }}</span>
      </div>

      <!-- Grid header: states -->
      <div class="grid grid-cols-[220px_repeat(3,minmax(0,1fr))] items-center gap-3">
        <template v-for="(colors, variant) in result" :key="variant">
          <div />
          <div
            v-for="state in states"
            :key="state"
            class="self-end text-xs font-medium text-gray-400"
          >
            state:
            <span class="text-default text-md font-semibold capitalize">{{ state }}</span>
          </div>

          <template v-for="(input, index) in inputList" :key="index">
            <div class="text-xs font-medium capitalize">{{ input.label }}</div>
            <div v-for="state in states" :key="state" class="flex flex-col items-start gap-3">
              <UFormField :help="input.help" class="w-full">
                <AppInput
                  class="w-full max-w-60"
                  :size="size"
                  :color="state === 'error' ? 'error' : 'primary'"
                  :disabled="state === 'disabled'"
                  placeholder="Please enter your email address"
                  v-bind="input.props || {}"
                >
                  <template v-if="input.btn" #trailing>
                    <UButton color="neutral" variant="link" size="sm" icon="ag:arrow-right" />
                  </template>
                </AppInput>
              </UFormField>
            </div>
          </template>

          <template v-for="(select, index) in selectList" :key="index">
            <div class="text-xs font-medium capitalize">{{ select.label }}</div>
            <div v-for="state in states" :key="state" class="flex flex-col items-start gap-3">
              <UFormField :help="select.help" class="w-full">
                <USelect
                  class="w-full max-w-60"
                  :items="selectItems"
                  :size="size"
                  :color="state === 'error' ? 'error' : 'primary'"
                  :disabled="state === 'disabled'"
                  placeholder="Please enter your email address"
                  v-bind="select.props || {}"
                >
                  <template v-if="select.btn" #trailing>
                    <UButton color="neutral" variant="link" size="sm" icon="ag:arrow-right" />
                  </template>
                </USelect>
              </UFormField>
            </div>
          </template>
        </template>
      </div>
    </div>
  </section>
</template>
