<!-- resources/js/components/ProductPage.vue -->
<template>
  <div v-if="product" class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="row container-content">
        <div class="col-12 image-carousel-mobile">
            <ImageCarousel v-if="product.images.length" :images="product.images" />
        </div>

        <div class="col-6 product-main">
            <div v-if="product.images.length" class="product-img-wrapper">
                <div class="main-image">
                    <img :src="'/images/' + currentImage" alt="Product Image" />
                </div>
            </div>
        </div>

        <div class="product-content col-6 d-flex justify-content-center align-items-center">
            <div class="content-wrapper">
                <p class="d-sm-block d-md-none mb-3 text-sm mb-headline">sneaker company</p>
                <h1 class="product-name">{{ product.name }}</h1>
                <p class="product-desc">{{ product.description }}</p>
                <div class="amount-wrapper">
                    <h2 v-if="product.discount" class="product-disc-price">${{ formatPrice(product.price.discounted) }} <span>{{product.discount.amount}}%</span></h2>
                    <p class="product-price">${{ formatPrice(product.price.full) }} </p>
                </div>

                <div class="row mt-5 btn-wrapper">
                    <div class="col-5 btn-wrapper-item text-center">
                        <ul class="qty-wrapper">
                            <li class="qty-dec" @click="decrement"><img src="/images/icon-minus.svg" alt="icon-minus"></li>
                            <li class="qty-counter">{{ quantity }}</li>
                            <li class="qty-inc" @click="increment"><img src="/images/icon-plus.svg" alt="icon-plus"></li>
                        </ul>
                    </div>
                    <div class="col-7 btn-wrapper-item text-center">
                        
                        <p class="add-cart-btn">
                            <img src="/images/icon-cart.svg" alt="icon-cart">
                            Add to cart
                        </p>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-6 product-item">
            <ul>
                <li 
                    v-for="(image, index) in product.images" 
                    :key="image" 
                    :class="{ active: currentImage === image }"
                >
                <img 
                    :src="'/images/' + image" 
                    alt="Product Image"
                    @click="updateMainImage(image)"
                />
                </li>
            </ul>
        </div>

        
    </div>
  </div>
  <div v-else-if="error">
    <NotFound />
  </div>
  <div v-else>
    <p class="text-center">Loading...</p>
  </div>
</template>

<script>
import axios from 'axios';
import NotFound from './NotFound.vue';
import ImageCarousel from './ImageCarousel.vue';


export default {
  components: {
    NotFound,
    ImageCarousel
  },
  data() {
    return {
      product: null,
      error: false,
      currentImage: "",
      quantity: 0,
      data: [
        { src: '/images/image-product-1.jpg', alt: 'Image 1' },
        { src: '/images/image-product-2.jpg', alt: 'Image 2' },
        { src: '/images/image-product-3.jpg', alt: 'Image 3' },
        { src: '/images/image-product-4.jpg', alt: 'Image 4' }
      ]
    };
  },
  mounted() {
    this.fetchProduct();
  },
  methods: {

    async fetchProduct() {
      const slug = this.$route.params.slug;
      try {
        const response = await axios.get(`/api/client/products/${slug}`);
        this.product = response.data;
        this.currentImage = this.product.images[0];
      } catch (error) {
        if (error.response && error.response.status === 404) {
          this.error = true;
        } else {
          console.error('Error fetching product:', error);
        }
      }
    },

    updateMainImage(image) {
      this.currentImage = image;
    },
    
    formatPrice(amount){
        return amount.toFixed(2);
    },
    increment() {
        this.quantity++;
    },
    decrement() {
        if (this.quantity > 0) {
            this.quantity--;
        }
    }
  },
};
</script>

<style scoped>



</style>
