export default function (component, awesomeTable) {
    let column_definition = [
        {
            "db_field": "id",
            "caption": "Id",
            "type": "link",
            "route": "accounts",
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
            "db_field": "date",
            "caption": "Date",
            "type": "date",
            "th_width": "150px",
            "search": true,
            "search_default": "",
        }, {
            "db_field": "employee_name",
            "caption": "Employee Name",
            "type": "text",
            "show_on_list": false,
            "show_on_view": false,
            "show_on_edit": false,
            "show_on_create": false,
            "th_width": "150px",
            "search": true,
        },  {
            "db_field": "number_of_employees",
            "caption": "Number of Employees",
            "th_width": "150px",
        },{
            "db_field": "total_regular_hours",
            "caption": "Total <br> Regular Hours",
            "type": "number"
        },
        {
            "db_field": "total_pay",
            "caption": "Total Pay",
            "type": "number",
        },
        {
            "db_field": "eftps_depsit",
            "caption": "EFTPS Deposit",
            "type": "number",
        },
        {
            "db_field": "eftps_confirmation",
            "caption": "Confirmation",
            "type": "text",
        },


    ];
    return column_definition;
}