
<!-- Modal -->
<div class="modal fade" id="serviceprice-dialog-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-edit" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel-edit">Edit Service Price</h4>
            </div>

            <form action="{{ route('service_price-update') }}" method="POST" role="form" id="serviceprice-form-edit" enctype="multipart/form-data">
                <input type="hidden" name="hidden_id" value="" id="hidden_id">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Service</label>
                                <select class="form-control" name="service" required="required">
                                    <option value="regular">Regular</option>
                                    <option value="premium">Premium</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input type="float" name="price" class="form-control" placeholder="Enter price" required="required">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="alert alert-danger" id="serviceprice-error-edit" style="display: none;">
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