<template>
    <div v-show="show" class="modal fade" id="add-edit-event-modal" tabindex="-1" role="dialog" aria-labelledby="add-edit-event-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="add-edit-event">todo Event</h4>
                </div>
                <form id="add-edit-event-form">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-12 col-sm-4">
                                    <label for="type">Event Type</label>
                                    <select name="type" class="form-control" >
                                        <option v-for="eventType in eventTypes" selected="" :value="eventType">{{formattedEventType(eventType)}}</option>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-sm-3">
                                    <label for="start">Event Starts</label>
                                    <input disabled type="text" name="start" class="form-control" value="">
                                </div>
                                <div class="col-xs-12 col-sm-3">
                                    <label for="end">Event End</label>
                                    <input disabled type="text" name="end" class="form-control" value="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title">Event Title</label>
                            <input type="text" name="title" class="form-control" value="">
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-4">
                                <label for="guests">Number of Guests</label>
                                <input type="text" name="guests" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button class="btn btn-danger pull-left delete-event">Delete Event</button>

                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success"> Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                show:false,
                eventTypes: server_data.page_data.calendar.event_types
            }
        }, computed: {
            // a computed getter
            formattedEventType: function (val) {
                // `this` points to the vm instance
               console.log(val)
            }
        },
        mounted(){
            console.log(server_data.page_data.calendar.event_types)
        },
        methods:{
            hideModal(){
                this.show=false;
            }
        }
    }
</script>