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
    Promo Merchandiser Form
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
      <form method="post" action="{{ route('promodisers.store') }}">
          <div class="form-group">
              @csrf
              <label for="Firstname">Firstname</label>
              <input type="text" class="form-control" name="Firstname"/>
          </div>
          <div class="form-group">
              <label for="Middlename">Middlename</label>
              <input type="text" class="form-control" name="Middlename"/>
          </div>
          <div class="form-group">
              <label for="lastname">Lastname</label>
              <input type="text" class="form-control" name="lastname"/>
          </div>
          <div class="form-group">
              <label for="Mobilenumber">Mobilenumber</label>
              <input type="tel" class="form-control" name="mobilenumber"/>
          </div>
          <div class="form-group">
              <label for="Storename">Storename</label>
              <input type="text" class="form-control" name="Storename"/>
          </div>
          <div class="form-group">
              <label for="Storelocation">Storelocation</label>
              <input type="text" class="form-control" name="Storelocation"/>
          </div>
          <button type="submit" class="btn btn-block btn-danger">Create Promodiser</button>
      </form>
  </div>
</div>
@endsection