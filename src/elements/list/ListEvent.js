/**
 * Created by embrasse-moi on 1/25/17.
 */
export default class ListEvent {
    constructor(sender) {
        this.sender = sender;
        this.listeners = [];
    }

    attach(listener) {
        console.log('hi from listEvent listen')

        this.listeners.push(listener);
    }

    notify(args) {
        console.log(args)

        let index;
        for (index = 0; index < this.listeners.length; index += 1) {
            this.listeners[index](this.sender, args);
        }
    }
}