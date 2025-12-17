<script setup lang="ts">
const showed = defineModel<boolean>({ required: true })

const lineBaseClass =
  'absolute block h-0.5 w-8 transform bg-current transition duration-500 ease-in-out'

function toggle() {
  showed.value = !showed.value
}
</script>

<template>
  <UButton
    class="relative h-10 w-10 border-none! p-1 text-gray-700"
    :aria-expanded="showed"
    variant="link"
    @click="toggle"
  >
    <span
      aria-hidden="true"
      :class="[lineBaseClass, { 'rotate-45': showed, '-translate-y-2.5': !showed }]"
    />
    <span aria-hidden="true" :class="[lineBaseClass, { 'opacity-0': showed }]" />
    <span
      aria-hidden="true"
      :class="[lineBaseClass, { '-rotate-45': showed, 'translate-y-2.5': !showed }]"
    />
  </UButton>
</template>
