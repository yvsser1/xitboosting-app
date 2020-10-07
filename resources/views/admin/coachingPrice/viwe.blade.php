<div class="dataTable_wrapper" style="margin-top: 15px;">
    <table class="table table-striped table-bordered table-hover" id="coachingprice-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Rank</th>
            <th>Hours</th>
            <th>Price</th>
            <th>Add Date</th>
            <th>Up Date</th>
            <th>#</th>
        </tr>
        </thead>
        <tbody id="table-data">
        @foreach($coachingPrices as $coachingPrice)
            <tr id="{{ $coachingPrice->id }}">
                <td>{{ $coachingPrice->id }}</td>
                <td>{{ $coachingPrice->rank }}</td>
                <td>{{ $coachingPrice->hours }}</td>
                <td>{{ $coachingPrice->price }}</td>
                <td>{{ $coachingPrice->created_at }}</td>
                <td>{{ $coachingPrice->updated_at }}</td>
                <td><input type="checkbox" name="delete" value="{{ $coachingPrice->id }}"></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>