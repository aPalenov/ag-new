<script setup lang="ts">
const { page } = usePageData()

const tenant = computed(() => page.value?.app?.tenant)
const locations = computed(() => page.value?.settings?.contact.locations ?? [])
const locationLabel = computed(() => locations.value[0]?.label || null)
</script>

<template>
  <div class="flex h-screen grow flex-col" :class="tenant">
    <header class="sticky top-0 z-30 bg-white shadow-sm">
      <UContainer class="hidden flex-wrap items-center gap-6 py-3 md:flex md:flex-nowrap">
        <LogoDealerInfoPrimary />

        <!-- Right: Location + Call button -->
        <div class="ml-auto flex flex-1 items-center justify-end gap-4 sm:gap-6">
          <UPopover>
            <UButton v-if="locationLabel" type="button" size="xs" variant="link">
              <UIcon name="i-ag-map-marker" class="size-5 text-[#4B6FE8]" />
              <span class="hidden text-left text-sm md:block">{{ locationLabel }}</span>
              <UIcon name="i-heroicons-chevron-down-20-solid" class="size-4 text-gray-400" />
            </UButton>

            <template #content>
              <div class="w-72 p-2">
                <ul class="divide-y divide-gray-100">
                  <li v-for="(location, index) in locations" :key="index" class="py-2">
                    <div class="flex items-start gap-2">
                      <UIcon name="i-ag-map-marker" class="mt-0.5 size-5 text-[#4B6FE8]" />
                      <div class="text-sm leading-tight">
                        <div class="font-medium">{{ location.label }}</div>
                        <div class="text-gray-500">Ежедневно с 9:00 до 21:00</div>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </template>
          </UPopover>

          <UButton color="neutral" variant="outline" size="lg">ЗАКАЗАТЬ ЗВОНОК</UButton>
        </div>
      </UContainer>

      <div class="md:border-t md:border-gray-200">
        <NavigationMainDefault />
      </div>
    </header>

    <main class="flex grow flex-col"><slot /></main>

    <footer>
      <UContainer class="py-6">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus nulla tempore, voluptate
        repellendus consequatur non blanditiis ipsum veritatis minus asperiores et voluptas. Velit
        deserunt iure, odio libero sapiente provident nulla?

        <UIcon name="i-ag-map-marker" class="size-10" />
        <div class="mt-4 text-xs text-gray-500">Tenant: {{ tenant }}</div>
      </UContainer>
    </footer>
  </div>
</template>
