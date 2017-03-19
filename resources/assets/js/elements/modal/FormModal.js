export class FormModal {
    constructor(id)
    {
        this.id = id;
        this.form_div = this.id +'_body';
    }
    create(modal_body) {


        let body= this.id+'_body';
        //this one needs bootstrap
        let div = document.createElement('div');

        let template = `
<div id="${this.id}" class="modal fade" tabindex="-1" role="dialog"  data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div id="${this.form_div}" class="modal-body">
      <p>vo vo </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-lg" id="confirmTrue" data-dismiss="modal">OK</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
`
        div.innerHTML = template;
        $(div).find('#'+this.form_div).html(modal_body);
        let return_div = div.children[0];
        $(return_div).keypress(function (e) {
            if (e.which == 13) {
            }
        });
        this.modal_div = return_div;
        return return_div;
    }
    show()
    {
        $(this.modal_div).modal('show');
    }
    hide(){
        $(this.modal_div).modal('hide');
    }
}