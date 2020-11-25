@extends('layouts.success')

@section('title', 'Oops!')

@section('content')
<div class="section-success d-flex align-items-center">
  <div class="col text-center">
    <h1>Oops!</h1>
    <p>
      Your transaction is failed <br />
      please contact our representative if this problem occurs
    </p>
    <a href="{{ route('home') }}" class="btn btn-home-page mt-3 px-5">
      Home Page
    </a>
  </div>
</div>
@endsection