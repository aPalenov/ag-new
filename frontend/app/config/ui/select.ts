export default {
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
        leading: 'ps-(--select-leading-ps-md) text-(--select-leading-icon-color) transition-colors',
        trailing:
          'pe-(--select-trailing-pe-md) text-(--select-leading-icon-color) transition-colors',
        leadingIcon: 'size-5',
        leadingAvatarSize: '2xs',
        trailingIcon: 'size-5',
      },
      lg: {
        base: 'px-(--select-px-lg) text-(length:--select-text-lg) gap-(--select-gap-lg) leading-(--select-line-height) rounded-(--select-radius-lg)',
        leading: 'ps-(--select-leading-ps-lg) text-(--select-leading-icon-color) transition-colors',
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
}
