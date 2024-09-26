<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $all = Deposit::where('account_id', Auth::user()->account->id)->get();
      return view('deposit',compact('all'));
    }

    /**
     * Update the specified resource in storage.
     */

     public function applyCC(Request $request, Account $account)
    {
      
      $acc = Auth::user()->account;
      if(!$acc->cc){
            $acc->cc = true;
            $acc->cc_number = 4847 . "-". fake()->randomNumber(4) ."-". fake()->randomNumber(4) ."-". fake()->randomNumber(4);
            $acc->cc_cvv = fake()->numberBetween(340,999);
            $acc->cc_end =  fake()->numberBetween(01,12) ."/". fake()->numberBetween(25,30);
            $acc->save();
      }
      
      return redirect('/dashboard');
        
    }

    public function addCash(Request $request, Account $account)
    {
      $request->validate([
        'amount' => ['required', 'int', 'max:5000000'],
    ]);
    if($request->amount == 0 || $request->amount <0){
      Session::flash('error', 'Check Your Amount'); 
      
      return back();
     }
     Deposit::create([
      'account_id' => Auth::user()->account->id,
      'balance' => Auth::user()->account->balance,
      'amount' => $request->amount,
     ]);

      $acc = Auth::user()->account;
      $acc->balance = $acc->balance + $request->amount;
      $acc->save();
      return redirect('/deposit')->with('status','deposit');
        
    }

    
}
