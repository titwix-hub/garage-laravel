<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddMoneyWalletRequest;

class UserController extends Controller
{
    public function settings(Request $request)
    {
        $user = $request->user();

        return view('users.settings', ['user' => $user]);
    }

    public function addMoney(AddMoneyWalletRequest $request)
    {
        $user = $request->user();

        $user->update([
           'wallet' => $user->wallet + $request->get('amount'),
        ]);

        return redirect()->back();
    }

    public function reservations(Request $request)
    {
        $user = $request->user();

        $reservations = $user->vehicles;

        return view('users.reservations', ['reservations' => $reservations]);
    }
}
