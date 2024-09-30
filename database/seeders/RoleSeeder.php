<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Thêm dữ liệu vào bảng roles
        DB::table('roles')->insert([
            [
                'name' => 'Admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Manager',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Customer',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        DB::table('users')->insert([
            [
                'full_name' => 'Nguyễn Viết Dương',
                'phone' => '0385906406',
                'email' => 'duongnv@hblab.vn',
                'password' => Hash::make('12345678'), // Mã hóa mật khẩu
                'status' => 'normal',
                'role_id' => 1, // Giả định rằng bạn đã có một role với ID = 1
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Nguyễn Bá Cường',
                'phone' => '0865468404',
                'email' => 'Cuongato2k4@gmail.com',
                'password' => Hash::make('12345678'), // Mã hóa mật khẩu
                'status' => 'normal',
                'role_id' => 2, // Giả định rằng bạn đã có một role với ID = 2
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Bùi Ngọc Thanh Trúc',
                'phone' => '0975107204',
                'email' => 'trucbntdev7204@gmail.com',
                'password' => Hash::make('12345678'), // Mã hóa mật khẩu
                'status' => 'normal',
                'role_id' => 2, // Giả định rằng bạn đã có một role với ID = 2
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Nguyễn Huy Tân',
                'phone' => '0886635676',
                'email' => 'tandz20004@gmail.com',
                'password' => Hash::make('12345678'), // Mã hóa mật khẩu
                'status' => 'normal',
                'role_id' => 2, // Giả định rằng bạn đã có một role với ID = 2
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Nguyễn Thị Hương',
                'phone' => '0396416189',
                'email' => 'nguyenthihuong.qc2004@gmail.com',
                'password' => Hash::make('12345678'), // Mã hóa mật khẩu
                'status' => 'normal',
                'role_id' => 2, // Giả định rằng bạn đã có một role với ID = 2
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Người dùng',
                'phone' => '012345678',
                'email' => 'nguyenthihuong.qc2004@gmail.com',
                'password' => Hash::make('012345678'), // Mã hóa mật khẩu
                'status' => 'normal',
                'role_id' => 3, // Giả định rằng bạn đã có một role với ID = 2
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Thêm nhiều người dùng ở đây nếu cần
        ]);
    }
}
