/**
 * Created by embrasse-moi on 2/2/17.
 */
import {SearchTableView}  from '../../elements/tables/SearchTableView';
import {SearchTableController}  from '../../elements/tables/SearchTableController';
import {TableModel}  from '../../elements/tables/TableModel';

export function search(table_definition, server_response_data) {

    console.log(table_definition)
    let div = document.createElement('div');

    let model = new TableModel(table_definition, server_response_data.data),
        view = new SearchTableView(model),
        controller = new SearchTableController(model, view, server_response_data.number_of_records_available);
    div.appendChild(view.createNewButton('New Role'));
    div.appendChild(view.searchTable());
    $(function () {
        controller.loadPageEvent.notify();
    });
    //let the search controller handle the data table div.appendChild(view.dataTable());
    return div;
}