<script setup lang="ts">
import { tv } from 'tailwind-variants'
import type { NavigationItemData } from '@@/types/generated'
import Link from '@/components/common/links/Link.vue'
import NavigationCarSelectionDefaultTemplate from '@/components/common/navigation/templates/NavigationCarSelectionDefaultTemplate.vue'

const screen = useScreen()

const props = withDefaults(
  defineProps<{
    item: NavigationItemData
    level?: number
  }>(),
  { level: 0 },
)

const templates = {
  NavigationCarSelectionDefaultTemplate,
}

const liTV = tv({
  base: 'relative px-[22px]',
  variants: {
    root: {
      true: 'md:first:pl-0',
      false: '',
    },
    nested: {
      true: 'first:pt-4 last:pb-4 md:first:pt-2 md:last:pb-2',
      false: '',
    },
  },
})

const linkTV = tv({
  base: 'group flex h-full items-center justify-between text-[15px] text-gray-900',
  variants: {
    nested: {
      true: 'hover:text-brand-accent py-2',
      false: 'cursor-pointer py-[15px]',
    },
  },
})

const opened = ref(false)
const linkComponent = computed(() => (props.item.data ? Link : 'span'))
const linkProps = computed(() => props.item.data || {})

const templateComponent = computed(() => {
  const name = props.item.template?.name

  return name ? templates[name as keyof typeof templates] : null
})

function toggle() {
  if (!props.item.data) {
    opened.value = !opened.value
  }
}
const target = useTemplateRef<HTMLLIElement>('target')
onClickOutside(target, () => {
  opened.value = false
})

const iconArrow = computed(() => {
  return opened.value ? 'ag:chevron-up' : 'ag:chevron-down'
})
</script>

<template>
  <li
    ref="target"
    :class="
      liTV({
        root: props.level === 0,
        nested: !!props.level,
        class: props.item.classes,
      })
    "
  >
    <component
      :is="linkComponent"
      v-bind="linkProps"
      tabindex="1"
      :class="linkTV({ nested: !!props.level })"
      @click="toggle"
      @keyup.enter="toggle"
    >
      <span class="flex h-full items-center tracking-wide transition-colors select-none">
        {{ props.item.label }}
      </span>
      <UIcon
        v-if="templateComponent || props.item.children.length"
        class="ml-2 text-xl leading-none"
        :name="props.level < 1 || !screen.gte.md ? iconArrow : 'ag:chevron-right'"
      />
    </component>

    <NavigationMainWrapperDefault
      v-if="templateComponent || props.item.children.length"
      :list="props.item.children"
      :level="props.level + 1"
      :open="!templateComponent && opened"
    >
      <KeepAlive v-if="templateComponent">
        <component
          :is="templateComponent"
          v-if="opened"
          v-bind="props.item.template!.props!"
          class="md:absolute md:z-10 md:bg-[#f5f5f5]"
        />
      </KeepAlive>
    </NavigationMainWrapperDefault>
  </li>
</template>
