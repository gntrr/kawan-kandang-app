<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gejala;

class GejalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gejalas = [
            ['kode_gejala' => 'G001', 'nama_gejala' => 'Nafsu makan menurun'],
            ['kode_gejala' => 'G002', 'nama_gejala' => 'Nafas penuh/ megap-megap'],
            ['kode_gejala' => 'G003', 'nama_gejala' => 'Nafas ngorok basah'],
            ['kode_gejala' => 'G004', 'nama_gejala' => 'Bersin-bersin'],
            ['kode_gejala' => 'G005', 'nama_gejala' => 'Batuk'],
            ['kode_gejala' => 'G006', 'nama_gejala' => 'Bulu kusam dan terlihat berkerut'],
            ['kode_gejala' => 'G007', 'nama_gejala' => 'Diarhea'],
            ['kode_gejala' => 'G008', 'nama_gejala' => 'Penurunan produksi telur'],
            ['kode_gejala' => 'G009', 'nama_gejala' => 'Dingin'],
            ['kode_gejala' => 'G010', 'nama_gejala' => 'Tampak kelelahan'],
            ['kode_gejala' => 'G011', 'nama_gejala' => 'Mencret dan feses berwarna kehijau hijauan'],
            ['kode_gejala' => 'G012', 'nama_gejala' => 'Mencret dan feses keputih-putihan'],
            ['kode_gejala' => 'G013', 'nama_gejala' => 'Ayam terlihat pucat'],
            ['kode_gejala' => 'G014', 'nama_gejala' => 'Nampak membiru'],
            ['kode_gejala' => 'G015', 'nama_gejala' => 'Pembengkakan di dalam pial'],
            ['kode_gejala' => 'G016', 'nama_gejala' => 'Jengger terlihat pucat'],
            ['kode_gejala' => 'G017', 'nama_gejala' => 'Mengalami kelumpuhan pada kaki dan sayap'],
            ['kode_gejala' => 'G018', 'nama_gejala' => 'Hidung dan mata mengeluarkan cairan'],
            ['kode_gejala' => 'G019', 'nama_gejala' => 'Terdapat pembengkakan pada kepala'],
            ['kode_gejala' => 'G020', 'nama_gejala' => 'Kepala seperti berputar'],
            ['kode_gejala' => 'G021', 'nama_gejala' => 'Sinus dan mata mengalami pembengkakan'],
            ['kode_gejala' => 'G022', 'nama_gejala' => 'Perut terlihat membesar'],
            ['kode_gejala' => 'G023', 'nama_gejala' => 'Sayap terlihat menggantung'],
            ['kode_gejala' => 'G024', 'nama_gejala' => 'Kotoran putih menempel di sekitar anus'],
            ['kode_gejala' => 'G025', 'nama_gejala' => 'Ayam mengalami mati mendadak'],
            ['kode_gejala' => 'G026', 'nama_gejala' => 'Telur terasa kasar'],
            ['kode_gejala' => 'G027', 'nama_gejala' => 'Hasil telur encer'],
            ['kode_gejala' => 'G028', 'nama_gejala' => 'Kotoran kuning kehijauan'],
            ['kode_gejala' => 'G029', 'nama_gejala' => 'Ada pembengkakan di area fasial dan sekitar mata'],
            ['kode_gejala' => 'G030', 'nama_gejala' => 'Feses dengan darah'],
            ['kode_gejala' => 'G031', 'nama_gejala' => 'Terlihat ayam bergerak di sudut kandang dengan bergelombol'],
            ['kode_gejala' => 'G032', 'nama_gejala' => 'Ayam mematuk area kloaka'],
            ['kode_gejala' => 'G033', 'nama_gejala' => 'Sangat jelas bahwa kerabang telur pucat'],
            ['kode_gejala' => 'G034', 'nama_gejala' => 'Telur tidak sebesar biasanya'],
            ['kode_gejala' => 'G035', 'nama_gejala' => 'Tembolok yang lumpuh'],
            ['kode_gejala' => 'G036', 'nama_gejala' => 'Sambil menjulurkan lehernya, ayam bernafas dengan mulut'],
            ['kode_gejala' => 'G037', 'nama_gejala' => 'Batuk melepaskan darah'],
            ['kode_gejala' => 'G038', 'nama_gejala' => 'Saat tidur, letakkan paruhnya di lantai'],
            ['kode_gejala' => 'G039', 'nama_gejala' => 'Membungkuk saat duduk'],
            ['kode_gejala' => 'G040', 'nama_gejala' => 'Bulu berdiri sepertinya mengantuk'],
            ['kode_gejala' => 'G041', 'nama_gejala' => 'Ayam tampak lebih kurus'],
            ['kode_gejala' => 'G042', 'nama_gejala' => 'Rongga mulut mengandung lendir dan darah'],
            ['kode_gejala' => 'G043', 'nama_gejala' => 'Kaki ayam pincang'],
            ['kode_gejala' => 'G044', 'nama_gejala' => 'Tremors di kepala dan leher'],
        ];

        foreach ($gejalas as $gejala) {
            Gejala::create($gejala);
        }
    }
}
