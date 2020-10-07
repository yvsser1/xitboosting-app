@extends('layouts.admin')

@section('title')
    Admin Panel - Service Price
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Service Price</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Service List (Add/Edit/Delet)
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <!-- Button trigger modal -->
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#serviceprice-dialog">Add</button>

                            <button class="btn btn-danger btn-sm" id="delete-serviceprice">Delete</button>

                            <button class="btn btn-success btn-sm pull-right" id="serviceprice-load-data">Refresh</button>

                            @include('admin.servicePrice.add')

                            @include('admin.servicePrice.edit')

                            @include('admin.servicePrice.viwe')

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

            $('#serviceprice-table').DataTable({
                responsive: true
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".modal").on("hidden.bs.modal", function(){
                document.getElementById('serviceprice-form').reset();
            });
        });

        //------------ Load Table ----------------
        $('#serviceprice-load-data').on('click',function (e) {

            $.get("{{ route('service_price-load-data') }}", function (data) {
                $('#table-data').empty();
                $.each(data, function (i, value) {

                    var tr = $('<tr/>', {
                        id: value.id
                    });
                    tr.append($('<td/>', {
                        text: value.id
                    })).append($('<td/>', {
                        text: value.service
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

        //------------ Add Service ------------------
        $("#serviceprice-form").on('submit', function(e){
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
                        $('#serviceprice-error ul').empty();
                        $('#serviceprice-error').css('display','block');
                        $.each(msg.error, function (i, value) {
                            $('#serviceprice-error ul').append("<li>"+value+"</li>") ;
                        })
                        //console.log(msg.error);
                    }
                    else
                    {
                        document.getElementById('serviceprice-form').reset();
                        $('#serviceprice-dialog').modal('toggle');
                        $('#serviceprice-load-data').click();
                    }

                }
            });
        });

        //----------- Update Service ------------------
        $("#serviceprice-form-edit").on('submit', function(e){
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
                        $('#serviceprice-error-edit ul').empty();
                        $('#serviceprice-error-edit').css('display','block');
                        $.each(msg.error, function (i, value) {
                            $('#serviceprice-error-edit ul').append("<li>"+value+"</li>") ;
                        });
                    }
                    else
                    {
                        document.getElementById('serviceprice-form-edit').reset();
                        $('#serviceprice-dialog-edit').modal('toggle');
                        $('#serviceprice-load-data').click();
                    }

                }
            });
        });

        //------------ Edit Service Viwe -----------------
        $(document).on('dblclick','#serviceprice-table #table-data tr',function (e) {
            var hidden_id = $(this).attr('id');

            $.get("{{ route('service_price-edit') }}",{id:hidden_id},function (data) {
                $('#serviceprice-dialog-edit').modal();
                $('#serviceprice-form-edit #hidden_id').val(hidden_id);
                $('#serviceprice-form-edit input[name="price"]').val(data.price);
                $('#serviceprice-form-edit select[name="service"] option[value="'+data.service+'"]').prop('selected', true);

            })
        });

        //------------ Delete Service ----------------------
        $(document).on('click','#delete-serviceprice',function (e) {
            if ($('input[name="delete"]').is(':checked')) {
                var sList = [];
                $('input[name=delete]:checked').each(function (e,v) {
                    sList.push(v.value);
                });
                console.log(sList)
                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('admin/service_price/delete') }}",
                    data: {id:sList},
                    beforeSend: function(){
                        // $('.submitBtn').attr("disabled","disabled");
                        // $('#fupForm').css("opacity",".5");
                    },
                    success: function(msg){
                        $('#serviceprice-load-data').click();
                    }
                });

            }
        });


    </script>

@stop