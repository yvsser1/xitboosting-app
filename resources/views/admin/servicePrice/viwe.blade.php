<div class="dataTable_wrapper" style="margin-top: 15px;">
    <table class="table table-striped table-bordered table-hover" id="serviceprice-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Service</th>
            <th>Price</th>
            <th>Add Date</th>
            <th>Up Date</th>
            <th>#</th>
        </tr>
        </thead>
        <tbody id="table-data">
        @foreach($servicePrices as $servicePrice)
            <tr id="{{ $servicePrice->id }}">
                <td>{{ $servicePrice->id }}</td>
                <td>{{ $servicePrice->service }}</td>
                <td>{{ $servicePrice->price }}</td>
                <td>{{ $servicePrice->created_at }}</td>
                <td>{{ $servicePrice->updated_at }}</td>
                <td><input type="checkbox" name="delete" value="{{ $servicePrice->id }}"></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>