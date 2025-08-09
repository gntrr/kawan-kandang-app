
# Sistem Deteksi Dini Penyakit Pada Ayam Broiler

## Deskripsi
Sistem Pendukung Keputusan (SPK) Deteksi Dini Penyakit Pada Ayam Broiler adalah aplikasi berbasis web yang dirancang untuk membantu peternak dalam mendiagnosis penyakit pada ayam broiler berdasarkan gejala-gejala yang diamati. Dengan pendekatan algoritma forward chaining, sistem ini memberikan hasil diagnosis yang akurat dan rekomendasi penanganan yang tepat.

## Fitur Utama

### 1. Manajemen Gejala
- Menambah, mengedit, dan menghapus data gejala
- Setiap gejala memiliki kode unik untuk identifikasi cepat
- Tampilan responsif dengan sistem pengelompokan yang terstruktur

### 2. Manajemen Penyakit
- Menambah, mengedit, dan menghapus data penyakit
- Dilengkapi dengan deskripsi penyakit dan solusi penanganan
- Detail penyakit yang komprehensif untuk referensi

### 3. Manajemen Rule
- Pembuatan aturan (rule) dengan pendekatan IF-THEN
- Menghubungkan gejala-gejala dengan kemungkinan penyakit
- Basis pengetahuan yang dapat diperluas dan disesuaikan

### 4. Sistem Diagnosis
- Antarmuka diagnosis yang mudah digunakan
- Pemilihan gejala yang dinamis dan intuitif
- Hasil diagnosis dengan tingkat keyakinan (confidence level)
- Analisis gejala dominan saat tidak ada rule yang 100% cocok

### 5. Riwayat Diagnosis
- Penyimpanan riwayat diagnosis untuk referensi
- Pelacakan hasil diagnosis berdasarkan tanggal
- Detail lengkap gejala yang dipilih dan hasil diagnosis

### 6. Antarmuka Responsif
- Tampilan yang menyesuaikan dengan berbagai ukuran layar
- Desain modern dengan tema biru-ungu yang menarik
- Navigasi yang intuitif untuk pengalaman pengguna yang optimal

## Alur Kerja Sistem

1. **Pengumpulan Data**
   - Admin menginput data gejala penyakit
   - Admin menginput data penyakit beserta solusi
   - Admin membuat aturan (rule) yang menghubungkan gejala dengan penyakit

2. **Proses Diagnosis**
   - Pengguna memilih gejala-gejala yang teramati pada ayam
   - Sistem melakukan pencocokan gejala dengan rule yang ada
   - Sistem menerapkan metode forward chaining untuk menentukan penyakit

3. **Hasil Diagnosis**
   - Jika ditemukan rule yang 100% cocok, penyakit langsung teridentifikasi
   - Jika tidak ada rule yang 100% cocok, sistem melakukan analisis gejala dominan
   - Sistem menampilkan hasil diagnosis dengan tingkat keyakinan
   - Sistem memberikan rekomendasi penanganan berdasarkan penyakit yang terdiagnosis

4. **Penyimpanan Data**
   - Hasil diagnosis disimpan dalam database
   - Dapat diakses kembali melalui menu riwayat diagnosis

## Requirements

### Sistem Operasi
- Windows / Linux / macOS

### Software
- PHP 8.0 atau lebih tinggi
- MySQL 5.7 atau lebih tinggi
- Composer (dependency manager untuk PHP)
- Web server (Apache/Nginx)

### Ekstensi PHP
- BCMath
- Ctype
- Fileinfo
- JSON
- Mbstring
- OpenSSL
- PDO
- Tokenizer
- XML

## Panduan Instalasi

### 1. Persiapan
- Pastikan komputer telah memiliki PHP, MySQL, dan Composer yang terinstal
- Siapkan database MySQL kosong untuk aplikasi
- Ekstrak source code ke direktori web server Anda

### 2. Konfigurasi Database
1. Buka file `.env.example` dan simpan salinannya sebagai `.env`
2. Edit file `.env` dan sesuaikan parameter database:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database
   DB_USERNAME=username_database
   DB_PASSWORD=password_database
   ```

### 3. Instalasi Dependensi
Buka terminal/command prompt, navigasikan ke direktori aplikasi dan jalankan:
```
composer install
```

### 4. Generate App Key
Jalankan perintah berikut untuk menghasilkan application key:
```
php artisan key:generate
```

### 5. Migrasi Database
Jalankan migrasi untuk membuat struktur tabel yang diperlukan:
```
php artisan migrate
```

### 6. Seeder (Opsional)
Jika ingin mengisi database dengan data awal, jalankan:
```
php artisan db:seed
```

### 7. Storage Link
Buat symbolic link untuk storage:
```
php artisan storage:link
```

### 8. Menjalankan Aplikasi
- Untuk lingkungan pengembangan, jalankan:
  ```
  php artisan serve
  ```
- Akses aplikasi melalui browser: `http://localhost:8000`
- Untuk lingkungan produksi, konfigurasikan web server Anda untuk mengarah ke direktori `public` aplikasi

### 9. Login Admin
- Gunakan kredensial default (jika menggunakan seeder):
  - Email: admin@example.com
  - Password: password
- Segera ubah password setelah login pertama

## Kesimpulan
SPK Deteksi Dini Penyakit Pada Ayam Broiler menyediakan solusi komprehensif untuk membantu peternak mengidentifikasi penyakit pada ayam broiler secara dini. Dengan antarmuka yang responsif dan sistem aturan yang dapat disesuaikan, aplikasi ini dapat menjadi alat yang berharga dalam pengelolaan kesehatan ayam broiler.