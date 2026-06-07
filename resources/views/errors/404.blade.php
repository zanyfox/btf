@extends('layouts.app')

@section('title', __('Error404'))

@section('content')
<div class="container">
  <div class="text-center" style="margin: 200px 0">
    <h1 class="mb-3">{{__('Error404')}}</h1>
    <h3 class="mb-3">{{__('PageNotFound')}}</h3>
    <p class="mb-2">{{__('ThePageYouAreTryingToFindIsNotAvailable')}}</p>
    <a href="{{route('home')}}" class="btn btn-primary">{{__('GoBackToTheMainPage')}}</a>
  </div>
</div>
@endsection
