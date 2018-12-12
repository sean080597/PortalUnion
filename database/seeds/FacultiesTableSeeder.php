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
    public function run()
    {
        DB::table('faculties')->insert([
            [
                'id' => 'DTH',
                'name' => 'Công Nghệ Thông Tin',
                'note' => '',
                'uid_secretary' => 8,
                'uid_deputysecre1' => 9,
                'uid_deputysecre2' => 10,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 'DAT',
                'name' => 'An Toàn Thông Tin',
                'note' => '',
                'uid_secretary' => 40,
                'uid_deputysecre1' => 42,
                'uid_deputysecre2' => 43,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 'DQT',
                'name' => 'Quản Trị Kinh Doanh',
                'note' => '',
                'uid_secretary' => 11,
                'uid_deputysecre1' => 12,
                'uid_deputysecre2' => 13,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 'DKS',
                'name' => 'QT Du lịch - Nhà Hàng - Khách Sạn',
                'note' => 'Khách Sạn',
                'uid_secretary' => 14,
                'uid_deputysecre1' => 15,
                'uid_deputysecre2' => 16,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 'DLH',
                'name' => 'QT Du lịch - Nhà Hàng - Khách Sạn',
                'note' => 'Lữ Hành',
                'uid_secretary' => 17,
                'uid_deputysecre1' => 18,
                'uid_deputysecre2' => 19,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 'DNH',
                'name' => 'QT Du lịch - Nhà Hàng - Khách Sạn',
                'note' => 'Nhà Hàng',
                'uid_secretary' => 20,
                'uid_deputysecre1' => 21,
                'uid_deputysecre2' => 22,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 'DKT',
                'name' => 'Kế Toán - Tài Chính - Ngân Hàng',
                'note' => '',
                'uid_secretary' => 23,
                'uid_deputysecre1' => 24,
                'uid_deputysecre2' => 25,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 'DDU',
                'name' => 'Dược',
                'note' => '',
                'uid_secretary' => 26,
                'uid_deputysecre1' => 27,
                'uid_deputysecre2' => 28,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 'DXD',
                'name' => 'Xây Dựng',
                'note' => '',
                'uid_secretary' => 29,
                'uid_deputysecre1' => 30,
                'uid_deputysecre2' => 31,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 'DTA',
                'name' => 'Tiếng Anh',
                'note' => '',
                'uid_secretary' => 32,
                'uid_deputysecre1' => 33,
                'uid_deputysecre2' => 34,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 'DLU',
                'name' => 'Luật',
                'note' => '',
                'uid_secretary' => 35,
                'uid_deputysecre1' => 36,
                'uid_deputysecre2' => 37,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}
