import { useClipboard } from '@vueuse/core'

type CopyFallbackOptions = {
  promptMessage?: string
}

export function useCopyToClipboard() {
  const { copy, isSupported } = useClipboard()

  async function copyText(text: string, options: CopyFallbackOptions = {}) {
    if (!text) return false

    if (isSupported.value) {
      try {
        await copy(text)

        return true
      } catch {}
    }

    if (!import.meta.server) {
      const message = options.promptMessage ?? 'Скопируйте текст:'
      // prompt gives user a selectable field to copy from
      window.prompt(message, text)
    }

    return false
  }

  return {
    copyText,
    isSupported,
  }
}
