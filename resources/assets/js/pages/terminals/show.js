/**
 * Created by embrasse-moi on 2/2/17.
 */
import {RecordTableView}  from '../../elements/tables/RecordTableView';
import {RecordTableController}  from '../../elements/tables/RecordTableController';
import {TableModel}  from '../../elements/tables/TableModel';

export function show(table_definition, server_response_data) {

    let model = new TableModel(table_definition, server_response_data.data),
        view = new RecordTableView(model),
        controller = new RecordTableController(model, view);

    let list_message = 'Back To List Of Terminals';
    let message;
    switch(table_definition.table_type){
        case 'show':
        case 'edit':
            message = 'Terminal: ' + server_response_data.data[0].name;
            break;
        case 'create':
            message = 'New Terminal';
            break;
    }



    let div = document.createElement('div');
    div.className = "recordTableView"

    let a =document.createElement('a');
    a.href = table_definition.route;
    a.role = 'button';
    a.className = 'btn-back';
    a.innerHTML = '<i class="fa fa-arrow-left"></i>' + list_message;
    $(div).append(a);
    div.appendChild(view.createNewButton('New Terminal'));
    let h = document.createElement('h2');
   h.innerHTML = message;
    div.appendChild(h);
    div.appendChild(view.recordTable());
    $(function () {
        controller.loadPageEvent.notify();
    });
    let register_div = document.createElement('div');
    register_div.className = 'container';
    let register_button = document.createElement('button');
    register_button.innerHTML= 'Register Your Device as ' + server_response_data.data[0].id;
    register_button.onclick = function(){

        document.cookie =   "terminal=" + server_response_data.data[0].id + "; path=/";



        // $.ajax({
        //     type: "POST",
        //     url: '/terminal/register',
        //     data: data,
        //     success: function (result) {
        //         console.log(result);
        //         $(waitModal).modal('hide');
        //         successModal.show('Passcode Updated');
        //     },
        //     error: function (response) {
        //         console.log(response)
        //         $(waitModal).modal('hide');
        //         errorModal.addErrorMessage(response.responseJSON.message);
        //         errorModal.show();
        //     }
        // });

    }
    div.appendChild(register_button);
    // div.appendChild(register_div);
    return div;
}