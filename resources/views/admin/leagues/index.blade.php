@extends('layouts.admin')

@section('title')
    Admin Panel - Leagues
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Leagues</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    League List (Add/Edit/Delet)
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <!-- Button trigger modal -->
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#league-dialog">Add</button>

                            <button class="btn btn-danger btn-sm" id="delete-league">Delete</button>

                            <button class="btn btn-success btn-sm pull-right" id="league-load-data">Refresh</button>

                            @include('admin.leagues.add')

                            @include('admin.leagues.edit')

                            @include('admin.leagues.viwe')

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

            $('#league-table').DataTable({
                responsive: true
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".modal").on("hidden.bs.modal", function(){
                document.getElementById('league-form').reset();
            });
        });

        //------------ Load Table ----------------
        $('#league-load-data').on('click',function (e) {

            $.get("{{ route('leagues-load-data') }}", function (data) {
                $('#table-data').empty();
                $.each(data, function (i, value) {

                    var tr = $('<tr/>', {
                        id: value.id
                    });
                    tr.append($('<td/>', {
                        text: value.id
                    })).append($('<td/>', {
                        text: value.name
                    })).append($('<td/>', {
                        text: value.created_at
                    })).append($('<td/>', {
                        text: value.updated_at
                    })).append($('<td/>', {
                        html: '<input type="checkbox" name="delete" value="' + value.id + '">'
                    }));
                    $('#table-data').append(tr);
                });
            });

        });

        //------------ Add League ------------------
        $("#league-form").on('submit', function(e){
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
                        $('#league-error ul').empty();
                        $('#league-error').css('display','block');
                        $.each(msg.error, function (i, value) {
                            $('#league-error ul').append("<li>"+value+"</li>") ;
                        })
                        //console.log(msg.error);
                    }
                    else
                    {
                        document.getElementById('league-form').reset();
                        $('#league-dialog').modal('toggle');
                        $('#league-load-data').click();
                    }

                }
            });
        });

        //----------- Update League ------------------
        $("#league-form-edit").on('submit', function(e){
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
                        $('#league-error-edit ul').empty();
                        $('#league-error-edit').css('display','block');
                        $.each(msg.error, function (i, value) {
                            $('#league-error-edit ul').append("<li>"+value+"</li>") ;
                        });
                    }
                    else
                    {
                        document.getElementById('league-form-edit').reset();
                        $('#league-dialog-edit').modal('toggle');
                        $('#league-load-data').click();
                    }

                }
            });
        });


        //------------ Edit League Viwe -----------------
        $(document).on('dblclick','#league-table #table-data tr',function (e) {
            var hidden_id = $(this).attr('id');

            $.get("{{ route('leagues-edit') }}",{id:hidden_id},function (data) {
                $('#league-dialog-edit').modal();
                $('#league-form-edit #hidden_id').val(hidden_id);
                $('#league-form-edit input[name="name"]').val(data.name);

            })
        });

        //------------ Delete League ----------------------
        $(document).on('click','#delete-league',function (e) {
            if ($('input[name="delete"]').is(':checked')) {
                var sList = [];
                $('input[name=delete]:checked').each(function (e,v) {
                    sList.push(v.value);
                });
                console.log(sList)
                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('admin/leagues/delete') }}",
                    data: {id:sList},
                    beforeSend: function(){
                        // $('.submitBtn').attr("disabled","disabled");
                        // $('#fupForm').css("opacity",".5");
                    },
                    success: function(msg){
                        $('#league-load-data').click();
                    }
                });

            }
        });


    </script>

@stop