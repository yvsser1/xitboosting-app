<div class="dataTable_wrapper" style="margin-top: 15px;">
    <table class="table table-striped table-bordered table-hover" id="queue-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Queue Name</th>
            <th>Add Date</th>
            <th>Up Date</th>
            <th>#</th>
        </tr>
        </thead>
        <tbody id="table-data">
        @foreach($queues as $queue)
            <tr id="{{ $queue->id }}">
                <td>{{ $queue->id }}</td>
                <td>{{ $queue->name }}</td>
                <td>{{ $queue->created_at }}</td>
                <td>{{ $queue->updated_at }}</td>
                <td><input type="checkbox" name="delete" value="{{ $queue->id }}"></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>