<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Penyakit;

class PenyakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penyakits = [
            [
                'kode_penyakit' => 'P001', 
                'nama_penyakit' => 'Berak Kapur (Pullorum Disease)', 
                'solusi' => 'Dosis Master Coliprim: 1 gram/liter air selama 3-4 hari. Setelah itu, berikan Master Vit-Stress selama 3-4 hari untuk proses penyembuhan.'
            ],
            [
                'kode_penyakit' => 'P002', 
                'nama_penyakit' => 'Kolera Ayam (Fowl Cholera)', 
                'solusi' => 'Master Kolericid: 1 gram/liter air selama 3-4 hari. Master Vit-Stress: 1 gram/3 liter air untuk proses penyembuhan.'
            ],
            [
                'kode_penyakit' => 'P003', 
                'nama_penyakit' => 'Flu Burung (Avian Influenza)', 
                'solusi' => 'Pemusnahan ayam yang terkena penyakit flu burung dengan cara dibakar dan bangkainya dikubur.'
            ],
            [
                'kode_penyakit' => 'P004', 
                'nama_penyakit' => 'Tetelo (Newcastle Disease)', 
                'solusi' => 'Tingkatkan kekebalan ayam dengan vaksinasi. Hari ke-2: Vaksin ND melalui tetes mata. Vaksinasi berikutnya melalui suntikan di otot dada.'
            ],
            [
                'kode_penyakit' => 'P005', 
                'nama_penyakit' => 'Tipus Ayam (Fowl Typhoid)', 
                'solusi' => 'Neo Terramycin: 2 sendok teh/3,8 liter air selama 3-4 hari berturut-turut.'
            ],
            [
                'kode_penyakit' => 'P006', 
                'nama_penyakit' => 'Berak Darah (Coccidiosis)', 
                'solusi' => 'Master Coliprim: 1 gram/liter air selama 3-4 hari. Setelah selesai, konsumsi Master Vit-Stress: 1 gram/3 liter air selama 3-4 hari.'
            ],
            [
                'kode_penyakit' => 'P007', 
                'nama_penyakit' => 'Gumboro (Infectious Bursal Disease)', 
                'solusi' => 'Master Vit-Stress: 1 gram/liter air untuk meningkatkan kondisi tubuh ayam.'
            ],
            [
                'kode_penyakit' => 'P008', 
                'nama_penyakit' => 'Salesma Ayam (Coryza Menular)', 
                'solusi' => 'Master Cyprosyn-Plus: 1 gram/liter air yang selama 3-4 hari. Tambahkan Master Vit-Stress: 1 gram/3 liter air untuk membantu proses pengobatan.'
            ],
            [
                'kode_penyakit' => 'P009', 
                'nama_penyakit' => 'Batuk Ayam Menahun (Infectious Bronchitis)', 
                'solusi' => 'Master Vit-Stress: 1 gram/liter air untuk memperbaiki kondisi tubuh ayam.'
            ],
            [
                'kode_penyakit' => 'P010', 
                'nama_penyakit' => 'Busung Ayam (Lymphoid Leukosis)', 
                'solusi' => 'Disarankan untuk segera disingkirkan atau dimusnahkan dengan cara dibakar, kemudian dikubur.'
            ],
            [
                'kode_penyakit' => 'P011', 
                'nama_penyakit' => 'Batuk Darah (Infectious Laryngo Tracheitis)', 
                'solusi' => 'Meskipun tidak ada obat, untuk memperbaiki kondisi tubuh, berikan Master Vit-Stress: 1 gram/liter air.'
            ],
            [
                'kode_penyakit' => 'P012', 
                'nama_penyakit' => 'Mareks (Mareks Disease)', 
                'solusi' => 'Tidak ada obat. Disarankan untuk segera dibuang dan dimusnahkan dengan cara dibakar, kemudian dikubur.'
            ],
            [
                'kode_penyakit' => 'P013', 
                'nama_penyakit' => 'Produksi Telur (Egg Drop Syndrome 76/EDS 76)', 
                'solusi' => 'Meskipun tidak ada obat, pemberian vitamin dapat membantu kondisi tubuh.'
            ],
            [
                'kode_penyakit' => 'P014', 
                'nama_penyakit' => 'Avian Encephalomyelitis (AE)', 
                'solusi' => 'Pencegahan dengan vaksin AE aktif, seperti AE Poxine, beberapa minggu sebelum masa produksi telur. Vaksinasi mencegah penularan dengan memberikan antibodi maternal ke DOC.'
            ],
            [
                'kode_penyakit' => 'P015', 
                'nama_penyakit' => 'Chronic Respiratory Disease (CRD)', 
                'solusi' => 'Antibiotik seperti Tylosin atau Doxycycline. Tambahkan suplemen vitamin A, D, dan E untuk meningkatkan daya tahan tubuh ayam.'
            ],
        ];

        foreach ($penyakits as $penyakit) {
            Penyakit::create($penyakit);
        }
    }
}
