import { defineStore } from 'pinia'
import dayjs from 'dayjs'
import { useApiFetch } from '@/composables/useApiFetch'

const TYPES = {
  static: 'static',
  dynamic: 'dynamic',
  unreserved: 'unreserved',
} as const

export type PhoneType = (typeof TYPES)[keyof typeof TYPES]

const mapType = (t: PhoneType) => (t && TYPES[t]) || TYPES.static

export const useAdvPhoneStore = defineStore('advPhone', {
  state: () => ({
    isLoading: false as boolean,
    type: null as PhoneType | null,
    staticPhone: null as string | null,
    dynamicPhone: null as string | null,
    dynamicPhoneShow: false as boolean,
  }),
  getters: {
    isDynamic: (state) => state.type !== TYPES.static,
    isDynamicPhoneShow: (state) => state.type === TYPES.dynamic && state.dynamicPhoneShow,
    phone(state): string | null {
      return (this as any).isDynamic ? state.dynamicPhone : state.staticPhone
    },
    phoneFormatter(): string | undefined {
      const phone = (this as any).phone as string | null
      return phone ? phone.replace(/(...)(..)(..)/, '+7 (495) $1-$2-$3') : undefined
    },
    phoneLink(): string | undefined {
      if (
        !this.isLoading &&
        (this.isDynamicPhoneShow || this.type === TYPES.static) &&
        this.phone
      ) {
        return `tel:+7495${this.phone}`
      }
      return undefined
    },
  },
  actions: {
    async fetch() {
      if (this.isLoading) {
        return
      }

      this.isLoading = true

      // Yandex Metrika
      // ymReachGoal('show_phone')

      try {
        const { data, error } = await useApiFetch<{
          type: PhoneType
          dynamicPhone?: string | null
          dynamicHideAfter?: number
        }>('/api/dynamic-phone/', { method: 'GET' })

        if (error?.value) throw error.value
        const payload = data?.value
        if (!payload) throw new Error('Empty response')

        this.type = mapType(payload.type)

        await this.setDynamicPhone({
          dynamicPhone: payload.dynamicPhone ?? null,
          dynamicHideAfter: Number(payload.dynamicHideAfter) || 0,
        })
      } finally {
        this.isLoading = false
      }
    },

    setInit(payload?: {
      type?: PhoneType
      staticPhone?: string
      dynamicPhone?: string | null
      dynamicHideAfter?: number
    }) {
      let type: PhoneType = TYPES.static
      let staticPhone: string = '7377272'
      let dynamicPhone: string | null = null
      let dynamicHideAfter = 0

      if (typeof window !== 'undefined') {
        const agPhone = window.ag_phone
        type = (agPhone?.type as PhoneType) || type
        staticPhone = agPhone?.staticPhone?.replace('7495', '') || staticPhone
        dynamicPhone = agPhone?.dynamicPhone?.replace('7495', '') || dynamicPhone
        dynamicHideAfter = agPhone?.dynamicHideAfter || dynamicHideAfter
      } else if (payload?.type && payload?.staticPhone) {
        type = payload.type
        staticPhone = payload.staticPhone
        dynamicPhone = payload.dynamicPhone ?? null
        dynamicHideAfter = payload.dynamicHideAfter ?? 0
      }

      this.type = mapType(type)
      this.staticPhone = staticPhone
      this.setDynamicPhone({ dynamicPhone, dynamicHideAfter })
    },

    setDynamicPhone({
      dynamicPhone,
      dynamicHideAfter,
    }: {
      dynamicPhone: string | null
      dynamicHideAfter: number
    }) {
      this.dynamicPhone = dynamicPhone

      if (Number.isInteger(dynamicHideAfter) && dynamicHideAfter > 0) {
        this.dynamicPhoneShow = true
        const hideAfter = dayjs().add(dynamicHideAfter, 'second')
        const interval = setInterval(() => {
          if (dayjs().isAfter(hideAfter)) {
            clearInterval(interval)
            this.dynamicPhoneShow = false
          }
        }, 10_000)
      } else {
        this.dynamicPhoneShow = false
      }
    },
  },
})
