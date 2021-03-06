
<!-- Modal -->
<div class="modal fade" id="coachingprice-dialog-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-edit" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel-edit">Edit Coaching Price</h4>
            </div>

            <form action="{{ route('coaching_price-update') }}" method="POST" role="form" id="coachingprice-form-edit" enctype="multipart/form-data">
                <input type="hidden" name="hidden_id" value="" id="hidden_id">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Rank</label>
                                <select class="form-control" name="rank" required="required">
                                    <option value="diamond">Diamond</option>
                                    <option value="master">Master</option>
                                    <option value="challenger">Challenger</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Hours</label>
                                <input type="number" name="hours" class="form-control" placeholder="Enter hours" required="required">
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input type="float" name="price" class="form-control" placeholder="Enter price" required="required">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="alert alert-danger" id="coachingprice-error-edit" style="display: none;">
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