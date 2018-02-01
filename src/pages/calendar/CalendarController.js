export class CalendarController
{
    save(event){

        let post_data = {
            id: event.id,
            title: event.title,
            start: event.start.format('YYYY-MM-DD HH:MM:SS'),
            end: event.end.format('YYYY-MM-DD HH:MM:SS'),
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
                console.log('calendar event saved');
            },
        })


    }
    clone(event){
        return {
            id: '',
            title: event.title,
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