<div class="dataTable_wrapper" style="margin-top: 15px;">
    <table class="table table-striped table-bordered table-hover" id="server-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Server Name</th>
            <th>Add Date</th>
            <th>Up Date</th>
            <th>#</th>
        </tr>
        </thead>
        <tbody id="table-data">
        @foreach($servers as $server)
            <tr id="{{ $server->id }}">
                <td>{{ $server->id }}</td>
                <td>{{ $server->name }}</td>
                <td>{{ $server->created_at }}</td>
                <td>{{ $server->updated_at }}</td>
                <td><input type="checkbox" name="delete" value="{{ $server->id }}"></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>