/**
 * Created by embrasse-moi on 1/18/17.
 */
import {TableView} from './TableView';
import {createWaitModal} from '../modal/waitModal'
import {createConfirmModal} from '../modal/confirmModal'


export class RecordTableView extends TableView {
    constructor(model) {
        super(model);
    }


    recordTable() {
        console.log('creating table.....');
        this.recordTableDiv = this.createRecordTableDiv();
        this.table = this.createTable();
        this.updateTable();
        this.recordTableDiv.appendChild(this.table);
        this.recordTableDiv.appendChild(this.createButtons());
        this.waitModal = createWaitModal();
        this.recordTableDiv.appendChild(this.waitModal);
        this.confirmModal = createConfirmModal();
        this.recordTableDiv.appendChild(this.confirmModal);
        this.recordTableDiv.appendChild(this.errorModal.createErrorModal());

        // if (this.checkWrite()) {
        //     this.setFocusToFirstInput();
        // }
        return this.recordTableDiv;
    }

    createButtons() {
        let div = document.createElement('div');
        div.id = this.id + '_buttons';
        div.className = 'record_table_buttons';

        if (this.model.td.record_table_buttons.includes('edit')) {
            div.appendChild(this.createEditButton());
            div.appendChild(this.createCancelButton());
            div.appendChild(this.createSaveButton());
            let self = this;
            let deleteButton = document.createElement('button');
            deleteButton.innerHTML = 'Delete';
            deleteButton.onclick = function () {
                self.deleteClicked.notify();
            }
            deleteButton.className = 'delete';
            this.deleteButton = deleteButton;
            div.appendChild(deleteButton);

        }
        return div

    }


    createRecordTableDiv() {
        let div = document.createElement('div');
        // div.addEventListener('keyup', function (event) {
        //     if (event.which == 13) {
        //         console.log('enter pressed')
        //         //me.submitSearch();
        //     }
        // });
        return div;
    }

    createTable() {

        let tbl = document.createElement('table');
        tbl.id = this.id;
        tbl.className = 'record_table';

        return tbl;

    }


    updateTable() {
        let tbl = this.table;
        tbl.innerHTML = '';
        this.elements = {};
        this.elements_array = [];
        let tbody = document.createElement('tbody');
        tbl.appendChild(tbody);
        this.tbody = tbody;
        this.cdo.forEach((col_def) => {

            switch (this.model.td.table_type) {
                case 'create':
                    if (col_def['show_on_create']){
                        this.addRow(tbody,col_def);
                    }
                    break;
                case 'edit':
                    if (col_def['show_on_edit']){
                        this.addRow(tbody,col_def);
                    }
                    break;
                case 'show':
                    if (col_def['show_on_view']){
                        this.addRow(tbody,col_def);
                    }
                    break;
                default:
                    console.log('error in the column definition');
            }
        })
    }
    addRow(tbody, col_def){
        if(col_def.type != 'row_checkbox' && col_def.type != 'row_number'){
            let tr = tbody.insertRow();
            let th = document.createElement('th');
            let caption = col_def.db_field;
            if (col_def.caption) {
                caption = col_def.caption;
            }
            th.innerHTML = caption;
            tr.appendChild(th);
            let data = this.model.tdo[0][col_def.db_field].data;
            let cell = tr.insertCell(-1);
            let element = this.createElement(data, col_def);
            this.elements[col_def.db_field] = element;
            this.elements_array.push(element);
            cell.appendChild(element);
        }

    }

    setViewCreate() {
        this.model.td.access = 'write';
        console.log(this.model.tdo)
        $(this.editButton).hide();
        $(this.deleteButton).hide();
        $(this.saveButton).show();
        $(this.cancelButton).show();
        this.updateTable();
    }

    setViewEdit() {
        this.model.td.access = 'write';
        $(this.editButton).hide();
        $(this.deleteButton).hide();
        $(this.saveButton).show();
        $(this.cancelButton).show();
        this.updateTable();
    }

    setViewShow() {
        this.model.td.access = 'read';
        $(this.editButton).show();
        $(this.deleteButton).show();
        $(this.saveButton).hide();
        $(this.cancelButton).hide();
        this.updateTable();
    }

}