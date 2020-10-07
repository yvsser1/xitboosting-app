<div class="dataTable_wrapper" style="margin-top: 15px;">
    <table class="table table-striped table-bordered table-hover" id="order-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Summoner Name</th>
            <th>E-mail</th>
            <th>Type</th>
            <th>Service</th>
            <th>Price</th>
            <th>Pay Status</th>
            <th>Service Status</th>
            <th>Order Date</th>
            <th>#</th>
        </tr>
        </thead>
        <tbody id="table-data">
        @foreach($order as $o)
            <tr id="{{ $o->id }}">
                <td>{{ $o->id }}</td>
                <td>{{ $o->user->name }}</td>
                <td>{{ $o->user->email }}</td>
                <td>{{ $o->type }}</td>
                <td>{{ $o->service }}</td>
                <td>{{ $o->price }}</td>
                <td>{{ $o->pay_status }}</td>
                <td>{{ $o->status }}</td>
                <td>{{ $o->created_at }}</td>
                <td><input type="checkbox" name="delete" value="{{ $o->id }}"></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>