## Tutorial Kontribusi

Halo, untuk berkontribusi pada project ini diharapkan untuk :
1. Menggunakan Laragon versi terbaru, dan membuka directory Laragon dengan terminal (C:\laragon\www)
2. ```bash
   \\ Jalankan kode ini di terminal Laragon
   git clone https://gitlab.com/upa-tik/proyek-manajemen-magang-upa-tik
   cd proyek-manajemen-magang-upa-tik
   composer install
   php artisan key:generate
   php artisan migrate --seed
   npm install

   php artisan serve
   ```
3. Jika sudah, maka sudah bisa kerja. Jangan lupa untuk membuat branch baru dan kabari kalo mau merge.
4. Untuk membuat branch, buat dulu dari GitLab atau GitHub dengan nama fitur yang ingin di tambah
5. ```bash
   \\ Kode untuk commit dari suatu branch
   git fetch origin
   git switch <nama branch kamu>
   git commit -m "<pesan>"
   git push
   ```