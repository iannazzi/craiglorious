<template>
<div>
    <div id="calendar"></div>
    <zzi-calendar-entry-modal></zzi-calendar-entry-modal>





</div>
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
            //we are going to need some data from the server...
            this.event_types = [];
//             $.get('/calendar/event_types',
//                function( data ) {
//                    this.event_types = data;
//                    console.log(this.event_types);
//            });
            let self=this;
            $(document).ready(function () {

                $('#calendar').fullCalendar({
                    height: 650,
                    events: '/calendar',
                    eventDragStop: function(event, jsEvent, ui, view) {
                        self.saveEvent(event);
                    },
                    eventResize: function( event, delta, revertFunc, jsEvent, ui, view ) {
                        self.saveEvent(event);
                    },
                    updateEvent: function(event){
                        console.log('send in update');
                    },
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
                        right: 'month,agendaWeek,listWeek,agendaDay'
                    },
                    navLinks: true,
                    dayClick: function(date, jsEvent, view) {
                        bus.$emit('add_calendar_entry', date)
                    },
                    eventClick:  function(event, jsEvent, view) {
                        bus.$emit('edit_calendar_entry', event)
                    },
                    scrollTime: '14:00:00',
//                    minTime:'05:00:00',
//                    maxTime:'22:00:00',
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
                    ],
                })



            });
        },
        methods: {
            saveEvent(event){
                console.log('saveEvent');
                let post_data = {
                    id: event.id,
                    title: event.title,
                    start: event.start.format(),
                    end:   event.end.format()
                }
                console.log(post_data)
                let data = {data: post_data, _method: 'put'};

                console.log(JSON.stringify(data))

                $.ajax({
                    url: '/calendar',
                    type: 'POST',
                    data: data,
                    success: function (response) {
                        //get the response from server and process it
//                                $("#calendarupdated").append(response);
                        console.log(response);
                        $('#calendar').fullCalendar( 'refetchEvents' );
                    }
                });
            }
        }

    }

</script>
