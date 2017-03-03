import {tableTests} from '../../elements/tables/tests/tableTests'
$(function () {
    let div = document.getElementById("tests");
    div.appendChild(tableTests());
});