<script setup lang="ts">
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
</script>

<template>
  <li
    ref="target"
    class="relative px-4"
    :class="[
      { 'first:pt-4 last:pb-4 md:first:pt-2 md:last:pb-2': props.level },
      props.item.classes,
    ]"
  >
    <component
      :is="linkComponent"
      v-bind="linkProps"
      tabindex="1"
      class="group flex h-full items-center justify-between text-[15px] text-gray-900"
      :class="props.level ? 'hover:text-brand-accent py-2' : 'cursor-pointer py-4'"
      @click="toggle"
      @keyup.enter="toggle"
    >
      <span class="flex h-full items-center tracking-wide transition-colors">
        {{ props.item.label }}
      </span>
      <UIcon
        v-if="templateComponent || props.item.children.length"
        class="ml-2 text-xl leading-none"
        :name="props.level < 1 || !screen.gte.md ? 'ag:chevron-down' : 'ag:chevron-right'"
      />
    </component>

    <NavigationMainWrapperDefault
      v-if="templateComponent || props.item.children.length"
      :list="props.item.children"
      :level="props.level + 1"
      :open="opened"
    >
      <component
        v-if="templateComponent"
        :is="templateComponent"
        v-bind="props.item.template!.props!"
        class="md:absolute md:z-10 md:bg-[#f5f5f5]"
        v-show="opened"
      />
    </NavigationMainWrapperDefault>
  </li>
</template>
