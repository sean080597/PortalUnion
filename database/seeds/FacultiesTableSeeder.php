<?php

use Illuminate\Database\Seeder;
use App\Faculty;
use Carbon\Carbon;

class FacultiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function insert_faculty($id, $faculty_name, $note){
        if(empty($note)){
            DB::table('faculties')->insert([
                'id' => $id,
                'name' => $faculty_name,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }else{
            DB::table('faculties')->insert([
                'id' => $id,
                'name' => $faculty_name,
                'note' => $note,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }

    public function run()
    {
        self::insert_faculty('DTH', 'Công Nghệ Thông Tin', '');
        self::insert_faculty('DAT', 'An Toàn Thông Tin', '');
        self::insert_faculty('DQT', 'Quản Trị Kinh Doanh', '');
        self::insert_faculty('DKS', 'QT Du lịch - Nhà Hàng - Khách Sạn', 'Khách Sạn');
        self::insert_faculty('DLH', 'QT Du lịch - Nhà Hàng - Khách Sạn', 'Lữ Hành');
        self::insert_faculty('DNH', 'QT Du lịch - Nhà Hàng - Khách Sạn', 'Nhà Hàng');
        self::insert_faculty('DKT', 'Kế Toán - Tài Chính - Ngân Hàng', '');
        self::insert_faculty('DDU', 'Dược', '');
        self::insert_faculty('DXD', 'Xây Dựng', '');
        self::insert_faculty('DTA', 'Tiếng Anh', '');
        self::insert_faculty('DLU', 'Luật', '');
    }
}
