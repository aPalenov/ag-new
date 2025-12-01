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
    },
    input: {
      slots: {
        root: 'relative inline-flex items-center',
        base: [
          'w-full border-0 appearance-none placeholder:text-(--input-placeholder-color) focus:outline-none disabled:cursor-not-allowed disabled:bg-[#bdbdbd]/10',
          'transition-colors',
        ],
      },
      variants: {
        size: {
          md: {
            base: 'px-(--input-px-md) text-(length:--input-text-md) gap-(--input-gap-md) leading-(--input-line-height) rounded-(--input-radius-md)',
            leading:
              'ps-(--input-leading-ps-md) text-(--input-leading-icon-color) peer-hover:text-(--input-leading-icon-color-hover) peer-focus:text-(--input-leading-icon-color-hover) peer-disabled:text-(--input-leading-icon-color) transition-colors',
            trailing:
              'pe-(--input-trailing-pe-md) text-(--input-leading-icon-color) peer-hover:text-(--input-leading-icon-color-hover) peer-focus:text-(--input-leading-icon-color-hover) peer-disabled:text-(--input-leading-icon-color) transition-colors',
            leadingIcon: 'size-5 text-inherit',
            leadingAvatarSize: '2xs',
            trailingIcon: 'size-5 text-inherit',
          },
          lg: {
            base: 'px-(--input-px-lg) text-(length:--input-text-lg) gap-(--input-gap-lg) leading-(--input-line-height) rounded-(--input-radius-lg)',
            leading:
              'ps-(--input-leading-ps-lg) text-(--input-leading-icon-color) peer-hover:text-(--input-leading-icon-color-hover) peer-focus:text-(--input-leading-icon-color-hover) peer-disabled:text-(--input-leading-icon-color) transition-colors',
            trailing:
              'pe-(--input-trailing-pe-lg) text-(--input-leading-icon-color) peer-hover:text-(--input-leading-icon-color-hover) peer-focus:text-(--input-leading-icon-color-hover) peer-disabled:text-(--input-leading-icon-color) transition-colors',
            leadingIcon: 'size-5 text-inherit',
            leadingAvatarSize: '2xs',
            trailingIcon: 'size-5 text-inherit',
          },
        },
        variant: {
          outline: '',
          none: 'bg-transparent',
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
          class:
            'ring-(--input-ring-color) focus-visible:ring-1 focus-visible:ring-inset focus-visible:ring-(--input-ring-color-hover) hover:ring-(--input-ring-color-hover) disabled:ring-(--input-ring-color) transition-shadow duration-200 ease-in-out',
        },
        {
          color: 'error',
          variant: 'outline',
          class:
            'ring-(--input-ring-error-color) focus-visible:ring-1 focus-visible:ring-inset focus-visible:ring-(--input-ring-error-color-hover) hover:ring-(--input-ring-error-color-hover) transition-shadow duration-200 ease-in-out',
        },
        {
          leading: true,
          size: 'md',
          class: 'ps-(--input-compound-leading-ps-md)',
        },
        {
          leading: true,
          size: 'lg',
          class: 'ps-(--input-compound-leading-ps-lg)',
        },
        {
          trailing: true,
          size: 'md',
          class: 'pe-(--input-compound-trailing-pe-md)',
        },
        {
          trailing: true,
          size: 'lg',
          class: 'pe-(--input-compound-trailing-pe-lg)',
        },
        {
          loading: true,
          leading: true,
          class: {
            leadingIcon: 'animate-spin',
          },
        },
        {
          loading: true,
          leading: false,
          trailing: true,
          class: {
            trailingIcon: 'animate-spin',
          },
        },
      ],
    },

    select: {
      slots: {
        base: [
          'relative group rounded-md inline-flex items-center focus:outline-none disabled:cursor-not-allowed disabled:opacity-75',
          'transition-colors',
        ],
        leading: 'absolute inset-y-0 start-0 flex items-center',
        leadingIcon: 'shrink-0 text-dimmed',
        leadingAvatar: 'shrink-0',
        leadingAvatarSize: '',
        trailing: 'absolute inset-y-0 end-0 flex items-center',
        trailingIcon: 'shrink-0 text-dimmed',
        placeholder: 'truncate text-(--select-placeholder-color)',
      },
      variants: {
        fieldGroup: {
          horizontal:
            'not-only:first:rounded-e-none not-only:last:rounded-s-none not-last:not-first:rounded-none focus-visible:z-1',
          vertical:
            'not-only:first:rounded-b-none not-only:last:rounded-t-none not-last:not-first:rounded-none focus-visible:z-1',
        },
        size: {
          md: {
            base: 'px-(--select-px-md) text-(length:--select-text-md) gap-(--select-gap-md) leading-(--select-line-height) rounded-(--select-radius-md)',
            leading:
              'ps-(--select-leading-ps-md) text-(--select-leading-icon-color) transition-colors',
            trailing:
              'pe-(--select-trailing-pe-md) text-(--select-leading-icon-color) transition-colors',
            leadingIcon: 'size-5',
            leadingAvatarSize: '2xs',
            trailingIcon: 'size-5',
          },
          lg: {
            base: 'px-(--select-px-lg) text-(length:--select-text-lg) gap-(--select-gap-lg) leading-(--select-line-height) rounded-(--select-radius-lg)',
            leading:
              'ps-(--select-leading-ps-lg) text-(--select-leading-icon-color) transition-colors',
            trailing:
              'pe-(--select-trailing-pe-lg) text-(--select-leading-icon-color) transition-colors',
            leadingIcon: 'size-5',
            leadingAvatarSize: '2xs',
            trailingIcon: 'size-5',
          },
        },
        variant: {
          outline: '',
        },
        color: {
          primary: '',
          error: '',
        },
        leading: {
          true: '',
        },
        trailing: {
          true: '',
        },
        loading: {
          true: 'ps-(--select-compound-leading-ps-md)',
        },
        type: {
          file: 'file:me-1.5 file:font-medium file:text-muted file:outline-none',
        },
      },
      compoundVariants: [
        {
          color: 'primary',
          variant: 'outline',
          class:
            'ring-(--select-ring-color) focus:ring-1 focus:ring-inset focus:ring-(--select-ring-color-hover) hover:ring-(--select-ring-color-hover) disabled:ring-(--select-ring-color) transition-shadow duration-200 ease-in-out',
        },
        {
          color: 'error',
          variant: 'outline',
          class:
            'ring-(--select-ring-error-color) focus:ring-1 focus:ring-inset focus:ring-(--select-ring-error-color-hover) hover:ring-(--select-ring-error-color-hover) transition-shadow duration-200 ease-in-out',
        },
        {
          leading: true,
          size: 'md',
          class: 'ps-(--select-compound-leading-ps-md)',
        },
        {
          leading: true,
          size: 'lg',
          class: 'ps-(--select-compound-leading-ps-lg)',
        },
        {
          trailing: true,
          size: 'md',
          class: 'pe-(--select-compound-trailing-pe-md)',
        },
        {
          trailing: true,
          size: 'lg',
          class: 'pe-(--select-compound-trailing-pe-lg)',
        },
        {
          loading: true,
          leading: true,
          class: {
            leadingIcon: 'animate-spin',
          },
        },
        {
          loading: true,
          leading: false,
          trailing: true,
          class: {
            trailingIcon: 'animate-spin',
          },
        },
      ],
      defaultVariants: {
        size: 'md',
        color: 'primary',
        variant: 'outline',
      },
    },

    // Badge component styles
    badge: {
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

    // Carousel component styles
    carousel: {
      variants: {
        orientation: {
          horizontal: {
            container: 'flex-row -ms-2 md:-ms-6',
            item: 'ps-2 md:ps-6',
          },
        },
      },
    },
  },
})
