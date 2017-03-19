import {RecordTableView}  from './RecordTableView';
import {RecordTableController}  from './RecordTableController';
import {DataTableView}  from './DataTableView';
import {DataTableController}  from './DataTableController';
import {TableModel}  from './TableModel';
import {SearchTableView}  from '../../elements/tables/SearchTableView';
import {SearchTableController}  from '../../elements/tables/SearchTableController';


export class AwesomeTable {
    constructor(options) {

        //table types: record, collection,
        //record table_view create edit show  i.e. read write


        this.options = options;

        let self = this;
        // $(function () {
        //     self.controller.loadPageEvent.notify();
        // });
    }

    addTo(div_id) {
        console.log(div_id)
        this.div = document.getElementById(div_id);
        switch (this.options.type) {
            case 'record':
                this.recordTable();
                break;
            case 'collection':
                this.collectionTable();
                break;
            case 'searchable':
                this.searchableTable();
                break;
            default:
                console.log('missed the type in the table definition');
        }
    }


    recordTable() {
        this.model = new TableModel(this.options);
        this.view = new RecordTableView(this.model);
        this.controller = new RecordTableController(this.model, this.view);

        this.modelModal = new TableModel(this.options);
        this.viewModal = new RecordTableView(this.modelModal);
        this.controllerModal = new RecordTableController(this.modelModal, this.viewModal);

        let self = this;


        if (typeof this.options.edit_display === undefined) {
            this.options.edit_display = 'on_page';
        }
        switch (this.options.edit_display) {
            case 'on_page':
                this.div.appendChild(this.view.createTable());
                break;
            case 'modal':

                this.div.appendChild(this.view.createTable());
                this.div.appendChild(this.viewModal.createModalTable());

                this.modelModal.options.onEditClicked = function () {
                    self.viewModal.showModalTable();
                }
                this.modelModal.options.onSaveSuccess = function () {
                    console.log('save success');
                    console.log(self.modelModal.data);
                    self.model.data = self.modelModal.data;
                    self.viewModal.hideModalTable();
                    self.view.updateTable();
                }
                this.modelModal.options.onCancelClicked = function () {
                    self.viewModal.hideModalTable();
                }
                break;

            case 'modal_only':


                this.modelModal.options.onEditClicked = function () {
                    alert('why is there an edit button on the modal')
                }
                this.modelModal.options.onCancelClicked = function () {
                    self.viewModal.hideModalTable();
                }
                // this.modelModal.options.onSaveSuccess = function () {
                //
                //
                //     console.log('save success');
                //     console.log(JSON.stringify(self.modelModal.tdo));
                //     console.log(JSON.stringify(self.model.tdo));
                //     self.model.tdo = self.modelModal.tdo;
                //     console.log(JSON.stringify(self.model.tdo));
                //
                //     self.viewModal.hideModalTable();
                //
                //     //i never drew this table.....
                //     self.view.updateTable();
                //
                //
                // }
                this.div.appendChild(this.viewModal.createModalTable());


        }


        $(function () {


        });


    }

    showModal() {
        this.viewModal.showModalTable();
    }
    hideModal() {
        this.viewModal.hideModalTable();
    }

    collectionTable() {
        this.model = new TableModel(this.options);
        this.view = new DataTableView(this.model);
        this.controller = new DataTableController(this.model, this.view);


        // return this.view.dataTable();

    }

    searchableTable() {
        this.model = new TableModel(this.options);
        this.view = new SearchTableView(this.model);
        this.controller = new SearchTableController(this.model, this.view);

        // return this.view.searchTable();

    }
}