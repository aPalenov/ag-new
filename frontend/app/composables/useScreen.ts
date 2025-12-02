import { reactive, readonly, onMounted } from 'vue'
import { useEventListener } from '@vueuse/core'
// import { useIsServer } from './isServer'
import tailwindConfig from '../../tailwind.config'

// Typing and parsing screen breakpoints from tailwind.config
const themeScreens = tailwindConfig.theme!.screens

type RawScreens = typeof themeScreens
type Breakpoint = keyof RawScreens

interface BpDef {
  key: Breakpoint
  px: number
  query: string
}

const bpDefs: BpDef[] = (Object.entries(themeScreens) as [Breakpoint, string][])
  .map(([key, val]) => {
    const px = parseInt(val)
    return { key, px, query: `(min-width: ${px}px)` }
  })
  .sort((a, b) => a.px - b.px)

// Interface for the reactive screen state
interface ScreenState {
  width: number
  height: number
  // Current closest matching breakpoint, or 'xs' if none match
  name: Breakpoint | 'xs'
  // Breakpoints that are greater than or equal to current screen width
  gte: Record<Breakpoint, boolean>
  // Shortcut for current exact match
  is: Record<Breakpoint | 'xs', boolean>
}

// Singleton module state
let screenStore: ScreenState | null = null
const mediaQueryLists: Partial<Record<Breakpoint, MediaQueryList>> = {}
let initialized = false

export function useScreen() {
  // Return a readonly proxy if already initialized
  if (screenStore) {
    return readonly(screenStore)
  }

  // Otherwise, initialize screen state
  screenStore = reactive<ScreenState>({
    width: 0,
    height: 0,
    name: 'xs',
    gte: bpDefs.reduce(
      (acc, { key }) => {
        acc[key] = false
        return acc
      },
      {} as Record<Breakpoint, boolean>,
    ),
    is: bpDefs.reduce(
      (acc, { key }) => {
        acc[key] = false
        return acc
      },
      { xs: true } as Record<Breakpoint | 'xs', boolean>,
    ),
  })

  if (!import.meta.server) {
    onMounted(() => {
      if (initialized) {
        return
      }

      initialized = true

      // Resize handler to update screen dimensions
      function updateSize() {
        screenStore!.width = window.innerWidth
        screenStore!.height = window.innerHeight
      }
      useEventListener(window, 'resize', updateSize)
      updateSize()

      // Set up matchMedia for each breakpoint
      function onMediaChange() {
        // Update `gte` values
        bpDefs.forEach(({ key }) => {
          screenStore!.gte[key] = mediaQueryLists[key]?.matches ?? false
        })

        // Determine the current breakpoint name — last matching one
        const passed = bpDefs.filter((d) => screenStore!.gte[d.key]).map((d) => d.key)
        screenStore!.name = passed.length ? passed[passed.length - 1]! : 'xs'

        // Update `is` shortcuts
        screenStore!.is.xs = screenStore!.name === 'xs'
        bpDefs.forEach(({ key }) => {
          screenStore!.is[key] = screenStore!.name === key
        })
      }

      bpDefs.forEach(({ key, query }) => {
        const mql = window.matchMedia(query)
        mediaQueryLists[key] = mql
        mql.addEventListener('change', onMediaChange)
        // Initial evaluation
        screenStore!.gte[key] = mql.matches
      })
      onMediaChange()
    })
  }

  return readonly(screenStore)
}
