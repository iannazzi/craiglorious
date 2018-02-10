export default {
    typeSelect(event){
        this.errors.clear(event.target.name);

        if (event.target.value == 'scheduled_shift') {
            this.show_employees = true;
        }
        else {
            this.show_employees = false;
        }

    },

    employeeSelect(event){
        //using jquery: let emp_name = $('#employee_select').find('option:selected').text().trim();
        //let selected_index = ;
        //console.log(this.selected_emp_value);
        //console.log(selected_index);
        //let emp_name = this.employees[event.target.options.selectedIndex - 1].name;
        let emp_name = this.employees[event.target.options.selectedIndex - 1].name;

        if(this.title == ''){
            this.title = 'Shift: ' + emp_name;
        }
    },
    loadEventData(event){
        console.log(event);
        this.start_date = event.start.format('YYYY-MM-DD');
        this.end_date = event.end.format('YYYY-MM-DD');
        this.start_time = event.start.format('HH:mm');
        this.end_time = event.end.format('HH:mm');
        this.class_name = event.className[0];
        this.allDay = event.allDay;
        this.title = event.title;
        this.comments = event.comments;
        this.id = event.id;
        this.employee_id = event.employee_id;
    },
    hideModal(){
        this.show = false;
        $('#add-edit-event-modal').modal('hide');
    },
    addEvent(date){
        this.loading = false;
        this.show_employees = false;
        this.add = true;
        this.errors.clearAll();
        this.start_date = date.format('YYYY-MM-DD');
        this.end_date = date.format('YYYY-MM-DD');
        this.start_time = date.format('HH:mm');
        this.end_time = date.add(1, 'hour').format('HH:mm');
        this.class_name = null;
        this.title = '';
        this.id = '';
        this.comments = '';
        this.employee_id = null;

        $('#add-edit-event-modal').modal('show');
    },
    // getEvent(){
    //     return {
    //         className: this.class_name,
    //         allDay: this.allDay,
    //         start: this.getStartDateTime(),
    //         end: this.getEndDateTime(),
    //         title: this.title,
    //         comments: this.comments,
    //         id: this.id,
    //         editable: 1,
    //         startEditable: 1,
    //         durationEditable: 1,
    //         resourceEditable: 1,
    //     }
    // },
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

        getData({
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
        this.id = '';
        this.add = true;
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
            employee_id: this.employee_id,
            editable: 1,
            start_editable: 1,
            duration_editable: 1,
            resource_editable: 1,
        }
        let data = {data: post_data, _method: 'put'};
        let self = this;
        console.log(JSON.stringify(data))

        getData({
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
        return this.start_date + ' ' + this.start_time + ':00'
    },
    getEndDateTime(){
        return this.end_date + ' ' + this.end_time + ':00'
    },
}