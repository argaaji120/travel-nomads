<input type="hidden" name="id" value="{{ $transaction->id }}">
<div class="form-group" style="margin-bottom: 0">
  <label for="transaction_status">Status Transaksi</label>
  <select name="transaction_status" id="stransaction_tatus" class="form-control status">
    <option value="PENDING" {{ $transaction->transaction_status == 'PENDING' ? 'selected' : '' }}>
      PENDING
    </option>
    <option value="SUCCESS" {{ $transaction->transaction_status == 'SUCCESS' ? 'selected' : '' }}>
      SUCCESS
    </option>
    <option value="CANCEL" {{ $transaction->transaction_status == 'CANCEL' ? 'selected' : '' }}>
      CANCEL
    </option>
    <option value="FAILED" {{ $transaction->transaction_status == 'FAILED' ? 'selected' : '' }}>
      FAILED
    </option>
  </select>
</div>