import {search} from './search';
import {show} from './show';

export function pageSetup(server_response_data) {
    let employee_select_values = [];
    let column_definition = [
        {
            "db_field": "id",
            "caption": "Id",
            "type": "link",
            "route": "/users",
            "show_on_list": true,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "th_width": "80px",
            "events": [],
            "search": "LIKE ANY BETWEEN EXACT",
            "properties": [],
            "word_wrap": true,
        }, {
            "db_field": "role_id",
            "caption": "Role",
            "type": "tree_select",
            "select_values": server_response_data.roles,
            "default_value":'null',
            "show_on_list": true,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "events": [],
            "search": "LIKE ANY BETWEEN EXACT",
            "properties": [],
        },

         {
            "db_field": "username",
            "caption": "Username",
             "placeholder":"firstname.lastname",
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
            "properties": [],
            "word_wrap": true,
            "post": true
        },
        {
            "db_field": "password",
            "caption": "Password",
            "type": "text",
            "show_on_list": false,
            "show_on_view": false,
            "show_on_edit": false,
            "show_on_create": true,
            "th_width": "150px",
            "td_tags": "",
            "class": "",
            "events": [],
            "properties": [],
            "word_wrap": true,
            "post": true
        },
        {
            "db_field": "password_confirmation",
            "caption": "Password Confirmation",
            "type": "text",
            "show_on_list": false,
            "show_on_view": false,
            "show_on_edit": false,
            "show_on_create":true,
            "th_width": "150px",
            "td_tags": "",
            "class": "",
            "events": [],
            "properties": [],
            "word_wrap": true,
            "post": true
        },
        {
            "db_field": "passcode",
            "caption": "Passcode",
            "type": "text",
            "show_on_list": false,
            "show_on_view": false,
            "show_on_edit": true,
            "show_on_create": true,
            "th_width": "150px",
            "td_tags": "",
            "class": "",
            "events": [],
            "properties": [],
            "word_wrap": true,
            "post": true
        },
        {
            "db_field": "passcode_confirmation",
            "caption": "Passcode Confirmation",
            "type": "text",
            "show_on_list": false,
            "show_on_view": false,
            "show_on_edit": true,
            "show_on_create":true,
            "th_width": "150px",
            "td_tags": "",
            "class": "",
            "events": [],
            "properties": [],
            "word_wrap": true,
            "post": true
        },
        {
            "db_field": "employee_id",
            "caption": "Employee",
            "type": "select",
            "select_values": employee_select_values,
            "default_value": "null",
            "show_on_list": true,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "th_width": "80px",
            "td_tags": "",
            "class": "",
            "events": [],
            "properties": [],
            "word_wrap": true,
        },
        {
            "db_field": "active",
            "caption": "Active",
            "default_value": 1,
            "type": "checkbox",
            "show_on_list": true,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "th_width": "80px",
            "td_tags": "",
            "class": "",
            "events": [],
            "search": "LIKE ANY BETWEEN EXACT",
            "properties": [],
            "word_wrap": true,
            "post": true
        },
        // {
        //     "db_field": "email",
        //     "caption": "Email",
        //     "type": "text",
        //     "show_on_list": true,
        // "show_on_view": true,
        //     "show_on_edit": true,
        //     "show_on_create": true,
        //     "th_width": "150px",
        //     "td_tags": "",
        //     "class": "",
        //     "events": [],
        //     "search": "LIKE ANY BETWEEN EXACT",
        //     "properties": [],
        //     "word_wrap": true,
        //     "post": true
        // },
    ];

    let table_definition = {
        "name": "user_table",
        "access": "READ",
        "record_table_buttons": ['edit'],
        "dynamic_table_buttons": ['addRow', 'deleteRow', 'deleteAllRows', 'moveRows', 'copyRows', 'edit'],
        "table_type": "KEY_VALUE INDEX",
        "route": "/users",
        "footer": [],
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




