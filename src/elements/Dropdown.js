/**
 * Created by embrasse-moi on 1/18/17.
 */
export default class Dropdown{
    constructor(){
        console.log('Dropdown.js ready')
    }
    dump() {
        console.log('Dropdown.js ready')
    }

    addValuesToSelect(element_id, values, captions)
    {
        element = document.getElementById(element_id);
        removeSelectOptions(element_id);
        option = document.createElement('option');
        option.value = 'false';
        option.appendChild(document.createTextNode('Select a Value'));
        element.appendChild(option);
        for(i=0;i<values.length;i++)
        {
            option = document.createElement('option');
            option.value = values[i];
            option.appendChild(document.createTextNode(captions[i]));
            element.appendChild(option);
        }

    }
    removeSelectOptions(element_id)
    {
        var element = document.getElementById(element_id);
        var i;
        for (i = element.length - 1; i>=0; i--)
        {
            element.remove(i);

        }
    }
}

