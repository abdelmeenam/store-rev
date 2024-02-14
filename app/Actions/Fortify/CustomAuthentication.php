<?php

namespace App\Actions\Fortify;

use App\Models\Admin;
use App\Models\Delivery;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomAuthentication
{
    public function authenticateAdmin($request)
    {

        // $request->validate([
        //     'email'=>'required|email|exists:users,email',
        //     'password'=>'required'
        // ],[
        //     'email.required'=>'البريد الألكترونى مطلوب'
        // ]);

        // determine which field used to authenticate as username , email , phone
        $user_name = $request->post(config('fortify.username')); // username
        $password = $request->post('password');




        // get admin based on user_name , email , phone_number
        $user = Admin::where('user_name', '=', $user_name)
                ->orWhere('email', '=', $user_name)
                ->orWhere('phone_number', '=', $user_name)
                ->first();

        // check if there is user (Admin) and his password == password input
        if ($user && Hash::check($password, $user->password)) {
            // authenticate with admin guard
            // Auth::guard('admin')->login($user);
            return $user;

        }
        return false;
    }



    public function authenticateUser($request)
    {


         // determine which field used to authenticate as username , email , phone
        $user_name = $request->post(config('fortify.username')); // username
        $password = $request->post('password');


         // get admin based on user_name , email , phone_number
         $user = User::where('phone_number', '=', $user_name)
                 ->orWhere('email_address', '=', $user_name)
                 ->first();


        if (!$user) {
            return false; // User not found
        }

        if ($user && Hash::check($password, $user->password)) {
            // Check if email is verified
            // if ($user->email_verified_at === null) {
            //     // abort(403, 'Your email address is not verified.');
            //     // return redirect()->to('custom_verification');
            //     // return 'email_not_verified';
            //     return false;
            // }
            return $user;

        }

        return false; // Incorrect password
    }



    public function authenticateVendor($request)
    {

         // determine which field used to authenticate as username , email , phone
         $user_name = $request->post(config('fortify.username')); // username
         $password = $request->post('password');

         // get admin based on user_name , email , phone_number
         $user = Vendor::where('phone', '=', $user_name)
                 ->orWhere('email', '=', $user_name)
                 ->first();

        if ($user && Hash::check($password, $user->password)) {
            return $user;
        }
        return false;
    }




}
