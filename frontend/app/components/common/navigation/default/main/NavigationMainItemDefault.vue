<script setup lang="ts">
import type { NavigationItemData } from '@@/types/generated'

const screen = useScreen()

const props = withDefaults(
  defineProps<{
    item: NavigationItemData
    level?: number
  }>(),
  { level: 0 },
)

const opened = ref(false)
// const linkComponent = computed(() => (props.item.data ? AppLink : 'span'))
const linkComponent = computed(() => (props.item.data ? 'a' : 'span'))
const linkProps = computed(() => props.item.data || {})

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
    class="relative border-white/10 px-4 md:border-none"
    :class="[
      { 'first:pt-4 last:pb-4 md:first:pt-2 md:last:pb-2': props.level, 'border-b': !props.level },
      props.item.classes,
    ]"
  >
    <component
      :is="linkComponent"
      v-bind="linkProps"
      tabindex="1"
      :class="[
        'group flex h-full items-center justify-between text-lg text-gray-900',
        !props.level ? 'cursor-pointer py-4 md:py-0' : 'hover:text-primary py-2',
      ]"
      @click="toggle"
      @keyup.enter="toggle"
    >
      <span
        class="flex h-full items-center tracking-wide transition-colors md:border-transparent"
        :class="{ 'md:border-y-4 md:border-b-white': !props.level && !props.item.data && opened }"
      >
        {{ props.item.label }}
      </span>
      <UIcon
        v-if="props.item.children.length"
        class="pl-2 text-xl leading-none"
        :name="props.level < 1 || !screen.gte.md ? 'ag:chevron-down' : 'ag:chevron-right'"
      />
    </component>

    <NavigationMainWrapperDefault
      v-if="props.item.children.length"
      :list="props.item.children"
      :level="props.level + 1"
      :open="opened"
    />
  </li>
</template>
