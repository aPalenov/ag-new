<script setup lang="ts">
import type { SelectMenuItem } from '@nuxt/ui'
import { brands } from '../../../tailwind.branding'

const appConfig = useAppConfig()
const buttonConfig = appConfig.ui?.button

// Derive keys from typed app config (augmented in types/app-config.d.ts)
type SizeKey = keyof typeof buttonConfig.variants.size
type VariantKey = keyof typeof buttonConfig.variants.variant
type ColorKey = keyof typeof buttonConfig.variants.color

const sizes = Object.keys(buttonConfig.variants.size) as SizeKey[]

// Build map variant -> colors from compoundVariants entries that have both
const result = buttonConfig.compoundVariants.reduce<Record<VariantKey, ColorKey[]>>(
  (acc, cv) => {
    if ('variant' in cv && 'color' in cv && cv.variant && cv.color) {
      ;(acc[cv.variant] ??= []).push(cv.color)
    }
    return acc
  },
  {} as Record<VariantKey, ColorKey[]>,
)

// Showcase states (not in config; keep explicit)
const states = [
  { key: 'default', disabled: false },
  { key: 'disabled', disabled: true },
]

const brandItems: SelectMenuItem[] = Object.keys(brands).map((brand) => ({
  label: brand,
}))
// Allow null and guard in template
const brandValue = ref<SelectMenuItem | null>(brandItems[0] ?? null)

const label = ref('ПОДРОБНЕЕ')
</script>

<template>
  <USelectMenu v-model="brandValue" :items="brandItems" class="w-48" />
  <UInput v-model="label" placeholder="Enter your label" label="Label" />
  <section class="grid grid-cols-[repeat(auto-fill,minmax(600px,1fr))] gap-5 space-y-10">
    <!-- Per-size sections -->
    <div v-for="size in sizes" :key="size" class="h-full rounded-lg border border-dashed p-5">
      <div class="mb-4 text-sm font-semibold">
        size:
        <span class="text-xl uppercase">{{ size }}</span>
      </div>

      <!-- Grid header: states -->
      <div class="grid grid-cols-[220px_repeat(2,minmax(0,1fr))] items-start gap-3">
        <template v-for="(colors, variant) in result" :key="variant">
          <div class="text-md my-4 self-end text-sm font-semibold text-gray-400">
            variant:
            <span class="text-default text-xl font-semibold capitalize">
              {{ variant }}
            </span>
          </div>
          <div
            v-for="state in states"
            :key="state.key"
            class="self-end text-xs font-medium text-gray-400"
          >
            state:
            <span class="text-default text-md font-semibold capitalize">{{ state.key }}</span>
          </div>

          <!-- One row per color -->
          <template v-for="color in colors" :key="`${variant}${color}`">
            <div class="text-xs font-medium text-gray-400">
              color:
              <span class="text-default text-lg font-semibold capitalize">{{ color }}</span>
            </div>

            <!-- A button per state column -->
            <div
              v-for="state in states"
              :key="`${variant}${color}${state.key}`"
              class="flex flex-col items-start gap-3"
            >
              <UButton
                :size="size"
                :color="color"
                :variant="variant"
                :disabled="state.disabled"
                trailing-icon="ag:arrow-right"
              >
                {{ label }}
              </UButton>
              <UButton
                :size="size"
                :color="color"
                :variant="variant"
                :disabled="state.disabled"
                icon="ag:arrow-left"
              >
                {{ label }}
              </UButton>
              <UButton
                :size="size"
                :color="color"
                :variant="variant"
                :disabled="state.disabled"
                icon="ag:arrow-left"
                trailing-icon="ag:arrow-right"
              >
                {{ label }}
              </UButton>
              <UButton :size="size" :color="color" :variant="variant" :disabled="state.disabled">
                {{ label }}
              </UButton>
              <div class="flex gap-3">
                <UButton
                  :size="size"
                  :color="color"
                  :variant="variant"
                  :disabled="state.disabled"
                  trailing-icon="ag:arrow-left"
                />
                <UButton
                  :size="size"
                  :color="color"
                  :variant="variant"
                  :disabled="state.disabled"
                  icon="ag:arrow-right"
                />
              </div>
            </div>
          </template>
        </template>
      </div>
    </div>
  </section>
</template>
