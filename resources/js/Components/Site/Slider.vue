<template>

    <div>
        <carousel v-if="!loading" :items-to-show="1"  :autoplay="5000" :transition="700" :wrapAround="true">
            <slide v-for="slide in slides" :key="slide.id">
                <div class="w-full"
                    :style="`background-image: linear-gradient(to right bottom, ${slide.color1}, ${slide.color2})`"
                    @mousedown.prevent="mouseDownHandler" @mouseup.prevent="mouseUpHandler($event, slide.url)">
                    <div :class="['w-full px-3 md:px-5 bg-contain bg-no-repeat  pt-[120px]',
                        { 'bg-left-bottom': slide.positioning === 'right' },
                        { 'bg-right-bottom': slide.positioning === 'left' }]"
                        :style="`background-image: url(${slide.image ? slide.image.filepath : ''})`"
                        class="w-full relative flex align-middle pt-[120px]">
                        <div class="max-w-screen-xl w-full mx-auto  text-left min-h-[90vh] flex items-center justify-between">
                            <div class="basis-1/2 text-left">

                                <h2
                                    class="pl-5 md:pl-10 border-l-4 border-l-cyan-700 text-4xl text-cyan-700 leading-relaxed">
                                    <span class="text-5xl">{{ slide.title }}</span><br>
                                    {{ slide.subtitle }}
                                </h2>
                                <div class="my-3 text-gray-800 text-lg">
                                    {{ slide.text }}
                                </div>
                                <div class="py-5 flex gap-1 md:gap-4">
                                    <a v-for="button in slide.buttons" :href="button.url"
                                        :class="`btn ${button.class}`">{{ button.text }}</a>
                                </div>
                            </div>
                            <div class="basis-1/2">
                            </div>
                        </div>
                    </div>
                </div>
            </slide>
            <template #addons>
                <div class="w-full absolute bottom-2">
                    <Pagination />
                </div>
                <Navigation />
            </template>
        </carousel>
        <slot v-else></slot>
    </div>
</template>

<script>
import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';
export default {
    name: "Slider",
    components: { Carousel, Slide, Pagination, Navigation },
    data() {
        return {
            slides: [],
            x: 0,
            loading: true
        }
    },
    mounted() {
        this.load();
    },
    methods: {
        load() {
            axios.get('/data/slides').then(response => {
                console.log(response.data.slides)
                this.slides = response.data.slides;
                this.loading = false;
            })
        },
        // Если есть смещение слайдера, клик не обрабатывается.
        mouseDownHandler(e) {
            this.x = e.clientX;
        },
        mouseUpHandler(e, url) {
            if (Math.abs(this.x - e.clientX) < 10) {
                window.open(url, '_self');
            }
        }
    }
}
</script>

<style scoped></style>