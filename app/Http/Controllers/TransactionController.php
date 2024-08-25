<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TransactionController extends Controller
{
    public function index()
    {
        $search = request('search');

        $transactions = Transaction::latest();

        if ($search) {
            $transactions->where('code', 'like', '%' . $search . '%');
        }

        return view('pages.transaction.index', [
            'title' => 'Transaction',
            'transactions' => $transactions->paginate(15),
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => ['required', rULE::in(['CONFIRMED', 'PROGRESS', 'WAITING', 'SUCCESS', 'FAILED'])],
        ]);

        if ($validator->fails()) {
            return redirect()->route('transaction/trash')->with('error', $validator->errors()->first());
        }

        $validatedData = $validator->validated();

        $transaction = Transaction::find($request->id);

        if ($transaction->status == 'SUCCESS') {
            return redirect()->route('transaction')->with('error', 'Transaction is completed, cannot be changed!');
        } elseif ($transaction->status == 'FAILED') {
            return redirect()->route('transaction')->with('error', 'Transaction is failed, cannot be changed!');
        }

        $transaction->update($validatedData);

        return redirect()->route('transaction')->with('success', 'Update status transaction successfully.');
    }
}
