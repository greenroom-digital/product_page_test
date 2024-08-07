<template>
    <div class="flex h-screen justify-center items-center">

        <div v-if="data.loading">
            <div class="text-6xl font-bold grayish-blue">Loading...</div>
        </div>
        <div v-if="!data.loading" class="max-w-[1440px] w-[1136px] p-6 bg-white rounded-lg flex">

            <Spotlight :entity="data.entity" />

            <div class="pl-28 pt-10">
                <h2 class="text-5xl font-bold mb-10 very-dark-blue">{{ data.entity?.name }}</h2>
                <p class="mt-2 md:pr-10 text-base dark-grayish-blue">{{ data.entity?.description }}</p>
                <div class="mt-6">
                    <span class="text-3xl very-dark-blue font-bold">$ {{ currentPrice ?? '' }}</span>

                    <span 
                        v-if="data.entity?.discount?.amount" 
                        class="py-1 px-2 font-bold primary bg-primary-pale rounded-lg ml-4 align-super">
                        {{ displayDiscount }}
                    </span>

                    <span class="grayish-blue font-bold line-through block mt-2">${{ originalPrice ?? '' }}</span>
                </div>
                <div class="mt-8 flex items-center">
                    <button class="text-3xl bg-light-grayish-blue font-bold primary px-3 py-1 pb-3 rounded-l-lg hover:bg-gray-300 hover:cursor-pointer">-</button>
                    <span class="text-md font-bold bg-light-grayish-blue very-dark-blue px-6 py-3">0</span>
                    <button class="text-3xl bg-light-grayish-blue font-bold primary px-3 py-1 pb-3 rounded-r-lg hover:bg-gray-200 hover:cursor-pointer">+</button>

                    <button class="text-base font-bold ml-4 bg-primary text-white px-20 py-4 rounded-lg glow cursor-pointer">
                        <img :src="imageUrl('icon-cart.svg')" class="svg-filter inline-block h-4 align-baseline mr-2">
                        Add to cart
                    </button>
                </div>
            </div>
            
        </div>

    </div>
</template>

<script setup>
import { reactive, computed, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import Spotlight from './components/Spotlight.vue';

const router = useRouter()

const data = reactive({
    entity: {},
    loading: false
})

// Display discounted if discount is available. else, the original price
const currentPrice = computed(() => data.entity?.discount?.amount
    ? data.entity?.price.discounted.toFixed(2) 
    : data.entity?.price?.full.toFixed(2))

// Display nothing if there is no discount. else, the original price
const originalPrice = computed(() => data.entity?.discount?.amount
    ? data.entity?.price?.full.toFixed(2) 
    : '')

// Display discount amount / percentage
const displayDiscount = computed(() => data.entity.discount?.type == 'amount' 
    ? `$${data.entity.discount?.amount.toFixed(2)}` 
    : `${data.entity.discount?.amount}%`)

const imageUrl = (img) => {
    let url = `${process.env.MIX_API_URL}/images`

    return `${url}/${img}`
}

const auth = () => {
    data.loading = true

    return new Promise((resolve, reject) => {
        axios({
            method: 'GET',
            url: '/client/temp-auth',
        }).then((res) => {
            localStorage.setItem('authToken', res.data.token)
            resolve(res.data?.token)
        }).catch((error) => {
            console.log(error)
        })
    })
}

const init = () =>  {
    auth().then((res) => {
        let slug = router.currentRoute.value.params.slug
        let token = res

        axios({
            method: 'GET',
            url: `/client/products/${slug}`,
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json'
            }
        }).then((res) => {
            data.entity = res.data.data
            data.loading = false
        }).catch(async (error) => {
            if (error.response.status == 404) {
                router.push({ name: 'NotFound' })
            }
        })
    })
}

onMounted(() => {
    init()
})

</script>