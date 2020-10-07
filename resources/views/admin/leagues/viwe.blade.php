<div class="dataTable_wrapper" style="margin-top: 15px;">
    <table class="table table-striped table-bordered table-hover" id="league-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>League</th>
            <th>Add Date</th>
            <th>Up Date</th>
            <th>#</th>
        </tr>
        </thead>
        <tbody id="table-data">
        @foreach($leagues as $league)
            <tr id="{{ $league->id }}">
                <td>{{ $league->id }}</td>
                <td>{{ $league->name }}</td>
                <td>{{ $league->created_at }}</td>
                <td>{{ $league->updated_at }}</td>
                <td><input type="checkbox" name="delete" value="{{ $league->id }}"></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>