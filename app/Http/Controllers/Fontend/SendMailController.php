<?php

namespace App\Http\Controllers\Fontend;

use App\Models\User;
use App\Mail\ActiveMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ActivationToken;
use App\Jobs\SendActivationEmail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    //
    public function sendMailActivate($id){
        $user = User::find($id);
        // Tạo token
        $token = Str::random(60);
        $expires_at = Carbon::now()->addMinutes(15);

        // Lưu token vào cơ sở dữ liệu
        ActivationToken::create([
            'user_id' => $id,
            'token' => $token,
            'expires_at' => $expires_at,
        ]);
        // Gửi email kích hoạt
        SendActivationEmail::dispatch($user, $token);

        // // Mail::to($user->email)->queue(new ActiveMail($token));
        // Mail::to($user->email)->send(new ActiveMail($token));
        return redirect()->back();
    }

    public function activate($token)
    {
        $tokenData = ActivationToken::where('token', $token)->first();

        if ($tokenData) {
            // Xác thực token
            if ($this->isTokenValid($tokenData)) {
                // Cập nhật trạng thái người dùng
                $user = $tokenData->user;
                $user->status = 2;
                $user->save();
                return redirect()->back();
            } else {
                // Token hết hạn
                // Xử lý thông báo cho người dùng
            }
        } else {
            // Token không hợp lệ
            // Xử lý thông báo cho người dùng
        }
    }

    protected function isTokenValid($tokenData)
    {
        // Chuyển đổi chuỗi ngày tháng thành đối tượng Carbon
        $expiresAt = \Carbon\Carbon::parse($tokenData->expires_at);

        // So sánh thời gian hết hạn với thời gian hiện tại
        return $expiresAt->gt(now());
    }
    
}
