<template>

    <div>
        <coupon @applied="onCouponApplied"></coupon>
        <zzi-tab name="Why me?" :selected="true">
            <h1>Here is the content for the about us</h1>
        </zzi-tab>


    </div>

</template>

<script>
    export default {
        mounted() {
            console.log('Coupon mounted.')
        },
        methods:{
            onCouponApplied(){
                console.log('got the event');
                this.$emit('appliedagain');
            }}
    }
</script>
