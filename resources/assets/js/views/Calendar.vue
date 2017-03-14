<template>
<div>
    <div id="calendar"></div>
    <zzi-calendar-entry-modal></zzi-calendar-entry-modal>

    <div class="container">
        <div class="jumbotron">
            <h1>Some Help....</h1>
            <p>I added keyboard commands to make your life easier</p>
        </div>
        <table class="table table-bordered table-hover">
            <tr>
                <th>Action</th><th>Keyboard Shortcut</th>
            </tr>
            <tr>
                <td>Copy Event</td><td>shift + click and drag</td>
            </tr>
        </table>
    </div>


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

            let self=this;
            var copyKey = false;
            //keep track of the shift key for copy event
            $(document).keydown(function (e) {
                copyKey = e.shiftKey;
            }).keyup(function () {
                copyKey = false;
            });
            $(document).ready(function () {

                $('#calendar').fullCalendar({
                    height: 650,
                    events: '/calendar',
                    eventDragStart: function (event, jsEvent, ui, view) {
//                        console.log('copy?')
//                        if (!copyKey) return;
//                        bus.$emit('copy_event', event);
                    },
                    eventDragStop: function(event, jsEvent, ui, view) {
                        //console.log(event);
                        //bus.$emit('save_event', event);
                    },
                    eventDrop(event, delta, revertFunc, jsEvent, ui, view ) {
                        console.log(event);
                        console.log(copyKey)
                        if(copyKey){
                            console.log('copy');
                            bus.$emit('copy_event', event);
                        }
                        else
                        {
                            console.log('save');
                            bus.$emit('save_event', event);
                        }
                        console.log(delta);
                    },
                    eventResize: function( event, delta, revertFunc, jsEvent, ui, view ) {
                        bus.$emit('save_event', event);
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

    }

</script>
