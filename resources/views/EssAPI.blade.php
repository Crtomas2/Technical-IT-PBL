<h1> Sales Item list</h1>
<table border="2">
    <thead>
        <tr> 
            <th>ID</th>
            <th>Barcode number</th>
            <th>Created at</th>
            <th>Updated at</th>
        </tr>
    </thead>
    <tbody>
        @foreach($smsApi as $itemCode)
            <tr>
                <td>{{ $itemCode->id }}</td>
                <td>{{ $itemCode->barcode_number }}</td>
                <td>{{ $itemCode->created_at }}</td>
                <td>{{ $itemCode->updated_at }}</td>
            </tr>  
        @endforeach
    </tbody>  
</table>

