<script setup lang="ts">
import { tv } from 'tailwind-variants'

const { page } = usePageData()

const navigation = computed(() => page.value?.navigation)

const showed = ref(false)
const screen = useScreen()

const menuTV = tv({
  base: 'shrink-0 grow md:visible! md:flex md:h-full md:items-center md:opacity-100!',
  variants: {
    showed: {
      true: 'visible h-[calc(100vh-var(--nav-height))] opacity-100',
      false: 'invisible h-0 opacity-0',
    },
    animated: {
      true: 'transition-all duration-500',
      false: '',
    },
  },
})

onMounted(() => {
  if (import.meta.client) {
    window.addEventListener('keyup', onEscKey)
  }
})

function onEscKey(e: KeyboardEvent) {
  if (e.key === 'Escape') {
    showed.value = false
  }
}

onBeforeUnmount(() => {
  if (import.meta.client) {
    window.removeEventListener('keyup', onEscKey)
  }
})

watch(
  () => screen.gte.md,
  () => {
    showed.value = false
  },
)

watch(showed, (val) => {
  document.body.style.overflow = val ? 'hidden' : ''
})
</script>

<template>
  <nav v-if="navigation?.main" class="[--nav-height:54px]">
    <div class="pointer-events-none h-(--nav-height) bg-white md:hidden" />

    <div class="fixed top-0 w-full bg-white shadow-sm md:static">
      <UContainer class="md:flex md:h-full md:items-center">
        <div class="flex h-(--nav-height) items-center justify-between md:hidden">
          <LogoDealerInfoPrimary />

          <NavigationMainBurgerDefault
            v-model="showed"
            aria-controls="navbar-navigation-main"
            aria-label="Open/Close menu"
          />
        </div>

        <div
          :class="
            menuTV({
              showed,
              animated: !screen.gte.md,
            })
          "
        >
          <NavigationMainWrapperDefault
            id="navbar-navigation-main"
            :list="navigation.main"
            :open="showed"
          />
        </div>

        <AdvPhoneLink class="ml-6 max-md:hidden" with-icon />
      </UContainer>
    </div>
  </nav>
</template>
