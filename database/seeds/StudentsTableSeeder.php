<?php

use Illuminate\Database\Seeder;
use App\Student;
use Carbon\Carbon;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::insert([
            [
                'id' => '1511061004',
                'name' => 'Lưu Quốc Cường',
                'address' => '141 D5, phường 25, quận Bình Thạnh, tp Hồ Chí Minh',
                'birthday' => Carbon::create('1997', '05', '08'),
                'phone' => '0822507800',
                'class_room_id' => '15dth12',
                'sex' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => '3'
            ],
            [
                'id' => '1511060993',
                'name' => 'Trương Quốc Cẩm',
                'address' => '141 D5, phường 25, quận Bình Thạnh, tp Hồ Chí Minh',
                'birthday' => Carbon::create('1993', '09', '03'),
                'phone' => '0822507800',
                'class_room_id' => '15dth12',
                'sex' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => '4'
            ],
            [
                'id' => '1511061043',
                'name' => 'Nguyễn Thanh Đăng',
                'address' => '141 D5, phường 25, quận Bình Thạnh, tp Hồ Chí Minh',
                'birthday' => Carbon::create('1997', '10', '08'),
                'phone' => '0822507800',
                'class_room_id' => '15dth12',
                'sex' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => '5'
            ],
            [
                'id' => '1511061278',
                'name' => 'Lê Đặng Phú',
                'address' => '141 D5, phường 25, quận Bình Thạnh, tp Hồ Chí Minh',
                'birthday' => Carbon::create('1993', '09', '03'),
                'phone' => '0822507800',
                'class_room_id' => '15dth11',
                'sex' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => '6'
            ]
        ]);
    }
}
