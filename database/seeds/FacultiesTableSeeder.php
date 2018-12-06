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
                'name' => 'Cong Nghe Thong Tin',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        ]);
    }
}
