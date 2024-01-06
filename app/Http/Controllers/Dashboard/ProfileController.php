<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;

class ProfileController extends Controller
{
    public function edit(){
        $user = Auth::user();

        return view('back.profile.edit', [
            'user' => $user,
            'countries' => Countries::getNames('en'),
            'locales' => Languages::getNames('en'),
        ]);
    }

    public function update(Request $request){
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birthday' => ['nullable', 'date', 'before:today'],
            'gender' => ['in:male,female'],
            'country' => ['required', 'string', 'size:2'],
        ]);

        $user = $request->user();       // return an instance of the authenticated user model

        $user->profile->fill( $request->all() )->save();

        return redirect()->route('dashboard.profile.edit')
            ->with('success', 'Profile updated!');
    }
}
