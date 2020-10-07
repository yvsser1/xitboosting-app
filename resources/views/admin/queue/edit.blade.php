
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="queue-dialog-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-edit" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel-edit">Edit Queue</h4>
            </div>

            <form action="{{ URL::to('admin/queues/update') }}" method="POST" role="form" id="queue-form-edit" enctype="multipart/form-data">

                <div class="modal-body">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Queue Name</label>
                                <input type="hidden" name="hidden_id" value="" id="hidden_id">
                                <input type="text" name="name" class="form-control" placeholder="Enter queue name" required="required">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="alert alert-danger" id="queue-error-edit" style="display: none;">
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