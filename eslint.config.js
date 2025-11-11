import js from '@eslint/js'
import pluginVue from 'eslint-plugin-vue'
import pluginTs from '@typescript-eslint/eslint-plugin'
import parserTs from '@typescript-eslint/parser'
import vueParser from 'vue-eslint-parser'
import prettier from 'eslint-config-prettier'
import globals from 'globals'

export default [
  // 1. Base JavaScript rules
  js.configs.recommended,

  // 2. Vue's recommended flat config
  ...pluginVue.configs['flat/recommended'],

  // 3. Rules for .ts files only
  {
    files: ['**/*.ts'],
    languageOptions: {
      globals: {
        ...globals.browser,
        ...globals.node,
      },
      parser: parserTs,
      parserOptions: {
        ecmaVersion: 2022,
        sourceType: 'module',
        project: './tsconfig.json',
        tsconfigRootDir: process.cwd(),
      },
    },
    plugins: {
      '@typescript-eslint': pluginTs,
    },
    rules: {
      ...pluginTs.configs.recommended.rules,
      '@typescript-eslint/no-unused-vars': ['warn', { argsIgnorePattern: '^_' }],
      '@typescript-eslint/no-non-null-assertion': 'off',
      '@typescript-eslint/no-explicit-any': 'off',
    },
  },

  // 4. Rules for Vue Single-File Components (.vue)
  {
    files: ['**/*.vue'],
    languageOptions: {
      globals: {
        ...globals.browser,
        route: 'readonly',
      },
      parser: vueParser,
      parserOptions: {
        parser: parserTs,
        ecmaVersion: 2022,
        sourceType: 'module',
        extraFileExtensions: ['.vue'],
        project: './tsconfig.vue.json',
        tsconfigRootDir: process.cwd(),
      },
    },
    plugins: {
      '@typescript-eslint': pluginTs,
    },
    rules: {
      ...pluginTs.configs.recommended.rules,
      'vue/multi-word-component-names': 'off',
      'vue/no-v-html': 'off',
      '@typescript-eslint/no-unused-vars': ['warn', { argsIgnorePattern: '^_' }],
      '@typescript-eslint/no-non-null-assertion': 'off',
      '@typescript-eslint/no-explicit-any': 'off',
      'vue/require-default-prop': 'off',
      'vue/no-v-text-v-html-on-component': 'off',
    },
  },

  // 5. Disable rules conflicting with Prettier
  prettier,

  // 6. Ignore folders and files
  {
    ignores: [
      '.git',
      '.idea',
      '.vscode',
      '**/*.key',
      'bootstrap',
      'config',
      'database',
      'docker',
      'lang',
      'logs',
      'node_modules',
      'public',
      'routes',
      'tests',
      'vendor',
      'resources/js/utils/ziggy.js',
      '.env*',
      'eslint.config.js',
    ],
  },
]
