import {search} from './search';
import {show} from './show';

export function pageSetup(server_response_data) {

    let column_definition = [
        {
        "db_field": "id",
        "caption": "Id",
        "type": "link",
        "placeholder": false,
        "route": "terminals",
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
        "route": "terminals",
        "select_values": "use with select",
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
    },  {
        "db_field": "status",
        "caption": "Status",
        "type": "select",
        "placeholder": false,
        "route": "terminals",
        "select_values": [{'value':'open','name':'Open'},{'value':'closed','name':'Closed'},{'value':'locked','name':'Locked'}],
        "default_value": "open",
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
    },  {
        "db_field": "description",
        "caption": "Description",
        "type": "textarea",
        "placeholder": false,
        "select_values": "use with select",
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
        "placeholder": false,
        "route": "terminals",
        "select_values": "use with select",
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
    }, ];
    let table_definition = {
        "name": "terminals_table",
        "access": "READ",
        "record_table_buttons": ['edit'],
        "dynamic_table_buttons": ['addRow', 'deleteRow', 'deleteAllRows', 'moveRows', 'copyRows', 'edit'],
        "table_view": "KEY_VALUE INDEX",
        "route": "/terminals",
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




