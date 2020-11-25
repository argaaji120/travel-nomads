<?php

namespace App\Http\Controllers;

use Mail;
use App\Mail\TransactionSuccess;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\TravelPackage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Uncomment to use midtrans
// use Midtrans\Config as MidtransConfig;
// use Midtrans\Snap as MidtransSnap;

class CheckoutController extends Controller
{
    public function index($id)
    {
        $transaction = Transaction::with(['details', 'travel_package', 'user'])->findOrFail($id);

        return view('pages.frontend.checkout', compact('transaction'));
    }

    public function process($id)
    {
        $travel_package = TravelPackage::findOrFail($id);

        $transaction = Transaction::create([
            'travel_packages_id' => $id,
            'users_id' => Auth::user()->id,
            'additional_visa' => 0,
            'transaction_total' => $travel_package->price,
            'transaction_status' => 'IN_CART'
        ]);

        TransactionDetail::create([
            'transactions_id' => $transaction->id,
            'username' => Auth::user()->username,
            'nationality' => 'ID',
            'is_visa' => false,
            'doe_passport' => Carbon::now()->addYear(5)
        ]);

        return redirect()->route('checkout', $transaction->id);
    }

    public function create(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|exists:users,username',
            'is_visa' => 'required|boolean',
            'doe_passport' => 'required'
        ]);

        $data = $request->all();
        $data['transactions_id'] = $id;

        TransactionDetail::create($data);

        $transaction = Transaction::with(['travel_package'])->findOrFail($id);

        if ($request->is_visa) {
            $transaction->transaction_total += 190;
            $transaction->additional_visa += 190;
        }

        $transaction->transaction_total += $transaction->travel_package->price;

        $transaction->save();

        return redirect()->route('checkout', $id);
    }

    public function remove($detail_id)
    {
        $detail = TransactionDetail::findOrFail($detail_id);

        $transaction = Transaction::with(['details', 'travel_package'])->findOrFail($detail->transactions_id);

        if ($detail->is_visa) {
            $transaction->transaction_total -= 190;
            $transaction->additional_visa -= 190;
        }

        $transaction->transaction_total -= $transaction->travel_package->price;

        $transaction->save();
        $detail->delete();

        return redirect()->route('checkout', $detail->transactions_id);
    }

    public function success($id)
    {
        $transaction = Transaction::with(['details', 'travel_package.galleries', 'user'])->findOrFail($id);
        $transaction->transaction_status = "PENDING";

        $transaction->save();

        // Uncomment the code below to use midtrans

        // Set Midtrans configuration
        // MidtransConfig::$serverKey = config('midtrans.serverKey');
        // MidtransConfig::$isProduction = config('midtrans.isProduction');
        // MidtransConfig::$isSanitized = config('midtrans.isSanitized');
        // MidtransConfig::$is3ds = config('midtrans.is3ds');

        // Built an array to be sent to Midtrans
        // $midtrans_params = [
        //     'transaction_details' => [
        //         'order_id' => 'NOMADS-' . $transaction->id,
        //         'gross_amount' => (int) $transaction->transaction_total
        //     ],
        //     'customer_details' => [
        //         'first_name' => $transaction->user->name,
        //         'email' => $transaction->user->email
        //     ],
        //     'enabled_payments' => ['gopay'],
        //     'vtweb' => []
        // ];

        // try {
        //     // Get Snap Payment page URL
        //     $paymentUrl = MidtransSnap::createTransaction($midtrans_params)->redirect_url;

        //     // Redirect to Midtrans page
        //     header('Location: ' . $paymentUrl);
        // } catch (Exception $e) {
        //     echo $e->getMessage();
        // }

        // Remove the code below when you use midtrans

        // Send e-ticket to users email
        Mail::to($transaction->user->email)->send(new TransactionSuccess($transaction));

        return view('pages.frontend.success');
    }
}
