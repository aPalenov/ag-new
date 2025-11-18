<script setup lang="ts">
const theme = useCurrentTheme()
</script>

<template>
  <UApp>
    <NuxtLayout :class="theme">
      <NuxtPage />
    </NuxtLayout>
  </UApp>
</template>
