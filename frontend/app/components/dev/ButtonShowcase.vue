<script setup lang="ts">
const appConfig = useAppConfig()
const buttonConfig = appConfig.ui?.button

const button = tv({
  base: 'text-white py-1 px-3 font-semibold rounded-full active:opacity-80',
  variants: {
    color: {
      primary: 'bg-blue-500 hover:bg-blue-700',
      secondary: 'bg-purple-500 hover:bg-purple-700',
      success: 'bg-green-500 hover:bg-green-700',
    },
    size: {
      sm: 'py-1 px-3 text-xs',
      md: 'py-1.5 px-4 text-sm',
      lg: 'py-2 px-6 text-md',
    },
  },
})

// Derive sizes from app config
const sizes = Object.keys(buttonConfig?.variants?.size || {}).map((key) => ({
  label: `Size=${key.toUpperCase()}`,
  value: key,
}))

// Derive colors from app config
const colors = Object.keys(buttonConfig?.variants?.color || {})

// Derive variants from app config with human labels
const variantLabelMap: Record<string, string> = {
  solid: 'view=fill',
  outline: 'view=stroke',
  link: 'view=link',
}
const variants = Object.keys(buttonConfig?.variants?.variant || {}).map((key) => ({
  label: variantLabelMap[key] || key,
  value: key,
}))

// Showcase states (not in config; keep explicit)
const states = [
  { label: 'State=default', key: 'default', disabled: false },
  { label: 'State=disabled', key: 'disabled', disabled: true },
]

const label = 'ПОДРОБНЕЕ'
</script>

<template>
  <div class="tenet grid grid-cols-[repeat(auto-fill,minmax(600px,1fr))] gap-5 space-y-10">
    <!-- Per-size sections -->
    <section
      v-for="size in sizes"
      :key="size.value"
      class="h-full rounded-lg border border-dashed p-5"
    >
      <div class="mb-4 text-sm font-semibold">{{ size.label }}</div>

      <!-- Grid header: states -->
      <div class="grid grid-cols-[220px_repeat(3_minmax(0_1fr))] items-center gap-3">
        <div />
        <div v-for="st in states" :key="st.key" class="text-xs font-medium text-gray-500">
          {{ st.label }}
        </div>

        <!-- Variants -->
        <template v-for="variant in variants" :key="variant.value">
          <div class="col-span-3 mt-4 text-xs text-gray-400 italic">{{ variant.label }}</div>

          <!-- One row per color -->
          <template v-for="color in colors" :key="variant.value + color">
            <div class="text-sm text-gray-700 capitalize">Type={{ color }}</div>

            <!-- A button per state column -->
            <div
              v-for="st in states"
              :key="variant.value + color + st.key"
              class="flex flex-col items-start gap-3"
            >
              <UButton
                :size="size.value"
                :color="color"
                :variant="variant.value"
                :disabled="st.disabled"
                trailing-icon="ag:arrow-right"
              >
                {{ label }}
              </UButton>
              <UButton
                :size="size.value"
                :color="color"
                :variant="variant.value"
                :disabled="st.disabled"
                trailing-icon="ag:arrow-left"
              >
                {{ label }}
              </UButton>
              <UButton
                :size="size.value"
                :color="color"
                :variant="variant.value"
                :disabled="st.disabled"
              >
                {{ label }}
              </UButton>
              <div class="flex gap-3">
                <UButton
                  :size="size.value"
                  :color="color"
                  :variant="variant.value"
                  :disabled="st.disabled"
                  trailing-icon="ag:arrow-left"
                />
                <UButton
                  :size="size.value"
                  :color="color"
                  :variant="variant.value"
                  :disabled="st.disabled"
                  icon="ag:arrow-right"
                />
              </div>
            </div>
          </template>
        </template>
      </div>
    </section>
  </div>
</template>
