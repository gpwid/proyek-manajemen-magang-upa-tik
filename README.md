## Tutorial Kontribusi

### PASTIKAN UNTUK MEMBUAT BRANCH DAN DAN REQUEST MERGE JIKA SUDAH"

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
4. Untuk membuat branch, buat dulu dari GitLab atau GitHub dengan nama fitur yang ingin di tambah. Bisa dari GitLab nya, atau lewat terminal :
   ```bash
   git switch main
   git pull                 # sinkron dengan remote
   git switch -c feat/nama-fitur   # contoh: feat/user-auth
   # ...koding...
   git add .
   git commit -m "feat: deskripsi singkat perubahan"
   git push -u origin feat/nama-fitur   # -u: set upstream (sekali saja)
   ```
5. Atau jika sudah ada branch,
   ```bash
   git fetch origin
   git switch <nama branch kamu>
   git commit -m "Menambahkan fitur bla bla bla"
   git push

   ```

6. Untuk buat Merge Request (MR) ke main, Checklist sebelum minta review:
   - Sinkron dulu dengan main:

   ```bash
   git fetch origin
   git rebase origin/main   # atau git merge origin/main
   ```
   - Tidak ada file terlarang di commit (.env, vendor/, node_modules/, dump .sql).

   - Migration & seeder sudah jalan di lokal (php artisan migrate --seed).

   - Kode sudah dirapikan (pint) dan test penting lulus (php artisan test).

   - MR kecil & fokus (lebih mudah direview).