@extends('layout')
@section('content')
<style>
    .container {
      max-width: 450px;
    }
    .push-top {
      margin-top: 50px;
    }
</style>
<div class="card push-top">
  <div class="card-header">
    Edit & Update
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('promodisers.update', $promodiser->id) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="Firstname">Firstname</label>
              <input type="text" class="form-control" name="Firstname" value="{{ $promodiser->Firstname }}"/>
          </div>
          <div class="form-group">
              <label for="Middlename">Middlename</label>
              <input type="text" class="form-control" name="Middlename" value="{{ $promodiser->Middlename }}"/>
          </div>
          <div class="form-group">
              <label for="lastname">Lastname</label>
              <input type="text" class="form-control" name="lastname" value="{{ $promodiser->lastname }}"/>
          </div>
          <div class="form-group">
              <label for="Mobilenumber">Mobilenumber</label>
              <input type="tel" class="form-control" name="mobilenumber" value="{{ $promodiser->mobilenumber }}"/>
          </div>
          <div class="form-group">
              <label for="Storename">Storename</label>
              <input type="text" class="form-control" name="Storename" value="{{ $promodiser->Storename }}"/>
          </div>
          <div class="form-group">
              <label for="Storelocation">Storelocation</label>
              <input type="text" class="form-control" name="Storelocation" value="{{ $promodiser->Storelocation }}"/>
          </div>
          <button type="submit" class="btn btn-block btn-danger">Update User</button>
      </form>
  </div>
</div>
@endsection