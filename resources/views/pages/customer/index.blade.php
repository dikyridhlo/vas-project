@extends('template.index')

@section('title', 'Customer')
@section('content')
<div class="row h-100 justify-content-center align-items-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <a class="text-danger" href="{{ url('logout') }}">Logout</a>
                    </div>
                    <div class="col-md-6">
                        <h1>Customer</h1>
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="btn btn-primary float-right" id="modal-btn">
                            Add Customer
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <table class="table table-striped data-list-view w-100" id="table-data">
                    <thead>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Location</th>
                        <th>Action</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


    <!-- Modal -->
    <div class="modal fade" id="CustomerModal" tabindex="-1" role="dialog" aria-labelledby="CustomerModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Customer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save-form">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-js')
    <script>
         table = $('#table-data').AppTable({
                url : "{{ url('customer/get-data') }}",
                column : [
                    {"data":"first_name" , "name":"first_name"},
                    {"data":"last_name" , "name":"last_name"},
                    {"data":"location_name" , "name":"location_name"},
                    {"data":"action" , "name":"action"},
                ],
                cant_order: [{
                    "targets": 3,
                    "orderable": false
                }]

            })
            $('#modal-btn').click(function(){
                $('#CustomerModal').modal('show');
            });
            $('#CustomerModal').on('shown.bs.modal', function () {
                request_form();
            })
            function request_form(){
                $.ajax({
                    type: "GET",
                    url: "{{ url('customer/form') }}",
                    dataType: "html",
                    success: function (response) {
                        $('#CustomerModal .modal-body').html(response);
                    }
                });
            }
        $('#save-form').click(function(){
            console.log($('#form').attr('action'));

            submitdata({
                DisabledButton  : $('#save-form'),
                url             : $('#form').attr('action'),
                data            : $('#form').get(0),
                type            : "POST",
                modal           : $('#CustomerModal'),
            });
            // $('#form').SubmitForm({
            //     DisabledButton  : $('#save-form'),
            //     url             : $('#form').attr('action'),
            //     data            : $('#form').get(0),
            //     type            : "POST",
            // });
        });
    </script>
@endsection
