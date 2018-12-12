<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CriteriaSelfRegisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('criteria_selfregis')->insert([
            [
                'content' => 'Rèn luyện về nhận thức về chính trị, đạo đức lối sống: (0 – 10)',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'content' => 'Rèn luyện về chuyên môn, nghiệp vụ, tinh thần tình nguyện: (0 – 10)',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'content' => 'Rèn luyện về sức khỏe, kỹ năng thực hành xã hội: (0 – 10)',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}
