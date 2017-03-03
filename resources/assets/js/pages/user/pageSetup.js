import {search} from './search';
import {show} from './show';

export function pageSetup(server_response_data) {
    let employee_select_values = [];
    let column_definition = [

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
        "route": "/user",
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
            //no index

            break;
        default:
            return document.createTextNode('Wrong page sent in ... ' + data.page);
    }
}




