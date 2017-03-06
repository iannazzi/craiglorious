<template>

    <div id="calendar"></div>

</template>
<style>
    #calendar{
        padding:20px;

    }
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
                    events: '/calendar',
                    customButtons: {
                        myCustomButton: {
                            text: 'custom!',
                            click: function() {
                                alert('clicked the custom button!');
                            }
                        }
                    },
                    header: {
                        left: 'prev,next today myCustomButton',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    navLinks: true,
                    dayClick: function(date, jsEvent, view) {

                        alert('Clicked on: ' + date.format());

                        alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);

                        alert('Current view: ' + view.name);

                        // change the day's background color just for fun
                        $(this).css('background-color', 'red');

                    },
                    businessHours: [ // specify an array instead
                        {
                            dow: [ 1, 2, 3,4,5 ], // Monday, Tuesday, WednesdayThursday, Friday
                            start: '10:00', // 8am
                            end: '19:00' // 6pm
                        },
                        {
                            dow: [ 6 ], //
                            start: '10:00', // 10am
                            end: '18:00' // 4pm
                        },
                        {
                            dow: [ 0 ], //
                            start: '12:00', // 10am
                            end: '17:00' // 4pm
                        }
                    ]
                })


            });
            //we need to get some data
//            $.get('/calendar', function (data) {
//                // if session was expired
//                console.log(data);
//
//
//            });


        },
        methods: {}
    }

</script>
