export default defineAppConfig({
  ui: {
    container: {
      extend: null,
      base: 'w-full max-w-(--ui-container) mx-auto px-(--ui-container-px)',
      trailingIcon: 'text-(--brand-light-text)',
    },
    button: {
      slots: {
        base: 'inline-flex items-center justify-center gap-2 font-medium transition select-none disabled:opacity-50 disabled:cursor-not-allowed rounded-(--btn-radius) hover:cursor-pointer',
      },
      variants: {
        size: {
          xs: { base: 'text-(--btn-text-xs) px-(--btn-px-xs) py-(--btn-py-xs)' },
          sm: { base: 'text-(--btn-text-sm) px-(--btn-px-sm) py-(--btn-py-sm)' },
          md: { base: 'text-(--btn-text-md) px-(--btn-px-md) py-(--btn-py-md)' },
          lg: { base: 'text-(--btn-text-lg) px-(--btn-px-lg) py-(--btn-py-lg)' },
          xl: { base: 'text-(--btn-text-xl) px-(--btn-px-xl) py-(--btn-py-xl)' },
        },
        color: {
          primary: '',
          secondary: '',
          tertiary: '',
        },
        variant: {
          solid: '',
          outline: '',
          link: '',
        },
      },
      compoundVariants: [
        {
          color: 'primary',
          variant: 'solid',
          class:
            'text-brand-light-text bg-brand-accent hover:bg-brand-accent hover:brightness-90 active:bg-brand-accent active:brightness-80 disabled:bg-brand-accent aria-disabled:bg-brand-accent hover:disabled:brightness-100 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-accent',
        },
        {
          color: 'secondary',
          variant: 'solid',
          class:
            'text-brand-light-text bg-brand-dark hover:bg-brand-dark hover:brightness-90 active:bg-brand-dark active:brightness-80 disabled:bg-brand-dark aria-disabled:bg-brand-dark hover:disabled:brightness-100 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-dark',
        },
        {
          color: 'tertiary',
          variant: 'solid',
          class:
            'text-[#333] bg-[#F0F0F0] hover:bg-[#F0F0F0] hover:brightness-90 active:bg-[#F0F0F0] active:brightness-80 disabled:bg-[#F0F0F0] aria-disabled:bg-[#F0F0F0] hover:disabled:brightness-100 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#F0F0F0]',
        },
        {
          color: 'primary',
          variant: 'outline',
          class:
            'ring ring-inset ring-brand-accent/50 text-brand-accent hover:bg-brand-accent/5 active:bg-brand-accent/10 disabled:bg-transparent aria-disabled:bg-transparent dark:disabled:bg-transparent dark:aria-disabled:bg-transparent focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-accent',
        },
        {
          color: 'secondary',
          variant: 'outline',
          class:
            'ring ring-inset ring-brand-dark/50 text-brand-dark hover:bg-brand-dark/5 active:bg-brand-dark/10 disabled:bg-transparent aria-disabled:bg-transparent dark:disabled:bg-transparent dark:aria-disabled:bg-transparent focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-dark',
        },
      ],
    },
  },
})
