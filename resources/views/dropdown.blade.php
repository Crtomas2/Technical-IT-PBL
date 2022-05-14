<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <title>EdgeScannerSystem</title>
        @livewireStyles
    </head>
    <body>
        <div class="container my-5">
            <h1 class="fs-5 fw-bold my-4 text-center">Manage Stores Edge Scanner</h1>
            <div class="row">
                <form action="" method="">
                    <div class="mb-3">
                        <label for="storename" class="form-label">StoreName</label>
                        <select class="form-control" name="" id="storename">
                            <option hidden>Choose Store</option>
                            @foreach ($Store as $item)
                            <option value="{{ $item->id }}">{{ $item->Storename }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="Storelocations" class="form-label">Storelocation</label>
                        <select class="form-control" name="Storelocations" id="Storelocations"></select>
                    </div>
                    <div class="mb-3">
                        <label for="LocationCode" class="form-label">Location Code</label>
                        <select class="form-control" name="LocationCode" id="LocationCode"></select>
                    </div>
                    <div class="mb-3">
                        <label for="StoreGroup" class="form-label">Store Group</label>
                        <select class="form-control" name="StoreGroup" id="StoreGroup"></select>
                    </div>
                    <center><button type="submit" class="btn btn-block btn-danger">SUBMIT</button></center>
                </form>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" 
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function() {
                const csrf_token = @json(csrf_token());
                $('#storename').on('change', function() {
                    var storeId = $(this).val();
                    if(storeId) {
                        $.ajax({
                            url: '/getStorelocation/' + storeId,
                            type: "GET",
                            data : {"_token": '{{ csrf_token() }}'},
                            dataType: "json",
                            success:function(data)
                            {
                                if(data.locations){
                                    $('#Storelocations').empty();
                                    $('#Storelocations').append('<option hidden>Choose location</option>'); 
                                    $.each(data.locations, function(index, location){
                                        $('#Storelocations').append('<option value="'+ location.id +'">' + location.Storelocations + '</option>');
                                    });
                                }else{
                                    $('#Storelocations').empty();
                                    console.log('error')
                                }
                            }
                        });
                    }else{
                        $('#Storelocations').empty();
                    }
                });
                $('#Storelocations').on('change', function() {
                    var locationId = $(this).val();
                    if(locationId) {
                        $.ajax({
                            url: '/getLocationCode/'+ locationId,
                            type: "GET",
                            data : {"_token": '{{  csrf_token() }}'},
                            dataType: "json",
                            success:function(data)
                            {
                                if(data.locationcode){
                                    console.log(data.locationcode)
                                    $('#LocationCode').empty();
                                    $('#LocationCode').append('<option hidden>Choose location Code</option>'); 
                                    $.each(data.locationcode, function(index, locationcode){
                                        $('#LocationCode').append('<option value="'+ locationcode.id +'">' +  locationcode.LocationCode + '</option>');
                                    });
                                }else{
                                    $('#LocationCode').empty();
                                    console.log('error')
                                }
                            }
                        });
                    }else{
                        $('#LocationCode').empty();
                    }
                });
                $('#LocationCode').on('change', function(){
                var GroupId = $(this).val();
                 if(GroupId) {
                        $.ajax({
                            url: '/getStoreGroup/'+ GroupId,
                            type: "GET",
                            data : {"_token": '{{  csrf_token() }}'},
                            dataType: "json",
                            success:function(data)
                            {
                                if(data.Group){
                                    console.log(data.Group)
                                    $('#StoreGroup').empty();
                                    $('#StoreGroup').append('<option hidden>Choose Store group</option>'); 
                                    $.each(data.Group, function(index, Group){
                                        $('#StoreGroup').append('<option value="'+ Group.id +'">' +  Group.StoreGroup + '</option>');
                                    });
                                }else{
                                    $('#StoreGroup').empty();
                                    console.log('error')
                                }
                            }
                        });
                    }else{
                        $('#StoreGroup').empty();
                    }
                
                });         
            });
           
        </script>

        @livewireScripts
    </body>
</html>

