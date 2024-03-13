<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //admin after login
    public function admin()
    {
        return view('admin.home');
    }

    //admin custome logout
    public function logout()
    {
        Auth::logout();
        $notification=array('message' => 'You are logged out!', 'alert-type' => 'success');
        return redirect()->route('admin.login')->with($notification);

    } 
        //password change page
        public function PasswordChange()
        {
            return view('admin.profile.password_change');
        
        }

        //password update
        public function PasswordUpdate(Request $request)
        {
            $validated = $request->validate([
                'old_password' => 'required',
                'password' =>'required|min:6|confirmed',
                 ]);

            $current_password=Auth::user()->password;   //login user passsword yet

            $oldpass=$request->old_password;
            $new_password=$request->password;
            if (Hash::check($oldpass,$current_password)) {
                        $user=User::findorfail(Auth::id());
                        $user->password=Hash::make($request->password);
                        $user->save();
                        Auth::logout();
                        $notification=array('message' => 'Your Password Changed', 'alert-type' => 'success');
                        return redirect()->route(admin.login)->with($notification);

            }else{
                $notification=array('message' => 'Old Password Not Matched', 'alert-type' => 'error');
                return redirect()->back()->with($notification);
            }

        }
}
