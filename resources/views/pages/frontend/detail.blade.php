@extends('layouts.main')

@push('after-style')
<link rel="stylesheet" href="{{ asset('assets/frontend/libraries/xzoom/dist/xzoom.css') }}" />
@endpush

@section('header')
<section class="section-details-header"></section>
@endsection

@section('content')
<section class="section-details-content">
  <div class="container">
    <div class="row">
      <div class="col p-0 pl-3 pl-lg-0">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page">Paket Travel</li>
            <li class="breadcrumb-item active" aria-current="page">Details</li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-8 pl-lg-0">
        <div class="card card-details">
          <h1>{{ $travel_package->title }}</h1>
          <p>{{ $travel_package->location }}</p>

          @if ($travel_package->galleries->count())
          <div class="gallery">
            <div class="xzoom-container">
              <img class="xzoom" id="xzoom-default" src="{{ Storage::url($travel_package->galleries->first()->image) }}"
                xoriginal="{{ Storage::url($travel_package->galleries->first()->image) }}" />
            </div>
            <div class="xzoom-thumbs">
              @foreach ($travel_package->galleries as $gallery)
              <a href="{{ Storage::url($gallery->image) }}">
                <img class="xzoom-gallery" width="128" src="{{ Storage::url($gallery->image) }}"
                  xpreview="{{ Storage::url($gallery->image) }}" />
              </a>
              @endforeach
            </div>
          </div>
          @endif

          <h2>Tentang Wisata</h2>
          <p>
            {!! $travel_package->about !!}
          </p>

          <div class="features row pt-3">
            <div class="col-md-4">
              <img src="{{ asset('assets/frontend/images/ic_event.png') }}" alt="event" class="features-image" />
              <div class="description">
                <h3>Featured Ticket</h3>
                <p>{{ $travel_package->featured_event }}</p>
              </div>
            </div>
            <div class="col-md-4 border-left">
              <img src="{{ asset('assets/frontend/images/ic_bahasa.png') }}" alt="bahasa" class="features-image" />
              <div class="description">
                <h3>Language</h3>
                <p>{{ $travel_package->language }}</p>
              </div>
            </div>
            <div class="col-md-4 border-left">
              <img src="{{ asset('assets/frontend/images/ic_foods.png') }}" alt="makanan" class="features-image" />
              <div class="description">
                <h3>Foods</h3>
                <p>{{ $travel_package->foods }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card card-details card-right">
          <h2>Members are going</h2>
          <div class="members my-2">
            <img src="{{ asset('assets/frontend/images/members.png') }}" alt="" class="w-75" />
          </div>
          <hr />
          <h2>Trip Informations</h2>
          <table class="trip-informations">
            <tr>
              <th width="50%">Date of Departure</th>
              <td width="50%" class="text-right">{{ date('F n, Y', strtotime($travel_package->departure_date)) }}
              </td>
            </tr>
            <tr>
              <th width="50%">Duration</th>
              <td width="50%" class="text-right">{{ $travel_package->duration }}</td>
            </tr>
            <tr>
              <th width="50%">Type</th>
              <td width="50%" class="text-right">{{ $travel_package->type }}</td>
            </tr>
            <tr>
              <th width="50%">Price</th>
              <td width="50%" class="text-right">${{ $travel_package->price }},00 / person</td>
            </tr>
          </table>
        </div>
        <div class="join-container">
          @auth
          <form action="{{ route('checkout.process', $travel_package->id) }}" method="post">
            @csrf
            <button class="btn btn-block btn-join-now mt-3 py-2" type="submit">
              Join Now
            </button>
          </form>
          @endauth
          @guest
          <a href="{{ route('login') }}" class="btn btn-block btn-join-now mt-3 py-2">Login or Register to Join</a>
          @endguest
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('after-script')
<script src="{{ asset('assets/frontend/libraries/xzoom/dist/xzoom.min.js') }}"></script>
<script>
  $(document).ready(function () {
    $(".xzoom, .xzoom-gallery").xzoom({
      zoomWidth: 500,
      title: false,
      tint: "#333",
      Xoffset: 15,
    });
  });
</script>
@endpush