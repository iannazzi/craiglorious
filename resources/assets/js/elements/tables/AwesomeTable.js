import {RecordTableView}  from './RecordTableView';
import {RecordTableController}  from './RecordTableController';
import {DataTableView}  from './DataTableView';
import {DataTableController}  from './DataTableController';
import {TableModel}  from './TableModel';
import {SearchTableView}  from '../../elements/tables/SearchTableView';
import {SearchTableController}  from '../../elements/tables/SearchTableController';
import {FormModal}  from '../../elements/modal/FormModal';


export class AwesomeTable {
    constructor(options) {

        //table types: record, collection,
        //record table_type create edit show  i.e. read write


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
        console.log(this.div)
        let model = new TableModel(this.options),
            view = new RecordTableView(model),
            controller = new RecordTableController(model, view),
            self = this;


        if (typeof this.options.edit_display === undefined) {
            this.options.edit_display = 'on_page';
        }
        switch (this.options.edit_display) {
            case 'on_page':
                this.div.appendChild(view.recordTable());
                break;
            case 'modal':
                let view2 = new RecordTableView(model),
                    controller2 = new RecordTableController(model, view2),
                    formModal = new FormModal(this.options.name + '_formModal');

                let table1 = view.recordTable();
                let table2 = view2.recordTable();
                this.div.appendChild(table1);
                this.div.appendChild(formModal.create(table2));

                this.options.onEditClicked = function () {
                    formModal.show();
                }
                this.options.onSaveSuccess = function () {
                    formModal.hide();
                }
                break;

            case 'modal_only':
                let table = view.recordTable();
                this.div.appendChild(formModal.create(table));
                this.formModal = formModal;

        }


        $(function () {



        });



    }
    showModal(){
        this.formModal.show();
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