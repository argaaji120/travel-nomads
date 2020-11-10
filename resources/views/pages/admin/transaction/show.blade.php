<div class="modal-header">
  <h6 class="modal-title">Detail Transaksi</h6>
  <button type="button" class="close" data-dismiss="modal" aria-label="close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <dl class="row">
    <dt class="col-sm-3">Paket Travel</dt>
    <dd class="col-sm-8">{{ $transaction->travel_package->title }}</dd>
    <dt class="col-sm-3">Pembeli</dt>
    <dd class="col-sm-8">{{ $transaction->user->name }}</dd>
    <dt class="col-sm-3">Additional Visa</dt>
    <dd class="col-sm-8">{{ $transaction->additional_visa }}</dd>
    <dt class="col-sm-3">Total Transaksi</dt>
    <dd class="col-sm-8">{{ $transaction->transaction_total }}</dd>
    <dt class="col-sm-3">Status Transaksi</dt>
    <dd class="col-sm-8">{{ $transaction->transaction_status }}</dd>
    <dt class="col-sm-3">Pembelian</dt>
    <dd class="col-sm-12">
      <div class="table-responsive">
        <table class="table table-bordered mt-2">
          <tr>
            <th>Username</th>
            <th>Nationality</th>
            <th>Visa</th>
            <th>DOE Passport</th>
          </tr>
          @foreach ($transaction->details as $detail)
          <tr>
            <td>{{ $detail->username }}</td>
            <td>{{ $detail->nationality }}</td>
            <td>{{ $detail->is_visa ? '30 Hari' : 'N/A' }}</td>
            <td>{{ date('d-m-Y', strtotime($detail->doe_passport)) }}</td>
          </tr>
          @endforeach
        </table>
      </div>
    </dd>
  </dl>
</div>