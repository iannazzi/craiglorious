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
        //record table_type create edit show  i.e. read write

        this.options = options;
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
                console.log('missed the type');
        }
        let self = this;
        // $(function () {
        //     self.controller.loadPageEvent.notify();
        // });
    }
    addTo(div_id){
        let self = this;
        $(function () {
            let div = document.getElementById(div_id);
            div.appendChild(self.render());
            self.controller.loadPageEvent.notify();

        });
    }

    render() {
        switch (this.options.type) {
            case 'record':
                return this.view.recordTable();
            case 'collection':
                return this.view.dataTable();
            case 'searchable':
                return this.view.searchTable();
            default:
                console.log('missed the return buddy');
        }

    }

    recordTable() {
        this.model = new TableModel(this.options);
        this.view = new RecordTableView(this.model);
        this.controller = new RecordTableController(this.model, this.view);
    }

    collectionTable() {
        this.model = new TableModel(this.options);
        this.view = new DataTableView(this.model);
        this.controller = new DataTableController(this.model, this.view);
    }

    searchableTable() {
        this.model = new TableModel(this.options);
        this.view = new SearchTableView(this.model);
        this.controller = new SearchTableController(this.model, this.view);
    }
}