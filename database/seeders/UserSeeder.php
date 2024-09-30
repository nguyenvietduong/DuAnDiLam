<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tạo người dùng mẫu
        $users      = [];
        $password   = Hash::make('12345678');
        $now        = now();

        for ($i = 1; $i <= 2000; $i++) {
            $users[] = [
                'full_name' => 'Người dùng ' . $i,
                'phone'     => '038590' . $i, // Tạo số điện thoại giả
                'email'     => 'user' . $i . '@example.com',
                'password'  => $password, // Mã hóa mật khẩu
                'status'    => 'normal',
                'role_id'   => 3, // Giả định rằng bạn đã có role với ID từ 1 đến 3
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        // Chèn tất cả người dùng vào bảng
        DB::table('users')->insert($users);
    }
}
