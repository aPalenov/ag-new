export default {
  slots: {
    base: 'font-normal',
  },
  variants: {
    size: {
      xs: {
        base: 'text-[8px]/3 px-1.5 py-0.5 gap-1 rounded-sm',
      },
      sm: {
        base: 'text-[10px]/3 px-2 py-1 gap-1 rounded',
      },
      md: {
        base: 'text-xs px-3 py-[3px] gap-1 rounded',
      },
      lg: {
        base: 'text-sm px-3.5 py-1 gap-1.5 rounded-md',
      },
      xl: {
        base: 'text-base px-4 py-1 gap-1.5 rounded-md',
      },
    },
    color: {
      primary: '',
      secondary: '',
      tertiary: '',
    },
    variant: {
      solid: '',
      soft: '',
    },
  },
  compoundVariants: [
    {
      color: 'primary',
      variant: 'solid',
      class: 'bg-brand-accent text-inverted',
    },
    {
      color: 'secondary',
      variant: 'solid',
      class: 'bg-brand-dark text-inverted',
    },
    {
      color: 'tertiary',
      variant: 'solid',
      class: 'bg-neutral-200/70',
    },
  ],
}
