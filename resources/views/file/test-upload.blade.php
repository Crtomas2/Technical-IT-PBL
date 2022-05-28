@extends('layouts.layout')

@section('content')
    @if(session('message'))
    <div class="alert alert-{{ session('status') }} alert-dismissible fade show" role="alert">
        {{ session('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            Upload a file
        </div>
        <form class="needs-validation" method="POST" action="{{ route('test-upload.upload') }}" enctype="multipart/form-data" novalidate>
            <div class="card-body">
                @csrf
                <div class="form-group row">
                    <label for="file" class="col-sm-2 col-form-label">
                        Data File
                    </label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control @error('file')is-invalid @enderror" id="file" name="file" aria-describedBy="fileHelpBlock" required>
                        <div class="invalid-feedback">
                            @error('file') {{ $message }} @else File is required @enderror
                        </div>
                        <small id="fileHelpBlock" class="form-text text-muted">
                            File must be a excel file (XLSX) or a comma-delimited value file (CSV)
                        </small>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </div>
        </form>
    </div>

    @if(session('collection'))
    <div class="card mt-4">
        <div class="card-header">
            Extracted table
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(session('collection') as $row)
                    <tr>
                        <th scope="row">{{ $row->id }}</th>
                        <td scope="row">{{ $row->first_name }}</td>
                        <td scope="row">{{ $row->last_name }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <form class="needs-validation" method="POST" action="{{ route('test-upload.store') }}">
                @csrf
                <button type="submit" class="btn btn-primary">
                    Upload to database
                </button>
            </form>
        </div>
    </div>
    @endif
    

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
        })();
    </script>
@endsection