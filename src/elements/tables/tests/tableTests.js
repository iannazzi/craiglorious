import {DataTableTest} from './DataTableTest'
import {AdjustableColumnTableTest} from './AdjustableColumnTableTest'
import {RecordTableTest} from './RecordTableTest'

export function tableTests() {
    let div = document.createElement('div');
    let template = `
        <div id="data_table"></div>
        <div id="edit_record"></div>
        <div id="create_record"></div>
        <div id="adjustable_col_table"></div>
        <div id="test6"></div>
        <div id="test7"></div>
        <div id="test8"></div>
        <div id="test9"></div>
        <div id="test10"></div>
   
`;
    let select_values = [
        {
            'value': 1,
            'name': 'liliana'
        },
        {
            'value': 2,
            'name': 'two'
        }, {
            'value': 3,
            'name': 'three'
        }, {
            'value': 4,
            'name': 'four'
        }, {
            'value': 5,
            'name': 'five'
        }, {
            'value': 6,
            'name': 'six'
        }, {
            'value': 7,
            'name': 'seven'
        }, {
            'value': 8,
            'name': 'eight'
        }, {
            'value': 9,
            'name': 'nine'
        },
    ]
    let tree_select = [
            {
                "name": "one",
                "value": "1",
                "children": [
                    {"name": "one_child_one", "value": "1_1"},
                    {"name": "one_child_two", "value": "1_2"},
                ]
            },
            {
                "name": "two",
                "value": "2",
                "children": [
                    {"name": "two_child_one", "value": "2_1"},
                    {"name": "two_child_two", "value": "2_2"}
                    ]
            }

        ]
    console.log(tree_select);


//table with basic elements
        let
    column_definition = [
        {
            "db_field": "row_checkbox",
            "caption": "",
            "type": "row_checkbox",
            "array": false,
            "default_value": false,
            "show_on_list": true,
            "show_on_view": true,
            "show_on_edit": false,
            "show_on_create": false,
            "th_width": 10,
            "td_tags": "",
            "class": "",
            "events": [],
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
            "show_on_view": false,
            "show_on_edit": false,
            "show_on_create": false,
            "th_width": 10,
            "td_tags": "",
            "class": "",
            "events": [],
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
            "db_field": "test",
            "caption": "test",
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
            "db_field": "text_number",
            "caption": "Rounded Text Number",
            "type": "html",
            "array": false,
            "default_value": '0.00',
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
            "round": 2,
            "total": 0,
            "word_wrap": true
        },

        {
            "db_field": "input_number",
            "caption": "Number",
            "type": "number",
            "array": false,
            "default_value": '0.00',
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
            "round": 2,
            "total": 3,
            "word_wrap": true
        },
        {
            "db_field": "input_text",
            "caption": "text",
            "type": "text",
            "array": false,
            "default_value": 'default value',
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
            "round": 2,
            "word_wrap": true
        },
        {
            "db_field": "date",
            "caption": "date",
            "type": "date",
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
            "word_wrap": true
        },
        {
            "db_field": 'select',
            "caption": "select",
            "type": "select",
            'array': false,
            'default_value': 'default value is set',
            "show_on_list": true,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "th_width": 10,
            "td_tags": '',
            "class": '',
            "events": [],
            "select_values": select_values,
            "search": "LIKE ANY BETWEEN EXACT",
            "properties": [],
            "total": 0,
            "round": 0,
            'word_wrap': true
        },
        {
            "db_field": 'individual_select',
            "caption": "Individual Select",
            "type": "select",
            'array': false,
            'default_value': 'default value is set',
            "show_on_list": true,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "th_width": 10,
            "td_tags": '',
            "class": '',
            "events": [],
            "individual_select_options": true,
            "select_values": select_values,
            "search": "LIKE ANY BETWEEN EXACT",
            "properties": [],
            "total": 0,
            "round": 0,
            'word_wrap': true
        },
        {
            "db_field": 'tree_select',
            "caption": "Tree Select",
            "type": "tree_select",
            'array': false,
            'default_value': 'default value is set',
            "show_on_list": true,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "th_width": 10,
            "td_tags": '',
            "class": '',
            "events": [],
            "individual_select_options": true,
            "select_values": tree_select,
            "search": "LIKE ANY BETWEEN EXACT",
            "properties": [],
            "total": 0,
            "round": 0,
            'word_wrap': true
        }, {
            "db_field": "checkbox",
            "caption": "Checkbox",
            "type": "checkbox",
            "array": false,
            "default_value": '0.00',
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
            "word_wrap": true
        },
        {
            "db_field": "radio",
            "type": "radio",
            "caption": "Radio",
            "array": false,
            "default_value": '0.00',
            "show_on_list": true,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "th_width": '',
            "td_tags": "",
            "class": "",
            "events": [],
            "properties": [],
            "word_wrap": true
        },
        {
            "db_field": "link",
            "caption": "Link",
            "type": "link",
            "route": "vendors",
            "url_caption": "hello",
            "get_url_link": "vendors",
            "get_id_link": "id",
            "array": false,
            "default_value": '0.00',
            "show_on_list": true,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "th_width": '',
            "td_tags": "",
            "class": "",
            "events": [],
            "properties": [],
            "round": 2,
            "total": 2,
            "word_wrap": true
        },
        {
            "db_field": "button",
            "caption": "Button",
            "type": "button",
            "button_caption": "button",
            "array": false,
            "default_value": '0.00',
            "show_on_list": true,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "th_width": '',
            "td_tags": "",
            "class": "",
            "events": [],
            "properties": [],
            "word_wrap": true
        },
        {
            "db_field": "textarea",
            "caption": "Text Area",
            "type": "textarea",
            "array": false,
            "default_value": 'Text Area',
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
            "round": 2,
            "total": 2,
            "word_wrap": true
        },
    ]

    let data = [
        {
            "id": 1,
            "invoice_number": '1234',
            "test": "Should Read 1.15",
            "text_number": 1.154,
            "input_number": 1.154,
            "input_text": "Should Read 1.15",
            "date": "2016-01-01",
            "select": "1",
            "radio": false,
            "individual_select": "3",
            "tree_select": "1",
            "link": 1,
            "button": 1,
            "checkbox": true,
            "textarea": `123 address lane
            apt# 12
Pittsford, NY 14534`

        }, {
            "id": 2,
            "invoice_number": 36,
            "test": "Should Read 1.16",
            "text_number": 1.155,
            "input_number": 1.155,
            "input_text": "Should Read 1.16",
            "date": "2015-01-02",
            "select": "2",
            "individual_select": "4",
            "tree_select": "2",
            "radio": true,
            "checkbox": 0,

            "link": 2,
            "button": 2,


        },
        {
            "id": 3,
            "invoice_number": 37,
            "test": "Should Read 10.00",
            "text_number": 9.99,
            "input_number": 9.99,
            "input_text": "Should Read 10.00",
            "date": "2015-01-03",
            "select": "9",
            "individual_select": "9",
            "tree_select": "1_2",
            "link": 3,
            "button": 3,
            "checkbox": false,


        },
    ]
    let t1 = DataTableTest(column_definition, data);
    div.appendChild(t1);
    let t2 = RecordTableTest(column_definition, [data[0]]);

    div.appendChild(t2);
    let t3 = RecordTableTest(column_definition, []);
    div.appendChild(t3);
    let t4 = AdjustableColumnTableTest();
    div.appendChild(t4);
    return div;
}