@extends('layouts.admin')

@section('title')
    Admin Panel - Faq
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Faq</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Faq List (Add/Edit/Delet)
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <!-- Button trigger modal -->
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#faq-dialog">Add</button>

                            <button class="btn btn-danger btn-sm" id="delete-faq">Delete</button>

                            <button class="btn btn-success btn-sm pull-right" id="faq-load-data">Refresh</button>

                            @include('admin.faq.add')

                            @include('admin.faq.edit')

                            @include('admin.faq.viwe')

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

            $('#faq-table').DataTable({
                responsive: true
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".modal").on("hidden.bs.modal", function(){
                document.getElementById('faq-form').reset();
            });
        });

        //------------ Load Table ----------------
        $('#faq-load-data').on('click',function (e) {

            $.get("{{ route('faq-load-data') }}", function (data) {
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

        //------------ Add Faq ------------------
        $("#faq-form").on('submit', function(e){
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
                        $('#faq-error ul').empty();
                        $('#faq-error').css('display','block');
                        $.each(msg.error, function (i, value) {
                            $('#faq-error ul').append("<li>"+value+"</li>") ;
                        })
                        //console.log(msg.error);
                    }
                    else
                    {
                        document.getElementById('faq-form').reset();
                        $('#faq-dialog').modal('toggle');
                        $('#faq-load-data').click();
                    }

                }
            });
        });

        //----------- Update Faq ------------------
        $("#faq-form-edit").on('submit', function(e){
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
                        $('#faq-error-edit ul').empty();
                        $('#faq-error-edit').css('display','block');
                        $.each(msg.error, function (i, value) {
                            $('#faq-error-edit ul').append("<li>"+value+"</li>") ;
                        });
                    }
                    else
                    {
                        document.getElementById('faq-form-edit').reset();
                        $('#faq-dialog-edit').modal('toggle');
                        $('#faq-load-data').click();
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

        //------------ Edit Faq Viwe -----------------
        $(document).on('dblclick','#faq-table #table-data tr',function (e) {
            var hidden_id = $(this).attr('id');

            $.get("{{ route('faq-edit') }}",{id:hidden_id},function (data) {
                $('#faq-dialog-edit').modal();
                $('#faq-form-edit #hidden_id').val(hidden_id);
                $('#faq-form-edit input[name="name"]').val(data.name);
                $('#faq-form-edit textarea[name="description"]').val(data.description);

            })
        });

        //------------ Delete Faq ----------------------
        $(document).on('click','#delete-faq',function (e) {
            if ($('input[name="delete"]').is(':checked')) {
                var sList = [];
                $('input[name=delete]:checked').each(function (e,v) {
                    sList.push(v.value);
                });
                console.log(sList)
                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('admin/faq/delete') }}",
                    data: {id:sList},
                    beforeSend: function(){
                        // $('.submitBtn').attr("disabled","disabled");
                        // $('#fupForm').css("opacity",".5");
                    },
                    success: function(msg){
                        $('#faq-load-data').click();
                    }
                });

            }
        });


    </script>

@stop