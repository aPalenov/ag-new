<script setup lang="ts">
import { NuxtLink } from '#components'
import { LinkTypeEnum, type LinkData } from '@@/types/generated'

const props = defineProps<LinkData>()

const component = computed(
  () =>
    ({
      [LinkTypeEnum.EXTERNAL_LINK]: 'a',
      [LinkTypeEnum.INTERNAL_LINK]: NuxtLink,
      [LinkTypeEnum.PAGE]: NuxtLink,
    })[props.type || LinkTypeEnum.INTERNAL_LINK],
)
</script>

<template>
  <component :is="component" :href="props.href" :target="target">
    <slot></slot>
  </component>
</template>
