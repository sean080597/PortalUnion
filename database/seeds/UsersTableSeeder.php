<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function insert_user_stu($n, $p){
        $faker = Faker::create();
        DB::table('users')->insert([
            'name' => $n,
            'phone' => "0".rand(100, 999).rand(100,999).rand(10, 99).rand(0, 9),
            'email' => $faker->email,
            'password' => bcrypt($p),
            'role_id' => 'stu',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }

    public function run()
    {
        //9 rows
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
                'name' => 'Hội Sinh Viên',
                'email' => 'hoisinhvien@gmail.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'sch',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            // account secretary & 2 deputy secretaries
            [
                'name' => 'Bi Thu Truong',
                'email' => 'Leola.Lynch@hotmail.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'sec',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Pho Bi Thu Truong 1',
                'email' => 'Michale61@yahoo.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'de1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Pho Bi Thu Truong 2',
                'email' => 'Bridget5@gmail.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'de2',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            //user_id = 6
            [
                'name' => 'LQC Doan Khoa',
                'email' => 'cuong.luusean@gmail.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'fac',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            //user_id = 7
            [
                'name' => 'TQC Chi Doan',
                'email' => 'camcam1132000@gmail.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'cla',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            //user_id = 8
            [
                'name' => 'Nguyễn Thanh Đăng',
                'email' => 'nguyenthanhdang1008@gmail.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'stu',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            //user_id = 9
            [
                'name' => 'Lê Đặng Phú',
                'email' => 'phu250497@gmail.com',
                'password' => bcrypt('sean080597'),
                'role_id' => 'stu',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);

        //===================================================================
        self::insert_user_stu('Nguyễn Ngọc Trường An', 'sean080597');
        self::insert_user_stu('Nguyễn Lê Ngọc Anh', 'sean080597');
        self::insert_user_stu('Đoàn Ngọc Tuấn Anh', 'sean080597');
        self::insert_user_stu('Nguyễn Thị Vân Anh', 'sean080597');
        self::insert_user_stu('Võ Hồng Anh', 'sean080597');
        self::insert_user_stu('Ngô Thị Kim Anh', 'sean080597');
        self::insert_user_stu('Nguyễn Thị Ngọc Ánh', 'sean080597');
        self::insert_user_stu('Ngô Gia Bảo', 'sean080597');
        self::insert_user_stu('Nguyễn Hữu Cảnh', 'sean080597');
        self::insert_user_stu('Khổng Minh Cường', 'sean080597');
        self::insert_user_stu('Trần Thị Minh Châu', 'sean080597');
        self::insert_user_stu('Lâm Hạnh Linh Châu', 'sean080597');
        self::insert_user_stu('Trương Quỳnh Chi', 'sean080597');
        self::insert_user_stu('Đặng Thị Thu Diệu', 'sean080597');
        self::insert_user_stu('Trần Hồ Thùy Dung', 'sean080597');
        self::insert_user_stu('Nguyễn Quốc Khương Duy', 'sean080597');
        self::insert_user_stu('Võ Thị Quỳnh Duyên', 'sean080597');
        self::insert_user_stu('Phan Huỳnh Mỹ Duyên', 'sean080597');
        self::insert_user_stu('Lê Ngọc Bội Duyên', 'sean080597');
        self::insert_user_stu('Phùng Vũ Khánh Duyên', 'sean080597');
        self::insert_user_stu('Tô Thùy Duyên', 'sean080597');
        self::insert_user_stu('Lê Huyền Thùy Dương', 'sean080597');
        self::insert_user_stu('Phan Lệ Thùy Dương', 'sean080597');
        self::insert_user_stu('Huỳnh Minh Đại', 'sean080597');
        self::insert_user_stu('Dương Thị Hồng Đào', 'sean080597');
        self::insert_user_stu('Lâm Thành Đạt', 'sean080597');
        self::insert_user_stu('Nguyễn Như Quỳnh Đoan', 'sean080597');
        self::insert_user_stu('Trần Minh Đức', 'sean080597');
        self::insert_user_stu('Bùi Thị Huỳnh Giao', 'sean080597');
        self::insert_user_stu('Hoàng Ngọc Hà', 'sean080597');
        self::insert_user_stu('Nguyễn Nhị Hà', 'sean080597');
        self::insert_user_stu('Trần Thị Hà', 'sean080597');
        self::insert_user_stu('Lương Thị Kiều Hải', 'sean080597');
        self::insert_user_stu('Đoàn Hồ Mỹ Hảo', 'sean080597');
        self::insert_user_stu('Nguyễn Thị Thanh Hằng', 'sean080597');
        self::insert_user_stu('Lê Đặng Gia Hân', 'sean080597');
        self::insert_user_stu('Trần Bảo Minh Hiền', 'sean080597');
        self::insert_user_stu('Nguyễn Thị Thu Hiền', 'sean080597');
        self::insert_user_stu('Dương Thị Diệu Hiền', 'sean080597');
        self::insert_user_stu('Nguyễn Lê Quỳnh Hoa', 'sean080597');
        self::insert_user_stu('Tiêu Yến Hoa', 'sean080597');
        self::insert_user_stu('Huỳnh Xiếu Hũi', 'sean080597');
        self::insert_user_stu('Đặng Ngô Huỳnh', 'sean080597');
        self::insert_user_stu('Bùi Lan Hương', 'sean080597');
        self::insert_user_stu('Đỗ Thị Hương', 'sean080597');
        self::insert_user_stu('Nguyễn Thị Thiên Hương', 'sean080597');
        self::insert_user_stu('Phạm Mai Hương', 'sean080597');
        self::insert_user_stu('Vỏ Huỳnh Thiên Hương', 'sean080597');
        self::insert_user_stu('Nguyễn Hoàng Kim', 'sean080597');
        self::insert_user_stu('Hồng Trang Nhật Khánh', 'sean080597');
        self::insert_user_stu('Mai Phạm Anh Khoa', 'sean080597');
        self::insert_user_stu('Võ Đăng Khôi', 'sean080597');
        self::insert_user_stu('Đỗ Nguyễn Tùng Lâm', 'sean080597');
        self::insert_user_stu('Phạm Khánh Linh', 'sean080597');
        self::insert_user_stu('Phạm Thị Mỹ Linh', 'sean080597');
        self::insert_user_stu('Lê Thị Kiều Linh', 'sean080597');
        self::insert_user_stu('Đặng Minh Lộc', 'sean080597');
        self::insert_user_stu('Nguyễn Thị Thiên Lý', 'sean080597');
        self::insert_user_stu('Lâm Xuân Mai', 'sean080597');
        self::insert_user_stu('Huỳnh Thị Như Minh', 'sean080597');
        self::insert_user_stu('Trần Thị Thanh Nữ', 'sean080597');
        self::insert_user_stu('Ngô Ngọc Như Ngà', 'sean080597');
        self::insert_user_stu('Phạm Hoàng Ngân', 'sean080597');
        self::insert_user_stu('Nguyễn Thúy Ngân', 'sean080597');
        self::insert_user_stu('Vũ Thị Kim Ngân', 'sean080597');
        self::insert_user_stu('Tôn Nữ Kim Ngân', 'sean080597');
        self::insert_user_stu('Nguyễn Thị Ngân', 'sean080597');
        self::insert_user_stu('Nguyễn Kim Ngôn', 'sean080597');
        self::insert_user_stu('Phan Thị Tuyết Ngân', 'sean080597');
        self::insert_user_stu('Phạm Thị Kim Ngân', 'sean080597');
        self::insert_user_stu('Mai Hồng Ngọc', 'sean080597');
        self::insert_user_stu('Huỳnh Thị Bảo Ngọc', 'sean080597');
        self::insert_user_stu('Trần Duy Nguyên', 'sean080597');
        self::insert_user_stu('Nguyễn Thị Ái Nguyệt', 'sean080597');
        self::insert_user_stu('Phùng Thị Ánh Nguyệt', 'sean080597');
        self::insert_user_stu('Nguyễn Phương Nha', 'sean080597');
        self::insert_user_stu('Đỗ Thị Nhàn', 'sean080597');
        self::insert_user_stu('Nguyễn Phương Nhi', 'sean080597');
        self::insert_user_stu('Huỳnh Hoa Nhi', 'sean080597');
        self::insert_user_stu('Đào Thị Kim Nhi', 'sean080597');
        self::insert_user_stu('Đào Thị Nhung', 'sean080597');
        self::insert_user_stu('Phan Thị Hồng Nhung', 'sean080597');
        self::insert_user_stu('Phạm Minh Như', 'sean080597');
        self::insert_user_stu('Nguyễn Thị Quỳnh Như', 'sean080597');
        self::insert_user_stu('Lê Phạm Huỳnh Như', 'sean080597');
        self::insert_user_stu('Nguyễn Thị Kiều Oanh', 'sean080597');
        self::insert_user_stu('Võ Thị Kiều Oanh', 'sean080597');
        self::insert_user_stu('Đỗ Hạnh Phan', 'sean080597');
        self::insert_user_stu('Nguyễn Tấn Phát', 'sean080597');
        self::insert_user_stu('Nguyễn Vũ Phong', 'sean080597');
        self::insert_user_stu('Đặng Thiên Phúc', 'sean080597');
        self::insert_user_stu('Trần Gia Phúc', 'sean080597');
        self::insert_user_stu('Nguyễn Lê Hồng Phúc', 'sean080597');
        self::insert_user_stu('Nguyễn Ngọc Thiên Phúc', 'sean080597');
        self::insert_user_stu('Vòng Kỷ Phụng', 'sean080597');
        self::insert_user_stu('Ngô Đoàn Thanh Phương', 'sean080597');
        self::insert_user_stu('Mai Thu Phượng', 'sean080597');
        self::insert_user_stu('Đoàn Nhật Quang', 'sean080597');
        self::insert_user_stu('Nguyễn Thị Ái Quy', 'sean080597');
        self::insert_user_stu('Phạm Nguyễn Ngọc Quý', 'sean080597');
        self::insert_user_stu('Trần Lê Mỹ Quỳnh', 'sean080597');
        self::insert_user_stu('Nguyễn Thị Thanh Rạng', 'sean080597');
        self::insert_user_stu('Nguyễn Minh Tài', 'sean080597');
        self::insert_user_stu('Đoàn Minh Tân', 'sean080597');
        self::insert_user_stu('Lê Trần Thảo Tiên', 'sean080597');
        self::insert_user_stu('Nguyễn Thị Cẩm Tiên', 'sean080597');
        self::insert_user_stu('Huỳnh Tuân', 'sean080597');
        self::insert_user_stu('Nguyễn Anh Tuấn', 'sean080597');
        self::insert_user_stu('Nguyễn Ngọc Thanh Tuyền', 'sean080597');
        self::insert_user_stu('Nguyễn Thanh Thanh', 'sean080597');
        self::insert_user_stu('Đặng Hồng Thanh Thanh', 'sean080597');
        self::insert_user_stu('Ngô Ngọc Nguyên Thảo', 'sean080597');
        self::insert_user_stu('Phạm Thị Thu Thảo', 'sean080597');
        self::insert_user_stu('Nguyễn Thị Thảo', 'sean080597');
        self::insert_user_stu('Trần Thanh Thảo', 'sean080597');
        self::insert_user_stu('Nguyễn Thị Hồng Thắm', 'sean080597');
        self::insert_user_stu('Hồ Thị Kim Thu', 'sean080597');
        self::insert_user_stu('Phạm Minh Thuận', 'sean080597');
        self::insert_user_stu('Nguyễn Thành Đạt', 'sean080597');
        self::insert_user_stu('Đào Nguyễn Quỳnh Thy', 'sean080597');
        self::insert_user_stu('Nguyễn Phạm Thùy Trang', 'sean080597');
        self::insert_user_stu('Phùng Nguyễn Đoan Trang', 'sean080597');
        self::insert_user_stu('Nguyễn Thụy Thùy Trang', 'sean080597');
        self::insert_user_stu('Nguyễn Thị Thảo Trang', 'sean080597');
        self::insert_user_stu('Phạm Thị Thùy Trang', 'sean080597');
        self::insert_user_stu('Tôn Nữ Minh Trâm', 'sean080597');
        self::insert_user_stu('Nguyễn Thanh Bảo Trâm', 'sean080597');
        self::insert_user_stu('Phan Thị Hồng Trầm', 'sean080597');
        self::insert_user_stu('Văn Thị Bích Triều', 'sean080597');
        self::insert_user_stu('Ngô Cao Phương Trinh', 'sean080597');
        self::insert_user_stu('Hồ Thanh Trọng', 'sean080597');
        self::insert_user_stu('Huỳnh Thanh Trúc', 'sean080597');
        self::insert_user_stu('Đỗ Thị Thanh Trúc', 'sean080597');
        self::insert_user_stu('Hồ Thủy Trúc', 'sean080597');
        self::insert_user_stu('Nguyễn Sĩ Thủy Trúc', 'sean080597');
        self::insert_user_stu('Nguyễn Thị Kiến Trúc', 'sean080597');
        self::insert_user_stu('Huỳnh Trần Phương Uyên', 'sean080597');
        self::insert_user_stu('Phạm Tường Vân', 'sean080597');
        self::insert_user_stu('Ngô Đặng Tường Vi', 'sean080597');
        self::insert_user_stu('Nguyễn Phạm Lan Vi', 'sean080597');
        self::insert_user_stu('Đặng Ngọc Viên', 'sean080597');
        self::insert_user_stu('Nguyễn Vũ Hiển Vinh', 'sean080597');
        self::insert_user_stu('Trần Thúy Vy', 'sean080597');
        self::insert_user_stu('Trần Lương Mai Xuân', 'sean080597');
        self::insert_user_stu('Đặng Thanh Xuân', 'sean080597');
        self::insert_user_stu('Trần Thị Hải Yến', 'sean080597');
        self::insert_user_stu('Dư Ngọc Diễm My', 'sean080597');
        self::insert_user_stu('Nguyễn Za Ly', 'sean080597');
    }
}
