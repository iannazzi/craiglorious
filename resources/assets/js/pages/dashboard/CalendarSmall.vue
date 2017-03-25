<template>
<div>
    <div id="calendar"></div>
</div>
</template>
<style>

</style>
<script>


    export default {
        data() {
            return {}
        },
        mounted: function () {
//            $.get( "http://api.openweathermap.org/data/2.5/forecast/city?id=524901&APPID=3e9e6d434403d69e58e548cd7464db2e", function( data ) {
//                console.log('weather feed: ');
//                console.log(data);
//            });
            let self = this;
            client({ path: '/calendar'}).then(
                function (response) {

                    $("#calendar").fullCalendar( 'addEventSource', response.entity.events )
//                    $('#calendar').fullCalendar({events: {
//                        data: response.entity,
//                    cache: true
//                    }});
                },
                function (response, status) {
                    console.log(response);
//                    if (_.contains([401, 500], status)) {
//                    }
                });

            $(document).ready(function () {

                // page is now ready, initialize the calendar...

                $('#calendar').fullCalendar({
                    height: 100,
                    header:false,

                    eventClick:  function(event, jsEvent, view) {

                        self.$router.push({path: '/calendar', query: { event: event.id }});

//                        $('#modalTitle').html(event.title);
//                        $('#modalBody').html(event.description);
//                        $('#eventUrl').attr('href',event.url);
//                        $('#fullCalModal').modal();
                    },
                    navLinks: false,
                    dayClick: function(date, jsEvent, view) {
                        self.$router.push({path: '/calendar', query: { day: date.format('YYYY-MM-DD') }});


                    },
                    defaultView: 'basicTenDay',
                    views: {
                        agendaFourDay: {
                            type: 'basicDay',
                            duration: { days: 4 },
                            buttonText: '4 day'
                        },
                        basicTenDay: {
                            type: 'basicDay',
                            duration: { days: 10 },
                            minTime:'09:00:00',
                            maxTime:'22:00:00',
                            buttonText: '10 day',

                        }
                    }
                })



            });
        },
        methods: {}
    }

</script>
