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
            if (typeof options[key] === 'undefined') {
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

        let model = new TableModel(this.options);
        let view = new RecordTableView(model);
        let controller = new RecordTableController(model, view);

        //modal is used for a pop up 'edit_display
        let modelModal = new TableModel(this.clone(this.options));
        let viewModal = new RecordTableView(modelModal);
        let controllerModal = new RecordTableController(modelModal, viewModal);

        let self = this;
        //this nonsense is to set the focus to the first input..
        $(viewModal.formModal.modal_div).on('shown.bs.modal', function () {
            let q = $(viewModal.formModal.modal_div).find(":input:first");
            q.focus();
            q.select();
        })

        switch (this.options.edit_display) {
            case 'on_page':
                this.div.appendChild(view.createRecordTable());
                model.options.onSaveClick = function () {
                    //we need ajax here....
                    let post_data = {data: controller.getPostData(), _method: 'put'};

                    if (typeof modelModal.options.additionalPostValues !== 'undefined') {
                        post_data['additional_post_values'] = modelModal.options.additionalPostValues;
                    }
                    view.showWaitModal(true);
                    console.log(JSON.stringify(post_data))

                    client({path: controller.model.td.route, entity: post_data}).then(
                        function (response) {
                            model.original_data = controller.getPostData();
                            view.showWaitModal(false);
                            controller.onSaveSuccess.notify(response.entity);
                        },
                        function (response) {
                            view.showWaitModal(false);
                            view.showErrorModal(response.entity.responseJSON.message);
                        });
                }
                break;
            case 'modal':

                viewModal.inputChanged.attach(
                    function () {
                        model.tdo = modelModal.tdo;
                        view.updateTable();
                    }
                );

                this.div.appendChild(view.createRecordTable());

                this.div.appendChild(viewModal.createModalTable(viewModal.createRecordTable()));

                model.options.onEditClick = function () {
                    modelModal.td.access = "write";
                    modelModal.td.table_view = "edit";

                    viewModal.showModalTable();
                    viewModal.updateTable();
                }
                modelModal.options.onSaveClick = function () {
                    //we need ajax here....
                    let post_data = {data: controller.getPostData(), _method: 'put'};

                    if (typeof modelModal.options.additionalPostValues !== 'undefined') {
                        post_data['additional_post_values'] = modelModal.options.additionalPostValues;
                    }
                    viewModal.showWaitModal(true);
                    console.log(JSON.stringify(post_data))

                    client({path: controller.model.td.route, entity: post_data}).then(
                        function (response) {
                            model.original_data = controller.getPostData();
                            viewModal.showWaitModal(false);
                            viewModal.hideModalTable();
                            controller.onSaveSuccess.notify(response.entity);
                        },
                    function (response) {
                        viewModal.showWaitModal(false);
                        view.showErrorModal(response.entity.responseJSON.message);
                    });
                }
                modelModal.options.onSaveSuccess = function () {
                    // self.model.td.access = "read";
                    // self.model.td.table_view = "show";
                    viewModal.hideModalTable();
                    //update the table data object
                    model.tdo = modelModal.tdo;
                    view.updateTable();
                }
                modelModal.options.onCancelClick = function () {
                    // self.model.td.access = "read";
                    // self.model.td.table_view = "show";
                    model.loadOriginalData();
                    view.updateTable();
                    viewModal.hideModalTable();
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

        let model = new TableModel(this.options);
        let view = new CollectionTableView(model);
        let controller = new CollectionTableController(model, view);

        let modelModal = new TableModel(this.clone(this.options));
        let viewModal = new CollectionTableView(modelModal);
        let controllerModal = new CollectionTableController(modelModal, viewModal);

        $(viewModal.formModal.modal_div).on('shown.bs.modal', function () {
            let q = $(viewModal.formModal.modal_div).find(":input:first");
            q.focus();
            q.select();
        })


        viewModal.inputChanged.attach(
            function () {
                model.tdo = modelModal.tdo;
                view.updateTable();
            }
        );
        switch (this.options.edit_display) {
            case 'on_page':
                this.div.appendChild(this.view.createCollectionTable());
                model.options.onSaveClick = function () {
                    //we need ajax here....
                    let post_data = {data: controller.getPostData(), _method: 'put'};

                    if (typeof modelModal.options.additionalPostValues !== 'undefined') {
                        post_data['additional_post_values'] = modelModal.options.additionalPostValues;
                    }
                    view.showWaitModal(true);
                    console.log(JSON.stringify(post_data))

                    client({path: controller.model.td.route, entity: post_data}).then(
                        function (response) {
                            model.original_data = controller.getPostData();
                            view.showWaitModal(false);
                            controller.onSaveSuccess.notify(response.entity);
                        },
                        function (response) {
                            view.showWaitModal(false);
                            view.showErrorModal(response.entity.responseJSON.message);
                        });
                }
                break;
            case 'modal':

                this.div.appendChild(view.createCollectionTable());
                this.div.appendChild(viewModal.createModalTable(viewModal.createCollectionTable()));
                modelModal.options.onSaveClick = function () {
                    //we need ajax here....
                    let post_data = {data: controller.getPostData(), _method: 'put'};

                    if (typeof modelModal.options.additionalPostValues !== 'undefined') {
                        post_data['additional_post_values'] = modelModal.options.additionalPostValues;
                    }
                    viewModal.showWaitModal(true);
                    console.log(JSON.stringify(post_data))

                    client({path: controller.model.td.route, entity: post_data}).then(
                        function (response) {
                            model.original_data = controller.getPostData();
                            viewModal.showWaitModal(false);
                            viewModal.hideModalTable();
                            controller.onSaveSuccess.notify(response.entity);
                        },
                        function (response) {
                            viewModal.showWaitModal(false);
                            view.showErrorModal(response.entity.responseJSON.message);
                        });
                }
                model.options.onEditClick = function () {

                    modelModal.td.access = "write";
                    modelModal.td.table_view = "edit";
                    viewModal.showModalTable();
                    viewModal.updateTable();
                }

                modelModal.options.onSaveSuccess = function () {
                    // self.model.td.access = "read";
                    // self.model.td.table_view = "show";
                    viewModal.hideModalTable();
                    model.tdo = modelModal.tdo;
                    view.updateTable();
                }
                modelModal.options.onCancelClick = function () {
                    model.loadOriginalData();
                    view.updateTable();
                    viewModal.hideModalTable();
                }
                break;

            case 'modal_only':


                modelModal.options.onEditClick = function () {
                    alert('why is there an edit button on the modal')
                }
                modelModal.options.onCancelClick = function () {
                    viewModal.hideModalTable();
                }

                this.div.appendChild(viewModal.createModalTable());


        }


        // return this.view.dataTable();

    }

    searchableTable() {
        let model = new TableModel(this.options);
        let view = new SearchTableView(model);
        let controller = new SearchTableController(model, view);
        this.options.onSearchClicked = function () {
            controller.searching.notify();
            controller.uri.onSearch();
            let post_data = {};
            post_data['search_fields'] = {};
            post_data['table_name'] = controller.view.name;
            controller.view.search_elements.forEach(element => {
                post_data.search_fields[element.name] = element.value;
            })
            console.log('I need controller for testing.... search post data');
            console.log(JSON.stringify(post_data))

            client({path: controller.model.td.route + '/search', entity: post_data}).then(
                function (response) {
                    controller.searchReturned.notify(response.entity)
                });
        };

        let searchTable = view.createSearchTable();
        this.div.appendChild(searchTable);
        $(function () {
            controller.loadPageEvent.notify();
        });
    }

    // showModal() {
    //     this.viewModal.showModalTable();
    // }
    //
    // hideModal() {
    //     this.viewModal.hideModalTable();
    // }


}