var table;
(function( $ ){
    $.fn.AppTable = function(obj) {
       return  $(this).DataTable({
            processing: true,
            serverSide: false,
            ajax: obj.url,
            columns: obj.column,
            "columnDefs": obj.cant_order,

        });
    };
 })( jQuery );
function refresh_table(){
    if (table) {
        table.ajax.reload();
    }
}
function submitdata(obj){
    console.log(obj);
    $.ajax({
        type: obj.type,
        url: obj.url,
        data: new FormData(obj.data),
        dataType: "json",
        processData: false,
        contentType: false,
        success: function (response) {
            if(response.code == 1){
                Swal.fire(
                    'Saved!',
                    'Data has been saved.',
                    'success'
                ).then((result) => {
                    if(obj.refresh_page){
                        window.location.replace(obj.refresh_page);
                    }else{
                        obj.modal.modal('hide');
                        refresh_table();
                    }
                });
            }else{

                Swal.fire({
                    title: 'Warning!',
                    text: response.messages,
                    type: 'warning',
                }).then((result) => {
                    obj.DisabledButton.attr("disabled" , false);
                    obj.DisabledButton.text(obj.btn_old_name);

                });

            }
        },
        error: function(data){
            obj.DisabledButton.attr("disabled" , false);
            obj.DisabledButton.text("Save");
            if( data.status === 422 ) {
                console.log(data.responseText);
                $('.text-alert').remove();
                var errors = JSON.parse(data.responseText);
                obj.customMessage = obj.customMessage ? true : false;
                $.each(errors.errors, function (key, value) {
                    if(obj.customMessage){
                        validate = $('[name="'+key+'"]') ? $('[name="'+key+'"]') : $('[name="'+key+'[]"]');
                        validate.closest('.form-group').append('<small class="text-danger text-alert">*'+value+'</small>');
                    }else{
                        $('[name="'+key+'"]').closest('.form-group').append('<small class="text-danger text-alert">*data cannot be empty</small>');
                    }

                });
            }
        }
    });
}
$(document).on('click' , '.delete-data', function (e) {
    e.preventDefault();
    var refreshData = $(this).data('refresh');
       Swal.fire({
           title: 'Are you sure delete this data?',
           text: "You cant revert your change!",
           type: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#349ce4',
           cancelButtonColor: '#d33',
           confirmButtonText: 'Delete'
       }).then((result) => {
           console.log(result);
           if (result.value == true) {

               $.ajax({
                   type: "GET",
                   url: $(this).attr('href'),
                   dataType: "json",
                   success: function (response) {
                       Swal.fire(
                           'Deleted!',
                           'Data successful deleted.',
                           'success'
                       ).then((result) => {
                           if(refreshData){
                               location.reload();
                           }else{
                               refresh_table();
                           }
                       });

                   }
               });
           }
       });
});

