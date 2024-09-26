<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TransferController extends Controller
{
    public function index()
    {
        $trans = Transaction::where('sender_id',Auth::user()->id)->orWhere('recipient_id',Auth::user()->id)->get();

        return view('transfer', compact('trans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function TransferMoney(Request $request, Account $account)
    {
      $request->validate([
        'account_num' => ['required', 'int',],
        'amount' => ['required', 'int', 'max:5000000'],
    ]);
   
    if((int)$request->account_num == Auth::user()->account->account_number){

        Session::flash('error', 'You Can\'t Transfer From You To You!'); 
        
        return back();
    }
    $recipient = Account::where('account_number', $request->account_num)->first();

    if(!$recipient){
        Session::flash('error', 'Check Account Number'); 
        
        return back();
    }
    if((int)$request->amount > Auth::user()->account->balance ){
        Session::flash('error', 'Your Balance is not enough'); 
        
        return back();
    }

    $new_balance = Auth::user()->account->balance - (int)$request->amount;
    $sender = Account::find(Auth::user()->id);
    $sender->balance = $new_balance;
    $sender->save();

    $recipient->balance = $recipient->balance   + $request->amount;

    $recipient->save();

    Transaction::create([
        'sender_id' => $sender->id,
        'sender_name' =>Auth::user()->name,
        'amount' => (int)$request->amount,
        'recipient_id' =>$recipient->id,
        'recipient_name' => User::find($recipient->id)->name,
    ]);

    return  back()->with('status', 'transfer');
    }

}
