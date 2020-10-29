@extends('layouts.admin')

@section('title', '| Tambah Paket Travel')

@section('content')
<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Paket Travel</h1>
  </div>

  <div class="card shadow">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold">Tambah Paket Travel</h6>
    </div>
    <div class="card-body">
      <form action="{{ route('travel-package.store') }}" method="POST" autocomplete="off">
        @csrf

        <!-- title -->
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
            value="{{ old('title') }}">
          @error('title')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <!-- location -->
        <div class="form-group">
          <label for="location">Location</label>
          <input type="text" class="form-control @error('location') is-invalid @enderror" name="location"
            value="{{ old('location') }}">
          @error('location')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <!-- about -->
        <div class="form-group">
          <label for="about">About</label>
          <textarea name="about" rows="8"
            class="d-block w-100 form-control @error('about') is-invalid @enderror">{{ old('about') }}</textarea>
          @error('about')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <!-- featured event -->
        <div class="form-group">
          <label for="featured_event">Featured Event</label>
          <input type="text" class="form-control @error('featured_event') is-invalid @enderror" name="featured_event"
            value="{{ old('featured_event') }}">
          @error('featured_event')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <!-- language -->
        <div class="form-group">
          <label for="language">Language</label>
          <input type="text" class="form-control @error('language') is-invalid @enderror" name="language"
            value="{{ old('language') }}">
          @error('language')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <!-- foods -->
        <div class="form-group">
          <label for="foods">Foods</label>
          <input type="text" class="form-control @error('foods') is-invalid @enderror" name="foods"
            value="{{ old('foods') }}">
          @error('foods')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <!-- departure date -->
        <div class="form-group">
          <label for="departure_date">Departure Date</label>
          <input type="date" class="form-control @error('departure_date') is-invalid @enderror" name="departure_date"
            value="{{ old('departure_date') }}">
          @error('departure_date')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <!-- duration -->
        <div class="form-group">
          <label for="duration">Duration</label>
          <input type="text" class="form-control @error('duration') is-invalid @enderror" name="duration"
            value="{{ old('duration') }}">
          @error('duration')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <!-- type -->
        <div class="form-group">
          <label for="type">Type</label>
          <input type="text" class="form-control @error('type') is-invalid @enderror" name="type"
            value="{{ old('type') }}">
          @error('type')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <!-- price -->
        <div class="form-group">
          <label for="price">Price</label>
          <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"
            value="{{ old('price') }}">
          @error('price')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <button type="submit" class="btn btn-primary btn-block">
          Simpan
        </button>
        <a href="{{ route('travel-package.index') }}" class="btn btn-light btn-block">Kembali</a>
      </form>
    </div>
  </div>
</div>
@endsection