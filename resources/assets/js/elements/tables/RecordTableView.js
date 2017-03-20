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

    createModalTable(){


        if (this.model.options.edit_display == 'modal') {


        }
        else if (this.model.options.edit_display == 'modal_only') {


        }
        this.formModal.setBody(this.createRecordTable());
        let div = document.createElement('div');
        div.appendChild(this.createSaveButton());
        div.appendChild(this.createCancelButton());
        this.formModal.setFooter(div);
        return this.formModal.get();
    }
    showModalTable(){
        this.formModal.show();
    }
    hideModalTable(){
        this.formModal.hide();
    }
    createRecordTable() {
        this.recordTableDiv = this.createRecordTableDiv();
        this.table = this.createTableElement();
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
        this.button_div = div;
        this.updateButtons(div);
        return div;


    }

    updateButtons() {

        this.button_div.innerHTML = '';
        if (this.model.td.access == 'read') {
            if (this.model.td.table_buttons.includes('edit')) {
                this.button_div.appendChild(this.createEditButton());
            }
            if (this.model.td.table_buttons.includes('delete')) {
                this.button_div.appendChild(this.createDeleteButton());
            }
        }
        else {

            if (this.model.options.edit_display == 'on_page') {
                this.button_div.appendChild(this.createSaveButton());
                this.button_div.appendChild(this.createCancelButton());
            }
            else if (this.model.options.edit_display == 'modal') {
                // let div = document.createElement('div');
                // div.appendChild(this.createSaveButton());
                // div.appendChild(this.createCancelButton());
                // this.formModal.footer(div);

            }
            else if (this.model.options.edit_display == 'modal_only') {
                //the buttons are not applied until the form is shown...

                // let div = document.createElement('div');
                // div.appendChild(this.createSaveButton());
                // div.appendChild(this.createCancelButton());
                // this.formModal.footer(div);

            }



        }


    }


    createRecordTableDiv() {
        let div = document.createElement('div');
        div.className = 'record_table_div';
        div.id = this.name + '_table_div';

        // div.addEventListener('keyup', function (event) {
        //     if (event.which == 13) {
        //         console.log('enter pressed')
        //         //me.submitSearch();
        //     }
        // });
        return div;
    }

    createTableElement() {

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

            switch (this.model.td.table_view) {
                case 'create':
                    if (col_def['show_on_create']) {
                        this.addRow(tbody, col_def);
                    }
                    break;
                case 'edit':
                    if (col_def['show_on_edit']) {
                        this.addRow(tbody, col_def);
                    }
                    break;
                case 'show':
                    if (col_def['show_on_view']) {
                        this.addRow(tbody, col_def);
                    }
                    break;
                default:
                    console.log('error in the column definition');
            }
        })
    }

    addRow(tbody, col_def) {
        if (col_def.type != 'row_checkbox' && col_def.type != 'row_number') {
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

    setViewToShow() {
        this.model.td.table_view = 'show';
        this.model.td.access = 'read';
        this.updateTable();
        this.updateButtons();
    }
}