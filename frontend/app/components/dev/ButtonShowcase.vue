<script setup lang="ts">
import type { SelectMenuItem } from '@nuxt/ui'
import { brands } from '../../../tailwind.branding'

const appConfig = useAppConfig()
const buttonConfig = appConfig.ui?.button

// Derive sizes from app config
const sizes = Object.keys(buttonConfig?.variants?.size || {})

// Derive variants from app config
const result = buttonConfig?.compoundVariants.reduce<Record<string, string[]>>(
  (acc, { variant, color }) => {
    if (!variant || !color) {
      return acc
    }

    ;(acc[variant] ??= []).push(color)
    return acc
  },
  {},
)

// Showcase states (not in config; keep explicit)
const states = [
  { key: 'default', disabled: false },
  { key: 'disabled', disabled: true },
]

const brandItems: SelectMenuItem[] = Object.keys(brands).map((brand) => ({
  label: brand,
}))

const brandValue = ref<SelectMenuItem>(brandItems[0] as SelectMenuItem)

const label = ref('ПОДРОБНЕЕ')
</script>

<template>
  <USelectMenu v-model="brandValue" :items="brandItems" class="w-48" />
  <UInput v-model="label" placeholder="Enter your label" label="Label" />
  <section
    class="grid grid-cols-[repeat(auto-fill,minmax(600px,1fr))] gap-5 space-y-10"
    :class="brandValue.label"
  >
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
            :key="state"
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
