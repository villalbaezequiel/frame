@extends('layouts.auth')
@section('title', 'Frame')

@section('container')
<div class="row">
  <div class="col-lg-5 col-md-6 col-sm-8 ml-auto mr-auto">

    <div class="col-md-12 p-4 ml-auto mr-auto">
      <img src="{{ asset('img/logo.svg') }}" />
    </div>

      <div class="card">
        <div class="card-header card-header-primary text-center">
          <h4 class="card-title">Mensaje</h4>
        </div>
        <div class="card-body table-responsive">
          <p class="card-description text-center" style="color: #9c27b0!important;">
            @if($message)
              {{ $message }}
            @endif
          </p>
        </div>
      </div>

  </div>
</div>
@endsection
