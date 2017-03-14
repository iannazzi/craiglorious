<template>
    <div class="modal fade" id="add-edit-event-modal" tabindex="-1" role="dialog"
         aria-labelledby="add-edit-event-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div v-if="!loading">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>

                        <h4 v-if="add" class="modal-title" id="add-edit-event">New Event</h4>
                        <h4 v-else>{{title}}</h4>

                    </div>
                    <form id="add-edit-event-form" @keydown="errors.clear($event.target.name)">
                        <div class="modal-body">
                            <div v-if="!add" class="row vertical-align">
                                <div class="col-md-4">
                                    <h4>Event ID</h4>
                                </div>
                                <div class="col-md-8">
                                    {{id}}
                                </div>
                            </div>
                            <div class="row vertical-align">
                                <div class="col-md-4">
                                    <h4>Event Title</h4>
                                </div>
                                <div class="col-md-8" v-bind:class="{ 'has-error': errors.has('title') }">
                                    <input id="entry_title" type="text" name="title" class="form-control"
                                           v-model="title" @keydown="errors.clear('title')">
                                    <span class="help text-danger" v-if="errors.has('title')"
                                          v-text="errors.get('title')"></span>
                                </div>
                            </div>
                            <div class="row vertical-align">
                                <div class="col-md-4">
                                    <h4>Event Type</h4>
                                </div>
                                <div class="col-md-8">
                                    <select v-model="class_name" name="class_name" class="form-control"
                                            @click="errors.clear($event.target.name)">
                                        <option v-for="eventType in eventTypes"
                                                v-show="eventType.visible"
                                                :id="eventType.id"
                                                :class="eventType.id"
                                                :value="eventType.id">
                                            {{eventType.text}}
                                        </option>
                                    </select>
                                    <span class="help text-danger" v-if="errors.has('class_name')"
                                          v-text="errors.get('class_name')"></span>

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
                                    <input type="date" class="form-control" v-model="start_date" @change="checkDate">
                                </div>
                                <div class="col-md-4">
                                    <label>Time</label>

                                    <input type="time" @change="checkDate" class="form-control" v-model="start_time">
                                </div>


                            </div>
                            <div v-if="errors.has('start')" class="row vertical-align">
                                <div class="col-md-8 col-md-offset-4">
                                <span class="help text-danger"
                                      v-text="errors.get('start')"></span>
                                </div>
                            </div>
                            <div class="row vertical-align">
                                <div class="add-edit-event-form-label col-md-4">
                                    <h4>Event Ends</h4>
                                </div>

                                <div class="col-md-4">
                                    <label>Day</label>
                                    <input type="date" class="form-control" v-model="end_date" @change="checkDate">
                                </div>
                                <div class="col-md-4">
                                    <label>Time</label>
                                    <input type="time" class="form-control" v-model="end_time" @change="checkDate">
                                </div>

                            </div>
                            <div v-if="errors.has('end')" class="row vertical-align">
                                <div class="col-md-8 col-md-offset-4">
                                <span class="help text-danger"
                                      v-text="errors.get('end')"></span>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button v-if="!add" class="btn btn-danger pull-left delete-event" v-on:click="onDelete">
                                Delete Event
                            </button>
                            <button v-if="!add" class="btn btn-info pull-left" v-on:click="onCopy">
                                Copy Event
                            </button>

                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" :disabled="errors.any()" v-on:click="onSave">
                                Save
                            </button>
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
    class Errors {
        constructor() {
            this.errors = {};
        }

        get(field) {
            if (this.errors[field]) {
                return this.errors[field][0];
            }
        }

        has(field) {
            return this.errors.hasOwnProperty(field);
        }

        any() {
            return Object.keys(this.errors).length > 0;
        }

        clear(field) {
//            this.errors={};
            delete this.errors[field];
        }

        record(errors) {
            console.log(errors);
            this.errors = errors;
        }
    }
    class Form {
        reset() {

        }
    }
    export default {
        data(){
            return {
                form: new Form({
                    allDay: false,
                    start_date: '',
                    start_time: '',
                    end_date: '',
                    end_time: '',
                    title: '',
                    id: '',
                }),
                class_name: null,
                loading: false,
                add: true,
                allDay: false,
                start_date: '',
                start_time: '',
                end_date: '',
                end_time: '',
                title: '',
                id: '',
                errors: new Errors(),

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

            },
            safeEndDate(){
                if (moment(this.end_date).isSameOrBefore(this.start_date)) {
                    this.end_date = this.start_date;
                    return this.end_date;
                }
                else {
                    return this.end_date;
                }
            },
            safeEndTime(){
                return this.end_time;
            }
        },
        mounted(){
            let self = this;

            bus.$on('save_event', function (event) {
                console.log('save_event');
                self.loadEventData(event);
                self.save();

            });
            bus.$on('add_calendar_entry', function (date) {
                self.addEvent(date);

            })
            bus.$on('edit_calendar_entry', function (event) {
                console.log(event);
                self.add = false;
                self.loadEventData(event);

//                self.show=true;
                $('#add-edit-event-modal').modal('show');



            })
            bus.$on('copy_event',function(event){
                self.loadEventData(event);
                self.id='';
                self.save();
            })

            $('#add-edit-event-modal').on('shown.bs.modal', function () {
                $('#entry_title').focus();
                $('#entry_title').select();
            })
        },
        methods: {
            loadEventData(event){
                self.start_date = event.start.format('YYYY-MM-DD');
                self.end_date = event.end.format('YYYY-MM-DD');
                self.start_time = event.start.format('HH:mm');
                self.end_time = event.end.format('HH:mm');
                self.class_name = event.className[0];
                self.title = event.title;
                self.id = event.id;
            },
            hideModal(){
                this.show = false;
                $('#add-edit-event-modal').modal('hide');
            },
            addEvent(date){
                this.add = true;
                this.start_date = date.format('YYYY-MM-DD');
                this.end_date = date.format('YYYY-MM-DD');
                this.start_time = date.format('HH:mm');
                this.end_time = date.add(1,'hour').format('HH:mm');
                console.log(this.end_time);
                this.class_name = null;
                this.title = '';
                this.id = '';
                $('#add-edit-event-modal').modal('show');
            },
            checkDate(){
                console.log(this.start_date);
                console.log(this.end_date);
                console.log(this.start_time);
                console.log(this.end_time);
                console.log(moment(this.end_date + ' ' + this.end_time + ':00').isSameOrBefore(this.start_date + ' ' + this.start_time + ':00'));

                if (moment(this.end_date + ' ' + this.end_time + ':00').isSameOrBefore(this.start_date + ' ' + this.start_time + ':00')) {
//                    if (moment(this.end_date).isSameOrBefore(this.start_date)) {
                    this.end_date = this.start_date;
                    this.end_time = this.start_time;
                }

            },
            onDelete(){

            },
            onCopy(){
                //lets see.....
                //remove the id and set add to true?
                this.id='';
                this.add=true;
            },
            onSave(){
                this.loading = true;
                this.save();
                console.log('saveEvent');
            },
            save(){
                let post_data = {
                    id: this.id,
                    title: this.title,
                    start: this.start_date + ' ' + this.start_time + ':00',
                    end: this.end_date + ' ' + this.end_time + ':00',
                    all_day: this.allDay,
                    class_name: this.class_name,
                    editable: 1,
                    start_editable: 1,
                    duration_editable: 1,
                    resource_editable: 1,
                }
                let data = {data: post_data, _method: 'put'};
                let self = this;
                console.log(JSON.stringify(data))

                $.ajax({
                    url: '/calendar',
                    type: 'POST',
                    data: data,
                    success: function (response) {
                        self.saveSuccess(response);
                    },
                    error(response){
                       self.saveError(response);
                    }
                });
            },
            saveSuccess(response){
                console.log(response);
                this.loading = false;
                this.hideModal();
                $('#calendar').fullCalendar('refetchEvents');
            },
            saveError(response){
                this.loading = false;
                console.log(response);
                this.errors.record(response.responseJSON.message);
            },
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