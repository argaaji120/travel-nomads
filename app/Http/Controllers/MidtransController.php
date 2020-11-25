<?php

namespace App\Http\Controllers;

use Mail;
use App\Mail\TransactionSuccess;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Midtrans\Config as MidtransConfig;
use Midtrans\Notification as MidtransNotification;

class MidtransController extends Controller
{
    public function notificationHandler(Request $request)
    {
        // Set Midtrans configuration
        MidtransConfig::$serverKey = config('midtrans.serverKey');
        MidtransConfig::$isProduction = config('midtrans.isProduction');
        MidtransConfig::$isSanitized = config('midtrans.isSanitized');
        MidtransConfig::$is3ds = config('midtrans.is3ds');

        $notification = new MidtransNotification();

        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;

        $order = explode('-', $notification->order_id);
        $order_id = $order[1];

        $transaction = Transaction::findOrFail($order_id);

        if ($status == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $transaction->transaction_status = 'CHALLENGE';
                } else {
                    $transaction->transaction_status = 'SUCCESS';
                }
            }
        } elseif ($status == 'settlement') {
            $transaction->transaction_status = 'SUCCESS';
        } elseif ($status == 'pending') {
            $transaction->transaction_status = 'PENDING';
        } elseif ('deny') {
            $transaction->transaction_status = 'FAILED';
        } elseif ('expire') {
            $transaction->transaction_status = 'EXPIRED';
        } elseif ($status == 'cancel') {
            $transaction->transaction_status = 'FAILED';
        }

        $transaction->save();

        if ($transaction) {
            if ($status == 'capture' && $fraud == 'accept') {
                Mail::to($transaction->user->email)->send(new TransactionSuccess($transaction));
            } elseif ($status == 'settlement') {
                Mail::to($transaction->user->email)->send(new TransactionSuccess($transaction));
            } elseif ($status == 'success') {
                Mail::to($transaction->user->email)->send(new TransactionSuccess($transaction));
            } elseif ($status == 'capture' && $fraud == 'challange') {
                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message' => 'Midtrans Payment Challange'
                    ]
                ]);
            } else {
                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message' => 'Midtrans Payment Not Settlement'
                    ]
                ]);
            }

            return response()->json([
                'meta' => [
                    'code' => 200,
                    'message' => 'Midtrans Notification Success'
                ]
            ]);
        }
    }

    public function finishRedirect(Request $request)
    {
        return view('pages.frontend.success');
    }

    public function unfinishRedirect(Request $request)
    {
        return view('pages.frontend.unfinish');
    }

    public function errorRedirect(Request $request)
    {
        return view('pages.frontend.failed');
    }
}
