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
            ],
            //==========================================================
            [
                'id' => '1511180309',
                'name' => 'Nguyễn Ngọc Trường An',
                'address' => '141 D5, phường 25, quận Bình Thạnh, tp Hồ Chí Minh',
                'birthday' => Carbon::create('1993', '09', '03'),
                'phone' => '0822507800',
                'class_room_id' => '15dth11',
                'sex' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => '7'
            ],
            [
                'id' => '1611700101',
                'name' => 'Nguyễn Lê Ngọc Anh',
                'address' => '141 D5, phường 25, quận Bình Thạnh, tp Hồ Chí Minh',
                'birthday' => Carbon::create('1993', '09', '03'),
                'phone' => '0822507800',
                'class_room_id' => '15dth11',
                'sex' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => '8'
            ],
            [
                'id' => '1511190557',
                'name' => 'Đoàn Ngọc Tuấn Anh',
                'address' => '141 D5, phường 25, quận Bình Thạnh, tp Hồ Chí Minh',
                'birthday' => Carbon::create('1993', '09', '03'),
                'phone' => '0822507800',
                'class_room_id' => '15dth11',
                'sex' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => '9'
            ],
            [
                'id' => '1511150440',
                'name' => 'Bùi Thị Huỳnh Giao',
                'address' => '141 D5, phường 25, quận Bình Thạnh, tp Hồ Chí Minh',
                'birthday' => Carbon::create('1993', '09', '03'),
                'phone' => '0822507800',
                'class_room_id' => '15dth11',
                'sex' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => '10'
            ],
            [
                'id' => '1511270182',
                'name' => 'Nguyễn Thị Vân Anh',
                'address' => '141 D5, phường 25, quận Bình Thạnh, tp Hồ Chí Minh',
                'birthday' => Carbon::create('1993', '09', '03'),
                'phone' => '0822507800',
                'class_room_id' => '15dth11',
                'sex' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => '11'
            ],
            [
                'id' => '1411090322',
                'name' => 'Võ Hồng Anh',
                'address' => '141 D5, phường 25, quận Bình Thạnh, tp Hồ Chí Minh',
                'birthday' => Carbon::create('1993', '09', '03'),
                'phone' => '0822507800',
                'class_room_id' => '15dth11',
                'sex' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => '12'
            ],
            [
                'id' => '1411180754',
                'name' => 'Ngô Thị Kim Anh',
                'address' => '141 D5, phường 25, quận Bình Thạnh, tp Hồ Chí Minh',
                'birthday' => Carbon::create('1993', '09', '03'),
                'phone' => '0822507800',
                'class_room_id' => '15dth11',
                'sex' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => '13'
            ],
            [
                'id' => '1411141336',
                'name' => 'Nguyễn Thị Ngọc Ánh',
                'address' => '141 D5, phường 25, quận Bình Thạnh, tp Hồ Chí Minh',
                'birthday' => Carbon::create('1993', '09', '03'),
                'phone' => '0822507800',
                'class_room_id' => '15dth11',
                'sex' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => '14'
            ],
            [
                'id' => '1511700013',
                'name' => 'Ngô Gia Bảo',
                'address' => '141 D5, phường 25, quận Bình Thạnh, tp Hồ Chí Minh',
                'birthday' => Carbon::create('1993', '09', '03'),
                'phone' => '0822507800',
                'class_room_id' => '15dth11',
                'sex' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => '15'
            ],
            [
                'id' => '1411141356',
                'name' => 'Nguyễn Hữu Cảnh',
                'address' => '141 D5, phường 25, quận Bình Thạnh, tp Hồ Chí Minh',
                'birthday' => Carbon::create('1993', '09', '03'),
                'phone' => '0822507800',
                'class_room_id' => '15dth11',
                'sex' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => '16'
            ],
            [
                'id' => '1511270940',
                'name' => 'Khổng Minh Cường',
                'address' => '141 D5, phường 25, quận Bình Thạnh, tp Hồ Chí Minh',
                'birthday' => Carbon::create('1993', '09', '03'),
                'phone' => '0822507800',
                'class_room_id' => '15dth11',
                'sex' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => '17'
            ],
            [
                'id' => '1611702213',
                'name' => 'Trần Thị Minh Châu',
                'address' => '141 D5, phường 25, quận Bình Thạnh, tp Hồ Chí Minh',
                'birthday' => Carbon::create('1993', '09', '03'),
                'phone' => '0822507800',
                'class_room_id' => '15dth11',
                'sex' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => '18'
            ],
            [
                'id' => '1411190582',
                'name' => 'Lâm Hạnh Linh Châu',
                'address' => '141 D5, phường 25, quận Bình Thạnh, tp Hồ Chí Minh',
                'birthday' => Carbon::create('1993', '09', '03'),
                'phone' => '0822507800',
                'class_room_id' => '15dth11',
                'sex' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => '19'
            ],
            [
                'id' => '1411190596',
                'name' => 'Đặng Thị Thu Diệu',
                'address' => '141 D5, phường 25, quận Bình Thạnh, tp Hồ Chí Minh',
                'birthday' => Carbon::create('1993', '09', '03'),
                'phone' => '0822507800',
                'class_room_id' => '15dth11',
                'sex' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => '20'
            ],
            [
                'id' => '1611701348',
                'name' => 'Trương Quỳnh Chi',
                'address' => '141 D5, phường 25, quận Bình Thạnh, tp Hồ Chí Minh',
                'birthday' => Carbon::create('1993', '09', '03'),
                'phone' => '0822507800',
                'class_room_id' => '15dth11',
                'sex' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => '21'
            ],
            [
                'id' => '1511270464',
                'name' => 'Trần Hồ Thùy Dung',
                'address' => '141 D5, phường 25, quận Bình Thạnh, tp Hồ Chí Minh',
                'birthday' => Carbon::create('1993', '09', '03'),
                'phone' => '0822507800',
                'class_room_id' => '15dth11',
                'sex' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => '22'
            ],
            [
                'id' => '1511270030',
                'name' => 'Nguyễn Quốc Khương Duy',
                'address' => '141 D5, phường 25, quận Bình Thạnh, tp Hồ Chí Minh',
                'birthday' => Carbon::create('1993', '09', '03'),
                'phone' => '0822507800',
                'class_room_id' => '15dth11',
                'sex' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => '23'
            ],
            [
                'id' => '1611701113',
                'name' => 'Võ Thị Quỳnh Duyên',
                'address' => '141 D5, phường 25, quận Bình Thạnh, tp Hồ Chí Minh',
                'birthday' => Carbon::create('1993', '09', '03'),
                'phone' => '0822507800',
                'class_room_id' => '15dth11',
                'sex' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => '24'
            ],
            [
                'id' => '1611702359',
                'name' => 'Phan Huỳnh Mỹ Duyên',
                'address' => '141 D5, phường 25, quận Bình Thạnh, tp Hồ Chí Minh',
                'birthday' => Carbon::create('1993', '09', '03'),
                'phone' => '0822507800',
                'class_room_id' => '15dth11',
                'sex' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => '25'
            ],
            [
                'id' => '1411180807',
                'name' => 'Lê Ngọc Bội Duyên',
                'address' => '141 D5, phường 25, quận Bình Thạnh, tp Hồ Chí Minh',
                'birthday' => Carbon::create('1993', '09', '03'),
                'phone' => '0822507800',
                'class_room_id' => '15dth11',
                'sex' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => '26'
            ],
            [
                'id' => '1511141466',
                'name' => 'Phùng Vũ Khánh Duyên',
                'address' => '141 D5, phường 25, quận Bình Thạnh, tp Hồ Chí Minh',
                'birthday' => Carbon::create('1993', '09', '03'),
                'phone' => '0822507800',
                'class_room_id' => '15dth11',
                'sex' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => '27'
            ],
            [
                'id' => '1611142370',
                'name' => 'Tô Thùy Duyên',
                'address' => '141 D5, phường 25, quận Bình Thạnh, tp Hồ Chí Minh',
                'birthday' => Carbon::create('1993', '09', '03'),
                'phone' => '0822507800',
                'class_room_id' => '15dth11',
                'sex' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => '28'
            ],
            [
                'id' => '1611701846',
                'name' => 'Lê Huyền Thùy Dương',
                'address' => '141 D5, phường 25, quận Bình Thạnh, tp Hồ Chí Minh',
                'birthday' => Carbon::create('1993', '09', '03'),
                'phone' => '0822507800',
                'class_room_id' => '15dth11',
                'sex' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => '29'
            ],
            [
                'id' => '1511061029',
                'name' => 'Huỳnh Minh Đại',
                'address' => '141 D5, phường 25, quận Bình Thạnh, tp Hồ Chí Minh',
                'birthday' => Carbon::create('1993', '09', '03'),
                'phone' => '0822507800',
                'class_room_id' => '15dth11',
                'sex' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => '30'
            ],
            [
                'id' => '1511100207',
                'name' => 'Dương Thị Hồng Đào',
                'address' => '141 D5, phường 25, quận Bình Thạnh, tp Hồ Chí Minh',
                'birthday' => Carbon::create('1993', '09', '03'),
                'phone' => '0822507800',
                'class_room_id' => '15dth11',
                'sex' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => '31'
            ],
            [
                'id' => '1411090199',
                'name' => 'Lâm Thành Đạt',
                'address' => '141 D5, phường 25, quận Bình Thạnh, tp Hồ Chí Minh',
                'birthday' => Carbon::create('1993', '09', '03'),
                'phone' => '0822507800',
                'class_room_id' => '15dth11',
                'sex' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => '32'
            ],
            [
                'id' => '1411142271',
                'name' => 'Nguyễn Như Quỳnh Đoan',
                'address' => '141 D5, phường 25, quận Bình Thạnh, tp Hồ Chí Minh',
                'birthday' => Carbon::create('1993', '09', '03'),
                'phone' => '0822507800',
                'class_room_id' => '15dth11',
                'sex' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => '33'
            ],
            [
                'id' => '1611270718',
                'name' => 'Trần Minh Đức',
                'address' => '141 D5, phường 25, quận Bình Thạnh, tp Hồ Chí Minh',
                'birthday' => Carbon::create('1993', '09', '03'),
                'phone' => '0822507800',
                'class_room_id' => '15dth11',
                'sex' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => '34'
            ],
        ]);
    }
}
