/**
 * Created by embrasse-moi on 1/19/17.
 */
import {TableController} from './TableController'
import {TableEvent} from './TableEvent'
import {RecordTableEvents} from './RecordTableEvents'

export class RecordTableController extends TableController {
    constructor(model, view) {
        super(model)
        this.view = view;
        this.cdo = this.model.cdo;

        this.events = new RecordTableEvents(this);

        if (this.model.tdo.length == 0) {
            this.model.addNewRow();
        }

    }


    copyTable() {
        this.cdo.forEach((col_def) => {
            let element = this.view.elements[col_def.db_field];
            switch (this.model.td.table_type) {
                case 'create':
                    if (col_def['show_on_create']){
                        this.copyElementValueToModel(element, col_def, 0);
                    }
                    break;
                case 'edit':
                    if (col_def['show_on_edit']){
                        this.copyElementValueToModel(element, col_def, 0);
                    }
                    break;
            }
        })
    }

    submitSave() {
        this.view.showWaitModal(true);
        let post_data = this.getPostData();
        //post_data = post_data[0];
        let data = {data: post_data, _method: 'put'};
        console.log(JSON.stringify(data))
        let self = this;
        $.ajax({
            url: self.model.td.route,
            // type: 'PATCH',
            type: 'post',
            data: data,
            success: function (result) {
                console.log(result);
                self.view.setViewShow();
                switch (self.model.td.table_type) {
                    case 'create':
                        window.location.href = self.model.td.route + '/' + result.id;
                        break;
                    case 'edit':
                        //set the original data to the new data
                        self.model.original_data = self.getPostData();
                        self.view.showWaitModal(false);
                        break;
                }

                self.saveComplete.notify();
                //switch the uri to the new id....
            },
            error: function (response) {
                console.log(response)
                self.view.showWaitModal(false);
                console.log(self.view.errorModal);
                self.view.showErrorModal(response.responseJSON.message);
            }
        });
    }

    getConfirm(confirmMessage, callback) {
        confirmMessage = confirmMessage || '';
        self = this;
        this.view.showConfirmModal(true);

        $('#confirmMessage').html(confirmMessage);
        $('#confirmFalse').click(function () {
            $(self.view.confirmModal).modal('hide');
            if (callback) callback(false);

        });
        $('#confirmTrue').click(function () {
            $(self.view.confirmModal).modal('hide');
            if (callback) callback(true);
        });
    }

    delete() {
        let self = this;
        self.view.showWaitModal(true);
        //let self2 = self;
        let data = {_method: 'delete', data: {id: self.model.tdo[0]['id']['data']}};
        //console.log(JSON.stringify(data));
        $.ajax({
            url: self.model.td.route,
            type: 'post',
            data: data,
            success: function (result) {
                //self.view.showWaitModal(false);
                if(self.model.options.deleteSuccess){
                    self.model.options.deleteSuccess();
                }
            }
        });
    }
    setFocusToFirstInput() {

        let elements = this.view.elements_array;
        for (let i = 0; i < elements.length; i++) {

            if (elements[i].type == 'text'
                || elements[i].type == 'number'
                || elements[i].type == 'textarea'
                || elements[i].type == 'date'

            ) {
                elements[i].focus();
                elements[i].select();
                break;
            }

            if (elements[i].type == 'select-one'
                || elements[i].type == 'select-multi'

            ) {
                elements[i].focus();
                // elements[i].select();
                break;
            }


        }



    }


}