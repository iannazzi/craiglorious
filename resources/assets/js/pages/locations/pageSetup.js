import {search} from './search';
import {show} from './show';

export function pageSetup(server_response_data) {

    let column_definition = [
        {
            "db_field": "id",
            "caption": "Id",
            "type": "link",
            "route": "locations",
            "show_on_list": true,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "th_width": "150px",
            "td_tags": "",
            "class": "",
            "events": [],
            "search": "LIKE ANY BETWEEN EXACT",
            "search_default": "",
            "properties": [],
            "word_wrap": true,
            "post": true
        }, {
            "db_field": "parent_id",
            "caption": "Parent Location",
            "type": "select",

            "select_values": server_response_data.locations,
            "show_on_list": true,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "th_width": "150px",
            "td_tags": "",
            "class": "",
            "events": [],
            "search": "LIKE ANY BETWEEN EXACT",
            "search_default": "",
            "properties": [],
            "word_wrap": true,
            "post": true
        }, {
            "db_field": "name",
            "caption": "Name",
            "type": "text",
            "show_on_list": true,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "th_width": "150px",
            "td_tags": "",
            "class": "",
            "events": [],
            "search": "LIKE ANY BETWEEN EXACT",
            "search_default": "",
            "properties": [],
            "word_wrap": true,
            "post": true
        }, {
            "db_field": "barcode",
            "caption": "Barcode",
            "type": "text",
            "show_on_list": true,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "th_width": "150px",
            "td_tags": "",
            "class": "",
            "events": [],
            "search": "LIKE ANY BETWEEN EXACT",
            "search_default": "",
            "properties": [],
            "word_wrap": true,
            "post": true
        }, {
            "db_field": "active",
            "caption": "Active",
            "type": "checkbox",
            "default_value": "1",
            "show_on_list": true,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "th_width": "150px",
            "td_tags": "",
            "class": "",
            "events": [],
            "search": "LIKE ANY BETWEEN EXACT",
            "search_default": "",
            "properties": [],
            "word_wrap": true,
            "post": true
        }, {
            "db_field": "comments",
            "caption": "Comments",
            "type": "textarea",
            "show_on_list": true,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "th_width": "150px",
            "td_tags": "",
            "class": "",
            "events": [],
            "search": "LIKE ANY BETWEEN EXACT",
            "search_default": "",
            "properties": [],
            "word_wrap": true,
            "post": true
        }];
    let table_definition = {
        "name": "locations_table",
        "access": "READ",
        "record_table_buttons": ['edit'],
        "dynamic_table_buttons": ['addRow', 'deleteRow', 'deleteAllRows', 'moveRows', 'copyRows', 'edit'],
        "table_type": "KEY_VALUE INDEX",
        "route": "/locations",
        "footer": [],
        "header": [],
        "column_definition": column_definition,
    };

    switch (server_response_data.page) {
        case 'show':
            table_definition.table_type = 'show';
            return show(table_definition, server_response_data);
            break;
        case 'create' :
            table_definition.table_type = 'create';
            return show(table_definition, server_response_data);
            break;
        case 'edit' :
            table_definition.table_type = 'edit';
            return show(table_definition, server_response_data);
            break;
        case 'index':
            table_definition.table_type = 'index';
            return search(table_definition, server_response_data)

            break;
        default:
            return document.createTextNode('Wrong page sent in ... ' + data.page);
    }
}




