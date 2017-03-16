
/**
 * Created by embrasse-moi on 2/28/17.
 */

export class DashboardModel{
    constructor(views){
        views.forEach(function (entry) {
            entry.show = true
        });
        this.views = views;
        this.rooms =  [
            {
                name: 'Sales',
                key: 'Customer Counter',
                icon: 'fa fa-door',
                show: true,
                active: false,
                class: 'customer_counter',
            },
            {
                name: 'Operations',
                key: 'Back Room',
                icon: 'fa fa-door',
                show: true,
                active: false,
                class: 'back-room',
            },
            {
                name: 'Accounting',
                key: 'Office',
                icon: 'fa fa-door',
                show: true,
                active: false,
                class: 'office',
            },
            {
                name: 'Systems',
                key: 'System',
                icon: 'fa fa-door',
                show: true,
                active: false,
                class: 'system',
            }

        ]
        this.query = '';

    }
}