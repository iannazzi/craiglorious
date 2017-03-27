import { getData } from './getData'
import {AwesomeTable} from '../elements/tables/AwesomeTable';


export class AwesomeTableBuilder
{
    constructor() {
        // this.component = component;
        this.AwesomeTable = AwesomeTable;
        this.getData = getData;
    }

    //most pages with tables need to get data then display it
    loadDataAndRenderTable(component) {
        return function (response) {
            component.data = response.data;
            component.dataReady = true;
            cached_page_data[component.route] = response.data;
            //this is part of the callback
            component.renderTable();

        }

    }

    //most record pages have show edit and create with corresponding tables
    createShowEditOrCreateRecordTable(component) {
        let access, edit_display;
        if (component.page == 'show') {
            access = 'read';
            edit_display = 'modal';
        }
        else {
            access = 'write';
            edit_display = 'on_page';
        }
        return new this.AwesomeTable({
            //name: "role",
            data: component.data.records,
            route: component.route,
            column_definition: component.column_definition,
            table_buttons: ['edit', 'delete'],

            type: 'record', //record, collection or searchable
            table_view: component.page, //index, create, edit, and show pages: columns respond differnetly to
            access: access, //read vs write
            edit_display: edit_display,
            getData:this.getData,
            onDeleteSuccess(){
                //back to roles
                component.$router.push(component.route);
            },
            onCreateSaved(id){
                //pop up a modal
                // this.create() //check the display
                //back to roles
                console.log('saving....')
                component.dataReady = false;
                component.$router.push({path: '/' + component.route + '/' + id, props: {justcreated: 'true'}});

            },
            onCancelCreateClick(){
                component.$router.push('/' + component.route);
            }

        })
    }

    loadRecordTableDataThenCallRenderTable(component) {
        component.dataReady = false;
        if (component.page == 'create') {
            if (typeof cached_page_data[component.route] !== 'undefined') {
                component.data = cached_page_data[component.route];
                component.data.records = [];
                component.dataReady = true;
                component.renderTable();
            }
            else {
                //this.getData('get', '/' + component.route + '/create', false, this.loadDataAndRenderTable(component));

                let self = this;
                this.getData( {
                    method: 'get',
                    url: '/' + component.route + '/create',
                    entity: false,
                    onSuccess: self.loadDataAndRenderTable(component)
                })


            }
        }
        else {
            let self = this;
            this.getData( {
                method: 'get',
                url: '/' + component.route + '/' + component.$route.params.id,
                entity: false,
                onSuccess: self.loadDataAndRenderTable(component)

            })


        }
    }

    getDataThenRenderTable(component){

        let self = this;
        this.getData( {
            method: 'get',
            url:  component.route,
            entity: false,
            onSuccess: self.loadDataAndRenderTable(component)

        })

    }

    createSearchableCollectionTable(component){

        //i need get data function sent in
        return new this.AwesomeTable({

            //name: "roles",
            access: "read",
            table_buttons: [],
            table_view: 'index', //component.page,
            edit_display: 'on_page',
            route: component.route, //so far this needs replacement
            footer: [],
            header: [],
            column_definition: component.column_definition,
            type: 'searchable',
            data: component.data,
            number_of_records_available: component.data.number_of_records_available,
            getData:this.getData,

        })
    }

}