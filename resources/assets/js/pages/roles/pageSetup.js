import {search} from './search';
import {show} from './show';

export function pageSetup(server_response_data) {

    let column_definition = [
        {
            "db_field": "id",
            "caption": "Id",
            "type": "link",
            "route": "roles",
            "show_on_list": true,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "th_width": 80,
            "events": [],
            "search": "LIKE ANY BETWEEN EXACT",
            "properties": [],
            "word_wrap": true,
            "post": true
        },
        {
            "db_field": "parent_role_id",
            "caption": "Parent Role Id",
            "type": "select",
            "select_values": server_response_data.roles,
            "show_on_list": true,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "th_width": 80,
            "events": [],
            "search": "LIKE ANY BETWEEN EXACT",
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
            "td_tags": "",
            "class": "",
            "events": [],
            "search": "LIKE ANY BETWEEN EXACT",
            "properties": [],
            "word_wrap": true,
            "post": true
        }, {
            "db_field": "timeout_minutes",
            "caption": "timeout_minutes",
            "type": "number",
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,

            "default_value": "120",
            "events": [],
            "properties": [],
            "post": true
        }, {
            "db_field": "ip_address_restrictions",
            "caption": "ip_address_restrictions",
            "type": "text",
            "default_value": "Add ip addresses separated by ,",
            "show_on_list": false,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "events": [],
            "properties": [],
            "word_wrap": true,
            "post": true
        }, {
            "db_field": "max_connections",
            "caption": "max_connections",
            "type": "text",
            "default_value": "1",
            "show_on_list": true,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "class": "",
            "events": [],
            "properties": [],
            "word_wrap": true,
            "post": true
        }, {
            "db_field": "relogin_on_browser_change",
            "caption": "relogin_on_browser_change",
            "type": "checkbox",
            "default_value": "1",
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "events": [],
            "properties": [],
            "word_wrap": true,
            "post": true
        }, {
            "db_field": "relogin_on_ip_address_change",
            "caption": "relogin_on_ip_address_change",
            "type": "checkbox",
            "default_value": "1",
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "events": [],
            "properties": [],
            "post": true
        }, {
            "db_field": "restrict_to_terminal_access",
            "caption": "restrict_to_terminal_access",
            "type": "checkbox",
            "default_value": "0",
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "events": [],
            "properties": [],
            "word_wrap": true,
            "post": true
        }, {
            "db_field": "allow_edit_invoice_details",
            "caption": "allow_edit_invoice_details",
            "type": "checkbox",
            "default_value": 1,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "events": [],
            "properties": [],
            "post": true
        }, {
            "db_field": "allow_edit_closed_invoice",
            "type": "checkbox",
            "default_value": 0,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
        }, {
            "db_field": "allow_voids",
            "caption": "allow_voids",
            "type": "checkbox",
            "default_value": false,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
        }, {
            "db_field": "allow_refunds",
            "caption": "allow_refunds",
            "type": "checkbox",
            "default_value": true,
            "show_on_list": false,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
        }, {
            "db_field": "max_discount_percent",
            "type": "number",
            "default_value": "10",
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
        }, {
            "db_field": "edit_closed_contents",
            "type": "checkbox",
            "default_value": "false",
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
        }, {
            "db_field": "edit_closed_payments",
            "type": "checkbox",
            "default_value": "true",
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
        }, {
            "db_field": "edit_closed_customer",
            "type": "checkbox",
            "default_value": 0,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
        }, {
            "db_field": "allow_other_payment",
            "type": "checkbox",
            "default_value": 0,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
        }, {
            "db_field": "allow_cc_return",
            "type": "checkbox",
            "default_value": 0,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
        }, {
            "db_field": "allow_advanced_return",
            "type": "checkbox",
            "default_value": 0,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
        }, {
            "db_field": "open_close_terminal",
            "type": "checkbox",
            "default_value": 0,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
        }, {
            "db_field": "po_max_open_past_cancel",
            "type": "number",
            "default_value": 10,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
        }, {
            "db_field": "po_max_received_not_invoiced",
            "type": "number",
            "default_value": 10,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
        }, {
            "db_field": "active",
            "type": "checkbox",
            "default_value": "true",
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
        }, {
            "db_field": "comments",
            "caption": "comments",
            "type": "textarea",
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "search": "LIKE ANY BETWEEN EXACT",
            "word_wrap": true,
        },];
    let table_definition = {
        "name": "table",
        "access": "READ",
        "record_table_buttons": ['edit'],
        "dynamic_table_buttons": ['addRow', 'deleteRow', 'deleteAllRows', 'moveRows', 'copyRows', 'edit'],
        "table_type": "KEY_VALUE INDEX",
        "route": "/roles",
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




