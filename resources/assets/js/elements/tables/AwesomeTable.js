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

         let und = function (key, value) {
             if(typeof options[key] === 'undefined'){
                 options[key] = value;
             }
        }

        //some defaults
        und('access', 'read');
        und('edit_display', 'on_page')



        this.options = options;
        let self = this;

    }
    clone(obj) {
        var copy;

        // Handle the 3 simple types, and null or undefined
        if (null == obj || "object" != typeof obj) return obj;

        // Handle Date
        if (obj instanceof Date) {
            copy = new Date();
            copy.setTime(obj.getTime());
            return copy;
        }

        // Handle Array
        if (obj instanceof Array) {
            copy = [];
            for (var i = 0, len = obj.length; i < len; i++) {
                copy[i] = this.clone(obj[i]);
            }
            return copy;
        }

        // Handle Object
        if (obj instanceof Object) {
            copy = {};
            for (var attr in obj) {
                if (obj.hasOwnProperty(attr)) copy[attr] = this.clone(obj[attr]);
            }
            return copy;
        }

        throw new Error("Unable to copy obj! Its type isn't supported.");
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


        this.modelModal = new TableModel(this.clone(this.options));
        this.viewModal = new RecordTableView(this.modelModal);
        this.controllerModal = new RecordTableController(this.modelModal, this.viewModal);

        let self = this;
        $(this.viewModal.formModal.modal_div).on('shown.bs.modal', function () {
            let q = $( self.viewModal.formModal.modal_div ).find( ":input:first" );
            q.focus();
            q.select();
        })

        switch (this.options.edit_display) {
            case 'on_page':
                this.div.appendChild(this.view.createRecordTable());
                break;
            case 'modal':

                this.viewModal.inputChanged.attach(
                    function () {
                        self.model.tdo = self.modelModal.tdo;
                        self.view.updateTable();
                    }
                );

                this.div.appendChild(this.view.createRecordTable());

                this.div.appendChild(this.viewModal.createModalTable(this.viewModal.createRecordTable()));

                this.model.options.onEditClick = function () {
                    self.modelModal.td.access = "write";
                    self.modelModal.td.table_view = "edit";

                    self.viewModal.showModalTable();
                    self.viewModal.updateTable();
                }
                this.modelModal.options.onSaveSuccess = function () {
                    // self.model.td.access = "read";
                    // self.model.td.table_view = "show";
                    self.viewModal.hideModalTable();
                    //update the table data object
                    self.model.tdo = self.modelModal.tdo;
                    self.view.updateTable();
                }
                this.modelModal.options.onCancelClick = function () {
                    // self.model.td.access = "read";
                    // self.model.td.table_view = "show";
                    self.model.loadOriginalData();
                    self.view.updateTable();
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

                this.div.appendChild(this.viewModal.createModalTable(this.viewModal.createRecordTable()));


        }


        $(function () {


        });


    }

    collectionTable() {
        let self = this;

        this.model = new TableModel(this.options);
        this.view = new CollectionTableView(this.model);
        this.controller = new CollectionTableController(this.model, this.view);

        this.modelModal = new TableModel(this.clone(this.options));
        this.viewModal = new CollectionTableView(this.modelModal);
        this.controllerModal = new CollectionTableController(this.modelModal, this.viewModal);

        $(this.viewModal.formModal.modal_div).on('shown.bs.modal', function () {
            let q = $( self.viewModal.formModal.modal_div ).find( ":input:first" );
            q.focus();
            q.select();
        })


        this.viewModal.inputChanged.attach(
            function () {
                self.model.tdo = self.modelModal.tdo;
                self.view.updateTable();
            }
        );
        switch (this.options.edit_display) {
            case 'on_page':
                this.div.appendChild(this.view.createCollectionTable());
                break;
            case 'modal':

                this.div.appendChild(this.view.createCollectionTable());
                this.div.appendChild(this.viewModal.createModalTable(this.viewModal.createCollectionTable()));
                this.model.options.onEditClick = function () {

                    self.modelModal.td.access = "write";
                    self.modelModal.td.table_view = "edit";
                    self.viewModal.showModalTable();
                    self.viewModal.updateTable();
                }

                this.modelModal.options.onSaveSuccess = function () {
                    // self.model.td.access = "read";
                    // self.model.td.table_view = "show";
                    self.viewModal.hideModalTable();
                    self.model.tdo = self.modelModal.tdo;
                    self.view.updateTable();
                }
                this.modelModal.options.onCancelClick = function () {
                    self.model.loadOriginalData();
                    self.view.updateTable();
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
        let self = this;
        $(function () {
            self.controller.loadPageEvent.notify();
        });
    }

    showModal() {
        this.viewModal.showModalTable();
    }

    hideModal() {
        this.viewModal.hideModalTable();
    }




}