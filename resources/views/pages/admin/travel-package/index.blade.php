@extends('layouts.admin')

@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Paket Travel</h1>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold">Daftar Paket Travel</h6>
      <a href="{{ route('travel-package.create') }}" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i>&nbsp; Tambah Paket Travel
      </a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover" id="table" width="100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Title</th>
              <th>Location</th>
              <th>Departure Date</th>
              <th>Type</th>
              <th width="15%">Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@push('style')
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('assets/backend/vendor/toastr/toastr.min.css') }}">
<!-- DataTables -->
<link href="{{ asset('assets/backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@push('script')
<!-- Toastr -->
<script src="{{ asset('assets/backend/vendor/toastr/toastr.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('assets/backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

@if(session()->has('success'))
<script>
  toastr.success("{{ session()->get('success') }}");
</script>
@endif

<script>
  $(function() {
    $('#table').DataTable({
      ajax: "{{ route('travel-package.index') }}",
      columns: [
        { data: 'no' },
        { data: 'title' },
        { data: 'location' },
        { data: 'departure_date' },
        { data: 'type' },
        { data: 'action', orderable: false }
      ]
    });
  });
</script>

<script>
  // MOdal Detail
  jQuery(document).ready(function($) {
    $('#myModal').on('show.bs.modal', function(e) {
      var button = $(e.relatedTarget);
      var modal = $(this);
      
      modal.find('.modal-content').load(button.data("remote"));
    });
  });
  
  // Modal Confirm
  jQuery(document).ready(function($) {
    $('#modalConfirm').on('show.bs.modal', function(e) {
      var button = $(e.relatedTarget);
      var modal = $(this);
      
      modal.find('.modal-content').load(button.data("remote"));
    });
  });
</script>

<div class="modal" id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title"></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <i class="fa fa-spinner fa-spin"></i>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal" id="modalConfirm" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title"></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <i class="fa fa-spinner fa-spin"></i>
        </div>
      </div>
    </div>
  </div>
</div>
@endpush