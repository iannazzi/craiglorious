import {search} from './search';
import {show} from './show';

export function pageSetup(server_response_data) {

    let column_definition = [
        {
            "db_field": "id",
            "caption": "Id",
            "type": "link",
            "placeholder": false,
            "route": "printers",
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
            "post": true
        }, {
            "db_field": "location_id",
            "caption": "Location Id",
            "type": "select",
            "select_values": [],
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
            "placeholder": false,
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
            "db_field": "description",
            "caption": "Description",
            "type": "text",
            "placeholder": false,
            "show_on_list": true,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "th_width": "150px",
            "td_tags": "",
            "class": "",
            "events": [],
            "properties": [],
            "word_wrap": true,
            "post": true
        }, {
            "db_field": "media",
            "caption": "Media",
            "type": "select",
            "select_values": server_response_data.media,
            "default_value": "default value is set",
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
            "default_value": 1,
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
            "post": true
        }];
    let table_definition = {
        "name": "printers_table",
        "access": "READ",
        "record_table_buttons": ['edit'],
        "dynamic_table_buttons": ['addRow', 'deleteRow', 'deleteAllRows', 'moveRows', 'copyRows', 'edit'],
        "table_view": "KEY_VALUE INDEX",
        "route": "/printers",
        "footer": [],
        "header": [],
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




