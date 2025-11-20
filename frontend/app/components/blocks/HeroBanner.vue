<script setup lang="ts">
const props = defineProps<{
  title: string
  subtitle?: string
  cta?: string
}>()
</script>

<template>
  <section class="py-10 text-center">
    <h1 class="text-3xl font-bold">{{ props.title }}</h1>
    <p v-if="props.subtitle" class="mt-2 text-gray-600">{{ props.subtitle }}</p>

    <div>
      <UButton
        v-if="props.cta"
        color="secondary"
        trailing-icon="i-ag-arrow-right"
        class="bg-brand-accent mt-4"
      >
        {{ props.cta }}
      </UButton>
      <div class="bg-brand-accent">tenet</div>
      <div class="bg-brand-accent/50">tenet</div>
    </div>
    <div class="lada">
      <UButton
        v-if="props.cta"
        color="secondary"
        trailing-icon="i-ag-arrow-right"
        class="bg-brand-accent mt-4"
      >
        {{ props.cta }}
      </UButton>
      <div class="bg-brand-accent">lada</div>
      <div class="bg-brand-accent/50">lada</div>
    </div>
    <UButton v-if="props.cta" color="primary" class="mt-4">{{ props.cta }}</UButton>
  </section>
  <!-- <ButtonShowcase /> -->
  <FieldShowcase />
</template>
