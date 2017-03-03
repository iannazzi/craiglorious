/**
 * Created by embrasse-moi on 1/25/17.
 */
export default class ListController {
    constructor(model, view) {
        console.log('ho from ListController')
        this.model = model;
        this.view = view;

        let self = this;
        this.view.listModified.attach((sender, args) => {
            self.updateSelected(args.index);
        });

        this.view.addButtonClicked.attach(() => {
            self.addItem();
        });
        this.view.delButtonClicked.attach(() => {
            self.delItem();
        });
    }

    addItem() {
        console.log('add item');
        let item = window.prompt('Add item:', '');
        if (item) {
            this.model.addItem(item);
        }
    }

    delItem() {
        let index;
        index = this.model.getSelectedIndex();
        if (index !== -1) {
            this.model.removeItemAt(this.model.getSelectedIndex());
        }
    }

    updateSelected(index) {
        this.model.setSelectedIndex(index);
    }
}