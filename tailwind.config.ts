import type { Config } from 'tailwindcss'

const config: Config = {
  theme: {
    container: {
      screens: {
        sm: '100%',
        xl: '1328px',
      },
    },
    screens: {
      xs: '480px',
      sm: '576px',
      md: '768px',
      lg: '992px',
      xl: '1200px',
      '2xl': '1400px',
    },
    typography: {
      DEFAULT: {
        css: {
          '--tw-prose-bold': 'inherit',
        },
      },
    },
  },
}

export default config
