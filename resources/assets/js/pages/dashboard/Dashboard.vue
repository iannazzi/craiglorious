<template>
    <div>
        <nav-component></nav-component>

        <zzi-nav-keys></zzi-nav-keys>
        <!--<zzi-calendar></zzi-calendar>-->
        <zzi-views></zzi-views>
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
            }
        },
        mounted: function () {
            let self = this;


//            $.ajax({
//                url: '/api/dashboard',
//                beforeSend: function(request) {
//                    request.setRequestHeader("Authorization", 'Bearer ' + localStorage.getItem('jwt-token'));
//                },
//                type: 'get',
//                data: {token: localStorage.getItem('jwt-token')},
//                success: function (response) {
//                   self.page_data=response.page_data;
//                   bus.$emit('viewsDownloadedFromServer', response.views)
//                },
//
//            });
            client({ path: '/dashboard'}).then(
                function (response) {
                    bus.$emit('viewsDownloadedFromServer', response.entity.views)
                    bus.$emit('pageDataDownloadedFromServer', response.entity.page_data)
                },
                function (response, status) {
                    console.log(response);
//                    if (_.contains([401, 500], status)) {
//                    }
                });





        },

    }

</script>
