export function loadScript(src: string, delay?: number) {
  return new Promise((resolve, reject) => {
    setTimeout(() => {
      const script = document.createElement('script')
      script.src = src
      script.onload = resolve
      script.onerror = reject
      document.head.appendChild(script)
    }, delay ?? 0)
  })
}
