<div class="dataTable_wrapper" style="margin-top: 15px;">
    <table class="table table-striped table-bordered table-hover" id="faq-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Question</th>
            <th>Answer</th>
            <th>Add Date</th>
            <th>Up Date</th>
            <th>#</th>
        </tr>
        </thead>
        <tbody id="table-data">
        @foreach($faqs as $faq)
            <tr id="{{ $faq->id }}">
                <td>{{ $faq->id }}</td>
                <td>{{ $faq->name }}</td>
                <td>{{ $faq->description }}</td>
                <td>{{ $faq->created_at }}</td>
                <td>{{ $faq->updated_at }}</td>
                <td><input type="checkbox" name="delete" value="{{ $faq->id }}"></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>