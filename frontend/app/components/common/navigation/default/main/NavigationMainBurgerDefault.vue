<script setup lang="ts">
const props = withDefaults(
  defineProps<{
    showedValue?: boolean
  }>(),
  {
    showedValue: false,
  },
)
const emit = defineEmits(['update:showedValue'])

const showed = useVModel(props, 'showedValue', emit)

function toggle() {
  showed.value = !showed.value
}
</script>

<template>
  <button
    class="relative mr-2 h-[40px] w-[40px] border-none! p-1 text-gray-700"
    :aria-expanded="showed"
    @click="toggle"
  >
    <span
      class="absolute block h-0.5 w-8 transform bg-current transition duration-500 ease-in-out"
      aria-hidden="true"
      :class="{ 'rotate-45': showed, '-translate-y-2.5': !showed }"
    />
    <span
      class="absolute block h-0.5 w-8 transform bg-current transition duration-500 ease-in-out"
      aria-hidden="true"
      :class="{ 'opacity-0': showed }"
    />
    <span
      class="absolute block h-0.5 w-8 transform bg-current transition duration-500 ease-in-out"
      aria-hidden="true"
      :class="{ '-rotate-45': showed, 'translate-y-2.5': !showed }"
    />
  </button>
</template>
