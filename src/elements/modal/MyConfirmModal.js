export class MyConfirmModal {

    ///// warning failed at getting this to work...


    constructor(id){
        this.id = id;
    }
    create(){
        let self = this;
        //this one needs bootstrap
        let div = document.createElement('div');


        let template = `
<div id="${this.id}" class="confirmModalDiv modal fade" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="confirmModalContent modal-content">
      <div class="confirmModalHeader modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  
      </div>
      <div class="confirmModalBody modal-body">
         <h3 id="confirmMessage">Confir-mage?</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-danger-light btn-lg" data-dismiss="modal" id="confirmFalse">Cancel</button>
        <button type="button" class="btn btn-primary btn-lg" id="confirmTrue" onclick="self.confirmy()">Confirm</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
`
        div.innerHTML = template;
        let return_div = div.children[0];
        this.confirm_div = return_div
        return return_div
    }
    confirm(callback){
        this.callback = callback;
        this.show()
    }
    confirmy()
    {
        this.callback();
    }
    cancel(){
        return false;
    }
    show()
    {
        console.log('showing error modal')
        $(this.confirm_div).modal('show');
    }
    hide(){
        $(this.confirm_div).modal('hide');
    }
    onClick(){
        console.log('user clicked modal dismiss');
    }

}