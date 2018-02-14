export default function (component, awesomeTable) {
    let column_definition = [{
        "db_field": "id",
        "caption": "Id",
        "type": "link",
        "onClick": function (id) {
            component.$router.push(component.route + '/' + id)
        },
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
    },
        {
            "db_field": "employee_id",
            "caption": "Employee Id",
            "type": "select",
            "placeholder": false,
            "select_values": component.data.employees,
            "show_on_list": true,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "th_width": "150px",
            "td_tags": "",
            "class": "",
            "events": [{"change":function(){
                let empname = awesomeTable.controller.getSelectValueName('employee_id', awesomeTable.model.tdo[0].employee_id.data);
                console.log(empname);
                awesomeTable.controller.updateCellValue('title', 'Shift: ' + empname, 0)
            }}],

            "search": "LIKE ANY BETWEEN EXACT",
            "properties": [],
            "word_wrap": true,
            "post": true
        }, {
            "db_field": "title",
            "caption": "Title",
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
        },  {
            "db_field": "start",
            "caption": "Start",
            "type": "text",
            "placeholder": "YYYY-MM-DD HH:MM 24 Hour Format (sorry!)",
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
            "db_field": "end",
            "caption": "End",
            "placeholder": "YYYY-MM-DD HH:MM 24 Hour Format (sorry!)",
            "type": "text",
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
        },
        {
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
            "properties": [],
            "word_wrap": true,
            "post": true
        },
      ];

    return column_definition;
}