import {search} from './search';
import {show} from './show';

export function pageSetup(server_response_data) {

    let column_definition = [
        {
            "db_field": "id",
            "type": "link",
            "route": "vendors",
            "caption": "Id",
            "default_value": '',
            "show_on_list": true,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "td_tags": "",
            "th_width": "40px",
            "class": "",
            "events": [],
            "search": "LIKE ANY BETWEEN EXACT",
            "properties": [],
            "word_wrap": true
        },
        {
            "db_field": "name",
            "type": "text",
            "caption": "name",
            "array": 0,
            "default_value": '',
            "show_on_list": true,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "td_tags": "",
            "class": "",
            "events": [],
            "search": "LIKE ANY BETWEEN EXACT",
            "properties": [],
            "word_wrap": true
        }, {
            "db_field": "check_name",
            "type": "text",
            "caption": "Check Name",
            "array": 0,
            "default_value": '',
            "show_on_list": false,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "td_tags": "",
            "class": "",
            "events": [],
            "properties": [],
            "word_wrap": true
        }, {
            "db_field": "account_number",
            "caption": "Account Number",
            "type": "text",
            "array": 0,
            "default_value": '',
            "show_on_list": true,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "td_tags": "",
            "class": "",
            "events": [],
            "search": "LIKE ANY BETWEEN EXACT",
            "properties": [],
            "word_wrap": true,
            "th_width": "200px",

        },
        {
            "db_field": "main_email",
            "caption": "Email",
            "type": "text",
            "array": 0,
            "default_value": '',
            "show_on_list": true,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "td_tags": "",
            "class": "",
            "events": [],
            "properties": [],
            "word_wrap": true
        },
        {
            "db_field": "cc_email",
            "caption": "CC Email",
            "type": "text",
            "array": 0,
            "default_value": '',
            "show_on_list": false,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "td_tags": "",
            "class": "",
            "events": [],
            "properties": [],
            "word_wrap": true
        }, {
            "db_field": "main_phone",
            "caption": "Phone #",
            "type": "text",
            "array": 0,
            "default_value": '',
            "show_on_list": true,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "td_tags": "",
            "class": "",
            "events": [],
            "properties": [],
            "word_wrap": true
        }, {
            "db_field": "work_phone",
            "caption": "Work Phone #",
            "type": "text",
            "array": 0,
            "default_value": '',
            "show_on_list": false,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "td_tags": "",
            "class": "",
            "events": [],
            "properties": [],
            "word_wrap": true
        }, {
            "db_field": "mobile",
            "caption": "Mobile #",
            "type": "text",
            "array": 0,
            "default_value": '',
            "show_on_list": false,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "td_tags": "",
            "class": "",
            "events": [],
            "properties": [],
            "word_wrap": true
        }, {
            "db_field": "fax",
            "caption": "Fax #",
            "type": "text",
            "array": 0,
            "default_value": '',
            "show_on_list": false,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "td_tags": "",
            "class": "",
            "events": [],
            "properties": [],
            "word_wrap": true
        }, {
            "db_field": "active",
            "caption": "Active",
            "type": "checkbox",
            "array": 0,
            "default_value": 1,
            "show_on_list": true,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "td_tags": "",
            "th_width": "80px",
            "class": "",
            "events": [],
            "search": "LIKE ANY BETWEEN EXACT",
            "properties": [],
            "word_wrap": true
        }, {
            "db_field": "billing_address",
            "caption": "Billing Address",
            "type": "textarea",
            "array": 0,
            "default_value": '',
            "show_on_list": true,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "td_tags": "",
            "class": "",
            "events": [],
            "th_width": "200px",
            "properties": [],
            "word_wrap": true
        }, {
            "db_field": "shipping_address",
            "caption": "Shipping Address",
            "type": "textarea",
            "array": 0,
            "default_value": '',
            "show_on_list": false,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "td_tags": "",
            "class": "",
            "events": [],
            "properties": [],
            "word_wrap": true
        }, {
            "db_field": "comments",
            "caption": "Comments",
            "type": "textarea",
            "array": 0,
            "default_value": '',
            "show_on_list": true,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "td_tags": "",
            "class": "",
            "events": [],
            "properties": [],
            "word_wrap": true
        },
    ];
    let table_definition = {
        "name": "vendor_table",
        "access": "READ",
        "record_table_buttons": ['edit'],
        "dynamic_table_buttons": ['addRow','deleteRow','deleteAllRows', 'moveRows','copyRows','edit'],
        "table_type": "KEY_VALUE INDEX",
        "route": "/vendors",
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




