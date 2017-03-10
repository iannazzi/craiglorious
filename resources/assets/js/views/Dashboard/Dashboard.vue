<template>
    <div>
        <!--<zzi-nav></zzi-nav>-->
        <zzi-calendar></zzi-calendar>
        <zzi-views></zzi-views>
    </div>
</template>

<script>
    export default {
        components: {
            'zzi-views': require('./views.vue'),
           'zzi-calendar': require('./CalendarSmall.vue')
        },
        mounted: function () {
            $('#search_input').focus()
        },

    }

</script>
