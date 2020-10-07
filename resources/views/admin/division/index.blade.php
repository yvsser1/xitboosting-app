@extends('layouts.admin')

@section('title')
    Admin Panel - Divisions
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Divisions</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Division List (Add/Edit/Delet)
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <!-- Button trigger modal -->
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#division-dialog">Add</button>

                            <button class="btn btn-danger btn-sm" id="delete-division">Delete</button>

                            <button class="btn btn-success btn-sm pull-right" id="division-load-data">Refresh</button>

                            @include('admin.division.add')

                            @include('admin.division.edit')

                            @include('admin.division.viwe')

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

            $('#division-table').DataTable({
                responsive: true
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".modal").on("hidden.bs.modal", function(){
                document.getElementById('division-form').reset();
            });
        });

        //------------ Load Table ----------------
        $('#division-load-data').on('click',function (e) {

            $.get("{{ route('divisions-load-data') }}", function (data) {
                $('#table-data').empty();
                $.each(data, function (i, value) {

                    if (value.p_name != null) {
                        img_url = '{{ URL::to('images') .'/' }}' + value.p_name;
                    } else {
                        img_url = 'http://placehold.it/400x400';
                    }
                    var img = '<img height="50" src="' + img_url + '" alt="img">';
                    var tr = $('<tr/>', {
                        id: value.id
                    });
                    tr.append($('<td/>', {
                        text: value.id
                    })).append($('<td/>', {
                        html: img
                    })).append($('<td/>', {
                        text: value.league
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

        //------------ Add Division ------------------
        $("#division-form").on('submit', function(e){
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
                        $('#division-error ul').empty();
                        $('#division-error').css('display','block');
                        $.each(msg.error, function (i, value) {
                            $('#division-error ul').append("<li>"+value+"</li>") ;
                        })
                        //console.log(msg.error);
                    }
                    else
                    {
                        document.getElementById('division-form').reset();
                        $('#division-dialog').modal('toggle');
                        $('#division-load-data').click();
                    }

                }
            });
        });

        //----------- Update Division ------------------
        $("#division-form-edit").on('submit', function(e){
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
                        $('#division-error-edit ul').empty();
                        $('#division-error-edit').css('display','block');
                        $.each(msg.error, function (i, value) {
                            $('#division-error-edit ul').append("<li>"+value+"</li>") ;
                        });
                    }
                    else
                    {
                        document.getElementById('division-form-edit').reset();
                        $('#division-dialog-edit').modal('toggle');
                        $('#division-load-data').click();
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

        //------------ Edit Division Viwe -----------------
        $(document).on('dblclick','#division-table #table-data tr',function (e) {
            var hidden_id = $(this).attr('id');

            $.get("{{ route('divisions-edit') }}",{id:hidden_id},function (data) {
                $('#division-dialog-edit').modal();
                $('#division-form-edit #hidden_id').val(hidden_id);
                $('#division-form-edit input[name="name"]').val(data.name);
                $('#division-form-edit select[name="league_id"] option[value="'+data.league_id+'"]').prop('selected', true);
                if(data.p_name != null)
                {
                    $('#division-form-edit img[name="p_name"]').attr('src','{{ URL::to('images') .'/' }}' + data.p_name);
                }
                else
                {
                    $('#division-form-edit img[name="p_name"]').attr('src','{{ URL::to('images') .'/' }}400x400.png');
                }

            })
        });

        //------------ Delete Division ----------------------
        $(document).on('click','#delete-division',function (e) {
            if ($('input[name="delete"]').is(':checked')) {
                var sList = [];
                $('input[name=delete]:checked').each(function (e,v) {
                    sList.push(v.value);
                });
                console.log(sList)
                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('admin/divisions/delete') }}",
                    data: {id:sList},
                    beforeSend: function(){
                        // $('.submitBtn').attr("disabled","disabled");
                        // $('#fupForm').css("opacity",".5");
                    },
                    success: function(msg){
                        $('#division-load-data').click();
                    }
                });

            }
        });


    </script>

@stop