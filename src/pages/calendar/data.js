import {Errors} from './errors.js';
import {Form} from './form.js';
export function data(){
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
        employee_name: null,
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
        show_employees:false,
        eventTypes: [],
        employees:{},
    }
}