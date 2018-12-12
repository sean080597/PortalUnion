<?php

use Illuminate\Database\Seeder;
use App\Student;
use App\ClassRoom;
use Carbon\Carbon;
use Faker\Factory as Faker;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function insert_stu($stu_id, $n, $count){
        $arr_classroom = array();
        $all_classrooms = ClassRoom::all();
        foreach($all_classrooms as $key => $classroom){
            $arr_classroom[$key] = $classroom->id;
        }
        $faker = Faker::create();
        DB::table('students')->insert([
            'id' => $stu_id,
            'name' => $n,
            'address' => $faker->address,
            'birthday' => Carbon::createFromTimeStamp($faker->dateTimeBetween('-30 days', '+30 days')->getTimestamp()),
            'class_room_id' => $arr_classroom[rand(0, count($arr_classroom) - 1)],
            'user_id' => $count,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $count++;
    }

    public function run()
    {
        Student::insert([
            [
                'id' => '1511061004',
                'name' => 'Lưu Quốc Cường',
                'address' => '141 D5, phường 25, quận Bình Thạnh, tp Hồ Chí Minh',
                'birthday' => Carbon::create('1997', '05', '08'),
                'class_room_id' => '15dth12',
                'sex' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => '6'
            ],
            [
                'id' => '1511060993',
                'name' => 'Trương Quốc Cẩm',
                'address' => '141 D5, phường 25, quận Bình Thạnh, tp Hồ Chí Minh',
                'birthday' => Carbon::create('1993', '09', '03'),
                'class_room_id' => '15dth12',
                'sex' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'user_id' => '7'
            ],
        ]);
        $count = 8;
        self::insert_stu('1511061043', 'Nguyễn Thanh Đăng', $count++);
        self::insert_stu('1511061278', 'Lê Đặng Phú', $count++);
        //===========================================================================
        self::insert_stu('1511180309', 'Nguyễn Ngọc Trường An', $count++);
        self::insert_stu('1611700101', 'Nguyễn Lê Ngọc Anh', $count++);
        self::insert_stu('1511190557', 'Đoàn Ngọc Tuấn Anh', $count++);
        self::insert_stu('1511270182', 'Nguyễn Thị Vân Anh', $count++);
        self::insert_stu('1411090322', 'Võ Hồng Anh', $count++);
        self::insert_stu('1411180754', 'Ngô Thị Kim Anh', $count++);
        self::insert_stu('1411141336', 'Nguyễn Thị Ngọc Ánh', $count++);
        self::insert_stu('1511700013', 'Ngô Gia Bảo', $count++);
        self::insert_stu('1411141356', 'Nguyễn Hữu Cảnh', $count++);
        self::insert_stu('1511270940', 'Khổng Minh Cường', $count++);
        self::insert_stu('1611702213', 'Trần Thị Minh Châu', $count++);
        self::insert_stu('1411190582', 'Lâm Hạnh Linh Châu', $count++);
        self::insert_stu('1611701348', 'Trương Quỳnh Chi', $count++);
        self::insert_stu('1411190596', 'Đặng Thị Thu Diệu', $count++);
        self::insert_stu('1511270464', 'Trần Hồ Thùy Dung', $count++);
        self::insert_stu('1511270030', 'Nguyễn Quốc Khương Duy', $count++);
        self::insert_stu('1611701113', 'Võ Thị Quỳnh Duyên', $count++);
        self::insert_stu('1611702359', 'Phan Huỳnh Mỹ Duyên', $count++);
        self::insert_stu('1411180807', 'Lê Ngọc Bội Duyên', $count++);
        self::insert_stu('1511141466', 'Phùng Vũ Khánh Duyên', $count++);
        self::insert_stu('1611142370', 'Tô Thùy Duyên', $count++);
        self::insert_stu('1611701846', 'Lê Huyền Thùy Dương', $count++);
        self::insert_stu('1511270965', 'Phan Lệ Thùy Dương', $count++);
        self::insert_stu('1511061029', 'Huỳnh Minh Đại', $count++);
        self::insert_stu('1511100207', 'Dương Thị Hồng Đào', $count++);
        self::insert_stu('1411090199', 'Lâm Thành Đạt', $count++);
        self::insert_stu('1411142271', 'Nguyễn Như Quỳnh Đoan', $count++);
        self::insert_stu('1611270718', 'Trần Minh Đức', $count++);
        self::insert_stu('1511150440', 'Bùi Thị Huỳnh Giao', $count++);
        self::insert_stu('1611701124', 'Hoàng Ngọc Hà', $count++);
        self::insert_stu('1511270812', 'Nguyễn Nhị Hà', $count++);
        self::insert_stu('1511100209', 'Trần Thị Hà', $count++);
        self::insert_stu('1611701713', 'Lương Thị Kiều Hải', $count++);
        self::insert_stu('1511150382', 'Đoàn Hồ Mỹ Hảo', $count++);
        self::insert_stu('1511271018', 'Nguyễn Thị Thanh Hằng', $count++);
        self::insert_stu('1611271143', 'Lê Đặng Gia Hân', $count++);
        self::insert_stu('1611701380', 'Trần Bảo Minh Hiền', $count++);
        self::insert_stu('1511271028', 'Nguyễn Thị Thu Hiền', $count++);
        self::insert_stu('1611201751', 'Dương Thị Diệu Hiền', $count++);
        self::insert_stu('1511270853', 'Nguyễn Lê Quỳnh Hoa', $count++);
        self::insert_stu('1511100217', 'Tiêu Yến Hoa', $count++);
        self::insert_stu('1611700762', 'Huỳnh Xiếu Hũi', $count++);
        self::insert_stu('1611160580', 'Đặng Ngô Huỳnh', $count++);
        self::insert_stu('1511700028', 'Bùi Lan Hương', $count++);
        self::insert_stu('1511271066', 'Đỗ Thị Hương', $count++);
        self::insert_stu('1511160511', 'Nguyễn Thị Thiên Hương', $count++);
        self::insert_stu('1611161208', 'Phạm Mai Hương', $count++);
        self::insert_stu('1411141557', 'Vỏ Huỳnh Thiên Hương', $count++);
        self::insert_stu('1411142452', 'Nguyễn Hoàng Kim', $count++);
        self::insert_stu('1611701404', 'Hồng Trang Nhật Khánh', $count++);
        self::insert_stu('1611702456', 'Mai Phạm Anh Khoa', $count++);
        self::insert_stu('1611700249', 'Võ Đăng Khôi', $count++);
        self::insert_stu('1511110129', 'Đỗ Nguyễn Tùng Lâm', $count++);
        self::insert_stu('1611701416', 'Phạm Khánh Linh', $count++);
        self::insert_stu('1511270067', 'Phạm Thị Mỹ Linh', $count++);
        self::insert_stu('1411110746', 'Lê Thị Kiều Linh', $count++);
        self::insert_stu('1611702296', 'Đặng Minh Lộc', $count++);
        self::insert_stu('1511160534', 'Nguyễn Thị Thiên Lý', $count++);
        self::insert_stu('1611702298', 'Lâm Xuân Mai', $count++);
        self::insert_stu('1611701430', 'Huỳnh Thị Như Minh', $count++);
        self::insert_stu('1411110804', 'Trần Thị Thanh Nữ', $count++);
        self::insert_stu('1611700982', 'Ngô Ngọc Như Ngà', $count++);
        self::insert_stu('1511700016', 'Phạm Hoàng Ngân', $count++);
        self::insert_stu('1511700031', 'Nguyễn Thúy Ngân', $count++);
        self::insert_stu('1511700008', 'Vũ Thị Kim Ngân', $count++);
        self::insert_stu('1411181236', 'Tôn Nữ Kim Ngân', $count++);
        self::insert_stu('1611180972', 'Nguyễn Thị Ngân', $count++);
        self::insert_stu('1511100017', 'Nguyễn Kim Ngôn', $count++);
        self::insert_stu('1511100108', 'Phan Thị Tuyết Ngân', $count++);
        self::insert_stu('1611700985', 'Phạm Thị Kim Ngân', $count++);
        self::insert_stu('1611700325', 'Mai Hồng Ngọc', $count++);
        self::insert_stu('1511270235', 'Huỳnh Thị Bảo Ngọc', $count++);
        self::insert_stu('1511700039', 'Trần Duy Nguyên', $count++);
        self::insert_stu('1611702379', 'Nguyễn Thị Ái Nguyệt', $count++);
        self::insert_stu('1511181225', 'Phùng Thị Ánh Nguyệt', $count++);
        self::insert_stu('1511270090', 'Nguyễn Phương Nha', $count++);
        self::insert_stu('1411110786', 'Đỗ Thị Nhàn', $count++);
        self::insert_stu('1611701213', 'Nguyễn Phương Nhi', $count++);
        self::insert_stu('1411110794', 'Huỳnh Hoa Nhi', $count++);
        self::insert_stu('1511100151', 'Đào Thị Kim Nhi', $count++);
        self::insert_stu('1611700790', 'Đào Thị Nhung', $count++);
        self::insert_stu('1711161775', 'Phan Thị Hồng Nhung', $count++);
        self::insert_stu('1611701221', 'Phạm Minh Như', $count++);
        self::insert_stu('1611700365', 'Nguyễn Thị Quỳnh Như', $count++);
        self::insert_stu('1611701219', 'Lê Phạm Huỳnh Như', $count++);
        self::insert_stu('1611701635', 'Nguyễn Thị Kiều Oanh', $count++);
        self::insert_stu('1411141788', 'Võ Thị Kiều Oanh', $count++);
        self::insert_stu('1611701637', 'Đỗ Hạnh Phan', $count++);
        self::insert_stu('1511142210', 'Nguyễn Tấn Phát', $count++);
        self::insert_stu('1411090070', 'Nguyễn Vũ Phong', $count++);
        self::insert_stu('1611701011', 'Đặng Thiên Phúc', $count++);
        self::insert_stu('1611141064', 'Trần Gia Phúc', $count++);
        self::insert_stu('17200115', 'Nguyễn Lê Hồng Phúc', $count++);
        self::insert_stu('1611110681', 'Nguyễn Ngọc Thiên Phúc', $count++);
        self::insert_stu('1511142221', 'Vòng Kỷ Phụng', $count++);
        self::insert_stu('1611701641', 'Ngô Đoàn Thanh Phương', $count++);
        self::insert_stu('1611700389', 'Mai Thu Phượng', $count++);
        self::insert_stu('1411142675', 'Đoàn Nhật Quang', $count++);
        self::insert_stu('1611701486', 'Nguyễn Thị Ái Quy', $count++);
        self::insert_stu('1611701236', 'Phạm Nguyễn Ngọc Quý', $count++);
        self::insert_stu('1711760395', 'Trần Lê Mỹ Quỳnh', $count++);
        self::insert_stu('1611270799', 'Nguyễn Thị Thanh Rạng', $count++);
        self::insert_stu('1411142711', 'Nguyễn Minh Tài', $count++);
        self::insert_stu('1511142259', 'Đoàn Minh Tân', $count++);
        self::insert_stu('1611701933', 'Lê Trần Thảo Tiên', $count++);
        self::insert_stu('1411141973', 'Nguyễn Thị Cẩm Tiên', $count++);
        self::insert_stu('1611271318', 'Huỳnh Tuân', $count++);
        self::insert_stu('1511100318', 'Nguyễn Anh Tuấn', $count++);
        self::insert_stu('1611141098', 'Nguyễn Ngọc Thanh Tuyền', $count++);
        self::insert_stu('1611701918', 'Nguyễn Thanh Thanh', $count++);
        self::insert_stu('1511100285', 'Đặng Hồng Thanh Thanh', $count++);
        self::insert_stu('1411181071', 'Ngô Ngọc Nguyên Thảo', $count++);
        self::insert_stu('1511180585', 'Phạm Thị Thu Thảo', $count++);
        self::insert_stu('1511150500', 'Nguyễn Thị Thảo', $count++);
        self::insert_stu('1511100291', 'Trần Thanh Thảo', $count++);
        self::insert_stu('1511100118', 'Nguyễn Thị Hồng Thắm', $count++);
        self::insert_stu('1411110860', 'Hồ Thị Kim Thu', $count++);
        self::insert_stu('1511700010', 'Phạm Minh Thuận', $count++);
        self::insert_stu('1611702220', 'Nguyễn Thành Đạt', $count++);
        self::insert_stu('1611701289', 'Đào Nguyễn Quỳnh Thy', $count++);
        self::insert_stu('1611702321', 'Nguyễn Phạm Thùy Trang', $count++);
        self::insert_stu('1511180596', 'Phùng Nguyễn Đoan Trang', $count++);
        self::insert_stu('1511270874', 'Nguyễn Thụy Thùy Trang', $count++);
        self::insert_stu('1411090453', 'Nguyễn Thị Thảo Trang', $count++);
        self::insert_stu('1511100309', 'Phạm Thị Thùy Trang', $count++);
        self::insert_stu('1611702269', 'Tôn Nữ Minh Trâm', $count++);
        self::insert_stu('1411181124', 'Nguyễn Thanh Bảo Trâm', $count++);
        self::insert_stu('1611290412', 'Phan Thị Hồng Trầm', $count++);
        self::insert_stu('1611142126', 'Văn Thị Bích Triều', $count++);
        self::insert_stu('1511100331', 'Ngô Cao Phương Trinh', $count++);
        self::insert_stu('1611180533', 'Hồ Thanh Trọng', $count++);
        self::insert_stu('1611700533', 'Huỳnh Thanh Trúc', $count++);
        self::insert_stu('1611701550', 'Đỗ Thị Thanh Trúc', $count++);
        self::insert_stu('1411210222', 'Hồ Thủy Trúc', $count++);
        self::insert_stu('1611271309', 'Nguyễn Sĩ Thủy Trúc', $count++);
        self::insert_stu('1411090457', 'Nguyễn Thị Kiến Trúc', $count++);
        self::insert_stu('1611701066', 'Huỳnh Trần Phương Uyên', $count++);
        self::insert_stu('1411110927', 'Phạm Tường Vân', $count++);
        self::insert_stu('1511700012', 'Ngô Đặng Tường Vi', $count++);
        self::insert_stu('1611701323', 'Nguyễn Phạm Lan Vi', $count++);
        self::insert_stu('1511190904', 'Đặng Ngọc Viên', $count++);
        self::insert_stu('1511060756', 'Nguyễn Vũ Hiển Vinh', $count++);
        self::insert_stu('1611140146', 'Trần Thúy Vy', $count++);
        self::insert_stu('1611701571', 'Trần Lương Mai Xuân', $count++);
        self::insert_stu('1411181215', 'Đặng Thanh Xuân', $count++);
        self::insert_stu('1511150405', 'Trần Thị Hải Yến', $count++);
        self::insert_stu('1411110766', 'Dư Ngọc Diễm My', $count++);
        self::insert_stu('1611141601', 'Nguyễn Za Ly', $count++);
    }
}
