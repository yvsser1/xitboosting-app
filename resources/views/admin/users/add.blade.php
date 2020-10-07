
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="user-dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Add User</h4>
            </div>

            <form action="{{ URL::to('admin/users/store') }}" method="POST" role="form" id="user-form" enctype="multipart/form-data">

                <div class="modal-body">

                    <div class="row">
                        <div class="col-sm-12">

                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter e-mail" required="required">
                            </div>
                            <div class="form-group">
                                <label>Summoner Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter username" required="required">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter password" required="required">
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Enter confirm password" required="required">
                            </div>

                        </div>
                        <div class="col-sm-12">
                            <div class="alert alert-danger" id="user-error" style="display: none;">
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