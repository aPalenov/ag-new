import button from './config/ui/button'
import input from './config/ui/input'
import select from './config/ui/select'
import badge from './config/ui/badge'
import carousel from './config/ui/carousel'

export default defineAppConfig({
  ui: {
    colors: {
      neutral: 'neutral',
    },
    container: {
      extend: null,
      base: 'w-full max-w-(--ui-container) mx-auto px-(--ui-container-px)',
      trailingIcon: 'text-(--brand-light-text)',
    },
    button,
    input,
    select,
    badge,
    carousel,
  },
})
