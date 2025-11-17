import brandVariables from './tailwind.branding'

const config = {
  theme: {
    screens: {
      xs: '480px',
      sm: '576px',
      md: '768px',
      lg: '992px',
      xl: '1200px',
      '2xl': '1608px',
    },
  },
  plugins: [brandVariables],
}

export default config
