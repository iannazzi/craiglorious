import {RecordTableView}  from './RecordTableView';
import {RecordTableController}  from './RecordTableController';
import {CollectionTableView}  from './CollectionTableView';
import {CollectionTableController}  from './CollectionTableController';
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
        this.div = document.getElementById(div_id);
        this.options.name = div_id;
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
                this.div.appendChild(this.view.createRecordTable());
                break;
            case 'modal':

                this.div.appendChild(this.view.createRecordTable());
                this.div.appendChild(this.viewModal.createModalTable(this.viewModal.createRecordTable()));
                this.modelModal.options.onEditClicked = function () {


                    self.modelModal.td.access = "write";
                    self.modelModal.td.table_view = "edit";
                    self.viewModal.showModalTable();
                    self.viewModal.updateTable();
                    self.viewModal.updateButtons();
                    self.controllerModal.setFocusToFirstInput();
                }
                this.modelModal.options.onSaveSuccess = function () {
                    console.log('save success');
                    // self.modelModal.td.access = "write";
                    // self.modelModal.td.edit_display = "edit";
                    console.log(self.modelModal.data);
                    self.model.data = self.modelModal.data;
                    self.viewModal.hideModalTable();
                    self.model.tdo = self.modelModal.tdo;
                    self.view.updateTable();
                }
                this.modelModal.options.onCancelClick = function () {
                    self.viewModal.hideModalTable();
                }
                break;

            case 'modal_only':


                this.modelModal.options.onEditClick = function () {
                    alert('why is there an edit button on the modal')
                }
                this.modelModal.options.onCancelClick = function () {
                    self.viewModal.hideModalTable();
                }

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
        this.view = new CollectionTableView(this.model);
        this.controller = new CollectionTableController(this.model, this.view);

        this.modelModal = new TableModel(this.options);
        this.viewModal = new CollectionTableView(this.modelModal);
        this.controllerModal = new CollectionTableController(this.modelModal, this.viewModal);

        if (typeof this.options.edit_display === undefined) {
            this.options.edit_display = 'on_page';
        }
        let self = this;
        switch (this.options.edit_display) {
            case 'on_page':
                this.div.appendChild(this.view.createCollectionTable());
                break;
            case 'modal':
                console.log(this.options.edit_display)

                this.div.appendChild(this.view.createCollectionTable());
                this.div.appendChild(this.viewModal.createModalTable(this.viewModal.createCollectionTable()));

                this.modelModal.options.onEditClick = function () {

                    //self.modelModal.td.access = "write";
                    //self.modelModal.td.table_view = "edit";
                    self.viewModal.showModalTable();
                    self.viewModal.updateTable();
                    self.viewModal.updateButtons();
                    self.controllerModal.setFocusToFirstInput();
                }
                this.modelModal.options.onSaveSuccess = function () {
                    console.log('save success');
                    // self.modelModal.td.access = "write";
                    // self.modelModal.td.edit_display = "edit";
                    console.log(self.modelModal.data);
                    self.model.data = self.modelModal.data;
                    self.viewModal.hideModalTable();
                    self.model.tdo = self.modelModal.tdo;
                    self.view.updateTable();
                }
                this.modelModal.options.onCancelClick = function () {
                    self.viewModal.hideModalTable();
                }
                break;

            case 'modal_only':


                this.modelModal.options.onEditClick = function () {
                    alert('why is there an edit button on the modal')
                }
                this.modelModal.options.onCancelClick = function () {
                    self.viewModal.hideModalTable();
                }

                this.div.appendChild(this.viewModal.createModalTable());



        }




        // return this.view.dataTable();

    }

    searchableTable() {

        this.model = new TableModel(this.options);
        this.view = new SearchTableView(this.model);
        this.controller = new SearchTableController(this.model, this.view);
        let searchTable = this.view.createSearchTable();
        this.div.appendChild(searchTable);

        // return this.view.searchTable();

    }
}