/**
 * Created by embrasse-moi on 1/23/17.
 */
import {RecordTableView} from '../RecordTableView';
import {RecordTableController}  from '../RecordTableController';
import {TableModel}  from '../TableModel';


export function RecordTableTest(column_definition, data) {


    //we need to be able to put the

    let div2 = document.createElement('div');

    let h = document.createElement('h2');
    h.innerHTML = `
Individual create edit view

`
    div2.appendChild(h);


    let name = 'show_edit_create'
    let table_definition = {
        "name": name,
        "access": "Write",
        "record_table_buttons": ['edit'],
        "table_type": "show",
        "post_url": "test",
        "footer": [],
        "header": [],
        "column_definition": column_definition,
    }



    let model = new TableModel(table_definition, data),
        view = new RecordTableView(model),
        controller = new RecordTableController(model, view);

    div2.appendChild(view.recordTable());
    $(function () {
        controller.loadPageEvent.notify();
    });


    //now test
    // view.addRowClicked.notify();
    // view.checkRows([1,2]);
    // view.moveRowUpClicked.notify();
    // view.moveRowDownClicked.notify();
    // view.copyRowClicked.notify();
    // view.deleteRowClicked.notify(false);

    //console.log(model.tdo);

    return div2;


}