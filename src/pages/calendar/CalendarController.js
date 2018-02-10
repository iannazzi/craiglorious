export class CalendarController
{
    save(event, vue_calander_component){
        // console.log(event.start.format('YYYY-MM-DD HH:mm:ss'))
        // console.log(event.start.format())

        // console.log('save after resize or move.....');
        // console.log(event);
        // console.log(event.className[0]);
        // console.log('vue_calander_component');
        // console.log(vue_calander_component.$data.schedule_access);
        //
        // if(event.className[0] == 'scheduled_shift'){
        //     if(!self.schedule_access)
        //     {
        //         alert('Permission denied');
        //         return;
        //     }
        // }

        let post_data = {
            id: event.id,
            title: event.title,
            comments: event.comments,
            start: event.start.format('YYYY-MM-DD HH:mm:ss'),
            end: event.end.format('YYYY-MM-DD HH:mm:ss'),
            all_day: event.allDay,
            class_name: event.className[0],
            editable: 1,
            start_editable: 1,
            duration_editable: 1,
            resource_editable: 1,
        }
        let data = {data: post_data, _method: 'put'};

        getData( {
            method: 'put',
            url: '/calendar',
            entity: data,
            onSuccess(response) {
                bus.$emit('event_saved');
            },
            onError(response){
                console.log(response);
                bus.$emit('event_save_error', response);
            }
        })


    }
    clone(event){
        return {
            id: '',
            title: event.title,
            comments: event.comments,

//                    start: event.start.format('YYYY-MM-DD HH:MM:SS'),
//                    end: event.end.format('YYYY-MM-DD HH:MM:SS'),
            start: event.start.clone(),
            end: event.end.clone(),
            className: event.className,
            editable: event.editable,
            startEditable: event.startEditable,
            durationEditable: event.durationEditable,
            resourceEditable: event.resourceEditable,
        }
    }
}