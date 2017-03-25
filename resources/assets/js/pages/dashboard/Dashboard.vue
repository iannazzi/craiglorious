<template>
    <div >
        <nav-component></nav-component>
        <zzi-nav-keys></zzi-nav-keys>
        <zzi-calendar></zzi-calendar>
        <zzi-views ></zzi-views>
        <footer-component></footer-component>
    </div>
</template>

<script>
    export default {
        components: {
            'zzi-views': require('./views.vue'),
           'zzi-calendar': require('./CalendarSmall.vue')
        },
        data(){
            return {
                viewsLoaded : false
            }
        },
        mounted: function () {
            let self = this;





        },

    }

</script>
