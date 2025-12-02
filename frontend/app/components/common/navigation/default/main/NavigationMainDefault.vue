<script setup lang="ts">
const { page } = usePageData()

const navigation = computed(() => page.value?.props?.navigation)

const small = ref(false)
const showed = ref(false)
const screen = useScreen()

function scrollEvent() {
  const scrollY = window.scrollY
  if ((small.value && scrollY <= 90) || (!small.value && scrollY >= 130)) {
    small.value = !small.value
  }
}

function resizeEvent() {
  if (screen.gte.md) {
    window.addEventListener('scroll', scrollEvent)
    scrollEvent()
  } else {
    window.removeEventListener('scroll', scrollEvent)
  }
}

onMounted(() => {
  if (import.meta.client) {
    resizeEvent()

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
    resizeEvent()
  },
)

watch(showed, (val) => {
  document.body.style.overflow = val ? 'hidden' : ''
})
</script>

<template>
  <div v-if="navigation" class="[--nav-height:54px] md:[--nav-height:96px]">
    <div class="pointer-events-none h-(--nav-height) bg-white" />

    <nav class="fixed top-0 z-30 w-full" :class="{ 'md:[--nav-height:60px]!': small }">
      <div
        class="absolute top-0 w-full bg-white/50 shadow-sm backdrop-blur-md transition-[height] md:right-[calc(var(--modal-scrollbar-width)*0.5)] md:h-(--nav-height)"
      >
        <div class="container p-0 md:flex md:h-full md:items-center md:px-6">
          <div class="flex h-(--nav-height) items-center justify-between md:hidden">
            <NavigationMainBurgerDefault
              v-model:showed-value="showed"
              aria-controls="navbar-navigation-main"
              aria-label="Open/Close menu"
            />

            <!-- <LinkPhoneWithIcon /> -->
          </div>

          <!-- logo -->
          <!-- <AppLink class="mr-1 hidden h-full py-1 md:block" :href="route('home')">
            <Img class="h-full" src="/images/logo.svg" alt="alxadvert" width="85" height="76" />
          </AppLink> -->

          <div
            class="shrink-0 grow md:visible! md:flex md:h-full md:items-center md:opacity-100!"
            :class="{
              'invisible h-0 opacity-0': !showed,
              'visible h-[calc(100vh-var(--nav-height))] opacity-100': showed,
              'transition-all duration-500': !screen.gte.md,
            }"
          >
            <NavigationMainWrapperDefault
              id="navbar-navigation-main"
              :list="navigation.main"
              :open="showed"
            />
          </div>

          <div class="ml-6 hidden md:block">
            <div class="block leading-none">
              <div class="mt-1 text-lg">
                <!-- <LinkPhone>
                  <template #default="{ phone }">
                    <Icon name="phone-talk" class="mr-1" />
                    {{ phone.name }}
                  </template>
                </LinkPhone>
                <LinkTelegram class="ml-3" />
                <LinkWhatsapp class="ml-3" /> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </div>
</template>
