<?php

namespace App\Http\Controllers\Fontend;

use App\Models\Ward;
use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use App\Models\District;
use App\Models\Province;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\CloudinaryHelper;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;

class BoothController extends Controller
{
    //
    public function index($id){
        $products = Product::where('user_id', $id)->paginate(10);
        return view('Fontend.user.booth.index',compact('products'));
    }

    public function create(){
        $categories = Category::all();
        $provinces = Province::all();
        $districts = District::all();
        $wards = Ward::all();

        $viewData = [
            'categories' => $categories,
            'provinces' => $provinces,
            'districts' => $districts,
            'wards' => $wards,
        ];
        return view('Fontend.user.booth.create', $viewData);        
    }

    public function store(ProductRequest $request)
    {
        //
        // dd($request->all());
        try {
            $data = $request->except('_toke','avatar','avatars');
            $data['slug'] = Str::slug($request->name) ;

            $data['user_id'] = Auth::user()->id;

            if ($request->hasFile('avatar')) {
                // Sử dụng Helper function để tải ảnh lên Cloudinary
                $imageUrl = CloudinaryHelper::uploadImage($request->file('avatar'));
                
                // Thêm đường dẫn của ảnh vào dữ liệu trước khi lưu
                $data['avatar'] = $imageUrl;
            }
            $product = Product::create($data);

            if ($request->hasFile('avatars')){
                // Lặp qua từng file ảnh được gửi từ form
                foreach ($request->file('avatars') as $avatar) {
                    // Upload ảnh lên Cloudinary
                    $uploadResult = CloudinaryHelper::uploadImage($avatar);

                    // Nếu upload thành công, lưu đường dẫn và tên của ảnh vào CSDL
                    if ($uploadResult) {
                        // Lưu đường dẫn và tên ảnh vào CSDL
                        $imageModel = new Image();
                        $imageModel->path = $uploadResult;
                        $imageModel->name = $avatar->getClientOriginalName();
                        $imageModel->product_id = $product->id;
                        $imageModel->save();
                    }
                }      
            }
            


        } catch (Exception $ex) {
            Log::error("ERROR => ProductController@store =>". $ex->getMessage());
            return redirect()->route('client.booth.create');
        }
        return redirect()->route('client.booth', Auth::user()->id );
    }

    public function edit(Product $Product,$id)
    {
        //
        $categories = Category::all();
        $provinces = Province::all();
        $districts = District::all();
        $wards = Ward::all();


        $product = Product::where('user_id', Auth::user()->id)->findOrFail($id);
        $imgs = Image::get()->where('product_id',$product->id);
        // dd($imgs);
        // $model = new Product();
        // $status = $model->getStatus();
        $viewData = [
            'product' => $product,
            'imgs' => $imgs,
            'categories' => $categories,
            'provinces' => $provinces,
            'districts' => $districts,
            'wards' => $wards,
        ];

        return view('Fontend.user.booth.edit', $viewData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product, $id)
    {
        //
        $product = Product::where('user_id', Auth::user()->id)->findOrFail($id);
     
        $data = $request->except('_token','avatar','avatars');
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('avatar')) {
            // Upload ảnh mới
            $imageUrl = CloudinaryHelper::uploadImage($request->file('avatar'));
            // Xóa ảnh cũ
            if (!empty($product->avatar)) {
                CloudinaryHelper::deleteImage($product->avatar);
            }
            
            $data['avatar'] = $imageUrl;
        }

        // $product = Product::findOrFail($id);
        $product->update($data);
        
        if ($request->hasFile('avatars')){
            if(!empty($product->images)){
                foreach($product->images as $image){
                    $upload = CloudinaryHelper::deleteImage($image->path);
                    Image::destroy($image->id);
                }
            }

            // Lặp qua từng file ảnh được gửi từ form
            foreach ($request->file('avatars') as $avatar) {
                // Upload ảnh lên Cloudinary
                $uploadResult = CloudinaryHelper::uploadImage($avatar);

                // Nếu upload thành công, lưu đường dẫn và tên của ảnh vào CSDL
                if ($uploadResult) {
                    // Lưu đường dẫn và tên ảnh vào CSDL
                    $imageModel = new Image();
                    $imageModel->path = $uploadResult;
                    $imageModel->name = $avatar->getClientOriginalName();
                    $imageModel->product_id = $product->id;
                    $imageModel->save();
                }
            }
            
            
            
        }

        return redirect()->route('client.booth', Auth::user()->id );

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Product $product, $id)
    {
        //
        // $product = Product::destroy($id);
        // $product->delete();


        $product = Product::where('user_id', Auth::user()->id)->findOrFail($id)->load('images');
        // dd($product);
        // Kiểm tra xem product có ảnh không
        if ($product->avatar) {
            // Nếu có, thực hiện xóa ảnh từ Cloudinary
            CloudinaryHelper::deleteImage($product->avatar);
        }
        if($product->images){
            foreach ($product->images as $image) {
                CloudinaryHelper::deleteImage($image->path);
            }
        }

        $product->delete();

        return redirect()->route('client.booth', Auth::user()->id );
    }
}
