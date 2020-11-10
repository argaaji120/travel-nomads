<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TransactionRequest;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = Transaction::with(['details', 'travel_package', 'user'])->orderBy('transaction_status', 'DESC')->get();

        if (request()->ajax()) {
            $data = [];
            $no   = 1;
            foreach ($transaction as $key => $value) {
                $data[] = [
                    'no' => $no++,
                    'travel' => $value->travel_package->title,
                    'user' => $value->user->name,
                    'visa' => $value->additional_visa,
                    'total' => $value->transaction_total,
                    'status' => $value->transaction_status,
                    'action' => '<a href="javascript:void(0)" data-remote="' . route('transaction.show', $value->id) . '" data-toggle="modal" data-target="#myModal" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a> 
                                <a href="javascript:void(0)" data-id="' . $value->id . '" class="btn btn-primary btn-sm btn-edit"><i class="fa fa-pencil-alt"></i></a>
                                <a href="javascript:void(0)" data-id="' . $value->id . '" class="btn btn-danger btn-sm btn-delete"><i class="far fa-trash-alt"></i></i></a>'
                ];
            }
            return response()->json(compact('data'));;
        }

        return view('pages.admin.transaction.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::with(['details', 'travel_package', 'user'])->findOrFail($id);

        return view('pages.admin.transaction.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);

        return view('pages.admin.transaction.edit', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionRequest $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update([
            'transaction_status' => $request->transaction_status
        ]);

        return response()->json(['success' => 'Status Transaksi Berhasil Diubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Transaction::findOrFail($id);
        $item->delete();

        return response()->json(['success' => 'Transaksi Berhasil dihapus']);
    }
}
