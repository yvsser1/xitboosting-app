<div class="dataTable_wrapper" style="margin-top: 15px;">
    <table class="table table-striped table-bordered table-hover" id="winprice-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Current League</th>
            <th>Current Division</th>
            <th>Games</th>
            <th>Price</th>
            <th>Add Date</th>
            <th>Up Date</th>
            <th>#</th>
        </tr>
        </thead>
        <tbody id="table-data">
        @foreach($winPrices as $winPrice)
            <tr id="{{ $winPrice->id }}">
                <td>{{ $winPrice->id }}</td>
                <td>{{ $winPrice->nowLeagues->name }}</td>
                <td>{{ $winPrice->nowDivisions->name }}</td>
                <td>{{ $winPrice->games }}</td>
                <td>{{ $winPrice->price }}</td>
                <td>{{ $winPrice->created_at }}</td>
                <td>{{ $winPrice->updated_at }}</td>
                <td><input type="checkbox" name="delete" value="{{ $winPrice->id }}"></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>