<div class="dataTable_wrapper" style="margin-top: 15px;">
    <table class="table table-striped table-bordered table-hover" id="division-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>League</th>
            <th>Division</th>
            <th>Add Date</th>
            <th>Up Date</th>
            <th>#</th>
        </tr>
        </thead>
        <tbody id="table-data">
        @foreach($divisions as $division)
            <tr id="{{ $division->id }}">
                <td>{{ $division->id }}</td>
                <td>
                    @if($division->photo) <img height="50" src="{{$division->photo->name ? URL::to('images') .'/'. $division->photo->name : URL::to('images') .'/'.'400x400.png'}}" alt="img"> @endif
                </td>
                <td>{{ $division->league->name }}</td>
                <td>{{ $division->name }}</td>
                <td>{{ $division->created_at }}</td>
                <td>{{ $division->updated_at }}</td>
                <td><input type="checkbox" name="delete" value="{{ $division->id }}"></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>