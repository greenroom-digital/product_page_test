<!-- resources/js/components/ImageCarousel.vue -->
<template>
    <vue-carousel :data="data"></vue-carousel>
</template>

<script>

export default {
    props: {
        images: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            data: [],
        };
    },
    created() {
        this.data = this.images.map(image => `<img src="/images/${image}" alt="Product Image">`);
    },


};
</script>

<style scoped>
.product-images-mobile {
  width: 100%;
}

.carousel,
.slide {
  width: 100%;
}

.slide img {
  width: 100%;
  height: auto;
  border-radius: 4px;
}
</style>
