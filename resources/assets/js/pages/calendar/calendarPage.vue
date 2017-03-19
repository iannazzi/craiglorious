<template>
    <div>
        <zzi-nav-keys></zzi-nav-keys>
        <div id="calendar"></div>
        <zzi-calendar-entry-modal></zzi-calendar-entry-modal>

        <div class="container hidden-print">
            <div class="jumbotron">
                <h1>Help is here</h1>
                <p></p>
            </div>
            <div class="panel ">
                <h2>I added keyboard commands to make your life easier</h2>
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>Action</th>
                        <th>Keyboard Shortcut</th>
                    </tr>
                    <tr>
                        <td>Copy Event</td>
                        <td>command + click and drag</td>
                    </tr>
                </table>
            </div>

        </div>


    </div>
</template>
<style>
    #calendar {
        padding: 20px;
    }
    @media print{@page {size: landscape}}
</style>
<script>
    export default {
        data() {
            return {}
        },
        mounted: function () {
            let self = this;
            bus.$on('add_event', function(event){
                console.log('add event');
                $('#calendar').fullCalendar('renderEvent', self.clone(event));
            });
            bus.$on('refetchEvents', function(){
                console.log('refetchEvents');
                $('#calendar').fullCalendar( 'refetchEvents' )
            })

            //we are going to need some data from the server...
            this.event_types = [];

            var copyKey = false;
            //keep track of the shift key for copy event
            //e.ctrlKey
            //e.altKey
            //e.shiftKey
            $(window).keydown(function (e) {
//                if (e.ctrlKey) alert("control");
//                if (e.altKey) alert("alt");
//                if (e.metaKey) alert("meta");
//                if (e.shiftKey) alert("shift");

            });
            $(document).keydown(function (e) {
                copyKey = e.metaKey;
            }).keyup(function () {
                copyKey = false;
            });
            $(document).ready(function () {
                let cal = $( "#calendar" );

                cal.fullCalendar({
                    //height: 650,
                    events: '/calendar',
                    selectable:true,
                    eventDragStart: function (event, jsEvent, ui, view) {
                    },
                    eventDragStop: function (event, jsEvent, ui, view) {
                        //console.log(event);
                        //bus.$emit('save_event', event);
                    },
                    eventRender: function(event, element) {
                        element.bind('dblclick', function() {
                            bus.$emit('edit_calendar_entry', event)
                        });
                    },

                    eventDrop(event, delta, revertFunc, jsEvent, ui, view) {
//                        console.log(event);
//                        console.log(delta);
//                        console.log(copyKey);
                        if (copyKey) {
                            //$('#calendar').fullCalendar('renderEvent', event);
                            console.log('copy');
                            //bus.$emit('drag_copy_event', event);

                            console.log(event.start.toString());
                            console.log(delta);

                            let new_event = self.clone(event);
                            new_event.id='';
//                            console.log(new_event.start.toString())
                            new_event.start.subtract(delta);
                            new_event.end.subtract(delta);
//                            console.log(new_event.start.toString())
                            self.save(new_event);


                            $('#calendar').fullCalendar('renderEvent', new_event);
//                            bus.$emit('add_event', new_event);
                            //event.start = event.start.add(delta);
                            //bus.$emit('add_event', event);
                            //revertFunc();
                        }
                        else {
                            console.log('save');
                            //bus.$emit('move_event', event);
                            self.save(event);
                        }

                    },
                    eventResize: function (event, delta, revertFunc, jsEvent, ui, view) {
                        //bus.$emit('resize_event', event);
                        self.save(event);
                    },
                    updateEvent: function (event) {
                        console.log('send in update');
                    },
                    customButtons: {
                        myCustomButton: {
                            text: 'custom!',
                            click: function () {
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
                    dayClick: function (date, jsEvent, view) {
                        if (view.name == 'month') {
                            cal.fullCalendar('gotoDate', date);
                            cal.fullCalendar('changeView', 'agendaWeek')
                        }
                        else {
                            bus.$emit('add_calendar_entry', date)
                        }

                    },
                    eventClick: function (event, jsEvent, view) {
//                        bus.$emit('edit_calendar_entry', event)
                    },
                    scrollTime: '14:00:00',
//                    minTime:'05:00:00',
//                    maxTime:'22:00:00',
                    businessHours: [ // specify an array instead
                        {
                            dow: [1, 2, 3, 4, 5], // Monday, Tuesday, WednesdayThursday, Friday
                            start: '10:00', // 8am
                            end: '19:00' // 6pm
                        },
                        {
                            dow: [6], //
                            start: '10:00', // 10am
                            end: '18:00' // 4pm
                        },
                        {
                            dow: [0], //
                            start: '12:00', // 10am
                            end: '17:00' // 4pm
                        }
                    ],
                })


            });
        },
        methods:{
            save(event){

                let post_data = {
                    id: event.id,
                    title: event.title,
                    start: event.start.format('YYYY-MM-DD HH:MM:SS'),
                    end: event.end.format('YYYY-MM-DD HH:MM:SS'),
                    all_day: event.allDay,
                    class_name: event.className[0],
                    editable: 1,
                    start_editable: 1,
                    duration_editable: 1,
                    resource_editable: 1,
                }
                let data = {data: post_data, _method: 'put'};
                $.ajax({
                    url: '/calendar',
                    type: 'POST',
                    data: data,
                    success: function (response) {
                        console.log('event_saved_from_main calendar');
                    },

                });
            },
            clone(event){
                return  {
                    id: '',
                    title: event.title,
//                    start: event.start.format('YYYY-MM-DD HH:MM:SS'),
//                    end: event.end.format('YYYY-MM-DD HH:MM:SS'),
                    start: event.start.clone(),
                    end: event.end.clone(),
                    className: event.className,
                    editable: event.editable,
                    startEditable: event.startEditable,
                    durationEditable: event.durationEditable,
                    resourceEditable: event.resourceEditable,
                }
            }
        }

    }

</script>
