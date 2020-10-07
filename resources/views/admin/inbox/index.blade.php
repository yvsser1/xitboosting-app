@extends('layouts.admin')

@section('title')
    Admin Panel - Inbox
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Inbox</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Inbox List (View/Delet)
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <!-- Button trigger modal -->

                            <button class="btn btn-danger btn-sm" id="delete-inbox">Delete</button>

                            <button class="btn btn-success btn-sm pull-right" id="inbox-load-data">Refresh</button>

                            @include('admin.inbox.add')

                            @include('admin.inbox.edit')

                            @include('admin.inbox.viwe')

                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
@stop

@section('script')

    <!-- DataTables JavaScript -->
    <script src="{{ asset('js/lib/dataTables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/lib/dataTables/dataTables.bootstrap.min.js') }}"></script>

    <script>
        $(document).ready(function() {

            $('#inbox-table').DataTable({
                responsive: true
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".modal").on("hidden.bs.modal", function(){
                document.getElementById('inbox-form').reset();
            });
        });

        //------------ Load Table ----------------
        $('#inbox-load-data').on('click',function (e) {

            $.get("{{ route('inbox-load-data') }}", function (data) {
                $('#table-data').empty();
                $.each(data, function (i, value) {

                    var tr = $('<tr/>',{
                        id : value.id
                    });
                    tr.append($('<td/>',{
                        text : value.id
                    })).append($('<td/>',{
                        text : value.subject
                    })).append($('<td/>',{
                        text : value.email
                    })).append($('<td/>',{
                        text : value.description
                    })).append($('<td/>',{
                        text : value.created_at
                    })).append($('<td/>',{
                        text : value.updated_at
                    })).append($('<td/>',{
                        html : '<input type="checkbox" name="delete" value="'+value.id+'">'
                    }));
                    $('#table-data').append(tr);
                })
            });

        });


        //------------ Edit Inbox Viwe -----------------
        $(document).on('dblclick','#table-data tr',function (e) {
            var hidden_id = $(this).attr('id');

            $.get("{{ route('inbox-edit') }}",{id:hidden_id},function (data) {
                $('#inbox-dialog-edit').modal();
                $('#inbox-form-edit #hidden_id').val(hidden_id);
                $('#inbox-form-edit input[name="subject"]').val(data.subject);
                $('#inbox-form-edit input[name="email"]').val(data.email);
                $('#inbox-form-edit textarea[name="description"]').val(data.description);


            })
        });

        //------------ Delete Inbox ----------------------
        $(document).on('click','#delete-inbox',function (e) {
            if ($('input[name="delete"]').is(':checked')) {
                var sList = [];
                $('input[name=delete]:checked').each(function (e,v) {
                    sList.push(v.value);
                });
                console.log(sList)
                $.ajax({
                    type: 'POST',
                    url: "{{ route('inbox-delete') }}",
                    data: {id:sList},
                    beforeSend: function(){
                        // $('.submitBtn').attr("disabled","disabled");
                        // $('#fupForm').css("opacity",".5");
                    },
                    success: function(msg){
                        $('#inbox-load-data').click();inbox                 }
                });

            }
        });


    </script>

@stop