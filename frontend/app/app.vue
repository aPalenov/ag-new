<script setup lang="ts">
const theme = useCurrentTheme()
</script>

<template>
  <UApp>
    <NuxtLayout :class="`layout-${theme}`">
      <NuxtPage />
    </NuxtLayout>
  </UApp>
</template>
