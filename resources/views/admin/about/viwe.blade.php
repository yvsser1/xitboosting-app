<div class="dataTable_wrapper" style="margin-top: 15px;">
    <table class="table table-striped table-bordered table-hover" id="about-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Add Date</th>
            <th>Up Date</th>
            <th>#</th>
        </tr>
        </thead>
        <tbody id="table-data">
        @foreach($abouts as $about)
            <tr id="{{ $about->id }}">
                <td>{{ $about->id }}</td>
                <td>{{ $about->name }}</td>
                <td>{{ $about->text }}</td>
                <td>{{ $about->created_at }}</td>
                <td>{{ $about->updated_at }}</td>
                <td><input type="checkbox" name="delete" value="{{ $about->id }}"></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>