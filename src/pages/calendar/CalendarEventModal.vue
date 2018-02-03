<template>
    <div class="modal fade" id="add-edit-event-modal" tabindex="-1" role="dialog"
         aria-labelledby="add-edit-event-modal"
         data-backdrop="static">
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
                                    <input @keydown="errors.clear('start')" @click="errors.clear('start')" type="date" class="form-control" v-model="start_date" @change="checkDate">
                                </div>
                                <div class="col-md-4">
                                    <label>Time</label>

                                    <input @keydown="errors.clear('start')" @click="errors.clear('start')" type="time" @change="checkDate" class="form-control" v-model="start_time">
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
                                    <input @keydown="errors.clear('end')" @click="errors.clear('end')" type="date" class="form-control" v-model="end_date" @change="checkDate">
                                </div>
                                <div class="col-md-4">
                                    <label>Time</label>
                                    <input @keydown="errors.clear('end')" @click="errors.clear('end')" type="time" class="form-control" v-model="end_time" @change="checkDate">
                                </div>

                            </div>
                            <div v-if="errors.has('end')" class="row vertical-align">
                                <div class="col-md-8 col-md-offset-4">
                                <span class="help text-danger"
                                      v-text="errors.get('end')"></span>
                                </div>
                            </div>
                            <div class="row vertical-align">
                                <div class="col-md-4">
                                    <h4>Comments</h4>
                                </div>
                                <div class="col-md-8">
                                    <textarea  class="form-control" v-model="comments" >
                                    </textarea>
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
        clearAll(){
            this.errors={};
        }

        record(errors) {
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
                    comments: '',
                    id: '',
                }),
                event:{

                },
                class_name: null,
                add_edit : false,
                loading: false,
                add: true,
                allDay: false,
                start_date: '',
                start_time: '',
                end_date: '',
                end_time: '',
                title: '',
                comments: '',
                id: '',
                errors: new Errors(),
                show: false,
                eventTypes: [],
            }
        },
        computed: {
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
            bus.$on('addCalendarEventTypes', function (event_types) {
                self.eventTypes = event_types;
            })
            bus.$on('add_calendar_entry', function (date) {
                self.add_edit = true;
                self.addEvent(date);
            })
            bus.$on('edit_calendar_entry', function (event) {
                self.add_edit = true;
                self.add = false;
                self.loading=false;
                self.loadEventData(event);
                $('#add-edit-event-modal').modal('show');
            })
            bus.$on('event_save_error', function(response){
                self.loading = false;
                console.log('event_save_error bus');
                self.errors.record(response.message);
            })
            $('#add-edit-event-modal').on('shown.bs.modal', function () {
                $('#entry_title').focus();
                $('#entry_title').select();
            })
        },
        methods: {
            loadEventData(event){
                this.start_date = event.start.format('YYYY-MM-DD');
                this.end_date = event.end.format('YYYY-MM-DD');
                this.start_time = event.start.format('HH:mm');
                this.end_time = event.end.format('HH:mm');
                this.class_name = event.className[0];
                this.allDay = event.allDay;
                this.title = event.title;
                this.comments = event.comments;
                this.id = event.id;
            },
            hideModal(){
                this.show = false;
                $('#add-edit-event-modal').modal('hide');
            },
            addEvent(date){
                this.loading=false;
                this.add = true;
                this.errors.clearAll();
                this.start_date = date.format('YYYY-MM-DD');
                this.end_date = date.format('YYYY-MM-DD');
                this.start_time = date.format('HH:mm');
                this.end_time = date.add(1,'hour').format('HH:mm');
                this.class_name = null;
                this.title = '';
                this.id = '';
                this.comments = '';

                $('#add-edit-event-modal').modal('show');
            },
            getEvent(){
                return {
                    className:  this.class_name,
                    allDay: this.allDay,
                    start: this.getStartDateTime(),
                    end: this.getEndDateTime(),
                    title: this.title,
                    comments: this.comments,
                    id: this.id,
                    editable: 1,
                    startEditable: 1,
                    durationEditable: 1,
                    resourceEditable: 1,
                }
            },
            checkDate(){
                if (moment(this.end_date + ' ' + this.end_time + ':00').isSameOrBefore(this.start_date + ' ' + this.start_time + ':00')) {
//                    if (moment(this.end_date).isSameOrBefore(this.start_date)) {
                    this.end_date = this.start_date;
                    this.end_time = this.start_time;
                }

            },
            onDelete(e){
                e.preventDefault();
                let post_data = {
                    id: this.id,
                }
                let data = {data: post_data, _method: 'delete'};
                let self = this;
                console.log(JSON.stringify(data))
                this.loading = true;

                getData( {
                    method: 'delete',
                    url: '/calendar',
                    entity: data,
                    onSuccess(response) {
                        self.loading = false;
                        self.hideModal();
                        bus.$emit('event_saved');
                    },
                    onError(response){
                        console.log(response);
                        bus.$emit('event_save_error', response);
                    }
                })


            },
            onCopy(e){
                //lets see.....
                //remove the id and set add to true?
                this.id='';
                this.add=true;
                e.preventDefault();

            },
            onSave(e){
                e.preventDefault();
                this.loading = true;
                this.save();
            },
            save(){
                //this is different than the calendarController.js save becuase this is not a full
                //fullcalendar event object

                let post_data = {
                    id: this.id,
                    title: this.title,
                    comments: this.comments,
                    start: this.getStartDateTime(),
                    end: this.getEndDateTime(),
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

                getData( {
                    method: 'post',
                    url: '/calendar',
                    entity: data,
                    onSuccess(response) {
                        self.hideModal();
                        bus.$emit('event_saved');

//                        if(self.add_edit) {
//                            bus.$emit('event_saved');
//                        }
                    },
                    onError(response){
                        console.log(response);
                        bus.$emit('event_save_error', response);
                    }
                })

            },
            getStartDateTime(){
                return  this.start_date + ' ' + this.start_time + ':00'
            },
            getEndDateTime(){
                return  this.end_date + ' ' + this.end_time + ':00'
            },
        }
    }
</script>



<style lang="scss">
    @import "../../sass/_variables.scss";

    .vertical-align {
        display: flex;
        align-items: center;
    }
    select option[value="scheduled_shift"] { /* value not val */
        background: rgba(100, 100, 100, 0.3);
    }
</style>