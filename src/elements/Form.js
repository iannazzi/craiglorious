/**
 * Created by embrasse-moi on 1/20/17.
 */
function noEnter(e)
{
    //this gets rid of the enter key if it is inadvetently submitting the form
    //Add the following attribute into each input type="text" tag(s) in your form:
    //onkeypress="return noEnter()"
    //onkeypress=”return event.keyCode!=13″
    //element.onkeypress = function(e){return noEnter(e);}
    var e=window.event || e;
    return e.keyCode!=13

}
function disableEnterKey(e)
{
    var key;
    if(window.event)
        key = window.event.keyCode; //IE
    else
        key = e.which; //firefox

    return (key != 13);
}