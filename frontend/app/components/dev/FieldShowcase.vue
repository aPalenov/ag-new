<script setup lang="ts">
import type { SelectMenuItem } from '@nuxt/ui'
import { brands } from '../../../tailwind.branding'

const appConfig = useAppConfig()
const inputConfig = appConfig.ui?.input

// Derive sizes from app config
const sizes = Object.keys(inputConfig?.variants?.size || {})

// Showcase states (not in config; keep explicit)
const states = ['default', 'error', 'disabled']
// Derive variants from app config
const result = inputConfig?.compoundVariants.reduce<Record<string, string[]>>(
  (acc, { variant, color }) => {
    if (!variant || !color) {
      return acc
    }

    ;(acc[variant] ??= []).push(color)
    return acc
  },
  {},
)

const brandItems: SelectMenuItem[] = Object.keys(brands).map((brand) => ({
  label: brand,
}))

const types = [
  {
    label: 'label',
    props: {
      label: 'Email address',
    },
  },
  {
    label: '',
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
      trailingIcon: 'ag:arrow-right',
      label: 'Email address',
    },
  },
  {
    label: 'label + icon + trailing-icon',
    props: {
      icon: 'ag:search',
      trailingIcon: 'ag:arrow-right',
      label: 'Email address',
    },
  },
]

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
      <div class="grid grid-cols-[220px_repeat(3,minmax(0,1fr))] items-start gap-3">
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

          <template v-for="(type, index) in types" :key="index">
            <div class="text-xs font-medium capitalize">{{ type.label }}</div>
            <div v-for="state in states" :key="state" class="flex flex-col items-start gap-3">
              <AppInput
                :size="size"
                :disabled="state === 'disabled'"
                placeholder="Please enter your email address"
                v-bind="type.props || {}"
              />
            </div>
          </template>
        </template>
      </div>
    </div>
  </section>
</template>
