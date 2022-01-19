@extends('contact.layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif

  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Name</td>
          <td>phone</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->phone}}</td>
            <td>
              <x-responsive-nav-link :href="{{ route('contacts.edit', $user->id)}}" :active="request()->routeIs('contacts.edit')">
                {{ __('Edit') }}
              </x-responsive-nav-link>
            <a href="{{ route('contacts.edit', $user->id)}}" class="btn btn-primary">Edit</a></td>
        </tr>
    </tbody>
  </table>
<div>
@endsection