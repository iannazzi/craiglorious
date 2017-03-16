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
            console.log('calendar coming')
            $(document).ready(function () {

                // page is now ready, initialize the calendar...

                $('#calendar').fullCalendar({
                    height: 100,
                    header:false,
                    events: '/calendar',

                    eventClick:  function(event, jsEvent, view) {
                        window.location='/dashboard#/calendar?event='+event.id;
//                        $('#modalTitle').html(event.title);
//                        $('#modalBody').html(event.description);
//                        $('#eventUrl').attr('href',event.url);
//                        $('#fullCalModal').modal();
                    },
                    navLinks: false,
                    dayClick: function(date, jsEvent, view) {
                        window.location='/dashboard#/calendar?day='+date.format('YYYY-MM-DD');


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
