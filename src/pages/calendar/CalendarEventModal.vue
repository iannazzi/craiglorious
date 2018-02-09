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
                                    <h4>Event Type</h4>
                                </div>
                                <div class="col-md-8">
                                    <select v-model="class_name" name="class_name" class="form-control"
                                            @change="typeSelect"
                                            ref="class_select">
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
                            <div class="row vertical-align" v-if="show_employees">
                                <div class="col-md-4">
                                    <h4>Employee</h4>
                                </div>
                                <div class="col-md-8">
                                    <select v-model = "employee_id" class="form-control" @change="employeeSelect">
                                        <option value="null">Select Employee...</option>
                                        <option v-for="employee in employees"
                                                v-bind:value="employee.value">
                                            {{employee.name}}
                                        </option>
                                    </select>


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
                                    <input @keydown="errors.clear('start')" @click="errors.clear('start')" type="date"
                                           class="form-control" v-model="start_date" @change="checkDate">
                                </div>
                                <div class="col-md-4">
                                    <label>Time</label>

                                    <input @keydown="errors.clear('start')" @click="errors.clear('start')" type="time"
                                           @change="checkDate" class="form-control" v-model="start_time">
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
                                    <input @keydown="errors.clear('end')" @click="errors.clear('end')" type="date"
                                           class="form-control" v-model="end_date" @change="checkDate">
                                </div>
                                <div class="col-md-4">
                                    <label>Time</label>
                                    <input @keydown="errors.clear('end')" @click="errors.clear('end')" type="time"
                                           class="form-control" v-model="end_time" @change="checkDate">
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
                                    <textarea class="form-control" v-model="comments">
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
    import computed from './computed.js';
    import methods from './methods.js';
    import {mounted} from './mounted.js'

    import {data} from './data.js'

    export default {
        data,
        computed,
        mounted,
        methods: methods,
    }
</script>

<style lang="scss">
    @import "./modal_styles.scss";
    @import "../../sass/_variables.scss";
</style>