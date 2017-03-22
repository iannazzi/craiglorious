import {TableEvent} from './TableEvent'
import {TableEvents} from './TableEvents'


export class CollectionTableEvents extends TableEvents{

    constructor(controller) {
        super(controller);

        let view = controller.view;
        let model = controller.model;
        controller.loadPageEvent= new TableEvent(controller);
        controller.createTableEvent = new TableEvent(view);
        view.addColumnClicked = new TableEvent(view);
        view.deleteColumnClicked = new TableEvent(view);
        view.addRowClicked = new TableEvent(view);
        view.deleteRowClicked = new TableEvent(view);
        view.moveRowUpClicked = new TableEvent(view);
        view.moveRowDownClicked = new TableEvent(view);
        view.copyRowClicked = new TableEvent(view);
        view.deleteAllClicked = new TableEvent(view);
        view.makeTableWriteable = new TableEvent(view);
        view.makeTableReadable = new TableEvent(view);
        view.inputChanged = new TableEvent(view);
        view.individualSelectChanged = new TableEvent(view);
        view.dataTableChanged = new TableEvent(view);
        view.onHeaderClick = new TableEvent(view);
        view.onEditClick = new TableEvent(view);
        view.onCancelClick = new TableEvent(view);
        view.onSaveClick = new TableEvent(view);

        controller.createTableEvent.attach(
            function () {


            }
        );
        //##################   EDIT

        controller.view.onEditClick.attach(
            function () {
                console.log(controller.model.options)
                if (typeof controller.model.options.onEditClick === 'function'){
                    console.log('hi thiere')
                    controller.model.options.onEditClick();
                }
                else{
                    console.log('hi thiereeerer ')

                    controller.model.td.access = 'write';
                    view.updateTable();
                    view.updateButtons();

                }

            }
        );
        //##################   CANCEL

        controller.view.onCancelClick.attach(
            function () {

                controller.model.loadOriginalData();

                if (controller.model.options.edit_display == 'on_page') {
                    controller.model.td.access = 'read';
                    view.updateTable();

                }
                else if (controller.model.options.edit_display == 'modal') {
                    controller.model.options.onCancelClick();
                }
                else if (controller.model.options.edit_display == 'modal_only') {
                    controller.model.options.onCancelClick();
                }






            }
        );
        //##################   SAVE

        controller.view.onSaveClick.attach(
            function () {

                let post_data = controller.getPostData();
                let data = {data: post_data, _method: 'put'};
                console.log(controller.model.td.additionalPostValues)

                if(typeof controller.model.td.additionalPostValues !== 'undefined'){
                    data['additional_post_values'] = controller.model.td.additionalPostValues;
                }

                view.showWaitModal(true);

                console.log(JSON.stringify(data))



                $.ajax({
                    url: controller.model.td.route,
                    type: 'post',
                    data: data,
                    success: function (result) {
                        console.log(result);
                        //controller.view.setViewShow();
                        //set the original data to the new data
                        controller.model.original_data = controller.getPostData();
                        controller.view.showWaitModal(false);
                        controller.onSaveSuccess.notify(result);
                        //switch the uri to the new id....
                    },
                    error: function (response) {
                        console.log(response)
                        controller.view.showWaitModal(false);

                        controller.view.showErrorModal(response.responseJSON.message);

                    }
                });
            }
        );
        //##################   SAVE SUCCESS
        controller.onSaveSuccess = new TableEvent(controller);
        controller.onSaveSuccess.attach(
            function (sender, result) {

                if (controller.model.options.edit_display == 'on_page') {
                    controller.model.td.access = 'read';
                    view.updateTable();
                    controller.model.original_data = controller.getPostData();
                }
                else if (controller.model.options.edit_display == 'modal') {
                    controller.model.options.onSaveSuccess(result.id);

                }
                else if (controller.model.options.edit_display == 'modal_only') {

                    console.log(result);
                    console.log(JSON.stringify(controller.getPostData()))
                    console.log(controller.model.td.table_view);
                    console.log(controller.model.td.edit_display);
                    console.log(JSON.stringify(controller.model.tdo))
                    console.log(result.id)

                    controller.model.options.onSaveSuccess(result.id);
                }
            }
        )


        let self = controller;
        view.onHeaderClick.attach(
            function (sender, args) {
                controller.onSort(args);
            }
        )
        controller.view.addColumnClicked.attach(
            function () {
                controller.model.addColumnToArray(controller.view.array_col);
                controller.view.updateTable();
            }
        )
        controller.view.deleteColumnClicked.attach(
            function () {
                controller.model.deleteColumnFromArray(controller.view.array_col);
                controller.view.updateTable();
            }
        )
        controller.view.addRowClicked.attach(
            function () {
                //adds a row to the table model
                controller.addRow()
                //table model notifies that it has changed
                //at controller point we can perform calculation directly on the model so that it will render
                controller.view.updateTable();

            }
        );
        controller.view.deleteRowClicked.attach(
            function (sender, confirm) {
                self.deleteRow(confirm)
                self.view.updateTable();
            }
        );
        controller.view.moveRowUpClicked.attach(
            function () {
                self.moveRowUp()
                self.view.updateTable();
            }
        );
        controller.view.moveRowDownClicked.attach(
            function () {
                self.moveRowDown()
                self.view.updateTable();
            }
        );
        controller.view.copyRowClicked.attach(
            function () {
                self.copyRow()
                self.view.updateTable();
            }
        );
        controller.view.deleteAllClicked.attach(
            function (args) {
                self.deleteAllRows(args)
                self.view.updateTable();
            }
        );
        controller.view.inputChanged.attach(
            function () {
                console.log('inputChanged Event...  copyTable then updateTotalsBody ... then the cd event');
                self.copyTable()
                self.view.updateTotalsBody()
            }
        );
        controller.view.individualSelectChanged.attach(
            function () {
                //console.log('individual select changed');
                self.copyTable();
                self.view.updateIndividualSelectOptions();
                self.view.inputChanged.notify();
            }
        );






    }

}