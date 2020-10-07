<div class="dataTable_wrapper" style="margin-top: 15px;">
    <table class="table table-striped table-bordered table-hover" id="duoprice-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Current League</th>
            <th>Current Division</th>
            <th>Next League</th>
            <th>Next Division</th>
            <th>Price</th>
            <th>Add Date</th>
            <th>Up Date</th>
            <th>#</th>
        </tr>
        </thead>
        <tbody id="table-data">
        @foreach($duoPrices as $duoPrice)
            <tr id="{{ $duoPrice->id }}">
                <td>{{ $duoPrice->id }}</td>
                <td>{{ $duoPrice->nowLeagues->name }}</td>
                <td>{{ $duoPrice->nowDivisions->name }}</td>
                <td>{{ $duoPrice->nextLeagues->name }}</td>
                <td>{{ $duoPrice->nextDivisions->name }}</td>
                <td>{{ $duoPrice->price }}</td>
                <td>{{ $duoPrice->created_at }}</td>
                <td>{{ $duoPrice->updated_at }}</td>
                <td><input type="checkbox" name="delete" value="{{ $duoPrice->id }}"></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>