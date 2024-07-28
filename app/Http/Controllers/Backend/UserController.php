<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\UserType;
use App\Jobs\ProcessImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Helpers\CloudinaryHelper;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::paginate(10)->load('userType');
        // dd($users);
        return view('Backend.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $user_type = UserType::all();
        $roles = Role::all()->groupBy('group');
        $roleActive = [];
        return view('Backend.user.create',compact('user_type','roles','roleActive'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        //
        try {
            $data = $request->except('_token','avatar','user_type');
            // dd($data);
            $data['password'] = Hash::make('123456');
            $data['status'] = 1;

            // Nếu tồn tại file avatar trong request
            if ($request->hasFile('avatar')) {
                // Sử dụng Helper function để tải ảnh lên Cloudinary
                $imageUrl = CloudinaryHelper::uploadImage($request->file('avatar'));
                // $imageUrl = ProcessImage::dispatch()->upload($request->file('avatar'));
                dd($imageUrl);
                // Thêm đường dẫn của ảnh vào dữ liệu trước khi lưu
                $data['avatar'] = $imageUrl;
            }
            $user = User::create($data);
            $user->roles()->sync($data['role_ids'] ?? []);

            if($user){
                $this->insertOrUpdateUserHasType($user, $request->user_type);
            }

        } catch (Exception $ex) {
            Log::error("ERROR => UserController@store =>". $ex->getMessage());
            return redirect()->route('admin.user.create');
        }
        return redirect()->route('admin.user.index');


    }

    protected function insertOrUpdateUserHasType($user, $type){
        $check = DB::table('user_has_type')
            ->where('user_id', $user->id)
            ->first();

        if ($check) {
            DB::table('user_has_type')
                ->where('user_id', $user->id)
                ->update([
                    'user_type_id' => $type,
                    'updated_at' => now(),
                ]);
        } else {
            DB::table('user_has_type')->insert([
                'user_type_id' => $type,
                'created_at' => now(),
                'user_id' => $user->id
            ]);
        }

        // $user->userHasType()->updateOrCreate(
        //     ['user_id' => $user->id],
        //     ['user_type_id' => $type, 'updated_at' => Carbon::now()]
        // );
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user,$id)
    {
        //
        $user_type = UserType::all();
        $user = User::findOrFail($id)->load('userType');
        $roles = Role::all()->groupBy('group');
        $roleActive = DB::table('model_has_roles')->where('model_id', $id)->pluck('role_id')->toArray() ;
        // dd($user);
        return view('Backend.user.edit',compact('user','user_type','roles','roleActive'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user, $id)
    {
        //
        $user = User::findOrFail($id);

        $data = $request->except('_token','avatar','user_type');
        // dd($data);
        $update = User::findOrFail($id);

        if ($request->hasFile('avatar')) {
            // Upload ảnh mới
            $imageUrl = CloudinaryHelper::uploadImage($request->file('avatar'));
            // $imageUrl = ProcessImage::dispatch()->upload($request->file('avatar'));

            // Xóa ảnh cũ trước khi cập nhật ảnh mới
            if (!empty($user->avatar)) {
                CloudinaryHelper::deleteImage($user->avatar);
                // ProcessImage::dispatch()->delete($user->avatar);
            }
    
            $data['avatar'] = $imageUrl;
        }

        $update->update($data);
        $user->roles()->sync($data['role_ids'] ?? []);


        if($update){
            $user = User::findOrFail($id);
            $this->insertOrUpdateUserHasType($user, $request->user_type);

        }
        return redirect()->route('admin.user.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(User $user, $id)
    {
        //
        DB::table('user_has_type')->where('user_id', $id)->delete();

        $user = User::findOrFail($id);
        if ($user->avatar) {
            // Nếu có, thực hiện xóa ảnh từ Cloudinary
            CloudinaryHelper::deleteImage($user->avatar);
            // ProcessImage::dispatch()->delete($user->avatar);

        }
        $user->delete();

        return redirect()->route('admin.user.index');
    }
}
