<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\User;

class ClassRoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function insert_class($id, $faculty_id){
        DB::table('class_rooms')->insert([
            'id' => $id,
            'faculty_id' => $faculty_id,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }

    public function run()
    {
        //DTH
        self::insert_class('15DTH03', 'DTH');
        self::insert_class('15DTH04', 'DTH');
        self::insert_class('15DTH05', 'DTH');
        self::insert_class('15DTH06', 'DTH');
        self::insert_class('15DTH07', 'DTH');
        self::insert_class('15DTH09', 'DTH');
        self::insert_class('15DTH11', 'DTH');
        self::insert_class('15DTH12', 'DTH');
        self::insert_class('15DTH13', 'DTH');
        self::insert_class('15DTH14', 'DTH');

        self::insert_class('16CTHA1', 'DTH');
        self::insert_class('16DTHA1', 'DTH');
        self::insert_class('16DTHA2', 'DTH');
        self::insert_class('16DTHA3', 'DTH');
        self::insert_class('16DTHB1', 'DTH');
        self::insert_class('16DTHB3', 'DTH');
        self::insert_class('16DTHB4', 'DTH');
        self::insert_class('16DTHB5', 'DTH');
        self::insert_class('16DTHB6', 'DTH');
        self::insert_class('16DTHC1', 'DTH');
        self::insert_class('16DTHC2', 'DTH');
        self::insert_class('16DTHC6', 'DTH');
        self::insert_class('16DTHC7', 'DTH');

        self::insert_class('17DATA1', 'DTH');//DAT
        self::insert_class('17DTHA1', 'DTH');
        self::insert_class('17DTHA2', 'DTH');
        self::insert_class('17DTHA3', 'DTH');
        self::insert_class('17DTHA4', 'DTH');
        self::insert_class('17DTHA5', 'DTH');
        self::insert_class('17DTHA6', 'DTH');
        self::insert_class('17DTHB1', 'DTH');
        self::insert_class('17DTHB2', 'DTH');
        self::insert_class('17DTHB3', 'DTH');
        self::insert_class('17DTHB4', 'DTH');
        self::insert_class('17DTHB5', 'DTH');
        self::insert_class('17DTHC1', 'DTH');
        self::insert_class('17DTHC2', 'DTH');
        self::insert_class('17DTHC3', 'DTH');
        self::insert_class('17DTHC4', 'DTH');
        self::insert_class('17DTHC5', 'DTH');
        self::insert_class('17DTHC6', 'DTH');
        self::insert_class('17DTHD1', 'DTH');
        self::insert_class('17DTHD2', 'DTH');
        self::insert_class('17DTHD3', 'DTH');

        self::insert_class('18DATA1', 'DTH');//DAT
        self::insert_class('18DTHA1', 'DTH');
        self::insert_class('18DTHA2', 'DTH');
        self::insert_class('18DTHA3', 'DTH');
        self::insert_class('18DTHA4', 'DTH');
        self::insert_class('18DTHA5', 'DTH');
        self::insert_class('18DTHA6', 'DTH');
        self::insert_class('18DTHB1', 'DTH');
        self::insert_class('18DTHB2', 'DTH');
        self::insert_class('18DTHB3', 'DTH');
        self::insert_class('18DTHB4', 'DTH');
        self::insert_class('18DTHB5', 'DTH');
        self::insert_class('18DTHC1', 'DTH');
        self::insert_class('18DTHC2', 'DTH');
        self::insert_class('18DTHC3', 'DTH');
        self::insert_class('18DTHC4', 'DTH');
        self::insert_class('18DTHC5', 'DTH');
        self::insert_class('18DTHC6', 'DTH');
        self::insert_class('18DTHD1', 'DTH');
        self::insert_class('18DTHD2', 'DTH');
        self::insert_class('18DTHD3', 'DTH');
        self::insert_class('18DTHD4', 'DTH');
        self::insert_class('18DTHD5', 'DTH');
        self::insert_class('18DTHD6', 'DTH');
        self::insert_class('18DTHE1', 'DTH');
        self::insert_class('18DTHE2', 'DTH');
        self::insert_class('18DTHE3', 'DTH');

        //DDU
        self::insert_class('16DDUA1', 'DDU');
        self::insert_class('16DDUA2', 'DDU');
        self::insert_class('16DDUA3', 'DDU');
        self::insert_class('16DDUA4', 'DDU');
        self::insert_class('16DDUA5', 'DDU');
        self::insert_class('16DDUA6', 'DDU');
        self::insert_class('16DDUB1', 'DDU');
        self::insert_class('16DDUB2', 'DDU');
        self::insert_class('16DDUB3', 'DDU');
        self::insert_class('16DDUB4', 'DDU');
        self::insert_class('16DDUB5', 'DDU');
        self::insert_class('16DDUB6', 'DDU');
        self::insert_class('16DDUC1', 'DDU');
        self::insert_class('16DDUC2', 'DDU');
        self::insert_class('16DDUC3', 'DDU');
        self::insert_class('16DDUC4', 'DDU');
        self::insert_class('16DDUC5', 'DDU');
        self::insert_class('16DDUC6', 'DDU');
        self::insert_class('16DDUD1', 'DDU');
        self::insert_class('16DDUD2', 'DDU');
        self::insert_class('16DDUD3', 'DDU');
        self::insert_class('16DDUD4', 'DDU');
        self::insert_class('16DDUD5', 'DDU');
        self::insert_class('16DDUD6', 'DDU');
        //DKT
        self::insert_class('16DKTA1', 'DKT');
        self::insert_class('16DKTA2', 'DKT');
        self::insert_class('16DKTA3', 'DKT');
        self::insert_class('16DKTA4', 'DKT');
        self::insert_class('16DKTA5', 'DKT');
        self::insert_class('16DKTA6', 'DKT');
        self::insert_class('16DKTB1', 'DKT');
        self::insert_class('16DKTB2', 'DKT');
        self::insert_class('16DKTB3', 'DKT');
        self::insert_class('16DKTB4', 'DKT');
        self::insert_class('16DKTB5', 'DKT');
        self::insert_class('16DKTB6', 'DKT');
        self::insert_class('16DKTC1', 'DKT');
        self::insert_class('16DKTC2', 'DKT');
        self::insert_class('16DKTC3', 'DKT');
        self::insert_class('16DKTC4', 'DKT');
        self::insert_class('16DKTC5', 'DKT');
        self::insert_class('16DKTC6', 'DKT');
        self::insert_class('16DKTD1', 'DKT');
        self::insert_class('16DKTD2', 'DKT');
        self::insert_class('16DKTD3', 'DKT');
        self::insert_class('16DKTD4', 'DKT');
        self::insert_class('16DKTD5', 'DKT');
        self::insert_class('16DKTD6', 'DKT');
        //DQT
        self::insert_class('16DQTA1', 'DQT');
        self::insert_class('16DQTA2', 'DQT');
        self::insert_class('16DQTA3', 'DQT');
        self::insert_class('16DQTA4', 'DQT');
        self::insert_class('16DQTA5', 'DQT');
        self::insert_class('16DQTA6', 'DQT');
        self::insert_class('16DQTB1', 'DQT');
        self::insert_class('16DQTB2', 'DQT');
        self::insert_class('16DQTB3', 'DQT');
        self::insert_class('16DQTB4', 'DQT');
        self::insert_class('16DQTB5', 'DQT');
        self::insert_class('16DQTB6', 'DQT');
        self::insert_class('16DQTC1', 'DQT');
        self::insert_class('16DQTC2', 'DQT');
        self::insert_class('16DQTC3', 'DQT');
        self::insert_class('16DQTC4', 'DQT');
        self::insert_class('16DQTC5', 'DQT');
        self::insert_class('16DQTC6', 'DQT');
        self::insert_class('16DQTD1', 'DQT');
        self::insert_class('16DQTD2', 'DQT');
        self::insert_class('16DQTD3', 'DQT');
        self::insert_class('16DQTD4', 'DQT');
        self::insert_class('16DQTD5', 'DQT');
        self::insert_class('16DQTD6', 'DQT');
        //DXD
        self::insert_class('16DXDA1', 'DXD');
        self::insert_class('16DXDA2', 'DXD');
        self::insert_class('16DXDA3', 'DXD');
        self::insert_class('16DXDA4', 'DXD');
        self::insert_class('16DXDA5', 'DXD');
        self::insert_class('16DXDA6', 'DXD');
        self::insert_class('16DXDB1', 'DXD');
        self::insert_class('16DXDB2', 'DXD');
        self::insert_class('16DXDB3', 'DXD');
        self::insert_class('16DXDB4', 'DXD');
        self::insert_class('16DXDB5', 'DXD');
        self::insert_class('16DXDB6', 'DXD');
        self::insert_class('16DXDC1', 'DXD');
        self::insert_class('16DXDC2', 'DXD');
        self::insert_class('16DXDC3', 'DXD');
        self::insert_class('16DXDC4', 'DXD');
        self::insert_class('16DXDC5', 'DXD');
        self::insert_class('16DXDC6', 'DXD');
        self::insert_class('16DXDD1', 'DXD');
        self::insert_class('16DXDD2', 'DXD');
        self::insert_class('16DXDD3', 'DXD');
        self::insert_class('16DXDD4', 'DXD');
        self::insert_class('16DXDD5', 'DXD');
        self::insert_class('16DXDD6', 'DXD');
        //DLU
        self::insert_class('16DLUA1', 'DLU');
        self::insert_class('16DLUA2', 'DLU');
        self::insert_class('16DLUA3', 'DLU');
        self::insert_class('16DLUA4', 'DLU');
        self::insert_class('16DLUA5', 'DLU');
        self::insert_class('16DLUA6', 'DLU');
        self::insert_class('16DLUB1', 'DLU');
        self::insert_class('16DLUB2', 'DLU');
        self::insert_class('16DLUB3', 'DLU');
        self::insert_class('16DLUB4', 'DLU');
        self::insert_class('16DLUB5', 'DLU');
        self::insert_class('16DLUB6', 'DLU');
        self::insert_class('16DLUC1', 'DLU');
        self::insert_class('16DLUC2', 'DLU');
        self::insert_class('16DLUC3', 'DLU');
        self::insert_class('16DLUC4', 'DLU');
        self::insert_class('16DLUC5', 'DLU');
        self::insert_class('16DLUC6', 'DLU');
        self::insert_class('16DLUD1', 'DLU');
        self::insert_class('16DLUD2', 'DLU');
        self::insert_class('16DLUD3', 'DLU');
        self::insert_class('16DLUD4', 'DLU');
        self::insert_class('16DLUD5', 'DLU');
        self::insert_class('16DLUD6', 'DLU');
        //DKS
        self::insert_class('16DKSA1', 'DKS');
        self::insert_class('16DKSA2', 'DKS');
        self::insert_class('16DKSA3', 'DKS');
        self::insert_class('16DKSA4', 'DKS');
        self::insert_class('16DKSA5', 'DKS');
        self::insert_class('16DKSA6', 'DKS');
        self::insert_class('16DKSB1', 'DKS');
        self::insert_class('16DKSB2', 'DKS');
        self::insert_class('16DKSB3', 'DKS');
        self::insert_class('16DKSB4', 'DKS');
        self::insert_class('16DKSB5', 'DKS');
        self::insert_class('16DKSB6', 'DKS');
        self::insert_class('16DKSC1', 'DKS');
        self::insert_class('16DKSC2', 'DKS');
        self::insert_class('16DKSC3', 'DKS');
        self::insert_class('16DKSC4', 'DKS');
        self::insert_class('16DKSC5', 'DKS');
        self::insert_class('16DKSC6', 'DKS');
        self::insert_class('16DKSD1', 'DKS');
        self::insert_class('16DKSD2', 'DKS');
        self::insert_class('16DKSD3', 'DKS');
        self::insert_class('16DKSD4', 'DKS');
        self::insert_class('16DKSD5', 'DKS');
        self::insert_class('16DKSD6', 'DKS');
        //DLH
        self::insert_class('16DLHA1', 'DLH');
        self::insert_class('16DLHA2', 'DLH');
        self::insert_class('16DLHA3', 'DLH');
        self::insert_class('16DLHA4', 'DLH');
        self::insert_class('16DLHA5', 'DLH');
        self::insert_class('16DLHA6', 'DLH');
        self::insert_class('16DLHB1', 'DLH');
        self::insert_class('16DLHB2', 'DLH');
        self::insert_class('16DLHB3', 'DLH');
        self::insert_class('16DLHB4', 'DLH');
        self::insert_class('16DLHB5', 'DLH');
        self::insert_class('16DLHB6', 'DLH');
        self::insert_class('16DLHC1', 'DLH');
        self::insert_class('16DLHC2', 'DLH');
        self::insert_class('16DLHC3', 'DLH');
        self::insert_class('16DLHC4', 'DLH');
        self::insert_class('16DLHC5', 'DLH');
        self::insert_class('16DLHC6', 'DLH');
        self::insert_class('16DLHD1', 'DLH');
        self::insert_class('16DLHD2', 'DLH');
        self::insert_class('16DLHD3', 'DLH');
        self::insert_class('16DLHD4', 'DLH');
        self::insert_class('16DLHD5', 'DLH');
        self::insert_class('16DLHD6', 'DLH');
        //DNH
        self::insert_class('16DNHA1', 'DNH');
        self::insert_class('16DNHA2', 'DNH');
        self::insert_class('16DNHA3', 'DNH');
        self::insert_class('16DNHA4', 'DNH');
        self::insert_class('16DNHA5', 'DNH');
        self::insert_class('16DNHA6', 'DNH');
        self::insert_class('16DNHB1', 'DNH');
        self::insert_class('16DNHB2', 'DNH');
        self::insert_class('16DNHB3', 'DNH');
        self::insert_class('16DNHB4', 'DNH');
        self::insert_class('16DNHB5', 'DNH');
        self::insert_class('16DNHB6', 'DNH');
        self::insert_class('16DNHC1', 'DNH');
        self::insert_class('16DNHC2', 'DNH');
        self::insert_class('16DNHC3', 'DNH');
        self::insert_class('16DNHC4', 'DNH');
        self::insert_class('16DNHC5', 'DNH');
        self::insert_class('16DNHC6', 'DNH');
        self::insert_class('16DNHD1', 'DNH');
        self::insert_class('16DNHD2', 'DNH');
        self::insert_class('16DNHD3', 'DNH');
        self::insert_class('16DNHD4', 'DNH');
        self::insert_class('16DNHD5', 'DNH');
        self::insert_class('16DNHD6', 'DNH');
        //DTA
        self::insert_class('16DTAA1', 'DTA');
        self::insert_class('16DTAA2', 'DTA');
        self::insert_class('16DTAA3', 'DTA');
        self::insert_class('16DTAA4', 'DTA');
        self::insert_class('16DTAA5', 'DTA');
        self::insert_class('16DTAA6', 'DTA');
        self::insert_class('16DTAB1', 'DTA');
        self::insert_class('16DTAB2', 'DTA');
        self::insert_class('16DTAB3', 'DTA');
        self::insert_class('16DTAB4', 'DTA');
        self::insert_class('16DTAB5', 'DTA');
        self::insert_class('16DTAB6', 'DTA');
        self::insert_class('16DTAC1', 'DTA');
        self::insert_class('16DTAC2', 'DTA');
        self::insert_class('16DTAC3', 'DTA');
        self::insert_class('16DTAC4', 'DTA');
        self::insert_class('16DTAC5', 'DTA');
        self::insert_class('16DTAC6', 'DTA');
        self::insert_class('16DTAD1', 'DTA');
        self::insert_class('16DTAD2', 'DTA');
        self::insert_class('16DTAD3', 'DTA');
        self::insert_class('16DTAD4', 'DTA');
        self::insert_class('16DTAD5', 'DTA');
        self::insert_class('16DTAD6', 'DTA');
    }
}
