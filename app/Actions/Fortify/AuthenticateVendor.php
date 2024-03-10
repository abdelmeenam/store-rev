<?php

namespace App\Actions\Fortify;

use App\Models\Vendor;
use Illuminate\Support\Facades\Hash;

class AuthenticateVendor
{
    public function Authenticate($request)
    {
        $userName = $request->post(config('fortify.username'));
        $password = $request->post('password');

        $user = Vendor::where('username', '=', $userName)
            ->orWhere('email', '=', $userName)
            ->orWhere('phone_number', '=', $userName)
            ->first();

        if ($user && Hash::check($password, $user->password)) {
            return $user;
        }
        return false;
    }
}
