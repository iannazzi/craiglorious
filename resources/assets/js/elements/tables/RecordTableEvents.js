import {TableEvent} from './TableEvent'
import {TableEvents} from './TableEvents'


export class RecordTableEvents extends TableEvents {

    constructor(controller) {
        super(controller);
        let view = controller.view;

        //##################    LOAD PAGE
        controller.loadPageEvent = new TableEvent(controller);
        controller.loadPageEvent.attach(
            function () {

                console.log('load page event...')


                //view.updateTable();


            }
        );

        //##################   INPUT CHANGED
        view.inputChanged = new TableEvent(view);
        controller.view.inputChanged.attach(
            function () {
                console.log('input changed');
                controller.copyTable()
            }
        );
        view.individualSelectChanged = new TableEvent(view);
        controller.view.individualSelectChanged.attach(
            function () {
                //console.log('individual select changed');
                controller.copyTable();
                //controller.view.updateIndividualSelectOptions();
            }
        );

        //##################   EDIT CLICKED
        view.onEditClick = new TableEvent(view);
        controller.view.onEditClick.attach(
            function () {
                if (typeof controller.model.options.onEditClick == 'function') {

                    controller.model.options.onEditClick();
                    console.log('using custom onEditClicked')
                    console.log(controller.model.options)

                }
                else {

                    controller.model.td.table_view = 'edit';
                    controller.model.td.access = 'write';
                    view.updateTable();
                    view.updateButtons();
                    controller.setFocusToFirstInput();
                }


            }
        );

        //##################   CANCEL CLICKED
        view.onCancelClick = new TableEvent(view);
        view.onCancelClick.attach(
            function () {

                //cancel was clicked
                //hide the modal
                //or set view to read

                switch (controller.model.td.table_view) {
                    case 'edit':
                        controller.model.loadOriginalData();

                        if (controller.model.options.edit_display == 'on_page') {
                            view.setViewToShow();
                            //set the original data to the new data

                        }
                        else if (controller.model.options.edit_display == 'modal') {
                            controller.model.options.onCancelClick();
                        }
                        else if (controller.model.options.edit_display == 'modal_only') {
                            controller.model.options.onCancelClick();
                        }

                        break;



                    case 'create':
                        if (typeof controller.model.td.onCancelCreateClick === 'function') {
                            controller.model.td.onCancelCreateClick()
                        }
                        else {
                            console.log('add onCancelCreateClick callback to option array')
                        }
                }


            }
        );

        //##################   SAVE CLICKED
        view.onSaveClick = new TableEvent(view);
        controller.view.onSaveClick.attach(
            function () {
                view.showWaitModal(true);
                let post_data = controller.getPostData();
                //post_data = post_data[0];
                let data = {data: post_data, _method: 'put'};
                console.log('POST data needed for testing')
                console.log(JSON.stringify(data))
                console.log(JSON.stringify(controller.getPostData()))

                $.ajax({
                    url: controller.model.td.route,
                    // type: 'PATCH',
                    type: 'post',
                    data: data,
                    success: function (result) {
                        console.log(JSON.stringify(controller.getPostData()))

                        view.showWaitModal(false);
                        controller.onSaveSuccess.notify(result);
                    },
                    error: function (response) {
                        console.log(response)
                        view.showWaitModal(false);
                        view.showErrorModal(response.responseJSON.message);
                    }
                });
            }
        );

        //##################   SAVE SUCCESS
        controller.onSaveSuccess = new TableEvent(controller);
        controller.onSaveSuccess.attach(
            function (sender, result) {

                console.log('freag')
                switch (controller.model.td.table_view) {
                    case 'create':
                        if (typeof controller.model.options.onCreateSaved === "function") {
                            controller.model.options.onCreateSaved(result.id);
                        }
                        else {
                            alert('add onCreate to table options');
                        }
                        //window.location.href = controller.model.td.route + '/' + result.id;
                        break;
                    case 'edit':
                        //modal or not
                        if (controller.model.options.edit_display == 'on_page') {
                            console.log(result);
                            view.setViewToShow();
                            //set the original data to the new data
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


                        break;
                }

                controller.saveComplete.notify();
                //switch the uri to the new id....

            }
        )

        //##################   SAVE COMPLETE
        controller.saveComplete = new TableEvent(controller);

        //##################   DELETE CLICKED
        view.onDeleteClick = new TableEvent(view);
        view.onDeleteClick.attach(
            function () {
                controller.getConfirm('Are you sure about that delete?', function (result) {
                    if (result) {
                        let self = controller;
                        self.view.showWaitModal(true);
                        //let self2 = self;
                        let data = {_method: 'delete', data: {id: self.model.tdo[0]['id']['data']}};
                        //console.log(JSON.stringify(data));
                        $.ajax({
                            url: self.model.td.route,
                            type: 'post',
                            data: data,
                            success: function (result) {
                                self.view.showWaitModal(false);
                                if (typeof self.model.options.onDeleteSuccess === 'function') {
                                    self.model.options.onDeleteSuccess(result);
                                }
                            }
                        });
                    }
                });
            }
        );


    }

}