/**
 * Created by embrasse-moi on 2/2/17.
 */
import {SearchTableView}  from '../../elements/tables/SearchTableView';
import {SearchTableController}  from '../../elements/tables/SearchTableController';
import {TableModel}  from '../../elements/tables/TableModel';

export function search(table_definition, server_response_data) {


    let new_message = 'New User';
    let model = new TableModel(table_definition, server_response_data.data),
        view = new SearchTableView(model),
        controller = new SearchTableController(model, view, server_response_data.number_of_records_available);


    // if(server_response_data.data[0].id == 1){
    //     //no delete option on the user
    //     table_definition.record_table_buttons= ['edit', ''];
    // }

    let div = document.createElement('div');
    let h2 = document.createElement('h2');
    h2.innerHTML= 'Listing is restricted to users with roles below ' + server_response_data.user.role.name;
    h2.className = 'bg-warning';
    if(! server_response_data.user.isAdmin) div.appendChild(h2);
    div.appendChild(view.createNewButton(new_message));
    div.appendChild(view.searchTable());
    $(function () {
        controller.loadPageEvent.notify();
    });
    //let the search controller handle the data table div.appendChild(view.dataTable());
    return div;
}