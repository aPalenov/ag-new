<script setup lang="ts">
import type { SelectMenuItem } from '@nuxt/ui'
import { brands } from '../../../tailwind.branding'

const appConfig = useAppConfig()
const inputConfig = appConfig.ui?.input

// Derive sizes from app config
const sizes = Object.keys(inputConfig?.variants?.size || {})

// Showcase states (not in config; keep explicit)
const states = ['default', 'hover', 'focus', 'error', 'disabled']
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

const variants = [
  {
    label: 'input',
  },
  {
    label: 'input + icon',
    props: {
      icon: 'ag:search',
    },
  },
  {
    label: 'input + trailing-icon',
    props: {
      trailingIcon: 'ag:arrow-right',
    },
  },
]

const brandValue = ref<SelectMenuItem>(brandItems[0] as SelectMenuItem)

const label = ref('ПОДРОБНЕЕ')
</script>

<template>
  <USelectMenu v-model="brandValue" :items="brandItems" class="w-48" />
  <UInput v-model="label" placeholder="Enter your label" label="Label" />
  <section
    class="grid grid-cols-[repeat(auto-fill,minmax(1200px,1fr))] gap-5 space-y-10"
    :class="brandValue.label"
  >
    <!-- Per-size sections -->
    <div v-for="size in sizes" :key="size" class="h-full rounded-lg border border-dashed p-5">
      <div class="mb-4 text-sm font-semibold">
        size:
        <span class="text-xl uppercase">{{ size }}</span>
      </div>

      <!-- Grid header: states -->
      <div class="grid grid-cols-[220px_repeat(5,minmax(0,1fr))] items-start gap-3">
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

          <template v-for="(variant, index) in variants" :key="index">
            <div class="text-xs font-medium capitalize">{{ variant.label }}</div>
            <div v-for="state in states" :key="state" class="flex flex-col items-start gap-3">
              <Input
                :size="size"
                :disabled="state === 'disabled'"
                placeholder="АПвыва ыва ываываываыв"
                label="Email address"
                v-bind="variant.props || {}"
              />
            </div>
          </template>
        </template>
      </div>
    </div>
  </section>
</template>
