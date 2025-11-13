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

  const headers: Record<string, string> = {
    Accept: 'application/json',
    ...(opts?.headers as Record<string, string> | undefined),
  }

  // On server, forward the original browser Host so backend can detect tenant
  if (import.meta.server) {
    try {
      // eslint-disable-next-line @typescript-eslint/no-explicit-any
      const forwarded =
        (useRequestHeaders as any)?.(['host', 'x-forwarded-host', 'x-forwarded-proto']) || {}
      const originalHost =
        (forwarded['x-forwarded-host'] as string | undefined) ||
        (forwarded['host'] as string | undefined)
      if (originalHost) headers['x-forwarded-host'] = originalHost
      const proto = forwarded['x-forwarded-proto'] as string | undefined
      if (proto) headers['x-forwarded-proto'] = proto
    } catch {
      // noop: if header extraction fails, we just don't set them
    }
  }

  const options = {
    baseURL,
    headers,
    // Spread last to allow overriding any option if needed
    ...opts,
  }

  // Cast to any to smooth over complex Nuxt generics across versions
  // eslint-disable-next-line @typescript-eslint/no-explicit-any
  return useFetch<T>(request, options as any)
}
