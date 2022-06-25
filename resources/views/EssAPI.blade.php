<h1> Sales Report Item list</h1>
<table border="1">
    <thead>
        <tr> 
            {{-- <th>ID</th> --}}
            <th>Item Code</th>
            <th>Stores</th>
            <th>Created at</th>
            <th>Updated at</th>
        </tr>
    </thead>
    <tbody>
        @foreach($smsApi as $itemCode)
            <tr>
                {{-- <td>{{ $itemCode->id }}</td> --}}
                <td>{{ $itemCode->barcode_number }}</td>
                <td>{{ $itemCode->stores_name }}</td>
                <td>{{ $itemCode->created_at }}</td>
                <td>{{ $itemCode->updated_at }}</td>
            </tr>  
        @endforeach
    </tbody>  
</table>

