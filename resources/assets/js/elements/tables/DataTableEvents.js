import {TableEvent} from './TableEvent'
import {TableEvents} from './TableEvents'


export class DataTableEvents extends TableEvents{

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
        view.headerClicked = new TableEvent(view);
        view.editClicked = new TableEvent(view);
        view.cancelClicked = new TableEvent(view);
        view.saveClicked = new TableEvent(view);

        controller.createTableEvent.attach(
            function () {


            }
        );

        controller.view.editClicked.attach(
            function () {
                model.td.access = 'write';
                view.setViewWrite();
                view.updateTable();
            }
        );

        controller.view.cancelClicked.attach(
            function () {

                model.td.access = 'read';
                model.loadOriginalData();
                view.setViewReadOnly();
                view.updateTable();

            }
        );
        controller.view.saveClicked.attach(
            function () {
                controller.submitSave();
            }
        );

        let self = controller;
        view.headerClicked.attach(
            function (sender, args) {
                //coming in from click the header
                //set the uri and stored uri
                let uri = new JsUri(window.location.href)
                let event = args[0];
                let th = args[1];
                //this code is the tri-selector: switches between none, asc, and desc
                self.sort_array = ['none', 'asc', 'desc'];
                let i = th.sort;
                i = ++i % self.sort_array.length;
                th.sort = i;

                let name = th.col_def.db_field

                if (!event.shiftKey) {
                    self.removeSortFromUri(uri, th)
                    self.view.header_array.forEach(th_element => {
                        if (th != th_element) {
                            self.removeSortFromSavedArray(th_element.col_def.db_field);
                        }
                    })
                }

                switch (self.sort_array[i]) {
                    case 'none':
                        uri.deleteQueryParam(name + '_sort')
                        self.removeSortFromSavedArray(name);
                        break;
                    case 'asc':
                        self.addSortToSavedArray(name, 'asc')
                        uri.addQueryParam(name + '_sort', 'asc')
                        break;
                    case 'desc':
                        uri.deleteQueryParam(name + '_sort')
                        uri.addQueryParam(name + '_sort', 'desc')
                        self.removeSortFromSavedArray(name)
                        self.addSortToSavedArray(name, 'desc')
                        break;
                }
                self.view.updateHeaderSortView();
                sessionStorage[self.saved_sort] = JSON.stringify(self.view.saved_sort_array);
                self.pushState(uri);
                self.model.sortData(self.view.saved_sort_array)
                self.view.updateTable();

            }
        )
        controller.view.addColumnClicked.attach(
            function () {
                self.model.addColumnToArray(self.view.array_col);
                self.view.updateTable();
            }
        )
        controller.view.deleteColumnClicked.attach(
            function () {
                self.model.deleteColumnFromArray(self.view.array_col);
                self.view.updateTable();
            }
        )
        controller.view.addRowClicked.attach(
            function () {
                //adds a row to the table model
                self.addRow()
                //table model notifies that it has changed
                //at controller point we can perform calculation directly on the model so that it will render
                self.view.updateTable();

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