<?php

namespace App\Http\Controllers\Fontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\CloudinaryHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //
    public function index(){
        return view('Fontend.user.profile.index') ;
    }

    public function edit($id){
        return view('Fontend.user.profile.edit') ;
    } 

    public function update(Request $request, $id){
        $data = $request->all();
            //
        $user = User::findOrFail($id);

        $update = User::findOrFail($id);

        if ($request->hasFile('avatar')) {
            // Upload ảnh mới
            $imageUrl = CloudinaryHelper::uploadImage($request->file('avatar'));
            // Xóa ảnh cũ khi cập nhật ảnh mới
            if (!empty($user->avatar)) {
                CloudinaryHelper::deleteImage($user->avatar);
            }
    
            $data['avatar'] = $imageUrl;
        }

        $update->update($data);

    
        return redirect()->route('client.profile.index');
    
        
    }

    public function viewUpdatePass($id){
        // $user = 
        return view('Fontend.user.profile.updatePass');
    }
    public function updatePass(Request $request,$id){
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
