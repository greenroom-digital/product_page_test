<template>
    <div>
        <FsLightbox
            v-if="data.currentImage"
            :toggler="data.toggleLightBox"
            :sources="data.lightBoxImages"
        />

        <div class="">
            <img 
                :src="imageUrl(data.currentImage)" 
                @click="data.toggleLightBox = !data.toggleLightBox"
                alt="Sneakers" 
                class="rounded-xl mb-4 cursor-pointer"
            >

            <div class="flex mt-4 justify-between">
                <div v-for="img,i in props.entity?.images" :key="i" :class="{'border-2 primary-border rounded-xl': img == data.currentImage}">
                    <img 
                        @click="() => setCurrentImage(img)"
                        :src="imageUrl(img)" 
                        alt="Thumbnail" 
                        :class="[{'opacity-50': img == data.currentImage}, 'w-20 h-auto rounded-lg  hover:cursor-pointer']"
                    >
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { reactive, onMounted } from 'vue'
    import FsLightbox from "fslightbox-vue/v3"

    const props = defineProps({
        entity: Object,
    })

    const data = reactive({
        currentImage: '',
        lightBoxImages: [],
        toggleLightBox: false
    })

    const applyUrlToImages = async() => {
        data.lightBoxImages = await props.entity?.images?.length 
            ? props.entity?.images?.map((img) => imageUrl(img))
            : []
    }

    const imageUrl = (img) => {
        let url = `${process.env.MIX_API_URL}/images`

        return `${url}/${img}`
    }

    const setCurrentImage = (img) => {
        data.currentImage = img
    }

    onMounted(() => {
        data.currentImage = props.entity?.images?.[0]
        applyUrlToImages()
    })

</script>