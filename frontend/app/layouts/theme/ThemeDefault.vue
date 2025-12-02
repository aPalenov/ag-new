<script setup lang="ts">
const { page } = usePageData()

const tenant = computed(() => page.value?.props?.app.tenant)
</script>

<template>
  <div :class="tenant">
    <header class="bg-white shadow-sm">
      <UContainer class="flex flex-wrap items-center gap-6 py-3 md:flex-nowrap">
        <!-- Left: Logo + dealership info -->
        <NuxtLink to="/" class="flex items-center gap-4 no-underline">
          <UIcon :name="`ag-logo:${tenant}`" class="w-[190px] text-[#3e3a39]" />
          <div class="hidden text-[15px] leading-tight text-[#333] sm:block">
            <div class="font-bold">
              АвтоГЕРМЕС
              <span class="uppercase">{{ tenant }}</span>
            </div>
            <div class="font-normal">официальный дилер</div>
          </div>
        </NuxtLink>

        <!-- Right: Location + Call button -->
        <div class="ml-auto flex flex-1 items-center justify-end gap-4 sm:gap-6">
          <UButton type="button" size="xs">
            <UIcon name="i-ag-map-marker" class="size-5 text-[#4B6FE8]" />
            <span class="hidden text-left text-sm md:block">
              г. Москва, Дмитровское ш., д. 161А
            </span>
            <UIcon name="i-heroicons-chevron-down-20-solid" class="size-4 text-gray-400" />
          </UButton>

          <UButton color="neutral" variant="outline" size="lg">ЗАКАЗАТЬ ЗВОНОК</UButton>
        </div>
      </UContainer>

      <div class="border-b-2 border-[#4B6FE8] bg-[#eef2ff]">
        <UContainer class="flex items-center justify-between gap-4 overflow-x-auto py-3">
          <NavigationMainDefault />
        </UContainer>
      </div>
    </header>

    <main>
      <UContainer>
        <slot />
      </UContainer>
    </main>

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
