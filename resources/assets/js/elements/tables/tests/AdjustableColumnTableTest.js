import {DataTableView} from '../DataTableView';
import {DataTableController} from '../DataTableController';
import {TableModel} from '../TableModel';
import {TableEvent} from '../TableEvent'
import * as math from '../math'


export function AdjustableColumnTableTest() {
    let div = document.createElement('div');
    let h = document.createElement('h2');
    h.innerHTML = `
variable column

`

    div.appendChild(h);

    let name = 'test_table3'
    let column_definition = [
        {
            "db_field": "row_checkbox",
            "caption": "",
            "type": "row_checkbox",
            "array": false,
            "default_value": false,
            "show_on_list": true,
             "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "th_width": 10,
            "td_tags": "",
            "class": "",
            "events": [],
            "search": "LIKE ANY BETWEEN EXACT",
            "properties": [],
            "round": 0,
            "word_wrap": true
        },
        {
            "db_field": "row_number",
            "caption": "row",
            "type": "row_number",
            "array": false,
            "default_value": false,
            "show_on_list": true,
             "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "th_width": 10,
            "td_tags": "",
            "class": "",
            "events": [],
            "search": "LIKE ANY BETWEEN EXACT",
            "properties": [],
            "round": 0,
            "word_wrap": true
        },
        {
            "db_field": "id",
            "caption": "id",
            "type": "html",
            "array": false,
            "default_value": '',
            "show_on_list": true,
             "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "th_width": '',
            "td_tags": "",
            "class": "",
            "events": [],
            "search": "LIKE ANY BETWEEN EXACT",
            "properties": [],
            "round": 0,
            "word_wrap": true
        },
        {
            "db_field": "sizes",
            "caption": [["XS", "S", "M", "L", ""], ["40", "42", "44", "46", ""], ["1", "2", "3", "4", "5"]],
            //caption should be json or decoded json
            "type": "number",
            "array": true,
            "default_value": '1',
            "show_on_list": true,
             "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "th_width": '10px',
            "td_tags": "",
            "class": "",
            "events": [{"keyup": "updateQuantity"}],
            "search": "LIKE ANY BETWEEN EXACT",
            "properties": [],
            "word_wrap": true
        },
        {
            "db_field": "qty",
            "caption": "Quantity",
            "type": "text",
            "array": false,
            "default_value": '',
            "show_on_list": true,
             "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "th_width": '',
            "td_tags": "",
            "class": "",
            "events": [],
            "search": "LIKE ANY BETWEEN EXACT",
            "properties": [{"readOnly": true}],
            "total": 2,
            "round": 2,
            "word_wrap": true
        },
    ]
    let table_definition = {
        "name": name,
        "access": "Write",
        "dynamic_table_buttons": ['addRow','deleteRow','deleteAllRows', 'moveRows','copyRows', 'addColumn', 'deleteColumn', 'edit'],

        "table_type": "KEY_VALUE INDEX",
        "post_url": "test",
        "footer": [],
        "header": [],
        "column_definition": column_definition,
    }
    let data = [
        {
            "id": 1,
            "sizes": [1, 2, 3, 4, 5],
            "input": "hi",
        },

    ]
    let buttons = [
        {
            "value": "Add Column",
            "event_name": "addColumn"
        },
        {
            "value": "Delete Column",
            "event_name": "deleteColumn"
        },
        {
            'class': "thin_button",
            'width': "160px",
            'value': "Write",
            'event_name': 'makeTableWriteable',

        },
        {
            'class': "thin_button",
            'width': "160px",
            'value': "Read",
            'event_name': 'makeTableReadable',

        },
        {
            'class': "thin_button",
            'width': "160px",
            'value': "Add Row",
            'event_name': 'addRowClicked',

        },
        {
            'class': "thin_button",
            'value': "Delete Row(s)",
            'event_name': 'deleteRowClicked',

        },
        {
            'class': "thin_button",
            'value': "Move Row(s) Up",
            'event_name': 'moveRowUpClicked',
        },
        {
            'class': "thin_button",
            'value': "Move Row(s) Down",
            'event_name': 'moveRowDownClicked',

        },
        {
            'class': "thin_button",
            'value': "Copy Row(s)",
            'event_name': 'copyRowClicked',

        },
        {
            'class': "thin_button",
            'value': "Delete All Rows",
            'event_name': 'deleteAllClicked',

        }

    ];

    let model = new TableModel(table_definition, data);
    let view = new DataTableView(model, buttons);
    let controller = new DataTableController(model, view);


    view.updateQuantity = new TableEvent(view);
    controller.view.updateQuantity.attach(
        function (sender, event) {
           //third attempt. After the view renders calculate row totals
            console.log('updateQuantityEvent');
            view.elements.forEach((row, r) => {
                let sum = 0;
                row.sizes.forEach(size => {
                    sum += math.myParseFloat(size.value);
                })
                view.elements[r]['qty'].value = sum;
            });
            //unfortunately we need to update the header/footer again....

            controller.copyTable();
            view.updateTotalsBody();


            // method one to find the element
            //on model change sum up the rows
            //this will not work because....
            //addrow from controller
            //add row to model
            //model notifies the change
            //this code then goes through the view which has not changed
            //controller updates the view

            //therefore we need to operate on the model itself
            //but the model re-renders the view and we do not want to touch that..... hmmmm


            // let element = event.target;
            // let row = controller.getElementRow(element);
            // let sum = 0;
            // controller.view.elements[row]['sizes'].forEach(size =>{
            //     sum += math.myParseFloat(size.value);
            // });
            // controller.view.elements[row]['qty'].value = sum;
            // controller.copyTable();


            //we could update the view, but we should update the model
            //Method 1 - interferes with user input
            //controller.copyTable() is already fired onkeyup
            // controller.model.tdo[row].sizes.data.forEach(size =>{
            //     sum += math.myParseFloat(size);
            // });
            // controller.model.tdo[row]['qty']['data'] = sum;
            // controller.model.modelChanged.notify(); //re-render of the table will occur

            //method 2... works like a charm


        }
    );
    view.dataTableChanged.attach(function () {
        console.log('datatable changed')
        //this should fire whenever we say updateTable
        //there are no elements...
        view.updateQuantity.notify();
    });

    div.appendChild(view.dataTable());
    // console.log(div)
    //view.updateQuantity.notify();
    //controller.setFocusToFirstInputOfRow(0);

    return div;
}