@extends('layouts.admin')

@section('title')
    Admin Panel - Server
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Server</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Server List (Add/Edit/Delet)
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <!-- Button trigger modal -->
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#server-dialog">Add</button>

                            <button class="btn btn-danger btn-sm" id="delete-server">Delete</button>

                            <button class="btn btn-success btn-sm pull-right" id="server-load-data">Refresh</button>

                            @include('admin.server.add')

                            @include('admin.server.edit')

                            @include('admin.server.viwe')

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

            $('#server-table').DataTable({
                responsive: true
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".modal").on("hidden.bs.modal", function(){
                document.getElementById('server-form').reset();
            });
        });

        //------------ Load Table ----------------
        $('#server-load-data').on('click',function (e) {

            $.get("{{ route('servers-load-data') }}", function (data) {
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

        //------------ Add Server ------------------
        $("#server-form").on('submit', function(e){
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
                        $('#server-error ul').empty();
                        $('#server-error').css('display','block');
                        $.each(msg.error, function (i, value) {
                            $('#server-error ul').append("<li>"+value+"</li>") ;
                        })
                        //console.log(msg.error);
                    }
                    else
                    {
                        document.getElementById('server-form').reset();
                        $('#server-dialog').modal('toggle');
                        $('#server-load-data').click();
                    }

                }
            });
        });

        //----------- Update Server ------------------
        $("#server-form-edit").on('submit', function(e){
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
                        $('#server-error-edit ul').empty();
                        $('#server-error-edit').css('display','block');
                        $.each(msg.error, function (i, value) {
                            $('#server-error-edit ul').append("<li>"+value+"</li>") ;
                        });
                    }
                    else
                    {
                        document.getElementById('server-form-edit').reset();
                        $('#server-dialog-edit').modal('toggle');
                        $('#server-load-data').click();
                    }

                }
            });
        });

        //file type validation
        $('input[name="photo_id"]').change(function() {
            var file = this.files[0];
            var imagefile = file.type;
            var match= ["image/jpeg","image/png","image/jpg"];
            if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
                alert('Please select a valid image file (JPEG/JPG/PNG).');
                $('input[name="photo_id"]').val('');
                return false;
            }
        });

        //------------ Edit Server Viwe -----------------
        $(document).on('dblclick','#server-table #table-data tr',function (e) {
            var hidden_id = $(this).attr('id');

            $.get("{{ route('servers-edit') }}",{id:hidden_id},function (data) {
                $('#server-dialog-edit').modal();
                $('#server-form-edit #hidden_id').val(hidden_id);
                $('#server-form-edit input[name="name"]').val(data.name);
                $('#server-form-edit textarea[name="description"]').val(data.description);

            })
        });

        //------------ Delete Server ----------------------
        $(document).on('click','#delete-server',function (e) {
            if ($('input[name="delete"]').is(':checked')) {
                var sList = [];
                $('input[name=delete]:checked').each(function (e,v) {
                    sList.push(v.value);
                });
                console.log(sList)
                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('admin/servers/delete') }}",
                    data: {id:sList},
                    beforeSend: function(){
                        // $('.submitBtn').attr("disabled","disabled");
                        // $('#fupForm').css("opacity",".5");
                    },
                    success: function(msg){
                        $('#server-load-data').click();
                    }
                });

            }
        });


    </script>

@stop