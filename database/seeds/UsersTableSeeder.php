<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'administer@gmail.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'adm',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'BCH đoàn trường',
                'email' => 'doantruong@gmail.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'sch',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'LQC Doan Khoa',
                'email' => 'cuong.luusean@gmail.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'fac',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'TQC Chi Doan',
                'email' => 'camcam1132000@gmail.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'cla',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Nguyễn Thanh Đăng',
                'email' => 'nguyenthanhdang1008@gmail.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'stu',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Lê Đặng Phú',
                'email' => 'phu250497@gmail.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'stu',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
