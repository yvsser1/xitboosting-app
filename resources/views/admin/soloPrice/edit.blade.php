
<!-- Modal -->
<div class="modal fade" id="soloprice-dialog-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-edit" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel-edit">Edit Solo Price</h4>
            </div>

            <form action="{{ URL::to('admin/solo_price/update') }}" method="POST" role="form" id="soloprice-form-edit" enctype="multipart/form-data">
                <input type="hidden" name="hidden_id" value="" id="hidden_id">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Current League</label>
                                <select class="form-control now_league_id" name="now_league_id" required="required">
                                    @foreach($leagues as $league)
                                        <option value="{{ $league["id"] }}">{{ $league["name"] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Current Division</label>
                                <select class="form-control now_division_id" name="now_division_id" required="required">
                                    <option value="">First Chosse Current League</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Next League</label>
                                <select class="form-control next_league_id" name="next_league_id" required="required">
                                    @foreach($leagues as $league)
                                        <option value="{{ $league["id"] }}">{{ $league["name"] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Next Division</label>
                                <select class="form-control next_division_id" name="next_division_id" required="required">
                                    <option value="">First Chosse Next League</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input type="float" name="price" class="form-control" placeholder="Enter price" required="required">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="alert alert-danger" id="soloprice-error-edit" style="display: none;">
                                <ul>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" name="submit" class="btn btn-primary" value="Save" >
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->