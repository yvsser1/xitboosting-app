<div class="dataTable_wrapper" style="margin-top: 15px;">
    <table class="table table-striped table-bordered table-hover" id="user-table">
        <thead>
        <tr>
            <th>#</th>
            <th>Sumoner Name</th>
            <th>E-mail</th>
            <th>Add Date</th>
            <th>Up Date</th>
            <th>#</th>
        </tr>
        </thead>
        <tbody id="table-data">
        @foreach($users as $k=>$user)
            <tr id="{{ $user->id }}">
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->updated_at }}</td>
                <td><input type="checkbox" name="delete" value="{{ $user->id }}"></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>