<script setup lang="ts">
import type { AdvertisingMarkingData } from '@@/types/generated'
import { tv } from 'tailwind-variants'

const props = defineProps<{
  advertising: AdvertisingMarkingData
  ui?: {
    button?: string
  }
}>()

const advertisingPopoverTV = tv({
  slots: {
    button: 'px-2 py-1 bg-[#bfbfbf]/60 normal-case rounded-sm text-[#333] text-[10px]/2',
  },
})

const styles = advertisingPopoverTV()

const { copyText } = useCopyToClipboard()

async function copyAdUrl(close?: () => void) {
  const url = props.advertising.url
  if (!url) return

  await copyText(url, { promptMessage: 'Скопируйте ссылку:' })
  close?.()
}
</script>

<template>
  <UPopover v-if="advertising" mode="click" arrow>
    <UButton
      type="button"
      size="xs"
      variant="link"
      :class="styles.button({ class: props.ui?.button })"
    >
      Реклама
    </UButton>

    <template #content="{ close }">
      <div class="w-72 p-3">
        <div class="flex items-start justify-between gap-3">
          <div class="text-xs text-gray-500">Рекламодатель</div>
          <UButton
            type="button"
            size="xs"
            color="neutral"
            variant="ghost"
            icon="i-heroicons-x-mark-20-solid"
            @click="close"
          />
        </div>

        <div v-if="advertising.label" class="mt-1 text-sm">
          {{ advertising.label }}
        </div>

        <div class="mt-1 text-xs text-gray-500">ERID: {{ advertising.erid }}</div>

        <button
          v-if="advertising.url"
          type="button"
          class="mt-2 text-sm text-blue-600 underline"
          @click="copyAdUrl(close)"
        >
          Скопировать ссылку
        </button>
      </div>
    </template>
  </UPopover>
</template>
