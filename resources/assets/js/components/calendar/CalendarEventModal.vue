<template>
    <div class="modal fade" id="add-edit-event-modal" tabindex="-1" role="dialog"
         aria-labelledby="add-edit-event-modal">
        <div class="modal-dialog" role="document">
            <div  class="modal-content">
                <div v-if="!loading">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>

                        <h4 v-if="add" class="modal-title" id="add-edit-event">New Event</h4>
                        <h4 v-else>{{title}}</h4>

                    </div>
                    <form   id="add-edit-event-form">
                        <div class="modal-body">
                            <div class="row vertical-align">
                                <div class="col-md-4">
                                    <h4>Event Title</h4>
                                </div>
                                <div class="col-md-8">
                                    <input id="entry_title" type="text" name="title" class="form-control" v-model="title">
                                </div>
                            </div>
                            <div class="row vertical-align">
                                <div class="col-md-4">
                                    <h4>Event Type</h4>
                                </div>
                                <div class="col-md-8">
                                    <select v-model="selected" name="type" class="form-control">
                                        <option v-for="eventType in eventTypes"
                                                v-show="eventType.visible"
                                                :id="eventType.id"
                                                :class="eventType.id"
                                                :value="eventType.id">
                                            {{eventType.text}}

                                        </option>
                                    </select>
                                </div>


                            </div>
                            <div class="row vertical-align">
                                <div class="col-sm-4">
                                    <h4>All Day</h4>
                                </div>
                                <div class="col-sm-8">
                                    <input class="input-group-lg big-checkbox"
                                           type="checkbox" v-model="allDay">

                                </div>
                            </div>
                            <div class="row vertical-align">
                                <div class="col-md-4">
                                    <h4>Event Starts</h4>
                                </div>
                                <div class="col-md-4">
                                    <label>Day</label>

                                    <input type="date" class="form-control" v-model="start_date">
                                </div>
                                <div class="col-md-4">
                                    <label>Time</label>

                                    <input type="time" class="form-control" v-model="start_time">
                                </div>

                            </div>
                            <div class="row vertical-align">
                                <div class="add-edit-event-form-label col-md-4">
                                    <h4>Event Ends</h4>
                                </div>
                                <div class="col-md-4">
                                    <label>Day</label>
                                    <input type="date" class="form-control" v-model="end_date">
                                </div>
                                <div class="col-md-4">
                                    <label>Time</label>
                                    <input type="time" class="form-control" v-model="end_time">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button v-if="!add" class="btn btn-danger pull-left delete-event">Delete Event</button>

                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" v-on:click="save">Save</button>
                        </div>
                    </form>
                </div>
                <div v-else>
                    <div class="modalWaitContents">
                        <div class="modalWaitIconDiv">
                            <i class="fa fa-circle-o-notch fa-spin"></i>
                        </div>
                        <div class="modalWaitText">
                            <h2>Please wait.... </h2>
                            <p>I am communicating with the server...</p>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                selected: null,
                loading:false,
                add: true,
                allDay: false,
                start_date: '',
                start_time: '',
                end_date: '',
                end_time: '',
                title: '',
                id:'',

                show: false,
                event: {},
                eventTypes: server_data.page_data.calendar.event_types
//                eventTypes:[
//                    {
//                        'value': 'null',
//                        'name': 'Select....',
//                        'visible':true
//                    },
//                    {
//                        'value': 'scheduled_shift',
//                        'name': 'Scheduled Shift',
//                        'visible':true
//                    },
//                    {
//                        'value': 'actual_shift',
//                        'name': 'Actual Shift',
//                        'visible':false
//                    },
//                    {
//                        'value': 'customer_appointment',
//                        'name': 'Appointment',
//                        'visible':true
//                    },
//                    {
//                        'value': 'personal_appointment',
//                        'name': 'Personal Appointment',
//                        'visible':true
//                    },
//                    {
//                        'value': 'internal_meeting',
//                        'name': 'Meeting',
//                        'visible':true
//                    },
//                    {
//                        'value': 'location_event',
//                        'name': 'Event',
//                        'visible':false
//
//                    },
//                    {
//                        'value': 'external_meeting',
//                        'name': 'External Meeting',
//                        'visible':false
//                    },
//                    {
//                        'value': 'external_event',
//                        'name': 'External Event',
//                        'visible':false
//                    },
//
//                ]
            }
        }, computed: {
            // a computed getter
            formattedEventType: function () {
                // `this` points to the vm instance

            }
        },
        mounted(){
            let self = this;
            bus.$on('add_calendar_entry', function (date) {
                console.log(date);
                self.add = true;
                self.start_date = date.format('YYYY-MM-DD');
                console.log(self.start_date);

                self.end_date = date.format('YYYY-MM-DD');
                self.start_time = date.format('HH:mm');
                self.end_time = date.format('HH:mm');
                self.selected = null;
                self.title = '';
                self.id = '';
                $('#add-edit-event-modal').modal('show');



            })
            bus.$on('edit_calendar_entry', function (event) {
                console.log(event);
                self.add = false;
                self.start_date = event.start.format('YYYY-MM-DD');
                console.log(self.start_date);
                self.end_date = event.end.format('YYYY-MM-DD');
                self.start_time = event.start.format('HH:mm');
                console.log(self.start_time);

                self.end_time = event.end.format('HH:mm');
                self.selected = event.className[0];
                self.title = event.title;
                self.id = event.id;

//                self.show=true;
                $('#add-edit-event-modal').modal('show');


//                $( '#add-edit-event' ).html('Edit Event ' + event.title);
//
//
//                        console.log(event.title + ' clicked - pop up modal');
//                        $('#modalTitle').html(event.title);
//                        $('#modalBody').html(event.description);
//                        $('#eventUrl').attr('href',event.url);
//                        $('#fullCalModal').modal();


            })
            $('#add-edit-event-modal').on('shown.bs.modal', function () {
                $('#entry_title').focus();
                $('#entry_title').select();
            })


        },
        methods: {
            hideModal(){
                this.show = false;
                $('#add-edit-event-modal').modal('hide');
            },
            save(){
                this.loading = true;
                let start = this.start_date + ' ' + this.start_time +':00';
                let end = this.end_date + ' ' + this.end_time+':00';
                console.log(start);
                console.log('saveEvent');
                let post_data = {
                    id: this.id,
                    title: this.title,
                    start: this.start,
                    end:  this.end,
                    all_day: this.allDay,
                    class_name: this.selected
                }
                console.log(post_data)
                let data = {data: post_data, _method: 'put'};
                let self = this;
                console.log(JSON.stringify(data))

                $.ajax({
                    url: '/calendar',
                    type: 'POST',
                    data: data,
                    success: function (response) {
                        //get the response from server and process it
//                                $("#calendarupdated").append(response);
                        console.log(response);
                        self.loading = false;
                        self.hideModal();
                        $('#calendar').fullCalendar( 'refetchEvents' );
                    }
                });


                //show waiting....
                //send data up
                //confirm
                //
            }
        }
    }
</script>
<style lang="scss">
    @import "../../../sass/_variables.scss";

    .vertical-align {
        display: flex;
        align-items: center;
    }
</style>