/**
 * Created by embrasse-moi on 1/25/17.
 */
import ListEvent from './ListEvent'
export default class ListView {
    constructor(model, elements) {
        this.model = model;
        this.elements = elements;
        console.log(elements.addButton)

        this.listModified = new ListEvent(this);
        this.addButtonClicked = new ListEvent(this);
        this.delButtonClicked = new ListEvent(this);

        let self = this
        this.model.itemAdded.attach(() => {
            self.rebuildList();
        });

        this.model.itemRemoved.attach(() => {
            self.rebuildList();
        });

        this.elements.list.onchange = ((e) => {
            self.listModified.notify({ index : e.target.selectedIndex });
        });

        this.elements.addButton.onclick = alert('wefgdfg')
        // (() => {
        //     alert('wefgdfg')
        //     self.addButtonClicked.notify();
        // });

        this.elements.delButton.onclick = (() => {
            alert('dsfsgasdg')
            self.delButtonClicked.notify();
        });
    }

    show() {
        this.rebuildList();
    }

    rebuildList() {
        let list;
        let items;
        let key;

        list = this.elements.list;
        // list.html('');
        list.innerHTML = '';

        items = this.model.getItems();
        for (key in items) {
            if (items.hasOwnProperty(key)) {
                let temp = document.createElement('option');
                temp.innerHTML = items[key];
                list.append(temp);
            }
        }
        this.model.setSelectedIndex(-1);
    }
}