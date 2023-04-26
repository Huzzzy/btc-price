<script>
import { Head } from '@inertiajs/vue3';

export default {
    components: {
        Head,
    },
    data() {
        return {
            newBtc: null
        }
    },
    computed: {
        priceDiff() {
            return (this.newBtc ? this.newBtc.price : this.btc.price) - (this.newBtc ? this.newBtc.previous_price : this.btc.previous_price)
        },
        fromDbOrWebSocketsPrice() {
            return this.newBtc ? this.newBtc.price : this.btc.price
        },
        fromDbOrWebSocketsPreviousPrice() {
            return this.newBtc ? this.newBtc.previous_price : this.btc.previous_price
        }
    },
    props: {
        btc: Object,
    },
    created() {
        window.Echo.channel('new_btc_price')
            .listen('.new_btc_price', res => {
                this.newBtc = res.btc;
            })
    }

}
</script>

<template>
    <Head title="BTC" />

    <h1 class="text-center mt-10 text-xl">BTC/USD</h1>
    <div class="flex justify-center mt-10">
        <h1 class="text-center text-3xl mx-5">
            {{ priceDiff > 0 ? '+' : '' }}
            {{ priceDiff }}
        </h1>
        <svg v-if="fromDbOrWebSocketsPrice < fromDbOrWebSocketsPreviousPrice"
            xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
            class="bi bi-chevron-down text-red-700" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
        </svg>

        <svg v-if="fromDbOrWebSocketsPrice > fromDbOrWebSocketsPreviousPrice"
            xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
            class="bi bi-chevron-up text-green-700" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z" />
        </svg>

        <h1 class="text-center text-3xl mx-5">
            {{ fromDbOrWebSocketsPrice }}$
        </h1>
    </div>
</template>

<style></style>
