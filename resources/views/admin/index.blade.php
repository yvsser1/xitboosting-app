@extends('layouts.admin')
@section('title')
    Admin Panel
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Orders</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Orders List (Edit/Delet)
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <!-- Button trigger modal -->
                            <button class="btn btn-danger btn-sm" id="delete-order">Delete</button>

                            <button class="btn btn-success btn-sm pull-right" id="order-load-data">Refresh</button>

                            @include('admin.order.edit')

                            @include('admin.order.viwe')

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

            $('#order-table').DataTable({
                responsive: true
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".modal").on("hidden.bs.modal", function(){
                document.getElementById('order-form').reset();
            });
        });

        //------------ Load Table ----------------
        $('#order-load-data').on('click',function (e) {

            $.get("{{ route('order-load-data') }}", function (data) {
                $('#table-data').empty();
                $.each(data, function (i, value) {

                    var tr = $('<tr/>',{
                        id : value.id
                    });
                    tr.append($('<td/>',{
                        text : value.id
                    })).append($('<td/>',{
                        text : value.user.name
                    })).append($('<td/>',{
                        text : value.user.email
                    })).append($('<td/>',{
                        text : value.type
                    })).append($('<td/>',{
                        text : value.service
                    })).append($('<td/>',{
                        text : value.price
                    })).append($('<td/>',{
                        text : value.pay_status
                    })).append($('<td/>',{
                        text : value.status
                    })).append($('<td/>',{
                        text : value.updated_at
                    })).append($('<td/>',{
                        html : '<input type="checkbox" name="delete" value="'+value.id+'">'
                    }));
                    $('#table-data').append(tr);
                })
            });

        });

        //----------- Update User ------------------
        $("#order-form-edit").on('submit', function(e){
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
                        $('#order-error-edit ul').empty();
                        $('#order-error-edit').css('display','block');
                        $.each(msg.error, function (i, value) {
                            $('#order-error-edit ul').append("<li>"+value+"</li>") ;
                        });
                    }
                    else
                    {
                        document.getElementById('order-form-edit').reset();
                        $('#order-dialog-edit').modal('toggle');
                        $('#order-load-data').click();
                    }

                }
            });
        });

        //------------ Edit User Viwe -----------------
        $(document).on('dblclick','#order-table #table-data tr',function (e) {
            var hidden_id = $(this).attr('id');

            $.get("{{ route('order-edit') }}",{id:hidden_id},function (data) {
                if(data.type == 'coaching'){
                    $('.duo,.win').css('display','none');
                    $('.coaching').css('display','block');
                }else if(data.type == 'solo' || data.type == 'duo'){
                    $('.coaching,.win').css('display','none');
                    $('.solo').css('display','block');
                }else if(data.type == 'win'){
                    $('.coaching,.solo').css('display','none');
                    $('.win').css('display','block');
                }
                $('#order-dialog-edit').modal();
                $('#order-form-edit #hidden_id').val(hidden_id);
                $('#order-form-edit input[name="type"]').val(data.type);
                $('#order-form-edit input[name="service"]').val(data.service);
                $('#order-form-edit input[name="name"]').val(data.user.name);
                $('#order-form-edit input[name="email"]').val(data.user.email);
                if(data.server != null){
                    $('#order-form-edit input[name="server"]').val(data.server.name);
                }
                $('#order-form-edit input[name="line"]').val(data.line);
                $('#order-form-edit input[name="rank"]').val(data.rank);
                $('#order-form-edit input[name="hours"]').val(data.hours);
                if(data.cleague != null){
                    $('#order-form-edit input[name="cleague"]').val(data.cleague.name + ' ' +data.cdivision.name);
                }
                if(data.nleague != null){
                    $('#order-form-edit input[name="nleague"]').val(data.nleague.name + ' ' +data.ndivision.name);
                }
                if(data.queue != null){
                    $('#order-form-edit input[name="queue"]').val(data.queue.name);
                }
                $('#order-form-edit input[name="game_service"]').val(data.game_service);
                $('#order-form-edit input[name="games"]').val(data.games);
                $('#order-form-edit input[name="pay_status"]').val(data.pay_status);
                $('#order-form-edit select[name="status"] option[value="'+data.status+'"]').prop('selected', true);
            })
        });

        //------------ Delete User ----------------------
        $(document).on('click','#delete-order',function (e) {
            if ($('input[name="delete"]').is(':checked')) {
                var sList = [];
                $('input[name=delete]:checked').each(function (e,v) {
                    sList.push(v.value);
                });
                console.log(sList)
                $.ajax({
                    type: 'POST',
                    url: "{{ route('order-delete') }}",
                    data: {id:sList},
                    success: function(msg){
                        $('#order-load-data').click();
                    }
                });

            }
        });


    </script>

@stop