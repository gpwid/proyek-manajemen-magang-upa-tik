# SIMBA — Sistem Informasi Bakat Magang

Singkat: aplikasi manajemen magang (permohonan, peserta, pembimbing, internship, logbook, absensi, admin).  
Dibangun dengan Laravel (PHP), MySQL (WAMP) dan Bootstrap 5.

## Fitur utama
- Autentikasi & peran user (admin, pembimbing, atasan, pemagang)  
- Formulir permohonan dan management instansi  
- Pendaftaran peserta (sinkronisasi dengan permohonan / institusi)  
- Pembuatan internship & relasi peserta ↔ internship  
- Logbook harian dan ekspor (Excel / PDF)  
- Absensi QR / check-in dengan IP/time window checks  
- Panel admin untuk kelola pengguna, instansi, permohonan, peserta

## Persyaratan
- PHP >= 8.x  
- Composer  
- Node.js & NPM (untuk asset)  
- MySQL (WAMP sudah tersedia di lingkungan development Anda)  
- Ekstensi PHP yang umum: mbstring, json, pdo_mysql, fileinfo, openssl, bcmath

## Instalasi (development)
1. Clone repo:
   git clone <repo-url> c:\wamp64\www\proyek-manajemen-magang-upa-tik
2. Masuk direktori:
   cd c:\wamp64\www\proyek-manajemen-magang-upa-tik
3. Install PHP dependencies:
   composer install
4. Salin file environment:
   cp .env.example .env
   - Atur DB_DATABASE, DB_USERNAME, DB_PASSWORD sesuai WAMP
5. Generate key:
   php artisan key:generate
6. Jalankan migration & seeder:
   php artisan migrate --seed
   (atau jika ada data lama, buat migration penyesuaian yang diperlukan)
7. Install dan build assets (opsional dev):
   npm install
   npm run dev
8. Buat symlink storage:
   php artisan storage:link
9. Jalankan server:
   php artisan serve
   atau akses melalui VirtualHost di WAMP

## Seeder penting
- `Database\Seeders\UserSeeder` membuat akun admin default.
- Jika data awal tidak muncul, jalankan:
  php artisan db:seed --class=UserSeeder

## Pengaturan yang sering diperlukan
- Timezone: pastikan `.env` / config/app.php set ke `Asia/Jakarta` bila ingin waktu UTC+7.
- Email: set konfigurasi MAIL_* di `.env` untuk verifikasi / notifikasi.
- Jika upload file tidak bekerja: pastikan form pakai `enctype="multipart/form-data"` dan `php.ini` mengijinkan ukuran file.

## Tips debugging umum
- "Undefined method file" / "Undefined method session" pada IDE: tambahkan PHPDoc di FormRequest, contoh:
  ```
  /**
   * @method \Illuminate\Http\UploadedFile|null file(string $key = null)
   * @method \Illuminate\Session\Store session()
   */
  ```
  (letakkan di atas class FormRequest yang relevan) — hanya untuk Intellisense.
- Jika field model tidak tersimpan (contoh `nisnim` kosong) — pastikan nama kolom ada di `$fillable` atau gunakan `$guarded = []`.
- Jika relasi participants/internship tidak bekerja: pastikan migration pivot (`internship_participant`) ter-migrate dan model punya relasi `belongsToMany`.
- Sidebar panjang/scrolling: atur CSS sidebar (`overflow-y: auto; overflow-x: hidden;`), gunakan `box-sizing: border-box` dan `white-space: nowrap` + `text-overflow: ellipsis` untuk link panjang.
- Setelah ubah blade/config: bersihkan cache view/config:
  php artisan view:clear
  php artisan cache:clear
  php artisan config:clear

## Struktur penting (lokasi file)
- app/Models — model Eloquent (User, Participant, Internship, Permohonan, Logbook)  
- app/Http/Controllers — pengontrol untuk admin / pemagang / auth  
- app/Services — logika bisnis terpisah (ParticipantService, InternshipService)  
- resources/views — Blade templates (admin/, pemagang/, auth/)  
- database/migrations — struktur tabel  
- database/seeders — seed data awal

## Routes & policies
- Routes utama di `routes/web.php` dan `routes/auth.php` (cek middleware role untuk akses)
- Pastikan route `admin.changelog.index` ada jika menampilkan menu changelog

## Kontribusi
- Fork → branch fitur → pull request.  
- Ikuti standar PSR, gunakan migration untuk perubahan DB, sertakan update seeder jika perlu.

## Lisensi
MIT