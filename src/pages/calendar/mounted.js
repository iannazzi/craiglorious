export function mounted(){
    let self = this;
    bus.$on('addCalendarModalData', function (data) {
        self.eventTypes = data.event_types;
        self.employees = data.employees;

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
        //$('#entry_title').focus();
        //$('#entry_title').select();

        self.$refs.class_select.focus()
    })
}