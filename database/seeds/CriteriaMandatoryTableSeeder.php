<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CriteriaMandatoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('criteria_mandatories')->insert([
            [
                'content' => 'Có tinh thần yêu nước, yêu trường lớp, tích cực trong hoạt động sinh hoạt lớp, sinh hoạt Đoàn (0 – 10 điểm)',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'content' => 'Chấp hành pháp luật, đồng thời vận động gia đình, bạn bè cùng thực hiện tốt; thực hiện tốt nội quy Nhà trường, điều lệ Đoàn. (0 – 10 điểm)',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'content' => 'Có thái độ học tập tích cực, đi học đúng giờ, đóng góp xây dựng bài, không vi phạm quy chế học tập, quy chế thi cử. (0 – 10 điểm)',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'content' => 'Tích cực tham gia các hoạt động văn hóa, văn nghệ, thể dục thể thao. (0 – 10 điểm)',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'content' => 'Tích cực tham gia các hoạt động tình nguyện (Mùa hè xanh, Xuân tình nguyện, Hiến máu tình nguyện, các hoạt động bảo vệ môi trường…); Không xả rác bừa bãi và tự nguyện nhặt rác (0 – 10 điểm)',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'content' => 'Tích cực chủ động trang bị những kỹ năng, nâng cao trình độ ngoại ngữ, tin  học; đăng ký tham gia phong trào “sinh viên 5 tốt”. (0 – 10 điểm)',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'content' => 'Tham dự đầy đủ, tích cực và tham gia đóng góp ý kiến trong sinh hoạt chi đoàn và các hoạt động do tổ chức Đoàn các cấp tổ chức, đóng đoàn phí đầy đủ. Chấp hành sự phân công của Ban chấp hành chi đoàn và Đoàn cấp trên.(0 – 10 điểm)',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}
