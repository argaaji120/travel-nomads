@extends('layouts.checkout')

@push('after-style')
<link rel="stylesheet" href="{{ asset('assets/frontend/libraries/gijgo/css/gijgo.min.css') }}" />
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
            <li class="breadcrumb-item" aria-current="page">Details</li>
            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-8 pl-lg-0">
        <div class="card card-details mb-3">
          <h1>Who is Going?</h1>
          <p>Trip to {{ $transaction->travel_package->title }}, {{ $transaction->travel_package->location }}</p>

          <div class="attendee">
            <table class="table table-responsive-sm text-center">
              <thead>
                <tr>
                  <td scope="col">Picture</td>
                  <td scope="col">Name</td>
                  <td scope="col">Nationality</td>
                  <td scope="col">Visa</td>
                  <td scope="col">Passport</td>
                  <td scope="col"></td>
                </tr>
              </thead>
              <tbody>
                @forelse ($transaction->details as $detail)
                <tr>
                  <td>
                    <img src="https://ui-avatars.com/api/?name={{ $detail->username }}" alt="{{ $detail->username }}"
                      height="60" class="rounded-circle" />
                  </td>
                  <td class="align-middle">{{ $detail->username }}</td>
                  <td class="align-middle">{{ $detail->nationality }}</td>
                  <td class="align-middle">{{ $detail->is_visa ? '30 Days' : 'N/A' }}</td>
                  <td class="align-middle">
                    {{ \Carbon\Carbon::createFromDate($detail->doe_passport) > \Carbon\Carbon::now() ? 'Active' : 'Inactive' }}
                  </td>
                  <td class="align-middle">
                    <a href="{{ route('checkout.remove', $detail->id) }}">
                      <img src="{{ asset('assets/frontend/images/ic_remove.png') }}" alt="" />
                    </a>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="6" class="text-center">
                    No visitor
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <div class="member mt-3">
            <h2>Add Member</h2>
            <form class="form-inline" action="{{ route('checkout.create', $transaction->id) }}" method="POST"
              autocomplete="off">
              @csrf
              <label class="sr-only" for="username">Name</label>
              <input type="text" class="form-control mb-2 mr-sm-2" name="username" id="username" placeholder="Username"
                required />

              <label class="sr-only" for="nationality">Nationality</label>
              <input type="text" class="form-control mb-2 mr-sm-2" style="width: 50px" name="nationality"
                id="nationality" placeholder="Nationality" required />

              <label class="sr-only" for="is_visa">Visa</label>
              <select class="custom-select mb-2 mr-sm-2" name="is_visa" id="is_visa" required>
                <option selected hidden value="">VISA</option>
                <option value="1">30 Days</option>
                <option value="0">N/A</option>
              </select>

              <label class="sr-only" for="doe_passport">DOE Passport</label>
              <div class="input-group mb-2 mr-sm-2">
                <input type="text" class="form-control datepicker" name="doe_passport" id="doe_passport"
                  placeholder="DOE Passport" required />
              </div>

              <button type="submit" class="btn btn-add-now mb-2 px-4">
                Add Now
              </button>
            </form>
            <h3 class="mt-2 mb-0">Note</h3>
            <p class="disclaimer mb-0">
              You are only able to invite member that has registered in Nomads.
            </p>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card card-details card-right">
          <h2>Checkout Information</h2>
          <table class="trip-informations">
            <tr>
              <th width="50%">Members</th>
              <td width="50%" class="text-right">
                {{ $transaction->details->count() }} person
              </td>
            </tr>
            <tr>
              <th width="50%">Additional VISA</th>
              <td width="50%" class="text-right">
                $ {{ $transaction->additional_visa }},00
              </td>
            </tr>
            <tr>
              <th width="50%">Trip Price</th>
              <td width="50%" class="text-right">
                $ {{ $transaction->travel_package->price }},00 / person
              </td>
            </tr>
            <tr>
              <th width="50%">Sub Total</th>
              <td width="50%" class="text-right">
                $ {{ $transaction->transaction_total }},00
              </td>
            </tr>
            <tr>
              <th width="50%">Total (+Unique)</th>
              <td width="50%" class="text-right text-total">
                <span class="text-blue">$ {{ $transaction->transaction_total }},</span><span
                  class="text-orange">{{ mt_rand(0,99) }}</span>
              </td>
            </tr>
          </table>

          <hr />
          <h2>Payment Instructions</h2>
          <!-- Uncomment the codes below when you use midtrans -->
          <!-- <p class="payment-instructions">
            You will be redirected to another page to pay using Gopay.
          </p> -->
          <p class="payment-instructions">
            Please complete your payment before to continue the wonderful trip
          </p>
          <div class="bank">
            <!-- Uncomment the codes below when you use midtrans -->
            <!-- <div class="bank-item pb-3">
              <div class="description">
                <img src="{{ asset('assets/frontend/images/gopay.png') }}" alt="" class="w-50" />
              </div>
              <div class="clearfix"></div>
            </div> -->
            <div class="bank-item pb-3">
              <img src="{{ asset('assets/frontend/images/ic_bank.png') }}" alt="" class="bank-image" />
              <div class="description">
                <h3>PT Nomads ID</h3>
                <p>
                  0881 8829 8800
                  <br />
                  Bank Central Asia
                </p>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="bank-item">
              <img src="{{ asset('assets/frontend/images/ic_bank.png') }}" alt="" class="bank-image" />
              <div class="description">
                <h3>PT Nomads ID</h3>
                <p>
                  0899 8501 7888
                  <br />
                  Bank HSBC
                </p>
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
        <div class="join-container">
          <!-- Uncomment the codes below when you use midtrans -->
          <!-- <a href="{{ route('checkout.success', $transaction->id) }}" class="btn btn-block btn-join-now mt-3 py-2">
            Process Payment
          </a> -->
          <a href="{{ route('checkout.success', $transaction->id) }}" class="btn btn-block btn-join-now mt-3 py-2">
            I Have Made Payment
          </a>
        </div>
        <div class="text-center mt-3">
          <a href="{{ route('detail', $transaction->travel_package->slug) }}" class="text-muted">Cancel Booking</a>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('after-script')
<script src="{{ asset('assets/frontend/libraries/gijgo/js/gijgo.min.js') }}"></script>
<script>
  $(document).ready(function () {
    $(".datepicker").datepicker({
      format: 'yyyy-mm-dd',
      uiLibrary: "bootstrap4",
      icons: {
        rightIcon: '<img src="{{ asset('assets/frontend/images/ic_doe.png') }}" alt="" />',
      },
    });
  });
</script>
@endpush