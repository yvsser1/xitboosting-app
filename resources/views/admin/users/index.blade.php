@extends('layouts.admin')

@section('title')
    Admin Panel - Users
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Users</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Users List (Add/Edit/Delet)
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <!-- Button trigger modal -->
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#user-dialog">Add</button>

                            <button class="btn btn-danger btn-sm" id="delete-user">Delete</button>

                            <button class="btn btn-success btn-sm pull-right" id="users-load-data">Refresh</button>

                            @include('admin.users.add')

                            @include('admin.users.edit')

                            @include('admin.users.viwe')

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

            $('#user-table').DataTable({
                responsive: true
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".modal").on("hidden.bs.modal", function(){
                document.getElementById('user-form').reset();
            });
        });

        //------------ Load Table ----------------
        $('#users-load-data').on('click',function (e) {

            $.get("{{ route('users-load-data') }}", function (data) {
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
                            text : value.email
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

        //------------ Add User ------------------
        $("#user-form").on('submit', function(e){
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
                        $('#user-error ul').empty();
                        $('#user-error').css('display','block');
                        $.each(msg.error, function (i, value) {
                            $('#user-error ul').append("<li>"+value+"</li>") ;
                        })
                        //console.log(msg.error);
                    }
                    else
                    {
                        document.getElementById('user-form').reset();
                        $('#user-dialog').modal('toggle');
                        $('#users-load-data').click();
                    }

                }
            });
        });

        //----------- Update User ------------------
        $("#user-form-edit").on('submit', function(e){
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
                        $('#user-error-edit ul').empty();
                        $('#user-error-edit').css('display','block');
                        $.each(msg.error, function (i, value) {
                            $('#user-error-edit ul').append("<li>"+value+"</li>") ;
                        });
                    }
                    else
                    {
                        document.getElementById('user-form-edit').reset();
                        $('#user-dialog-edit').modal('toggle');
                        $('#users-load-data').click();
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

        //------------ Edit User Viwe -----------------
        $(document).on('dblclick','#user-table #table-data tr',function (e) {
            var hidden_id = $(this).attr('id');

            $.get("{{ route('edit') }}",{id:hidden_id},function (data) {
                $('#user-dialog-edit').modal();
                $('#user-form-edit #hidden_id').val(hidden_id);
                $('#user-form-edit input[name="name"]').val(data.name);
                $('#user-form-edit input[name="email"]').val(data.email);

            })
        });

        //------------ Delete User ----------------------
        $(document).on('click','#delete-user',function (e) {
            if ($('input[name="delete"]').is(':checked')) {
                var sList = [];
                $('input[name=delete]:checked').each(function (e,v) {
                    sList.push(v.value);
                });
                console.log(sList)
                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('admin/users/delete') }}",
                    data: {id:sList},
                    success: function(msg){
                        $('#users-load-data').click();
                    }
                });

            }
        });


    </script>

@stop