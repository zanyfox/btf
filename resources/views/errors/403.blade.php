@extends('layouts.app')

@section('title', '403 Error')

@section('content')
<div class="container">
  <div class="text-center" style="margin: 200px 0">
    <h1 class="mb-3">Error403</h1>
    <h3 class="mb-3">Access Forbidden</h3>
    <p class="mb-2">You Do Not Have Access To This Page</p>
    <a href="{{route('home')}}" class="btn btn-primary">{{__('GoBackToTheMainPage')}}</a>
  </div>
</div>
@endsection
