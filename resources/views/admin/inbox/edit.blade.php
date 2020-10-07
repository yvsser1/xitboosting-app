
<!-- Modal -->
<div class="modal fade" id="inbox-dialog-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-edit" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel-edit">Edit Inbox</h4>
            </div>

            <form action="{{ URL::to('inbox') }}" method="POST" role="form" id="inbox-form-edit" enctype="multipart/form-data">

                <div class="modal-body">

                    <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Subject</label>
                                <input type="hidden" name="hidden_id" value="" id="hidden_id">
                                <input type="text" name="subject" class="form-control" placeholder="Enter subject" required="required">
                            </div>
                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="text" name="email" class="form-control" placeholder="Enter email" required="required">
                            </div>
                            <div class="form-group">
                                <label>Message</label>
                                <textarea class="form-control" name="description" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="alert alert-danger" id="inbox-error-edit" style="display: none;">
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