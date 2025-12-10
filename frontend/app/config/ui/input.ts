export default {
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
}
