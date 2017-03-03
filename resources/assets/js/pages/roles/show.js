/**
 * Created by embrasse-moi on 2/2/17.
 */
import {RecordTableView}  from '../../elements/tables/RecordTableView';
import {RecordTableController}  from '../../elements/tables/RecordTableController';
import {DataTableView}  from '../../elements/tables/DataTableView';
import {DataTableController}  from '../../elements/tables/DataTableController';
import {TableModel}  from '../../elements/tables/TableModel';


export function show(table_definition, server_response_data) {


    //set up some data...
    let column_definition2 = [
        {
            "db_field": "name",
            "caption": "View",
            "type": "html",
            "show_on_list": true,
            "th_width": 80,
        }, {
            "db_field": "access",
            "caption": "Access",
            "type": "select",
            "select_names" : ['Write','Read','None'],
            "select_values": ['write','read','none'],
            "show_on_list": true,
        },  ];
    let view_table_definition = {
        "name": "views_table",
        "access": "READ",
        "dynamic_table_buttons": ['edit'],
        "table_type": "index",//record
        "route": "/roles",
        "footer": [],
        "header": [],
        "column_definition": column_definition2,
    };

    let model = new TableModel(table_definition, server_response_data.data),
        view = new RecordTableView(model),
        controller = new RecordTableController(model, view);
    console.log('view data');
    console.log(server_response_data.view);
    let views_model = new TableModel(view_table_definition, server_response_data.view),
        views_view = new DataTableView(views_model),
        views_controller = new DataTableController(views_model, views_view);

    //build up the page
    let div = document.createElement('div');
    div.className = "recordTableView"


    let tmp = `
<a class="btn-back" href="/roles" role="button">
<i class="fa fa-arrow-left" aria-hidden="true"></i>
Back To Role List
</a>

`

    $(div).append(tmp);
    div.appendChild(view.createNewButton('New Role'));
    let h = document.createElement('h2');
    let message;
    switch(table_definition.table_type){
        case 'show':
        case 'edit':
            message = 'Role ' + server_response_data.data[0].name;
            break;
        case 'create':
            message = 'New Role'
            break;
    }
    //modify the page if it is an admin

    if(server_response_data.data[0].id == 1){
        message = 'Admin Role - No Editing is possible'
        table_definition.record_table_buttons = [];
        view_table_definition.dynamic_table_buttons = [];
    }
    h.innerHTML = message;
    div.appendChild(h);
    div.appendChild(view.recordTable());
    $(function () {
        controller.loadPageEvent.notify();
    });

    //now we need a table on the show page
    //view name + checkbox

    div.appendChild(views_view.dataTable());


    return div;
}