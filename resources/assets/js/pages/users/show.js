/**
 * Created by embrasse-moi on 2/2/17.
 */
import {RecordTableView}  from '../../elements/tables/RecordTableView';
import {RecordTableController}  from '../../elements/tables/RecordTableController';
import {TableModel}  from '../../elements/tables/TableModel';

export function show(table_definition, server_response_data) {
    let list_message = 'Back To List Of Users';
    let new_user_message = 'New User';
    let message;
    switch(table_definition.table_view){
        case 'show':
        case 'edit':
            message = 'User ' + server_response_data.data[0].username;
            break;
        case 'create':
            message = 'New User';
            break;
    }


    // if(server_response_data.data[0].id == 1){
    //     //no delete option on the user
    //     table_definition.record_table_buttons= ['edit', ''];
    // }

    let model = new TableModel(table_definition, server_response_data.data),
        view = new RecordTableView(model),
        controller = new RecordTableController(model, view);

    controller.saveComplete.attach(function () {
    });

    let div = document.createElement('div');
    div.className = "recordTableView"
    let a =document.createElement('a');
    a.href =  table_definition.route;
    a.role = 'button';
    a.className = 'btn-back';
    a.innerHTML = '<i class="fa fa-arrow-left"></i>' + list_message;
    $(div).append(a);
    div.appendChild(view.createNewButton(new_user_message));
    let h = document.createElement('h2');
    h.innerHTML = message;

    div.appendChild(h);
    div.appendChild(view.createTable());
    $(function () {
        controller.loadPageEvent.notify();
    });
    return div;
}