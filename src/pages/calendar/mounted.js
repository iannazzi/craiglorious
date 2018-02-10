export function mounted(){
    let self = this;
    bus.$on('addCalendarModalData', function (data) {
        console.log(data.schedule_access);

        self.eventTypes = data.event_types;
        self.employees = data.employees;
        self.schedule_access = data.schedule_access;
        console.log('schedule_access ' + data.schedule_access);

    })
    bus.$on('add_calendar_entry', function (date) {
        self.add_edit = true;
        self.addEvent(date);
    })
    bus.$on('edit_calendar_entry', function (event) {

        console.log('editing event does user have access? ' + self.schedule_access)
        console.log(event.className[0]);
        if(event.className[0] == 'scheduled_shift'){
            if(!self.schedule_access)
            {
                alert('Permission denied');
                return;
            }
            self.show_employees = true;
        }
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