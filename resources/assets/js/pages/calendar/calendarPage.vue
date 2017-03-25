<template>
    <div>
        <nav-component></nav-component>
        <zzi-nav-keys></zzi-nav-keys>
        <div v-show="loaded">
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
        <div v-show="false">
            <zzi-matrix></zzi-matrix>
        </div>


        <footer-component></footer-component>


    </div>
</template>
<style>
    #calendar {
        padding: 20px;
    }

    @media print {
        @page {
            size: landscape
        }
    }
</style>
<script>
    export default {
        data() {
            return {
                loaded: false
            }
        },
        mounted: function () {

            //cached page data...
            console.log(this.$root.cached_page_data);
            console.log(cached_page_data);


            let self = this;

            self.renderCal();
            this.loaded = true;
            client({path: '/calendar'}).then(
                function (response) {
                    bus.$emit('addCalendarEventTypes', response.entity.event_types)
                    self.loaded = true;
                    $("#calendar").fullCalendar('addEventSource', response.entity.events)
                });


            bus.$on('add_event', function (event) {
                console.log('add event');
                console.log(event);
                $('#calendar').fullCalendar('renderEvent', event);
                //$('#calendar').fullCalendar('renderEvent', self.clone(event));
            });
            bus.$on('refetchEvents', function () {
                console.log('refetchEvents');
                $('#calendar').fullCalendar('refetchEvents')
            })



        },
        methods: {
            renderCal(){
                let self = this;
                $(document).ready(function () {


                    let copyKey;
                    $(document).keydown(function (e) {
                        copyKey = e.metaKey;
                    }).keyup(function () {
                        copyKey = false;
                    });

                    let cal = $("#calendar");

                    cal.fullCalendar({
                        //height: 650,
                        selectable: true,
                        eventRender: function (event, element) {
                            element.bind('dblclick', function () {
                                bus.$emit('edit_calendar_entry', event)
                            });
                        },

                        eventDrop(event, delta, revertFunc, jsEvent, ui, view) {

                            if (copyKey) {
                                console.log('save');
                                self.save(event);
                                let original_event = self.clone(event);
                                original_event.id = '';
                                original_event.start.subtract(delta);
                                original_event.end.subtract(delta);
                                self.save(original_event);


                                $('#calendar').fullCalendar('renderEvent', original_event);

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

                client({path: '/calendar', entity: data}).then(
                    function (response) {
                        console.log('event_saved_from_main calendar');
                    });

            },
            clone(event){
                return {
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
