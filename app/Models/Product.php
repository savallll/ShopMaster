<?php

namespace App\Models;

use App\Models\User;
use App\Models\Ward;
use App\Models\Image;
use App\Models\Category;
use App\Models\District;
use App\Models\Province;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    public $timestamps = true;
    protected $fillable=[
        'id',
        'name',
        'description',
        'avatar',
        'slug',
        'status',
        'hot',
        'price',
        'number',
        'sale',
        'content',
        'category_id',
        'province_id',
        'district_id',
        'ward_id',
        'user_id',
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function images(){
        return $this->hasMany(Image::class, 'product_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    const STATUS_CANCEL = -1;

    const STATUS_DEFAULT = 1;

    const STATUS_SUCCESS = 2;

    const STATUS_FINISH = 3;

    protected $setStatus = [
        self::STATUS_SUCCESS => [
            'name' => 'Hoạt động',
            'class' => 'badge text-bg-primary',
        ],
        self::STATUS_DEFAULT => [
            'name' => 'Khởi tạo',
            'class' => 'badge text-bg-warning',
        ],
        self::STATUS_CANCEL => [
            'name' => 'Tạm dừng',
            'class' => 'badge text-bg-danger',
        ],
        self::STATUS_FINISH => [
            'name' => 'Hoàn thành',
            'class' => 'badge text-bg-success',
        ]
    ];

    public function getStatus(){
        return Arr::get($this->setStatus,$this->status, []);
    }

    public function getAddressAttribute()
    {
        // Kiểm tra xem có tồn tại province_id, district_id và ward_id trong sản phẩm hay không
        if ($this->province_id && $this->district_id && $this->ward_id) {
            // Tìm kiếm các thông tin về địa chỉ
            $province = Province::where('province_id', $this->province_id)->first();
            $district = District::where('district_id', $this->district_id)->first();
            $ward = Ward::where('wards_id', $this->ward_id)->first();

            $address = '';
            if ($province) {
                $address .= $province->name;
            }
            if ($district) {
                $address .= ', ' . $district->name;
            }
            if ($ward) {
                $address .= ', ' . $ward->name;
            }

        return $address;
        }

        return 'Không có địa chỉ'; // Hoặc bạn có thể trả về giá trị mặc định khác nếu muốn
    }

}
