@extends('layouts.admin')

@section('title')
    Admin Panel - Queue
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Queue</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Queue List (Add/Edit/Delet)
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <!-- Button trigger modal -->
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#queue-dialog">Add</button>

                            <button class="btn btn-danger btn-sm" id="delete-queue">Delete</button>

                            <button class="btn btn-success btn-sm pull-right" id="queue-load-data">Refresh</button>

                            @include('admin.queue.add')

                            @include('admin.queue.edit')

                            @include('admin.queue.viwe')

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

            $('#queue-table').DataTable({
                responsive: true
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".modal").on("hidden.bs.modal", function(){
                document.getElementById('queue-form').reset();
            });
        });

        //------------ Load Table ----------------
        $('#queue-load-data').on('click',function (e) {

            $.get("{{ route('queues-load-data') }}", function (data) {
                $('#table-data').empty();
                $.each(data, function (i, value) {

                    var tr = $('<tr/>',{
                        id : value.id
                    });
                    tr.append($('<td/>',{
                        text : value.id
                    })).append($('<td/>',{
                        text : value.name
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

        //------------ Add Queue ------------------
        $("#queue-form").on('submit', function(e){
            e.preventDefault();
            var url = $(this).attr('action');
            var post = $(this).attr('method');
            $.ajax({
                type: post,
                url: url,
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function(){
                    // $('.submitBtn').attr("disabled","disabled");
                    // $('#fupForm').css("opacity",".5");
                },
                success: function(msg){
                    if(msg.error)
                    {
                        $('#queue-error ul').empty();
                        $('#queue-error').css('display','block');
                        $.each(msg.error, function (i, value) {
                            $('#queue-error ul').append("<li>"+value+"</li>") ;
                        })
                        //console.log(msg.error);
                    }
                    else
                    {
                        document.getElementById('queue-form').reset();
                        $('#queue-dialog').modal('toggle');
                        $('#queue-load-data').click();
                    }

                }
            });
        });

        //----------- Update Queue ------------------
        $("#queue-form-edit").on('submit', function(e){
            e.preventDefault();
            var url = $(this).attr('action');
            var post = $(this).attr('method');
            $.ajax({
                type: post,
                url: url,
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function(){
                    // $('.submitBtn').attr("disabled","disabled");
                    // $('#fupForm').css("opacity",".5");
                },
                success: function(msg){
                    if(msg.error)
                    {
                        $('#queue-error-edit ul').empty();
                        $('#queue-error-edit').css('display','block');
                        $.each(msg.error, function (i, value) {
                            $('#queue-error-edit ul').append("<li>"+value+"</li>") ;
                        });
                    }
                    else
                    {
                        document.getElementById('queue-form-edit').reset();
                        $('#queue-dialog-edit').modal('toggle');
                        $('#queue-load-data').click();
                    }

                }
            });
        });

        //------------ Edit Queue Viwe -----------------
        $(document).on('dblclick','#queue-table #table-data tr',function (e) {
            var hidden_id = $(this).attr('id');

            $.get("{{ route('queues-edit') }}",{id:hidden_id},function (data) {
                $('#queue-dialog-edit').modal();
                $('#queue-form-edit #hidden_id').val(hidden_id);
                $('#queue-form-edit input[name="name"]').val(data.name);
                $('#queue-form-edit textarea[name="description"]').val(data.description);

            })
        });

        //------------ Delete Queue ----------------------
        $(document).on('click','#delete-queue',function (e) {
            if ($('input[name="delete"]').is(':checked')) {
                var sList = [];
                $('input[name=delete]:checked').each(function (e,v) {
                    sList.push(v.value);
                });
                console.log(sList)
                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('admin/queues/delete') }}",
                    data: {id:sList},
                    beforeSend: function(){
                        // $('.submitBtn').attr("disabled","disabled");
                        // $('#fupForm').css("opacity",".5");
                    },
                    success: function(msg){
                        $('#queue-load-data').click();
                    }
                });

            }
        });


    </script>

@stop