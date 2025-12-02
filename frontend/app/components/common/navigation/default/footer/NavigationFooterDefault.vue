<script setup lang="ts">
const navigation = useNavigationStore()
</script>

<template>
  <ul class="space-y-1 text-sm">
    <li v-for="(item, index) in navigation.footer" :key="index">
      <AppLink v-if="item.data" v-bind="item.data" class="text-gray-200 hover:text-white">
        {{ item.label }}
      </AppLink>
    </li>
  </ul>
</template>
