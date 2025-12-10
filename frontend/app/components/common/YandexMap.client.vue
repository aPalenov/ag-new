<script setup lang="ts">
import type * as YMapsTypes from '@yandex/ymaps3-types'
import { useIntersectionObserver } from '@vueuse/core'

const props = defineProps<{
  center: [number, number]
  zoom: number
  items: Array<{
    label: string
    coordinates: [number, number]
  }>
}>()

const iconClassName =
  'iconify i-ag:map-marker text-brand-dark size-14 -translate-x-1/2 -translate-y-[88%] cursor-pointer transition-colors'

const layerCustomization = [
  {
    tags: { any: ['water', 'landscape'] },
    stylers: [{ saturation: -0.3 }],
  },
  {
    tags: { any: ['road'] },
    elements: 'geometry',
    stylers: [{ saturation: -1, lightness: -0.1 }],
  },
] as YMapsTypes.CustomizationConfig

const activeIndex = defineModel('activeIndex', {
  type: Number,
  required: false,
  default: -1,
})

const rootEl = ref<HTMLElement | null>(null)
const mapContainer = ref<HTMLElement | null>(null)
const isLoaded = ref(false)

let stopObserver: (() => void) | null = null
let map: YMapsTypes.YMap | null = null
let markerEntities: YMapsTypes.YMapMarker[] = []

declare global {
  interface Window {
    ymaps3?: typeof YMapsTypes
  }
}

// Установка цвета маркера
function setMarkerColor(markerEl: HTMLElement, isActive: boolean) {
  if (isActive) {
    markerEl.classList.add('text-brand-accent')
    markerEl.classList.remove('text-brand-dark')
  } else {
    markerEl.classList.remove('text-brand-accent')
    markerEl.classList.add('text-brand-dark')
  }
}

// Сброс всех маркеров в неактивное состояние
function resetAllMarkers() {
  markerEntities.forEach((marker) => {
    setMarkerColor(marker.element as HTMLElement, false)
  })
  activeIndex.value = -1
}

// Активация маркера по индексу
function activateMarker(index: number) {
  if (index < 0 || index >= markerEntities.length) {
    return
  }

  const selectedMarker = markerEntities[index]
  const item = props.items[index]

  if (selectedMarker && item) {
    setMarkerColor(selectedMarker.element as HTMLElement, true)

    map?.setLocation({
      center: item.coordinates,
      zoom: 16,
      duration: 500,
    })

    activeIndex.value = index
  }
}

// Обработчик клика на маркер
function handleMarkerClick(index: number, e: Event) {
  e.stopPropagation()
  resetAllMarkers()
  activateMarker(index)
}

// Загрузка Yandex Maps API
async function loadYandexMapsAPI() {
  if (window.ymaps3) {
    return window.ymaps3
  }

  const runtimeConfig = useRuntimeConfig()
  await loadScript(
    `https://api-maps.yandex.ru/v3/?apikey=${runtimeConfig.public.ymapsApiKey}&lang=ru_RU`,
  )

  if (!window.ymaps3) {
    throw new Error('Yandex Maps API did not load correctly')
  }

  return window.ymaps3
}

// Создание маркера
function createMarker(ymaps3: typeof YMapsTypes, item: (typeof props.items)[0], index: number) {
  const el = document.createElement('div')
  el.className = iconClassName
  el.onclick = (e) => handleMarkerClick(index, e)

  const entity = new ymaps3.YMapMarker({ coordinates: item.coordinates }, el)
  map?.addChild(entity)

  return entity
}

// Инициализация карты
async function initMap(): Promise<void> {
  if (isLoaded.value || !mapContainer.value) {
    return
  }

  try {
    const ymaps3 = await loadYandexMapsAPI()
    await ymaps3.ready

    const { YMap, YMapDefaultSchemeLayer, YMapDefaultFeaturesLayer } = ymaps3

    const schemeLayer = new YMapDefaultSchemeLayer({ customization: layerCustomization })
    const featuresLayer = new YMapDefaultFeaturesLayer({})

    map = new YMap(
      mapContainer.value,
      {
        location: { center: props.center, zoom: props.zoom },
        showScaleInCopyrights: false,
        mode: 'vector',
      },
      [schemeLayer, featuresLayer],
    )

    markerEntities = props.items.map((item, index) => createMarker(ymaps3, item, index))

    // Обработчик клика на карту для сброса маркеров
    mapContainer.value.onclick = resetAllMarkers

    isLoaded.value = true
  } catch (e) {
    console.error('Yandex Map init error:', e)
  }
}

// Отслеживание изменения activeIndex извне
watch(activeIndex, (newIndex) => {
  if (!isLoaded.value || newIndex === -1) {
    return
  }

  resetAllMarkers()
  activateMarker(newIndex)
})

onMounted(async () => {
  await nextTick()

  if (!rootEl.value) {
    return
  }

  const { stop } = useIntersectionObserver(
    rootEl,
    (entries) => {
      const entry = entries[0]
      if (entry?.isIntersecting) {
        stop()
        initMap()
      }
    },
    {
      root: null,
      threshold: 0.1,
      rootMargin: '200px 0px',
    },
  )

  stopObserver = stop
})

onBeforeUnmount(() => {
  stopObserver?.()
  stopObserver = null

  if (map && markerEntities.length) {
    for (const entity of markerEntities) {
      try {
        map.removeChild(entity)
      } catch {
        // ignore
      }
    }
  }
  markerEntities = []

  if (map) {
    try {
      map.destroy()
    } catch {
      // ignore
    }
    map = null
  }

  activeIndex.value = -1
})
</script>

<template>
  <div ref="rootEl" class="bg-black/5">
    <div ref="mapContainer" class="h-full w-full" />
    <div
      v-if="!isLoaded"
      class="pointer-events-none absolute inset-0 flex items-center justify-center text-xs"
    >
      Загрузка карты…
    </div>
  </div>
</template>
