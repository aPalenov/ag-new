declare module '*.vue' {
  import type { DefineComponent } from 'vue'
  // Minimal shim for Vue SFC modules
  const component: DefineComponent<Record<string, unknown>, Record<string, unknown>, unknown>
  export default component
}
