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
    import {CalendarController} from './CalendarController.js'
    import fullcalendar from './fullcalendar.js'

    let cc = new CalendarController();
    export default {
        data() {
            return {
                loaded: false,
                schedule_access: null
            }
        },
        components: {
            'zzi-calendar-entry-modal': require('./CalendarEventModal.vue')
        },
        mounted: function () {
            let self = this;


            self.renderCal();
            this.loaded = true;
            console.log('rendering initial events');
            self.renderEvents();
            bus.$on('event_saved', function(){
                console.log('event_saved bus');
                self.renderEvents();
                //bus.$emit('refetchEvents');

//                if (self.add_edit){
////                    bus.$emit('add_event', self.getEvent());
//                    bus.$emit('refetchEvents', self.getEvent());
//
//                }
            })
            bus.$on('add_event', function (event) {
                console.log('add event');
                console.log(event);
                $('#calendar').fullCalendar('renderEvent', event);
                //$('#calendar').fullCalendar('renderEvent', self.clone(event));
            });
            bus.$on('refetchEvents', function () {


//                console.log('refetchEvents');
//                $('#calendar').fullCalendar('refetchEvents')
            })

        },
        methods: {
            renderEvents(){
                let self = this;
                getData( {
                    method: 'get',
                    url: '/calendar',
                    entity: false,
                    onSuccess(response) {
                        bus.$emit('addCalendarModalData', response.data)
                        self.schedule_access = response.data.schedule_access;
                        console.log('removing events');
                        $('#calendar').fullCalendar('removeEvents');
                        console.log('rendering new events');
                        $("#calendar").fullCalendar('addEventSource', response.data.events)
                    },
                })
            },
            renderCal(){
                let self = this;
                //$(document).ready(function () {


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
                        height: "auto",

                        dayNamesShort: ['Sunday', 'Monday', 'Tuesday', 'Wednesday',
                            'Thursday', 'Friday', 'Saturday'],
                        eventRender: function (event, element) {
                            element.bind('dblclick', function () {
                                bus.$emit('edit_calendar_entry', event)
                            });
                        },

                        eventDrop(event, delta, revertFunc, jsEvent, ui, view) {

                            if (copyKey) {
                                console.log('event moved with copy key');

                                if(self.checkScheduleAccess(event)){
                                    cc.save(event,self);
                                    let original_event = cc.clone(event);
                                    original_event.id = '';
                                    original_event.start.subtract(delta);
                                    original_event.end.subtract(delta);
                                    cc.save(original_event, self);
                                }
                                else{
                                    self.renderEvents();
                                }






                                //$('#calendar').fullCalendar('renderEvent', original_event);

                            }
                            else {
                                console.log('event moved');
                                if(self.checkScheduleAccess(event)){
                                    cc.save(event,self);
                                }
                                else{
                                    self.renderEvents();
                                }
                            }

                        },
                        eventResize: function (event, delta, revertFunc, jsEvent, ui, view) {
                            //bus.$emit('resize_event', event);
                            console.log('event resized');
                            console.log(event);
                            if(self.checkScheduleAccess(event)){
                                cc.save(event,self);
                            }
                            else{
                                self.renderEvents();
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
//                        bus.$emit('edit_calendar_entry', event) use double click instead
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

           //     });

            },
            checkScheduleAccess(event){
                console.log(event.className[0]);
                console.log(this.schedule_access);
                if(event.className[0] == 'scheduled_shift'){
                    if(!this.schedule_access)
                    {
                        alert('Permission denied');
                        return false;
                    }
                }
                return true;
            }
        }

    }

</script>
