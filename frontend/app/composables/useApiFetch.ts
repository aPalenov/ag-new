import type { UseFetchOptions } from 'nuxt/app'

export function useApiFetch<T>(request: string | (() => string), opts?: UseFetchOptions<T>) {
  const config = useRuntimeConfig() as unknown as {
    apiBase: string
    public: { apiBase: string }
  }

  // Prefer caller-provided baseURL, otherwise pick from runtime config
  const baseURL =
    (opts?.baseURL as string | undefined) ??
    (import.meta.server ? config.apiBase : config.public.apiBase)

  const options = {
    baseURL,
    headers: {
      Accept: 'application/json',
      ...(opts?.headers as Record<string, string> | undefined),
    },
    // Spread last to allow overriding any option if needed
    ...opts,
  }

  // Cast to any to smooth over complex Nuxt generics across versions
  // eslint-disable-next-line @typescript-eslint/no-explicit-any
  return useFetch<T>(request, options as any)
}
