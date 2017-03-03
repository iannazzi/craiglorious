/**
 * Created by embrasse-moi on 1/25/17.
 */
import ListEvent from './ListEvent'
export default class ListModel {
    constructor(items) {
        this.items = items;
        this.selectedIndex = -1;

        this.itemAdded = new ListEvent(this);
        this.itemRemoved = new ListEvent(this);
        this.selectedIndexChanged = new ListEvent(this);
    }

    getItems() {
        return [].concat(this.items);
    }

    addItem(item) {
        this.items.push(item);
        this.itemAdded.notify({ item : item });
    }

    removeItemAt(index) {
        let item = this.items[index];
        this.items.splice(index, 1);
        this.itemRemoved.notify({ item : item });
        if (index === this.selectedIndex) {
            this.setSelectedIndex(-1);
        }
    }

    getSelectedIndex() {
        return this.selectedIndex;
    }

    setSelectedIndex(index) {
        let previousIndex;

        previousIndex = this.selectedIndex;
        this.selectedIndex = index;
        this.selectedIndexChanged.notify({ previous : previousIndex });
    }
}