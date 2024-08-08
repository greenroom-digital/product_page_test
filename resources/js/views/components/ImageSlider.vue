<template>
    <div>
        <carousel :items-to-show="1" :autoplay="2000" :wrapAround="true">
            <slide v-for="img,i in props.entity?.images" :key="i">
                <img :src="imageUrl(img)" :alt="img">
            </slide>

            <template #addons>
                <navigation />
            </template>
        </carousel>
        
    </div>
</template>

<script setup>
    import 'vue3-carousel/dist/carousel.css'
    import { Carousel, Slide, Navigation } from 'vue3-carousel'

    const props = defineProps({
        entity: Object,
    })

    const imageUrl = (img) => {
        let url = `${process.env.MIX_API_URL}/images`

        return (img) ? `${url}/${img}` : ''
    }

</script>