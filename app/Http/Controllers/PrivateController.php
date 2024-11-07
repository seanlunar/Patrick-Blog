<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PrivateController extends Controller
{


    public function index(){

        if (Auth::user()->hasRole(['admin', 'superadmin'])) {
            return to_route('dashboard');
        }
        return redirect()->route('welcome');
    }
     public function addUser(Request $request)
     {
//    dd($request->all());

      $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
      ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)    ]);

            $user->assignRole('user');
            Alert::toast('Successfully added an account ', 'success');

            return redirect()->back();
     }
}
