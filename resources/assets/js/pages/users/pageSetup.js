import {search} from './search';
import {show} from './show';

export function pageSetup(server_response_data) {

    let table_definition = {
        "name": "user_table",
        "access": "READ",
        "record_table_buttons": ['edit'],
        "dynamic_table_buttons": ['addRow', 'deleteRow', 'deleteAllRows', 'moveRows', 'copyRows', 'edit'],
        "table_view": "KEY_VALUE INDEX",
        "route": "/users",
        "footer": [],
        "column_definition": column_definition,
    };

    switch (server_response_data.page) {
        case 'show':
            table_definition.table_view = 'show';
            return show(table_definition, server_response_data);
            break;
        case 'create' :
            table_definition.table_view = 'create';
            return show(table_definition, server_response_data);
            break;
        case 'edit' :
            table_definition.table_view = 'edit';
            return show(table_definition, server_response_data);
            break;
        case 'index':
            table_definition.table_view = 'index';
            return search(table_definition, server_response_data)

            break;
        default:
            return document.createTextNode('Wrong page sent in ... ' + data.page);
    }
}




