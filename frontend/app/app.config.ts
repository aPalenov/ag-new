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
    button: {
      slots: {
        base: 'inline-flex items-center justify-center gap-2 font-medium transition select-none disabled:opacity-50 disabled:cursor-not-allowed rounded-(--btn-radius) hover:cursor-pointer',
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
          class: 'pl-(--btn-leading-pl-md)',
        },
        {
          size: 'lg',
          leading: true,
          class: 'pl-(--btn-leading-pl-lg)',
        },
        {
          size: 'md',
          trailing: true,
          class: 'pr-(--btn-trailing-pr-md)',
        },
        {
          size: 'lg',
          trailing: true,
          class: 'pr-(--btn-trailing-pr-lg)',
        },
        {
          size: 'md',
          square: true,
          class: 'p-(--btn-square-p-md)',
        },
        {
          size: 'lg',
          square: true,
          class: 'p-(--btn-square-p-lg)',
        },
      ],
    },
    input: {
      slots: {
        root: 'relative inline-flex items-center',
        base: [
          'w-full rounded-md border-0 appearance-none placeholder:text-dimmed focus:outline-none disabled:cursor-not-allowed disabled:opacity-75',
          'transition-colors',
        ],
      },
      variants: {
        size: {
          md: {
            base: 'px-(--input-px-md) py-(--input-py-md) text-(length:--input-text-md) gap-(--input-gap-md)',
            leading: 'ps-(--input-leading-ps-md)',
            trailing: 'pe-(--input-trailing-pe-md)',
            leadingIcon: 'size-5',
            leadingAvatarSize: '2xs',
            trailingIcon: 'size-5',
          },
          lg: {
            base: 'px-(--input-px-lg) py-(--input-py-lg) text-(length:--input-text-lg) gap-(--input-gap-lg)',
            leading: 'ps-(--input-leading-ps-lg)',
            trailing: 'pe-(--input-trailing-pe-lg)',
            leadingIcon: 'size-5',
            leadingAvatarSize: '2xs',
            trailingIcon: 'size-5',
          },
        },
        variant: {
          outline: 'text-highlighted bg-default ring ring-inset ring-accented',
          none: 'text-highlighted bg-transparent',
        },
        color: {
          primary: '',
          error: '',
        },
      },
      compoundVariants: [
        {
          color: 'primary',
          variant: 'outline',
          class: 'focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-primary',
        },
      ],
    },
  },
})
