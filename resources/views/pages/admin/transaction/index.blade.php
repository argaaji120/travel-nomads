@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Transaksi</h1>
  </div>
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold">Daftar Transaksi</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover" id="table" width="100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Paket Travel</th>
              <th>User</th>
              <th>Visa</th>
              <th>Total</th>
              <th>Status</th>
              <th width="15%">Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Detail -->
<div class="modal" id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
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

<!-- Modal Edit -->
<div class="modal" id="modal-edit" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">Edit Status Transaksi</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-edit" method="POST">
        @csrf
        @method('put')
        <div class="modal-body" style="margin-bottom: 0">
        </div>
        <div class="modal-footer" style="border: none; margin-top: 0">
          <button type="button" class="btn btn-primary btn-block btn-update" style="margin-top: 0">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Confirm -->
<div class="modal" id="modal-confirm" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">Konfirmasi</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah kamu yakin ingin menghapus transaksi ini?</p>
      </div>
      <div class="modal-footer">
        <form action="" method="POST" id="form-delete">
          @csrf
          @method('delete')
          <input type="hidden" name="id" value="">
          <button class="btn btn-light" type="button" data-dismiss="modal">Tidak</button>
          <button class="btn btn-primary btn-yakin" type="button">Yakin</button>
        </form>
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
<script src="https://cdn.datatables.net/plug-ins/1.10.21/api/fnReloadAjax.js"></script>
<script src="{{ asset('assets/backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<script>
  $(document).ready(function() {
    // MOdal Detail
    jQuery(document).ready(function($) {
      $('#myModal').on('show.bs.modal', function(e) {
        var button = $(e.relatedTarget);
        var modal = $(this);
        
        modal.find('.modal-content').load(button.data("remote"));
      });
    });
    
    // Table
    let transaction = $('#table').DataTable({
      ajax: "{{ route('transaction.index') }}",
      deferRender: true,
      columns: [
        { data: 'no' },
        { data: 'travel' },
        { data: 'user' },
        { data: 'visa' },
        { data: 'total' },
        { data: 'status' },
        { data: 'action', orderable: false }
      ]
    });

    // reload the table data every 30 second
    setInterval( function () {
      transaction.ajax.reload(null, false);
    }, 30000 );

    // Show Edit Modal
    $('body').on('click', '.btn-edit', function () {
      let transaction_id = $(this).data('id');

      $.ajax({
        url: '{{ route('transaction.index') }}/' + transaction_id + '/edit',
        type: 'GET',
        success: function(data) {
          $('#modal-edit').find('.modal-body').html(data)
          $('#modal-edit').modal('show')
        },
        error: function(error) {
          console.log(error.responseJSON)
          alert('gagal get data transaksi')
        }
      })
    });

    // Update Transaction
    $('.btn-update').on('click', function() {
      let transaction_id = $('#form-edit').find('input[name="id"]').val()
      let formData = $('#form-edit').serialize()

      $.ajax({
        url: '{{ route('transaction.index') }}/' + transaction_id,
        type: 'PUT',
        data: formData,
        success: function(response) {
          toastr.success(response.success);
          transaction.ajax.reload(null, false)
          $('#modal-edit').modal('hide')
        },
        error: function(error) {
          console.log(error.responseJSON)
        }
      })
    })

    // Show Confirm Modal
    $('body').on('click', '.btn-delete', function () {
      $('#form-delete').find('input[name="id"]').val($(this).data('id'))
      $('#modal-confirm').modal('show')
    });

    // Delete Transaction
    $('.btn-yakin').on('click', function() {
      let transaction_id = $('#form-delete').find('input[name="id"]').val()
      let formData = $('#form-delete').serialize()

      $.ajax({
        url: '{{ route('transaction.index') }}/' + transaction_id,
        type: 'DELETE',
        data: formData,
        success: function(result) {
          toastr.success(result.success)
          transaction.ajax.reload(null, false);
          $('#modal-confirm').modal('hide')
        },
        error: function(error) {
          console.log(error.responseJSON)
        }
      })
    })
  })
</script>
@endpush