<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $adminData = User::findOrFail($id);

        return view('admin.admin_profile_view', compact('adminData'));
    }

    public function AdminProfileUpdate(Request $request)
    {
        /* dd($request->all()); */
        $id = Auth::user()->id;
        $admin = User::findOrFail($id);
        $admin->name = $request->name;
        $admin->email = $request->email;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('uploads/admin_profiles/'.$admin->photo));
            $imageName = date('YmdHi').'.'. $file->getClientOriginalName();
            $file->move(public_path('uploads/admin_profiles'), $imageName);
            $admin['photo'] = $imageName;
        }
        $admin->save();
        
        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function AdminPasswordChange(){
        return view('admin.admin_password_change');
    }

    public function AdminPasswordUpdate(Request $request){

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->old_password, Auth::user()->password)) {
            $notification = array(
                'message' => 'Old password does not match',
                'alert-type' => 'error'
            );
    
            return redirect()->back()->with($notification);
        }

        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => 'Password Updated',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
