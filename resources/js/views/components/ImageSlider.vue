<template>
    <div>
        <VueFlux
            :options="options"
            :rscs="rscs"
            :transitions="transitions">

            <template #preloader="preloaderProps">
                <FluxPreloader v-bind="preloaderProps" />
            </template>

            <template #controls="controlsProps">
                <FluxControls v-bind="controlsProps" mouseOver="false"/>
            </template>
        </VueFlux>
        
    </div>
</template>

<script setup>
    import { shallowReactive, ref } from 'vue'
    import {
        VueFlux,
        FluxControls,
        FluxPreloader,
        FluxButton,
        Img,
        Slide,
    } from 'vue-flux'
    import 'vue-flux/style.css'

    const props = defineProps({
        entity: Object,
    })

    const options = shallowReactive({
        autoplay: false,
        aspectRatio: '4:3',
        bindKeys: true,
        delay: 2000,
    })

    const rscs = shallowReactive([
        new Img(`${process.env.MIX_API_URL}/images/${props.entity?.images?.[0]}`),
        new Img(`${process.env.MIX_API_URL}/images/${props.entity?.images?.[1]}`),
        new Img(`${process.env.MIX_API_URL}/images/${props.entity?.images?.[2]}`),
        new Img(`${process.env.MIX_API_URL}/images/${props.entity?.images?.[3]}`),
    ])

    const transitions = shallowReactive([Slide]);

</script>