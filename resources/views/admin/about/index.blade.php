@extends('layouts.admin')

@section('title')
    Admin Panel - About
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">About</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    About List (Edit)
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <!-- Button trigger modal -->

                            <button class="btn btn-success btn-sm pull-right" id="about-load-data">Refresh</button>

                            @include('admin.about.add')

                            @include('admin.about.edit')

                            @include('admin.about.viwe')

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

            $('#about-table').DataTable({
                responsive: true
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".modal").on("hidden.bs.modal", function(){
                document.getElementById('about-form').reset();
            });
        });

        //------------ Load Table ----------------
        $('#about-load-data').on('click',function (e) {

            $.get("{{ route('about-load-data') }}", function (data) {
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
                        text : value.text
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

        //----------- Update About ------------------
        $("#about-form-edit").on('submit', function(e){
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
                        $('#about-error-edit ul').empty();
                        $('#about-error-edit').css('display','block');
                        $.each(msg.error, function (i, value) {
                            $('#about-error-edit ul').append("<li>"+value+"</li>") ;
                        });
                    }
                    else
                    {
                        document.getElementById('about-form-edit').reset();
                        $('#about-dialog-edit').modal('toggle');
                        $('#about-load-data').click();
                    }

                }
            });
        });

        //------------ Edit About Viwe -----------------
        $(document).on('dblclick','#about-table #table-data tr',function (e) {
            var hidden_id = $(this).attr('id');

            $.get("{{ route('about-edit') }}",{id:hidden_id},function (data) {
                $('#about-dialog-edit').modal();
                $('#about-form-edit #hidden_id').val(hidden_id);
                $('#about-form-edit input[name="name"]').val(data.name);
                $('#about-form-edit textarea[name="text"]').val(data.text);

            })
        });

    </script>

@stop