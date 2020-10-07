<!-- Modal -->
<div class="modal fade" id="order-dialog-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-edit" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel-edit">Edit Order</h4>
            </div>

            <form action="{{ route('order-update') }}" method="POST" role="form" id="order-form-edit" enctype="multipart/form-data">

                <div class="modal-body">

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Summoner Name</label>
                                <input type="text" name="name" class="form-control" disabled="disabled">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="text" name="email" class="form-control" disabled="disabled">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Type</label>
                                <input type="hidden" name="hidden_id" value="" id="hidden_id">
                                <input type="text" name="type" class="form-control" disabled="disabled">
                            </div>
                            <div class="form-group">
                                <label>Service</label>
                                <input type="text" name="service" class="form-control" disabled="disabled">
                            </div>
                            <div class="form-group">
                                <label>Server</label>
                                <input type="text" name="server" class="form-control" disabled="disabled">
                            </div>
                        </div>
                        <div class="col-sm-6 coaching">
                            <div class="form-group">
                                <label>Line</label>
                                <input type="text" name="line" class="form-control" disabled="disabled">
                            </div>
                            <div class="form-group">
                                <label>Rank</label>
                                <input type="text" name="rank" class="form-control" disabled="disabled">
                            </div>
                            <div class="form-group">
                                <label>Hours</label>
                                <input type="text" name="hours" class="form-control" disabled="disabled">
                            </div>
                        </div>
                        <div class="col-sm-6 solo duo">
                            <div class="form-group">
                                <label>Current League Division</label>
                                <input type="text" name="cleague" class="form-control" disabled="disabled">
                            </div>
                            <div class="form-group">
                                <label>Next League Division</label>
                                <input type="text" name="nleague" class="form-control" disabled="disabled">
                            </div>
                            <div class="form-group">
                                <label>Queue</label>
                                <input type="text" name="queue" class="form-control" disabled="disabled">
                            </div>
                        </div>
                        <div class="col-sm-6 win">
                            <div class="form-group">
                                <label>Current League Division</label>
                                <input type="text" name="cleague" class="form-control" disabled="disabled">
                            </div>
                            <div class="form-group">
                                <label>Queue</label>
                                <input type="text" name="nleague" class="form-control" disabled="disabled">
                            </div>
                            <div class="form-group">
                                <label>Game Service</label>
                                <input type="text" name="game_service" class="form-control" disabled="disabled">
                            </div>
                            <div class="form-group">
                                <label>Games</label>
                                <input type="text" name="games" class="form-control" disabled="disabled">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Pay Status</label>
                                <input type="text" name="pay_status" class="form-control" disabled="disabled">
                            </div>
                            <div class="form-group">
                            <label>Service Status</label>
                                <select class="form-control" name="status" required="required">
                                    <option value="process">Process</option>
                                    <option value="done">Done</option>
                                    <option value="cancel">Cancel</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="alert alert-danger" id="order-error-edit" style="display: none;">
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