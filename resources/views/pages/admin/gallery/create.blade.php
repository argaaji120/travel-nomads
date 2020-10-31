@extends('layouts.admin')

@section('title', '| Tambah Galeri Travel')

@section('content')
<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Galeri Travel</h1>
  </div>

  <div class="card shadow">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold">Tambah Galeri Travel</h6>
    </div>
    <div class="card-body">
      <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
        @csrf

        <!-- Paket Travel -->
        <div class="form-group">
          <label for="travel_packages_id">Paket Travel</label>
          <select name="travel_packages_id" id="travel_packages_id"
            class="form-control @error('travel_packages_id') is-invalid @enderror">
            <option value="">Pilih Paket Travel</option>
            @forelse ($travel_packages as $travel_package)
            <option value="{{ $travel_package->id }}">{{ $travel_package->title }}</option>
            @empty
            <option value=""></option>
            @endforelse
          </select>
          @error('travel_packages_id')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <!-- Image -->
        <div class="form-group">
          <label for="image">Gambar</label>
          <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
            value="{{ old('image') }}">
          @error('image')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>

        <button type="submit" class="btn btn-primary btn-block">
          Simpan
        </button>
        <a href="{{ route('gallery.index') }}" class="btn btn-light btn-block">Kembali</a>
      </form>
    </div>
  </div>
</div>
@endsection

@push('style')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/backend/vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/backend/vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@push('script')
<!-- Select2 -->
<script src="{{ asset('assets/backend/vendor/select2/js/select2.full.min.js') }}"></script>

<script>
  $(function() {
    $('#travel_packages_id').select2({
    theme: 'bootstrap4'
    });
  })
</script>
@endpush