/**
 * Created by embrasse-moi on 2/4/17.
 */
import {pageSetup} from './pageSetup'
$(function(){
    let div = document.getElementById("data_table_view");
    div.appendChild(pageSetup(server_response_data));
});