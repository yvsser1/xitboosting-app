@extends('layouts.admin')

@section('title')
    Admin Panel - Gallery
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Gallery</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Gallery List (Add/Edit/Delet)
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <!-- Button trigger modal -->
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#gallery-dialog">Add</button>

                            <button class="btn btn-danger btn-sm" id="delete-gallery">Delete</button>

                            <button class="btn btn-success btn-sm pull-right" id="gallery-load-data">Refresh</button>

                            @include('admin.gallery.add')

                            @include('admin.gallery.edit')

                            @include('admin.gallery.viwe')

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

            $('#gallery-table').DataTable({
                responsive: true
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".modal").on("hidden.bs.modal", function(){
                document.getElementById('gallery-form').reset();
            });
        });

        //------------ Load Table ----------------
        $('#gallery-load-data').on('click',function (e) {

            $.get("{{ route('gallery-load-data') }}", function (data) {
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

        //------------ Add Gallery ------------------
        $("#gallery-form").on('submit', function(e){
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
                        $('#gallery-error ul').empty();
                        $('#gallery-error').css('display','block');
                        $.each(msg.error, function (i, value) {
                            $('#gallery-error ul').append("<li>"+value+"</li>") ;
                        })
                        //console.log(msg.error);
                    }
                    else
                    {
                        document.getElementById('gallery-form').reset();
                        $('#gallery-dialog').modal('toggle');
                        $('#gallery-load-data').click();
                    }

                }
            });
        });

        //----------- Update Gallery ------------------
        $("#gallery-form-edit").on('submit', function(e){
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
                        $('#gallery-error-edit ul').empty();
                        $('#gallery-error-edit').css('display','block');
                        $.each(msg.error, function (i, value) {
                            $('#gallery-error-edit ul').append("<li>"+value+"</li>") ;
                        });
                    }
                    else
                    {
                        document.getElementById('gallery-form-edit').reset();
                        $('#gallery-dialog-edit').modal('toggle');
                        $('#gallery-load-data').click();
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

        //------------ Edit Gallery Viwe -----------------
        $(document).on('dblclick','#gallery-table #table-data tr',function (e) {
            var hidden_id = $(this).attr('id');

            $.get("{{ route('gallery-edit') }}",{id:hidden_id},function (data) {
                $('#gallery-dialog-edit').modal();
                $('#gallery-form-edit #hidden_id').val(hidden_id);
                $('#gallery-form-edit input[name="name"]').val(data.name);
                if(data.p_name != null)
                {
                    $('#gallery-form-edit img[name="p_name"]').attr('src','{{ URL::to('images') .'/' }}' + data.p_name);
                }
                else
                {
                    $('#gallery-form-edit img[name="p_name"]').attr('src','{{ URL::to('images') .'/' }}400x400.png');
                }

            })
        });

        //------------ Delete Gallery ----------------------
        $(document).on('click','#delete-gallery',function (e) {
            if ($('input[name="delete"]').is(':checked')) {
                var sList = [];
                $('input[name=delete]:checked').each(function (e,v) {
                    sList.push(v.value);
                });
                console.log(sList)
                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('admin/gallery/delete') }}",
                    data: {id:sList},
                    beforeSend: function(){
                        // $('.submitBtn').attr("disabled","disabled");
                        // $('#fupForm').css("opacity",".5");
                    },
                    success: function(msg){
                        $('#gallery-load-data').click();
                    }
                });

            }
        });


    </script>

@stop