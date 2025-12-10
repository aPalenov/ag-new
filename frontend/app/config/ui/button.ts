export default {
  slots: {
    base: 'inline-flex items-center justify-center gap-2 font-normal uppercase transition select-none disabled:opacity-50 disabled:cursor-not-allowed rounded-(--btn-radius) hover:cursor-pointer',
  },
  variants: {
    size: {
      md: {
        base: 'text-(length:--btn-text-md) px-(--btn-px-md) py-(--btn-py-md) gap-2',
      },
      lg: {
        base: 'text-(length:--btn-text-lg) px-(--btn-px-lg) py-(--btn-py-lg) gap-2',
      },
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
        'text-brand-light-text bg-brand-accent hover:bg-brand-accent hover:brightness-85 active:bg-brand-accent active:brightness-80 disabled:bg-brand-accent aria-disabled:bg-brand-accent hover:disabled:brightness-100 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-accent',
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
        'text-[#333] bg-[#F0F0F0] hover:bg-[#F0F0F0] hover:brightness-95 active:bg-[#F0F0F0] active:brightness-90 disabled:bg-[#F0F0F0] aria-disabled:bg-[#F0F0F0] hover:disabled:brightness-100 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#F0F0F0]',
    },
    {
      color: 'primary',
      variant: 'outline',
      class:
        'ring ring-inset ring-brand-accent/50 text-brand-accent hover:bg-brand-accent/5 active:bg-brand-accent/10 disabled:bg-transparent aria-disabled:bg-transparent dark:disabled:bg-transparent dark:aria-disabled:bg-transparent focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-accent',
    },
    {
      color: 'tertiary',
      variant: 'outline',
      class:
        'ring ring-inset ring-[#F0F0F0]/50 text-[#F0F0F0] hover:bg-[#F0F0F0]/5 active:bg-[#F0F0F0]/10 disabled:bg-transparent aria-disabled:bg-transparent dark:disabled:bg-transparent dark:aria-disabled:bg-transparent focus:outline-none focus-visible:ring-2 focus-visible:ring-[#F0F0F0]',
    },
    {
      color: 'secondary',
      variant: 'outline',
      class:
        'ring ring-inset ring-brand-dark/50 text-brand-dark hover:bg-brand-dark/5 active:bg-brand-dark/10 disabled:bg-transparent aria-disabled:bg-transparent dark:disabled:bg-transparent dark:aria-disabled:bg-transparent focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-dark',
    },
    {
      color: 'primary',
      variant: 'link',
      class:
        'text-muted hover:text-default active:text-default disabled:text-muted aria-disabled:text-muted focus:outline-none focus-visible:ring-inset focus-visible:ring-2 focus-visible:ring-inverted',
    },
    {
      size: 'md',
      leading: true,
      class: 'pl-(--btn-compound-leading-pl-md)',
    },
    {
      size: 'lg',
      leading: true,
      class: 'pl-(--btn-compound-leading-pl-lg)',
    },
    {
      size: 'md',
      trailing: true,
      class: 'pr-(--btn-compound-trailing-pr-md)',
    },
    {
      size: 'lg',
      trailing: true,
      class: 'pr-(--btn-compound-trailing-pr-lg)',
    },
    {
      size: 'md',
      square: true,
      class: 'p-(--btn-compound-square-p-md)',
    },
    {
      size: 'lg',
      square: true,
      class: 'p-(--btn-compound-square-p-lg)',
    },
  ],
}
