// @ts-check
import withNuxt from './.nuxt/eslint.config.mjs'

export default withNuxt({
  rules: {
    'no-empty': 'off',
    '@typescript-eslint/no-explicit-any': 'off',
    'vue/require-default-prop': 'off',
    'vue/html-self-closing': 'off',
    'vue/no-v-html': 'off',
  },
})
