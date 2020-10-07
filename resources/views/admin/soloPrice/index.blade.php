@extends('layouts.admin')

@section('title')
    Admin Panel - Solo Price
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Solo Price</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Solo Price List (Add/Edit/Delet)
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">

                            <!-- Button trigger modal -->
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#soloprice-dialog">Add</button>

                            <button class="btn btn-danger btn-sm" id="delete-soloprice">Delete</button>

                            <button class="btn btn-success btn-sm pull-right" id="soloprice-load-data">Refresh</button>

                            @include('admin.soloPrice.add')

                            @include('admin.soloPrice.edit')

                            @include('admin.soloPrice.viwe')

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

            $('#soloprice-table').DataTable({
                responsive: true
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".modal").on("hidden.bs.modal", function(){
                document.getElementById('soloprice-form').reset();
            });
        });

        //------------ Load Table ----------------
        $('#soloprice-load-data').on('click',function (e) {

            $.get("{{ route('solo_price-load-data') }}", function (data) {
                $('#table-data').empty();
                $.each(data, function (i, value) {

                    var tr = $('<tr/>', {
                        id: value.id
                    });
                    tr.append($('<td/>', {
                        text: value.id
                    })).append($('<td/>', {
                        text: value.now_leagues.name
                    })).append($('<td/>', {
                        text: value.now_divisions.name
                    })).append($('<td/>', {
                        text: value.next_leagues.name
                    })).append($('<td/>', {
                        text: value.next_divisions.name
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

        //------------ Add Solo Price ------------------
        $("#soloprice-form").on('submit', function(e){
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
                        $('#soloprice-error ul').empty();
                        $('#soloprice-error').css('display','block');
                        $.each(msg.error, function (i, value) {
                            $('#soloprice-error ul').append("<li>"+value+"</li>") ;
                        })
                        //console.log(msg.error);
                    }
                    else
                    {
                        document.getElementById('soloprice-form').reset();
                        $('#soloprice-dialog').modal('toggle');
                        $('#soloprice-load-data').click();
                    }

                }
            });
        });

        //----------- Update Solo Price ------------------
        $("#soloprice-form-edit").on('submit', function(e){
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
                        $('#soloprice-error-edit ul').empty();
                        $('#soloprice-error-edit').css('display','block');
                        $.each(msg.error, function (i, value) {
                            $('#soloprice-error-edit ul').append("<li>"+value+"</li>") ;
                        });
                    }
                    else
                    {
                        document.getElementById('soloprice-form-edit').reset();
                        $('#soloprice-dialog-edit').modal('toggle');
                        $('#soloprice-load-data').click();
                    }

                }
            });
        });

        //------------ Edit Solo Price Viwe -----------------
        $(document).on('dblclick','#soloprice-table #table-data tr',function (e) {
            var hidden_id = $(this).attr('id');

            $.get("{{ route('solo_price-edit') }}",{id:hidden_id},function (data) {
                $('#soloprice-dialog-edit').modal();
                $('#soloprice-form-edit #hidden_id').val(hidden_id);
                $('#soloprice-form-edit input[name="price"]').val(data.price);
                $('#soloprice-form-edit select[name="now_league_id"] option[value="'+data.now_league_id+'"]').prop('selected', true);
                $('#soloprice-form-edit select[name="now_division_id"] option[value="'+data.now_division_id+'"]').prop('selected', true);
                $('#soloprice-form-edit select[name="next_league_id"] option[value="'+data.next_league_id+'"]').prop('selected', true);
                $('#soloprice-form-edit select[name="next_division_id"] option[value="'+data.next_division_id+'"]').prop('selected', true);

            })
        });

        //------------ Delete Solo Price ----------------------
        $(document).on('click','#delete-soloprice',function (e) {
            if ($('input[name="delete"]').is(':checked')) {
                var sList = [];
                $('input[name=delete]:checked').each(function (e,v) {
                    sList.push(v.value);
                });
                console.log(sList)
                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('admin/solo_price/delete') }}",
                    data: {id:sList},
                    beforeSend: function(){
                        // $('.submitBtn').attr("disabled","disabled");
                        // $('#fupForm').css("opacity",".5");
                    },
                    success: function(msg){
                        $('#soloprice-load-data').click();
                    }
                });

            }
        });

        $(document).on('change','.now_league_id',function () {
            var now_league_id = $(this).val();
            $.ajax({
                type: "POST",
                url: "{{ route('division-get') }}",
                data: { league_id: now_league_id},
                success: function(msg){
                    var option = '<option value="">Chosse Current Division</option>';
                    $.each(msg, function (key, val) {
                        option += '<option value="'+val.id+'">'+val.name+'</option>';
                    });

                    $('.now_division_id').html(option);
                },
                error: function (error) {
                }
            });
        });

        $(document).on('change','.next_league_id',function () {
            var now_league_id = $(this).val();
            $.ajax({
                type: "POST",
                url: "{{ route('division-get') }}",
                data: { league_id: now_league_id},
                success: function(msg){
                    var option = '<option value="">Chosse Current Division</option>';
                    $.each(msg, function (key, val) {
                        option += '<option value="'+val.id+'">'+val.name+'</option>';
                    });

                    $('.next_division_id').html(option);
                },
                error: function (error) {
                }
            });
        });


    </script>

@stop