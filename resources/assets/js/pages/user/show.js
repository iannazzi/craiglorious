/**
 * Created by embrasse-moi on 2/2/17.
 */
import {RecordTableView}  from '../../elements/tables/RecordTableView';
import {RecordTableController}  from '../../elements/tables/RecordTableController';
import {TableModel}  from '../../elements/tables/TableModel';

export function show(table_definition, server_response_data) {

    let model = new TableModel(table_definition, server_response_data.data),
        view = new RecordTableView(model),
        controller = new RecordTableController(model, view);

    controller.saveComplete.attach(function () {
    });


    switch(table_definition.table_type){
        case 'show':
        case 'edit':
            break;
        case 'create':
            message = 'New User';
            break;
    }



    let div = document.createElement('div');
    div.className = "passwordView"

    div.appendChild(view.createNewButton("Change Passwords"));
    let h = document.createElement('h2');
    h.innerHTML = 'Change Password and/or PassCode';
    div.appendChild(h);
    div.appendChild(view.recordTable());
    $(function () {
        controller.loadPageEvent.notify();
    });
    return div;
}