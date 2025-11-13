<script setup lang="ts">
export type NavLinkData = { type: 'page' | 'url'; href: string }
export interface NavigationItemData {
  label: string
  data: NavLinkData
  children?: NavigationItemData[]
}

const props = withDefaults(defineProps<{ item: NavigationItemData; depth?: number }>(), {
  depth: 0,
})

const route = useRoute()

const isExternal = (href: string) => /^(https?:)?\/\//.test(href)

const hasChildren = computed(() => Boolean(props.item.children?.length))
const isRootLevel = computed(() => props.depth === 0)
const isExternalLink = computed(() => isExternal(props.item.data.href))

const normalizedInternalHref = computed(() => {
  if (isExternalLink.value) {
    return null
  }

  const href = props.item.data.href || '/'
  if (!href.startsWith('/')) {
    return `/${href}`
  }

  const trimmed = href.replace(/\/+$/, '')
  return trimmed.length ? trimmed : '/'
})

const currentPath = computed(() => {
  const path = route.path || '/'
  const trimmed = path.replace(/\/+$/, '')
  return trimmed.length ? trimmed : '/'
})

const isActive = computed(() => {
  if (!normalizedInternalHref.value) {
    return false
  }

  return currentPath.value === normalizedInternalHref.value
})

const linkComponent = computed(() => (isExternalLink.value ? 'a' : 'NuxtLink'))

const linkBindings = computed(() => {
  if (isExternalLink.value) {
    return {
      href: props.item.data.href,
      target: '_blank',
      rel: 'noopener noreferrer',
    }
  }

  return {
    to: normalizedInternalHref.value ?? '/',
  }
})

const linkClass = computed(() => {
  const base = isRootLevel.value
    ? 'flex items-center gap-2 rounded-full px-4 py-2 text-xs font-semibold transition-colors duration-150 md:text-sm'
    : 'block rounded-md px-4 py-2 text-sm font-medium transition-colors duration-150'

  const inactive = isRootLevel.value
    ? 'text-[#1F273A] hover:bg-[#4B6FE8]/10 hover:text-[#1F273A]'
    : 'text-gray-700 hover:bg-[#eef2ff] hover:text-gray-900'

  const active = isRootLevel.value
    ? 'bg-[#4B6FE8] text-white shadow-sm'
    : 'bg-[#eef2ff] text-gray-900'

  return [base, isActive.value ? active : inactive].join(' ')
})

const dropdownClasses =
  'pointer-events-none absolute left-0 top-full z-20 hidden min-w-[220px] translate-y-3 flex-col rounded-xl border border-slate-100 bg-white py-3 shadow-xl transition-all duration-200 group-hover:pointer-events-auto group-hover:flex group-hover:translate-y-1'
</script>

<template>
  <li class="group relative" :class="{ 'shrink-0': isRootLevel }">
    <component :is="linkComponent" v-bind="linkBindings" :class="linkClass">
      <span>{{ item.label }}</span>
      <UIcon
        v-if="hasChildren && isRootLevel"
        name="i-heroicons-chevron-down-16-solid"
        class="size-4 text-current opacity-70 transition-transform duration-200 group-hover:rotate-180"
      />
    </component>

    <div v-if="hasChildren && isRootLevel" :class="dropdownClasses">
      <NavigationItemPrimary
        v-for="(child, i) in item.children"
        :key="i"
        :item="child"
        :depth="depth + 1"
      />
    </div>

    <ul v-else-if="hasChildren" class="mt-1 ml-4 space-y-1 border-l border-gray-200 pl-4">
      <NavigationItemPrimary
        v-for="(child, i) in item.children"
        :key="i"
        :item="child"
        :depth="depth + 1"
      />
    </ul>
  </li>
</template>
