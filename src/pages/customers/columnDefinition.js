export default function(component){
    let column_definition = [
        {
            "db_field": "id",
            "caption": "Id",
            "type": "link",
            "onClick":  function(id){
                component.$router.push(component.route + '/' + id)
            },
            "route": "customers",
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
            "db_field": "first_name",
            "caption": "First Name",
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
            "db_field": "last_name",
            "caption": "Last Name",
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
        },
        {
            "db_field": "phone",
            "caption": "Phone",
            "type": "text",
            "show_on_list": true,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "th_width": "150px",
            "td_tags": "",
            "class": "",
            "events": [],
            "search_default": "",
            "search": "LIKE ANY BETWEEN EXACT",

            "properties": [],
            "word_wrap": true,
            "post": true
        },
        {
            "db_field": "email",
            "caption": "Email",
            "type": "text",
            "show_on_list": true,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "th_width": "150px",
            "td_tags": "",
            "class": "",
            "events": [],
            "search_default": "",
            "search": "LIKE ANY BETWEEN EXACT",

            "properties": [],
            "word_wrap": true,
            "post": true
        },
        {
            "db_field": "address1",
            "caption": "Address 1",
            "type": "text",
            "show_on_list": false,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "th_width": "150px",
            "td_tags": "",
            "class": "",
            "events": [],
            "search_default": "",

            "properties": [],
            "word_wrap": true,
            "post": true
        },
        {
            "db_field": "address2",
            "caption": "Address 2",
            "type": "text",
            "show_on_list": false,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "th_width": "150px",
            "td_tags": "",
            "class": "",
            "events": [],
            "search_default": "",

            "properties": [],
            "word_wrap": true,
            "post": true
        },
        {
            "db_field": "address3",
            "caption": "Address 3",
            "type": "text",
            "show_on_list": false,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "th_width": "150px",
            "td_tags": "",
            "class": "",
            "events": [],
            "search_default": "",

            "properties": [],
            "word_wrap": true,
            "post": true
        },
        {
            "db_field": "city",
            "caption": "City",
            "type": "text",
            "show_on_list": false,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "th_width": "150px",
            "td_tags": "",
            "class": "",
            "events": [],
            "search_default": "",

            "properties": [],
            "word_wrap": true,
            "post": true
        },
        {
            "db_field": "state_id",
            "caption": "State",
            "type": "select",
            "select_values" : component.data.states,
            "show_on_list": false,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "th_width": "150px",
            "td_tags": "",
            "class": "",
            "events": [],
            "search_default": "",

            "properties": [],
            "word_wrap": true,
            "post": true
        },
        {
            "db_field": "zip",
            "caption": "Zip code",
            "type": "text",
            "show_on_list": false,
            "show_on_view": true,
            "show_on_edit": true,
            "show_on_create": true,
            "th_width": "150px",
            "td_tags": "",
            "class": "",
            "events": [],
            "search_default": "",

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

            "search_default": 1,
            "properties": [],
            "word_wrap": true,
            "post": true
        }, ];

    return column_definition;
}