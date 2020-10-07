<div class="dataTable_wrapper" style="margin-top: 15px;">
    <table class="table table-striped table-bordered table-hover" id="inbox-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Subject</th>
            <th>E-mail</th>
            <th>Message</th>
            <th>Add Date</th>
            <th>Up Date</th>
            <th>#</th>
        </tr>
        </thead>
        <tbody id="table-data">
        @foreach($inboxs as $inbox)
            <tr id="{{ $inbox->id }}">
                <td>{{ $inbox->id }}</td>
                <td>{{ $inbox->subject }}</td>
                <td>{{ $inbox->email }}</td>
                <td>{{ $inbox->description }}</td>
                <td>{{ $inbox->created_at }}</td>
                <td>{{ $inbox->updated_at }}</td>
                <td><input type="checkbox" name="delete" value="{{ $inbox->id }}"></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>