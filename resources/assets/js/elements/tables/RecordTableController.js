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
            switch (this.model.td.table_view) {
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

    onSave() {

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


    setFocusToFirstInput() {
        if(this.checkRead()) return;
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
    checkWrite()
    {
        let write = false;
        if(this.model.td.access.toUpperCase() == "WRITE") write = true;
        return write;
    }
    checkRead()
    {
        return ! this.checkWrite();
    }


}