<script setup lang="ts">
const theme = useCurrentTheme()
</script>

<template>
  <UApp>
    <NuxtLayout :class="theme" class="font-roboto">
      <NuxtPage />
    </NuxtLayout>
  </UApp>
</template>
