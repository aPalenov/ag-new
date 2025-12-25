<script setup lang="ts">
import type { AccordionItem } from '@nuxt/ui'
import type { NavigationItemData } from '@@/types/generated'

type FooterAccordionItem = AccordionItem & { navItem: NavigationItemData }

const props = defineProps<{
  items: NavigationItemData[]
}>()

const footerNavMobile = computed<NavigationItemData[]>(() => {
  const result: NavigationItemData[] = []

  for (const item of props.items) {
    if (item.name === 'about' && item.children?.length) {
      const childrenItems = item.children as NavigationItemData[]

      const contactsChild = childrenItems.find((child) => child.name === 'contacts')
      const children = childrenItems.filter((child) => !(child.name === 'contacts'))

      result.push({ ...item, children })

      if (contactsChild?.data?.href) {
        result.push({
          name: 'contacts',
          label: contactsChild.label,
          data: contactsChild.data,
          children: [],
        })
      }

      continue
    }

    result.push(item)
  }

  return result
})

const footerMobileAccordionItems = computed<FooterAccordionItem[]>(() => {
  return footerNavMobile.value
    .filter((it) => Array.isArray(it.children) && it.children.length > 0)
    .map((it, index) => ({
      label: it.label,
      slot: `footer-${index}` as const,
      trailingIcon: 'i-heroicons-chevron-right-20-solid',
      navItem: it,
    }))
})

const footerMobileLinkItems = computed<NavigationItemData[]>(() => {
  return footerNavMobile.value.filter((it) => !it.children?.length && !!it.data?.href)
})

const footerMobileActive = ref<string[]>([])

function isModelsSection(item: NavigationItemData) {
  return item.name === 'models'
}
</script>

<template>
  <!-- Mobile: accordion -->
  <div class="py-6 md:hidden">
    <UAccordion
      v-model="footerMobileActive"
      :items="footerMobileAccordionItems"
      type="multiple"
      :ui="{
        root: 'w-full',
        item: 'border-none',
        trigger: 'py-4 gap-4 cursor-pointer',
        label: 'text-lg leading-head text-gray-900',
        trailingIcon: 'size-5 text-gray-600 transition-transform group-data-[state=open]:rotate-90',
        body: 'pb-4',
      }"
    >
      <template
        v-for="acc in footerMobileAccordionItems"
        :key="acc.slot"
        #[acc.slot]="slotProps: { item: FooterAccordionItem }"
      >
        <NavigationFooterLinksDefault
          :items="slotProps.item.navItem.children"
          :models="isModelsSection(slotProps.item.navItem)"
          class="space-y-3"
        />
      </template>
    </UAccordion>

    <div v-for="(item, index) in footerMobileLinkItems" :key="index" class="py-4">
      <NuxtLink :to="item.data!.href" class="leading-head text-lg text-gray-900">
        {{ item.label }}
      </NuxtLink>
    </div>
  </div>

  <!-- Desktop: columns -->
  <div class="hidden grid-cols-2 gap-6 py-6 md:grid md:grid-cols-4">
    <div v-for="(item, index) in props.items" :key="index">
      <h3 v-if="!isModelsSection(item)" class="mb-3 font-semibold text-gray-900">
        {{ item.label }}
      </h3>
      <NavigationFooterLinksDefault
        v-if="item.children && item.children.length"
        :items="item.children"
        :models="isModelsSection(item)"
        class="space-y-2"
      />
      <NuxtLink
        v-else-if="item.data?.href"
        :to="item.data.href"
        class="text-sm text-gray-600 hover:text-blue-600"
      >
        {{ item.label }}
      </NuxtLink>
    </div>
  </div>
</template>
