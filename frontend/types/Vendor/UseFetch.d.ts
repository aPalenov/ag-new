import type { UseFetchOptions } from '#app'
import type { NitroFetchRequest } from 'nitropack'
import type { KeyOfRes } from 'nuxt/dist/app/composables/asyncData'

export {}

declare global {
  namespace UseFetch {
    type options<T> =
      | UseFetchOptions<
          T extends void ? unknown : T,
          (res: T extends void ? unknown : T) => T extends void ? unknown : T,
          KeyOfRes<(res: T extends void ? unknown : T) => T extends void ? unknown : T>
        >
      | undefined

    type request = NitroFetchRequest
  }
}
