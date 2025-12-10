import type { EmblaCarouselType } from 'embla-carousel'

type NuxtUiCarouselInstance = {
  emblaApi?: Ref<EmblaCarouselType | null>
}

export function useCarousel() {
  const carouselRef = ref<NuxtUiCarouselInstance | null>(null)

  const getApi = () => carouselRef.value?.emblaApi ?? null

  const next = () => {
    const api = getApi()
    console.log('api', api)
    api?.scrollNext()
  }

  const prev = () => {
    const api = getApi()

    console.log('', carouselRef.value)
    api?.scrollPrev()
  }

  const goTo = (index: number) => {
    const api = getApi()
    api?.scrollTo(index)
  }

  return {
    carouselRef,
    // методы для навигации
    next,
    prev,
    goTo,
  }
}
