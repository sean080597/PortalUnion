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
            ],
            //======================================================
            [
                'name' => 'Nguyễn Ngọc Trường An',
                'email' => 'Thaddeus_Larkin@gmail.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'stu',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Nguyễn Lê Ngọc Anh',
                'email' => 'Dallas89@hotmail.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'stu',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Đoàn Ngọc Tuấn Anh',
                'email' => 'Arvid.Miller15@yahoo.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'stu',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Bùi Thị Huỳnh Giao',
                'email' => 'Sydnee.Howell@gmail.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'stu',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Nguyễn Thị Vân Anh',
                'email' => 'Devan.Kreiger4@gmail.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'stu',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Võ Hồng Anh',
                'email' => 'Margarete30@hotmail.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'stu',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Ngô Thị Kim Anh',
                'email' => 'Ewald_Maggio4@hotmail.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'stu',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Nguyễn Thị Ngọc Ánh',
                'email' => 'Anissa.Parker65@yahoo.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'stu',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Ngô Gia Bảo',
                'email' => 'Simone.Sawayn73@gmail.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'stu',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Nguyễn Hữu Cảnh',
                'email' => 'Minnie_Dietrich@yahoo.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'stu',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Khổng Minh Cường',
                'email' => 'Aryanna.Rosenbaum@yahoo.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'stu',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Trần Thị Minh Châu',
                'email' => 'Kellen_Kuhn46@hotmail.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'stu',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Lâm Hạnh Linh Châu',
                'email' => 'Fleta_Powlowski@hotmail.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'stu',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Đặng Thị Thu Diệu',
                'email' => 'Lizzie92@yahoo.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'stu',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Trương Quỳnh Chi',
                'email' => 'Fausto.Heaney@gmail.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'stu',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Trần Hồ Thùy Dung',
                'email' => 'Ralph.Vandervort@yahoo.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'stu',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Nguyễn Quốc Khương Duy',
                'email' => 'Jodie.Jacobson28@hotmail.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'stu',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Võ Thị Quỳnh Duyên',
                'email' => 'Jamey_Stoltenberg@hotmail.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'stu',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Phan Huỳnh Mỹ Duyên',
                'email' => 'Palma74@hotmail.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'stu',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Lê Ngọc Bội Duyên',
                'email' => 'Wyatt11@gmail.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'stu',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Phùng Vũ Khánh Duyên',
                'email' => 'Makenna.Stroman@gmail.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'stu',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Tô Thùy Duyên',
                'email' => 'Shaun.Schiller66@gmail.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'stu',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Lê Huyền Thùy Dương',
                'email' => 'Brielle_McLaughlin86@yahoo.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'stu',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Huỳnh Minh Đại',
                'email' => 'Enos.Ernser@yahoo.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'stu',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Dương Thị Hồng Đào',
                'email' => 'Ben.Ebert@hotmail.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'stu',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Lâm Thành Đạt',
                'email' => 'Rosalia_Lebsack@gmail.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'stu',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Nguyễn Như Quỳnh Đoan',
                'email' => 'Mary.Swift37@yahoo.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'stu',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Trần Minh Đức',
                'email' => 'Edmond.Roberts54@yahoo.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'stu',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);
    }
}
