<script setup lang="ts">
import dayjs from 'dayjs'

const { page } = usePageData()

const tenant = computed(() => page.value?.app?.tenant)
const serverTime = computed(() => page.value?.app?.serverTime)
const serverTimeYear = computed(() => dayjs(serverTime.value).year())

const locations = computed(() => page.value?.settings?.contact.locations ?? [])
const locationLabel = computed(() => locations.value[0]?.label || null)

const footerNav = computed(() => page.value?.navigation?.footer ?? [])
</script>

<template>
  <div class="flex h-screen grow flex-col" :class="tenant">
    <header class="sticky top-0 z-30 bg-white shadow-sm">
      <UContainer class="hidden flex-wrap items-center gap-6 py-2 md:flex md:flex-nowrap">
        <LogoDealerInfoPrimary />

        <!-- Right: Location + Call button -->
        <div class="ml-auto flex flex-1 items-center justify-end gap-10">
          <UPopover>
            <UButton
              v-if="locationLabel"
              type="button"
              size="xs"
              variant="link"
              class="normal-case"
            >
              <UIcon name="ag:map-marker" class="mr-2 text-[22px] text-[#3e3a39]" />
              <span class="hidden text-left text-sm md:block">{{ locationLabel }}</span>
              <UIcon name="i-heroicons-chevron-down-20-solid" class="size-4 text-gray-400" />
            </UButton>

            <template #content>
              <div class="w-72 p-2">
                <ul class="divide-y divide-gray-100">
                  <li v-for="(location, index) in locations" :key="index" class="py-2">
                    <div class="flex items-start gap-2">
                      <UIcon name="ag:map-marker" class="mt-0.5 size-5 text-[#4B6FE8]" />
                      <div class="text-sm leading-tight">
                        <div class="font-medium">{{ location.label }}</div>
                        <div class="text-gray-500">Ежедневно с 9:00 до 21:00</div>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </template>
          </UPopover>

          <UButton color="secondary" size="lg">ЗАКАЗАТЬ ЗВОНОК</UButton>
        </div>
      </UContainer>

      <div class="md:border-t md:border-[#bdbdbd]">
        <NavigationMainDefault />
      </div>
    </header>

    <main class="flex grow flex-col"><slot /></main>

    <footer class="bg-[#f0f0f0]">
      <UContainer class="py-10">
        <!-- Top Section: Logo, Locations, Phone -->
        <div class="grid grid-cols-1 gap-6 border-b border-[#bdbdbd] pb-6 md:grid-cols-3">
          <!-- Logo & Company Name -->
          <LogoDealerInfoPrimary
            class="flex-col items-start gap-4"
            :ui="{
              text: 'flex gap-1 md:text-lg',
            }"
          />

          <!-- Locations -->
          <div>
            <div
              v-for="(location, index) in locations"
              :key="index"
              class="leading-head text-sm text-[#333]"
            >
              {{ location.label }}
            </div>
          </div>

          <!-- Phone & Working Hours -->
          <div class="text-right">
            <AdvPhoneLink />
            <div class="mt-1 text-sm text-[#333]">с 9:00 до 21:00</div>
          </div>
        </div>

        <!-- Navigation Section -->
        <NavigationFooterDefault :items="footerNav" />

        <!-- Bottom Section: Copyright & Legal Links -->
        <div class="leading-head space-y-4 pt-6 text-xs text-[#4c4c51]">
          <div>© 2005-{{ serverTimeYear }} ООО "АвтоГЕРМЕС" Все права защищены</div>

          <div>
            Обращаем Ваше внимание на то, что вся представленная на сайте информация, носит
            информационный характер и ни при каких условиях не является публичной офертой,
            определяемой положениями Статьи 437 (2) Гражданского кодекса Российской Федерации.
            Наличие конкретных комплектаций, опций и оборудования по доступным автомобилям уточняйте
            у продавцов консультантов.
          </div>

          <div>
            Предоставляя свои персональные данные и используя настоящий веб-сайт, Вы даете согласие
            на обработку Ваших персональных данных и принимаете условия их обработки. Политика
            конфиденциальности.
          </div>

          <div>
            Для повышения удобства работы с сайтом и обеспечения его корректной работы компания
            АвтоГЕРМЕС использует файлы cookie. Эти файлы содержат данные о предыдущих посещениях
            Вами сайта. Cookie не идентифицируют Ваши личные данные. Вся информация является сугубо
            конфиденциальной. При необходимости Вы можете отключить cookie с помощью настроек
            браузера.
          </div>
        </div>
      </UContainer>
    </footer>
  </div>
</template>
