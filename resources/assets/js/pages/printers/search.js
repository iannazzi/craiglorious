/**
 * Created by embrasse-moi on 2/2/17.
 */
import {SearchTableView}  from '../../elements/tables/SearchTableView';
import {SearchTableController}  from '../../elements/tables/SearchTableController';
import {TableModel}  from '../../elements/tables/TableModel';

export function search(table_definition, server_response_data) {




    let model = new TableModel(table_definition, server_response_data.data),
        view = new SearchTableView(model),
        controller = new SearchTableController(model, view, server_response_data.number_of_records_available);

    let div = document.createElement('div');


    div.appendChild(view.createNewButton('New Printer'));
    div.appendChild(view.searchTable());
    $(function () {
        controller.loadPageEvent.notify();
    });
    //let the search controller handle the data table div.appendChild(view.dataTable());
    return div;
}