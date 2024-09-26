<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use App\Models\Wirthdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WirthdrawController extends Controller
{
    //

    public function index() {
        $all = Wirthdraw::where('account_id', Auth::user()->account->id)->get();
        return view('wirthdraw', compact('all'));
    }

    public function wirthdraw(Request $request){

        $request->validate(
            [
                'amount' => ['required', 'int']
                
            ]
        );
       if($request->amount > Auth::user()->account->balance || $request->amount == 0 || $request->amount <0){
        Session::flash('error', 'Check Your balance'); 
        
        return back();
       }
       Wirthdraw::create([
        'account_id' => Auth::user()->account->id,
        'balance' => Auth::user()->account->balance,
        'amount' => $request->amount,
       ]);
       $user = Account::find(Auth::user()->account->id);
       $user->balance = $user->balance - $request->amount;
       $user->save();
       return  back()->with('status', 'wirthdraw');

    }
}
