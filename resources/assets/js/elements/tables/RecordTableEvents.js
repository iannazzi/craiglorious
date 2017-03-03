import {TableEvent} from './TableEvent'
import {TableEvents} from './TableEvents'


export class RecordTableEvents extends TableEvents {

    constructor(controller) {
        super(controller);
        let view = controller.view;


        controller.loadPageEvent = new TableEvent(controller);
        controller.loadPageEvent.attach(
            function () {

                console.log('load page event...')

                switch (controller.model.td.table_type) {
                    case 'create':
                        //show save/cancel
                        controller.model.td.access = 'write';
                        controller.view.setViewCreate()
                        controller.setFocusToFirstInput();
                        break;
                    case 'edit':
                        controller.model.td.access = 'write';
                        controller.view.setViewEdit()
                        break;
                    case 'show':
                        controller.view.setViewShow()
                        break;
                }
            }
        );
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
        view.editClicked = new TableEvent(view);
        controller.view.editClicked.attach(
            function () {
                controller.model.td.table_type = 'edit';
                controller.view.setViewEdit();
                controller.setFocusToFirstInput();

            }
        );
        view.cancelClicked = new TableEvent(view);
        controller.view.cancelClicked.attach(
            function () {
                switch (controller.model.td.table_type) {
                    case 'edit':
                        controller.model.loadOriginalData();
                        controller.model.td.table_type = 'show';
                        controller.view.setViewShow()
                        break;
                    case 'create':
                        window.location.href = '../' + controller.model.td.route;
                        break;
                }


            }
        );
        view.saveClicked = new TableEvent(view);
        controller.view.saveClicked.attach(
            function () {
                controller.submitSave();
            }
        );
        view.deleteClicked = new TableEvent(view);
        controller.view.deleteClicked.attach(
            function () {
                controller.getConfirm('Are you sure about that delete?', function (result) {
                    if (result) {
                        controller.delete();
                    }
                });
            }
        );
        controller.saveReturned = new TableEvent(controller);
        controller.saveReturned.attach(
            function () {
                controller.view.setViewShow();
            }
        )
        controller.saveComplete = new TableEvent(controller);



    }

}