/**
 * Created by embrasse-moi on 1/23/17.
 */
import {CollectionTableView}  from '../CollectionTableView';
import {CollectionTableController}  from '../CollectionTableController';
import {RecordTableView}  from '../RecordTableView';
import {RecordTableController}  from '../RecordTableController';
import {TableModel}  from '../TableModel';
import * as math from '../math'
import {TableEvent} from '../TableEvent';


export function DataTableTest(column_definition, data) {


    let name = 'test_table2'
    let table_definition = {
        "name": name,
        "access": "edit",
        "dynamic_table_buttons": ['addRow','deleteRow','moveRows','deleteAllRows','copyRows','edit'],
        "table_view": "KEY_VALUE INDEX",
        "post_url": "test",
        "footer": [],
        "header": [],
        "column_definition": column_definition,
    }

    let options={};
    options.data = data;
    options.column_definition = column_definition;
    options.table_definition = table_definition;


    let model = new TableModel(options);
    let view = new RecordTableView(model);
    let controller = new RecordTableController(model, view);


    let div2 = document.createElement('div');
    let h = document.createElement('h2');
    h.innerHTML = `
test table: totals row, writable, barcode

`
    div2.appendChild(h);


    let p = document.createElement('p');
    p.innerHTML = 'Multiply amount by';
    div2.appendChild(p);
    let multiply = document.createElement('input');
    multiply.value = '';
    multiply.id = 'multiply';
    div2.appendChild(multiply);
    let btn = document.createElement('button');
    btn.innerHTML = 'Multiply Amount'
    div2.appendChild(btn);
    btn.onclick = function () {
        view.multiplyAmount.notify(multiply)
    }

    // view.multiplyAmount = new TableEvent(view);
    // controller.view.multiplyAmount.attach(
    //     function (sender, element) {
    //         view.elements.forEach((row, r) => {
    //             let mult = element.value;
    //             row.input_number.value = math.myParseFloat(row.input_number.value) * math.myParseFloat(mult);
    //         });
    //         view.inputChanged.notify();
    //     }
    // );

    div2.appendChild(view.createRecordTable());


    //now test
    // view.addRowClicked.notify();
    // view.checkRows([1,2]);
    // view.moveRowUpClicked.notify();
    // view.moveRowDownClicked.notify();
    // view.copyRowClicked.notify();
    // view.deleteRowClicked.notify(false);

    //console.log(model.tdo);

    // use awesome table/// return new this.AwesomeTable




    return div2;

}