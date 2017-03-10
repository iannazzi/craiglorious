<template>
<div>
    <div id="calendar"></div>
    <div id="fullCalModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                    <h4 id="modalTitle" class="modal-title"></h4>
                </div>
                <div id="modalBody" class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary"><a id="eventUrl" target="_blank">Event Page</a></button>
                </div>
            </div>
        </div>
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
            console.log('calendar coming')
            $(document).ready(function () {

                // page is now ready, initialize the calendar...

                $('#calendar').fullCalendar({
                    height: 650,
                    events: '/calendar',
                    clientEvent: function(event){
                        console.log('client event');
                    },
                    eventRender: function(event, element) {
//                       console.log('render event');
                    },
                    eventAfterRender: function(event, element) {
//                        console.log('after render event');
                    },
                    eventAfterAllRender: function(event, element) {
//                        console.log('after all render event');
                    },
                    eventDestroy: function(event, element) {
//                        console.log('destroy event');
                    },
                    eventDragStop: function(event, jsEvent, ui, view) {
                        console.log('update after event drag stop');
                    },
                    eventResize: function( event, delta, revertFunc, jsEvent, ui, view ) {
                        console.log('update after event resize');

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
                            }
                        });
                    },

                    eventClick:  function(event, jsEvent, view) {
                        console.log(event.title + ' clicked - pop up modal');
//                        $('#modalTitle').html(event.title);
//                        $('#modalBody').html(event.description);
//                        $('#eventUrl').attr('href',event.url);
//                        $('#fullCalModal').modal();
                    },
                    updateEvent: function(event){
                        console.log('send in update');
//                        $.ajax({
//                            url: '/calendar',
//                            type: 'POST',
//                            data: {data: JSON.stringify(event)},
//                            success: function (response) {
//                                //get the response from server and process it
////                                $("#calendarupdated").append(response);
//                                console.log(response);
//                            }
//                        });
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
                        right: 'month,agendaWeek,listWeek,agendaDay,agendaFourDay,agendaTenDay'
                    },
                    navLinks: true,
                    dayClick: function(date, jsEvent, view) {

                        $('#calendar').fullCalendar( 'changeView', 'agendaDay' )



                            alert('Clicked on: ' + date.format());

                            alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);

                            alert('Current view: ' + view.name);

                            // change the day's background color just for fun
                            $(this).css('background-color', 'red');



                    },
                    scrollTime: '12:00:00',
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
                    views: {
                        agendaFourDay: {
                            type: 'basicDay',
                            duration: { days: 4 },
                            buttonText: '4 day'
                        },
                        agendaTenDay: {
                            type: 'agenda',
                            duration: { days: 10 },
                            minTime:'09:00:00',
                            maxTime:'22:00:00',
                            buttonText: '10 day',

                        }
                    }
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
