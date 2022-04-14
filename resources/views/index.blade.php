@extends('layout')
@section('content')
<style>
  .push-top {
    margin-top: 50px;
  }
</style>
<div class="push-top">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <table class="table">
    <thead>
        <tr class="table-warning">
          <td>ID</td>
          <td>Firstname</td>
          <td>Middlename</td>
          <td>Lastname</td>
          <td>Mobilenumber</td>
          <td>Storename</td>
          <td>Storelocation</td>
          <td class="text-center">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($promodiser as $promodisers)
        <tr>
            <td>{{$promodisers->id}}</td>
            <td>{{$promodisers->Firstname}}</td>
            <td>{{$promodisers->Middlename}}</td>
            <td>{{$promodisers->lastname}}</td>
            <td>{{$promodisers->mobilenumber}}</td>
            <td>{{$promodisers->Storename}}</td>
            <td>{{$promodisers->Storelocation}}</td>
            <td class="text-center">
                <a href="{{ route('promodisers.edit', $promodisers->id)}}" class="btn btn-primary btn-sm"">Edit</a>
                <form action="{{ route('promodisers.destroy', $promodisers->id)}}" method="post" style="display: inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"" type="submit">Delete</button>
                  </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection