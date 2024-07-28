<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller{
    public function show($id){
        // $user = 
        return view('Backend.profile.show');
    }
    
    public function updatePass($id){
        // $user = 
        return view('Backend.profile.updatePass');
    }
    public function update(Request $request,$id){
        // Validate the form data
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|string|different:old_password',
            'confirm_password' => 'required|same:new_password',
        ]);

        // Retrieve the authenticated user
        $user = Auth::user();

        // Check if the old password matches the user's current password
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->with('error', 'Mật khẩu cũ không chính xác');
        }

        // Update the user's password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Mật khẩu đã được cập nhật thành công');
    }

}