import {CollectionTableView} from './CollectionTableView'

export class SearchTableView extends CollectionTableView {
    constructor(model){
        super(model);

    }
    createSearchTable() {
        this.searchDiv = this.createSearchDiv();
        this.searchTableElement = this.createSearchTableElement();
        this.searchDiv.appendChild(this.searchTableElement);
        this.searchThead = this.createSearchThead();
        this.searchTableElement.appendChild(this.searchThead);
        this.searchTbody = this.createSearchTbody();
        this.searchTableElement.appendChild(this.searchTbody);
        this.updateSearchTable();
        this.searchDiv.appendChild(this.createSearchButtons())
        this.searchDataTableDiv = this.createDataTableDiv();
        this.searchDiv.appendChild(this.searchDataTableDiv);



        return this.searchDiv;
    }
createSearchButtons(){
    let self = this;
    this.searchButtonDiv = document.createElement('div');
    this.searchButtonDiv.className = "search_buttons";
    this.searchButton = document.createElement('button');
    this.searchButton.className = 'search'
    this.searchButton.onclick = function () {
        self.searchClicked.notify();
    }
    this.searchButton.innerHTML = `<i class="fa fa-binoculars" aria-hidden="true"></i><p>Search</p>`;
    this.searchButtonDiv.appendChild(this.searchButton);
    this.searchResetButton = document.createElement('button');
    this.searchResetButton.onclick = function () {
        self.resetClicked.notify();
    }

    this.searchResetButton.innerHTML = '<p>Reset</p>';
    this.searchResetButton.className = 'reset'

    this.searchButtonDiv.appendChild(this.searchResetButton);
    return this.searchButtonDiv;
}
    updateSearchTable() {
        this.updateSearchThead(this.searchThead);
        this.updateSearchTbody(this.searchTbody);
    }

    createSearchDiv() {
        let div = document.createElement('div');
        let self = this;
        div.addEventListener('keyup', function (event) {
            if (event.which == 13) {
                console.log('enter pressed');
                self.searchClicked.notify();
            }
        });
        return div;
    }

    createSearchTableElement() {

        let tbl = document.createElement('table');
        tbl.id = this.id + '_search';
        tbl.className = 'search_table';
        return tbl;
    }

    createSearchThead() {
        let thead = document.createElement('thead');
        thead.id = this.id + '_search_thead';
        return thead;
    }

    createSearchTbody() {
        let tbody = document.createElement('tbody');
        tbody.id = this.id + '_search_tbody';
        return tbody;
    }
    createDataTableDiv(){
        return document.createElement('div')
    }

    updateSearchThead(thead) {
        let tr = thead.insertRow();
        this.cdo.forEach(col_def => {
            if (typeof col_def['search'] !== 'undefined') {

                let th_width = '';
                if (typeof col_def['th_width'] != 'undefined') {
                    th_width = col_def['th_width'];
                }
                let caption = '';
                if (typeof col_def['caption'] != 'undefined') {
                    caption = col_def['caption'];
                }

                if (col_def['type'] == 'date') {

                    let th = document.createElement('th');
                    th.innerHTML = caption + ' Start Date';
                    th.style.width = th_width;
                    tr.appendChild(th);

                    let th2 = document.createElement('th');
                    th.style.width = th_width;
                    th2.innerHTML = caption + ' END Date';
                    tr.appendChild(th2);

                }
                else {
                    let th = document.createElement('th');
                    th.innerHTML = caption;
                    th.style.width = th_width;
                    tr.appendChild(th);
                }

            }
        })
    }

    updateSearchTbody(tbody) {
        let tr = tbody.insertRow();
        let col_counter = 0;
        this.search_elements = [];
        this.cdo.forEach(col_def => {
            if (typeof col_def['search'] != 'undefined') {
                let th_width = '';
                let cell_html = '';
                let cell = tr.insertCell(col_counter);
                cell.id = "sr0" + "sc" + col_counter;
                col_counter++;
                if (col_def['type'] == 'date') {
                    let element = document.createElement('input');
                    element.type = 'date';
                    element.name = this.name + '_' + col_def['db_field'] + '_date_start';
                    cell.appendChild(element);
                    this.search_elements.push(element)
                    col_def['search_element'] = [];
                    col_def['search_element'][0] = element;



                    cell = tr.insertCell(col_counter);
                    cell.id = "sr0" + "sc" + col_counter;
                    col_counter++;

                    let element2 = document.createElement('input');
                    element2.type = 'date';
                    element2.name = this.name + '_' + col_def['db_field'] + '_date_end';
                    cell.appendChild(element2);
                    this.search_elements.push(element2)
                    col_def['search_element'][1] = element;


                }
                else if (col_def['type'] == 'checkbox') {
                    let element = document.createElement('select');
                    element.name = this.name + '_' + col_def['db_field']
                    let option = document.createElement('option');
                    option.value = 'null';
                    option.appendChild(document.createTextNode("Either"));
                    element.appendChild(option);
                    option = document.createElement('option');
                    option.value = '1';
                    option.appendChild(document.createTextNode('Checked'));
                    element.appendChild(option);
                    option = document.createElement('option');
                    option.value = '0';
                    option.appendChild(document.createTextNode('Not Checked'));
                    element.appendChild(option);
                    cell.appendChild(element);
                    this.search_elements.push(element);
                    col_def['search_element'] = element;
                }
                else if (col_def['type'] == 'select') {
                    let element = this.createSelect(col_def);
                    element.name = this.name + '_' + col_def['db_field']
                    cell.appendChild(element);
                    this.search_elements.push(element)
                    col_def['search_element'] = element;

                }
                else if (col_def['type'] == 'tree_select') {
                    let element = this.createTreeSelect(col_def);
                    element.name = this.name + '_' + col_def['db_field']
                    cell.appendChild(element);
                    this.search_elements.push(element)
                    col_def['search_element'] = element;

                }
                else {
                    let element = document.createElement('input');
                    element.type = col_def.type;
                    element.name = this.name + '_' + col_def['db_field']
                    cell.appendChild(element);
                    this.search_elements.push(element)
                    col_def['search_element'] = element;

                }
            }
        })

    }




    addMessageInsteadOfTable(message)
    {
        let div = document.createElement('div');
        div.innerHTML = message;
        this.searchDataTableDiv.innerHTML = '';
        this.searchDataTableDiv.appendChild(div);
    }
    addDataTable()
    {
        this.searchDataTableDiv.innerHTML = '';
        this.searchDataTableDiv.appendChild(this.createCollectionTable())
    }

    destroyCollectionTable(){
        this.searchDataTableDiv.innerHTML = '';
    }
    searching()
    {
        this.addMessageInsteadOfTable('searching...')

    }




}