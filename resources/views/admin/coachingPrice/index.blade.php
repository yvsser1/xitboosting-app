@extends('layouts.admin')

@section('title')
    Admin Panel - Coaching Price
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Coaching Price</h1>
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
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#coachingprice-dialog">Add</button>

                            <button class="btn btn-danger btn-sm" id="delete-coachingprice">Delete</button>

                            <button class="btn btn-success btn-sm pull-right" id="coachingprice-load-data">Refresh</button>

                            @include('admin.coachingPrice.add')

                            @include('admin.coachingPrice.edit')

                            @include('admin.coachingPrice.viwe')

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

            $('#coachingprice-table').DataTable({
                responsive: true
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".modal").on("hidden.bs.modal", function(){
                document.getElementById('coachingprice-form').reset();
            });
        });

        //------------ Load Table ----------------
        $('#coachingprice-load-data').on('click',function (e) {

            $.get("{{ route('coaching_price-load-data') }}", function (data) {
                $('#table-data').empty();
                $.each(data, function (i, value) {

                    var tr = $('<tr/>', {
                        id: value.id
                    });
                    tr.append($('<td/>', {
                        text: value.id
                    })).append($('<td/>', {
                        text: value.rank
                    })).append($('<td/>', {
                        text: value.hours
                    })).append($('<td/>', {
                        text: value.price
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
        $("#coachingprice-form").on('submit', function(e){
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
                        $('#coachingprice-error ul').empty();
                        $('#coachingprice-error').css('display','block');
                        $.each(msg.error, function (i, value) {
                            $('#coachingprice-error ul').append("<li>"+value+"</li>") ;
                        })
                        //console.log(msg.error);
                    }
                    else
                    {
                        document.getElementById('coachingprice-form').reset();
                        $('#coachingprice-dialog').modal('toggle');
                        $('#coachingprice-load-data').click();
                    }

                }
            });
        });

        //----------- Update Division ------------------
        $("#coachingprice-form-edit").on('submit', function(e){
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
                        $('#coachingprice-error-edit ul').empty();
                        $('#coachingprice-error-edit').css('display','block');
                        $.each(msg.error, function (i, value) {
                            $('#coachingprice-error-edit ul').append("<li>"+value+"</li>") ;
                        });
                    }
                    else
                    {
                        document.getElementById('coachingprice-form-edit').reset();
                        $('#coachingprice-dialog-edit').modal('toggle');
                        $('#coachingprice-load-data').click();
                    }

                }
            });
        });

        //------------ Edit Division Viwe -----------------
        $(document).on('dblclick','#coachingprice-table #table-data tr',function (e) {
            var hidden_id = $(this).attr('id');

            $.get("{{ route('coaching_price-edit') }}",{id:hidden_id},function (data) {
                $('#coachingprice-dialog-edit').modal();
                $('#coachingprice-form-edit #hidden_id').val(hidden_id);
                $('#coachingprice-form-edit input[name="price"]').val(data.price);
                $('#coachingprice-form-edit input[name="hours"]').val(data.hours);
                $('#coachingprice-form-edit select[name="rank"] option[value="'+data.league_id+'"]').prop('selected', true);

            })
        });

        //------------ Delete Division ----------------------
        $(document).on('click','#delete-coachingprice',function (e) {
            if ($('input[name="delete"]').is(':checked')) {
                var sList = [];
                $('input[name=delete]:checked').each(function (e,v) {
                    sList.push(v.value);
                });
                console.log(sList)
                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('admin/coaching_price/delete') }}",
                    data: {id:sList},
                    beforeSend: function(){
                        // $('.submitBtn').attr("disabled","disabled");
                        // $('#fupForm').css("opacity",".5");
                    },
                    success: function(msg){
                        $('#coachingprice-load-data').click();
                    }
                });

            }
        });


    </script>

@stop