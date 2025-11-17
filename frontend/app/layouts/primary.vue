<script setup lang="ts">
import type { NavigationItemData } from '@/components/navigation/primary/NavigationItemPrimary.vue'

const { page } = usePageData()

type NavigationSections = {
  primary?: NavigationItemData[] | { items?: NavigationItemData[] }
}

const fallbackPrimaryNavigation: NavigationItemData[] = [
  { label: 'Модельный ряд', data: { type: 'page', href: '/models' } },
  { label: 'Авто в наличии', data: { type: 'page', href: '/inventory' } },
  { label: 'Сервис', data: { type: 'page', href: '/service' } },
  { label: 'Спецпредложения', data: { type: 'page', href: '/offers' } },
  { label: 'Trade-in', data: { type: 'page', href: '/trade-in' } },
  { label: 'Контакты', data: { type: 'page', href: '/contacts' } },
]

const tenant = computed(() => {
  const app = page.value?.props?.app
  return app?.tenant ?? 'main'
})

const navigation = computed<NavigationSections>(() => {
  const raw = page.value?.props?.navigation as NavigationSections | undefined
  return raw ?? {}
})

function normalizeNavigationItems(
  value: NavigationSections['primary'] | undefined,
): NavigationItemData[] {
  if (Array.isArray(value)) {
    return value as NavigationItemData[]
  }

  if (value && typeof value === 'object') {
    const maybeItems = (value as { items?: unknown }).items
    if (Array.isArray(maybeItems)) {
      return maybeItems as NavigationItemData[]
    }
  }

  return []
}

const primaryNavigationItems = computed<NavigationItemData[]>(() => {
  const items = normalizeNavigationItems(navigation.value.primary)
  return items.length ? items : fallbackPrimaryNavigation
})
</script>

<template>
  <div>
    <header class="bg-white shadow-sm">
      <UContainer class="flex flex-wrap items-center gap-6 py-3 md:flex-nowrap">
        <!-- Left: Logo + dealership info -->
        <NuxtLink to="/" class="flex items-center gap-4 no-underline">
          <UIcon name="i-ag-logo-tenet" class="w-[190px] text-[#3e3a39]" />
          <div class="hidden text-[15px] leading-tight text-[#333] sm:block">
            <div class="font-bold">АвтоГЕРМЕС TENET</div>
            <div class="font-normal">официальный дилер</div>
          </div>
        </NuxtLink>

        <!-- Right: Location + Call button -->
        <div class="ml-auto flex flex-1 items-center justify-end gap-4 sm:gap-6">
          <Button type="button" size="xs">
            <UIcon name="i-ag-map-marker" class="size-5 text-[#4B6FE8]" />
            <span class="hidden text-left text-sm md:block">
              г. Москва, Дмитровское ш., д. 161А
            </span>
            <UIcon name="i-heroicons-chevron-down-20-solid" class="size-4 text-gray-400" />
          </Button>

          <UButton
            color="neutral"
            variant="solid"
            size="lg"
            class="rounded-xl bg-neutral-900 px-4 py-2 text-sm font-semibold tracking-[0.12em] text-white uppercase hover:bg-neutral-800 md:px-6 md:py-2.5"
          >
            ЗАКАЗАТЬ ЗВОНОК
          </UButton>
        </div>
      </UContainer>

      <div class="border-b-2 border-[#4B6FE8] bg-[#eef2ff]">
        <UContainer class="flex items-center justify-between gap-4 overflow-x-auto py-3">
          <!-- <NavigationBarPrimary :items="primaryNavigationItems" /> -->
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
        {{ primaryNavigationItems }}
        <div class="mt-4 text-xs text-gray-500">Tenant: {{ tenant }}</div>
      </UContainer>
    </footer>
  </div>
</template>
