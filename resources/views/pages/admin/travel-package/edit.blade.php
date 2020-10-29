@extends('layouts.admin')

@section('title', '| Ubah Paket Travel')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Paket Travel</h1>
  </div>

  <div class="card shadow">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold">Ubah Paket Travel</h6>
    </div>
    <div class="card-body">
      <form action="{{ route('travel-package.update', $item->id) }}" method="POST" autocomplete="off">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Title"
            value="{{ old('title') ? old('title') : $item->title }}">
          @error('title')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label for="location">Location</label>
          <input type="text" class="form-control @error('location') is-invalid @enderror" name="location"
            placeholder="Location" value="{{ old('location') ? old('location') : $item->location }}">
          @error('location')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label for="about">About</label>
          <textarea name="about" rows="10"
            class="d-block w-100 form-control @error('about') is-invalid @enderror">{{ old('about') ? old('about') : $item->about }}</textarea>
          @error('about')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label for="featured_event">Featured Event</label>
          <input type="text" class="form-control @error('featured_event') is-invalid @enderror" name="featured_event"
            placeholder="Featured Event"
            value="{{ old('featured_event') ? old('featured_event') : $item->featured_event }}">
          @error('featured_event')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label for="language">Language</label>
          <input type="text" class="form-control @error('language') is-invalid @enderror" name="language"
            placeholder="Language" value="{{ old('language') ? old('language') : $item->language }}">
          @error('language')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label for="foods">Foods</label>
          <input type="text" class="form-control @error('foods') is-invalid @enderror" name="foods" placeholder="Foods"
            value="{{ old('foods') ? old('foods') : $item->foods }}">
          @error('foods')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label for="departure_date">Departure Date</label>
          <input type="date" class="form-control @error('departure_date') is-invalid @enderror" name="departure_date"
            placeholder="Departure Date"
            value="{{ old('departure_date') ? old('departure_date') : $item->departure_date }}">
          @error('departure_date')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label for="duration">Duration</label>
          <input type="text" class="form-control @error('duration') is-invalid @enderror" name="duration"
            placeholder="Duration" value="{{ old('duration') ? old('duration') : $item->duration }}">
          @error('duration')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label for="type">Type</label>
          <input type="text" class="form-control @error('type') is-invalid @enderror" name="type" placeholder="Type"
            value="{{ old('type') ? old('type') : $item->type }}">
          @error('type')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label for="price">Price</label>
          <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"
            placeholder="Price" value="{{ old('price') ? old('price') : $item->price }}">
          @error('price')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <button type="submit" class="btn btn-primary btn-block">
          Ubah
        </button>
        <a href="{{ route('travel-package.index') }}" class="btn btn-light btn-block">Kembali</a>
      </form>
    </div>
  </div>
</div>
@endsection