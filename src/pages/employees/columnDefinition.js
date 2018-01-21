export default function(component){
    let column_definition = [
        {
            "db_field": "id",
            "caption": "Id",
            "type": "link",
            "onClick":  function(id){
                component.$router.push(component.route + '/' + id)
            },
            "route": "employees",
            "show_on_list": true,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "th_width": "150px",
            "td_tags": "",
            "class": "",
            "events": [],
            "properties": [],

            "search_default": "",
            "word_wrap": true,
            "post": true
        }, {
            "db_field": "full_name",
            "caption": "Full Name",
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
        },
        {
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

            "search_default": "0",
            "properties": [],
            "word_wrap": true,
            "post": true
        }, ];

    return column_definition;
}