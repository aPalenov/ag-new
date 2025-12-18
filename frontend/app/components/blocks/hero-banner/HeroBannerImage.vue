<script setup lang="ts">
defineOptions({ inheritAttrs: false })

const props = defineProps<{
  srcXl: string
  srcXs: string
}>()

const attrs = useAttrs()
</script>

<template>
  <picture>
    <source :srcset="props.srcXl" media="(min-width: 768px)" />
    <AppImg :src="props.srcXs" v-bind="attrs" />
  </picture>
</template>
