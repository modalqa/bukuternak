# Panduan Deploy BukuTernak di Shared Hosting (cPanel)

Stack: **Laravel 13 + MySQL + PHP 8.2 + Shared Hosting cPanel**

> Panduan ini khusus untuk shared hosting berbasis cPanel.
> Untuk deploy di VPS, lihat [DEPLOY.md](DEPLOY.md).

---

## Prasyarat

- Shared hosting dengan **PHP 8.1+** (disarankan PHP 8.2)
- MySQL tersedia di cPanel
- Akses **File Manager** atau FTP
- Akses **SSH Terminal** di cPanel *(lebih mudah, sangat disarankan)*
- Domain sudah aktif dan diarahkan ke hosting

### Cek versi PHP di cPanel
Masuk cPanel → **Select PHP Version** → pastikan pilih **PHP 8.2**

Aktifkan ekstensi berikut:
- `pdo_mysql`
- `mbstring`
- `openssl`
- `tokenizer`
- `xml`
- `fileinfo`
- `bcmath`
- `curl`
- `zip`

---

## Struktur Folder di Hosting

Shared hosting biasanya punya struktur:

```
/home/username/
├── public_html/        ← folder yang diakses publik (root domain)
├── buku-ternak/        ← kita taruh kode Laravel di sini (di luar public_html)
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── resources/
│   ├── routes/
│   ├── storage/
│   ├── vendor/
│   ├── .env
│   └── ...
```

> **Kenapa di luar `public_html`?**
> Supaya file sensitif (`.env`, kode PHP, database config) tidak bisa diakses langsung dari browser. Hanya folder `public/` Laravel yang perlu diekspos.

---

## Langkah 1 — Buat Database MySQL

1. Login ke **cPanel**
2. Buka **MySQL Databases**
3. Buat database baru, contoh: `username_buku_ternak`
4. Buat user MySQL baru, contoh: `username_ternak` dengan password kuat
5. Tambahkan user ke database → centang **All Privileges**
6. Catat: nama database, username, password

---

## Langkah 2 — Upload Kode Project

### Cara A — Via SSH (direkomendasikan)

Masuk ke cPanel → **Terminal** (atau SSH dari komputer lokal):

```bash
ssh username@domain.com
```

```bash
cd /home/username

# Clone project dari GitHub
git clone https://github.com/USERNAME/buku-ternak-laravel.git buku-ternak
cd buku-ternak

# Install Composer dependencies (tanpa dev)
composer install --no-dev --optimize-autoloader
```

Jika Composer belum tersedia:

```bash
curl -sS https://getcomposer.org/installer | php8.2
php8.2 composer.phar install --no-dev --optimize-autoloader
```

---

### Cara B — Via File Manager / FTP

1. Di komputer lokal, jalankan:
   ```bash
   composer install --no-dev --optimize-autoloader
   ```
2. Zip seluruh folder project (termasuk `vendor/`)
3. Upload via **cPanel File Manager** ke `/home/username/`
4. Ekstrak di sana, rename foldernya menjadi `buku-ternak`

---

## Langkah 3 — Konfigurasi .env

Di terminal SSH:

```bash
cd /home/username/buku-ternak
cp .env.example .env
nano .env
```

Isi konfigurasi berikut:

```env
APP_NAME=BukuTernak
APP_ENV=production
APP_DEBUG=false
APP_URL=https://domain.com

APP_LOCALE=id
APP_FALLBACK_LOCALE=id

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=username_buku_ternak
DB_USERNAME=username_ternak
DB_PASSWORD=password_kuat_di_sini

SESSION_DRIVER=database
SESSION_LIFETIME=120

LOG_CHANNEL=stack
LOG_LEVEL=error
```

> Nama database dan user biasanya diawali `username_` di shared hosting.

Generate APP_KEY:

```bash
php8.2 artisan key:generate
```

---

## Langkah 4 — Arahkan public_html ke Folder public Laravel

Ada dua cara:

### Cara A — Symlink (paling bersih)

```bash
# Hapus isi public_html yang lama (backup dulu jika perlu)
rm -rf /home/username/public_html

# Buat symlink
ln -s /home/username/buku-ternak/public /home/username/public_html
```

### Cara B — Salin file dan edit index.php (jika symlink tidak bisa)

```bash
# Salin semua isi public/ ke public_html/
cp -r /home/username/buku-ternak/public/. /home/username/public_html/
```

Edit `/home/username/public_html/index.php`, ubah kedua path:

```php
// SEBELUM:
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

// SESUDAH:
require __DIR__.'/../buku-ternak/vendor/autoload.php';
$app = require_once __DIR__.'/../buku-ternak/bootstrap/app.php';
```

---

## Langkah 5 — Migrasi Database

```bash
cd /home/username/buku-ternak
php8.2 artisan migrate --force
```

Jika berhasil:

```
INFO  Running migrations.
  ...create_users_table ............... DONE
  ...create_cycles_table .............. DONE
  ...create_livestock_tables .......... DONE
```

---

## Langkah 6 — Permission Storage & Cache

```bash
chmod -R 775 /home/username/buku-ternak/storage
chmod -R 775 /home/username/buku-ternak/bootstrap/cache
```

---

## Langkah 7 — Optimasi Cache

```bash
php8.2 artisan config:cache
php8.2 artisan route:cache
php8.2 artisan view:cache
php8.2 artisan event:cache
```

---

## Langkah 8 — Aktifkan HTTPS

1. Di cPanel, buka **SSL/TLS** atau **Let's Encrypt SSL**
2. Install SSL untuk domain kamu (biasanya gratis via AutoSSL cPanel)
3. Aktifkan **Force HTTPS Redirect** di cPanel → pastikan `.htaccess` di `public_html` sudah ada

Jika belum ada, tambahkan di `/home/username/public_html/.htaccess`:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On

    # Force HTTPS
    RewriteCond %{HTTPS} off
    RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

    # Laravel front controller
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

---

## Langkah 9 — Verifikasi

Buka browser ke `https://domain.com` — landing page BukuTernak harus muncul.

Checklist:
- [ ] Landing page terbuka tanpa error
- [ ] Register akun baru berhasil
- [ ] Login berhasil dan masuk ke Dashboard
- [ ] Buat siklus baru
- [ ] Tambah catatan pakan, kematian, biaya, penjualan
- [ ] Hapus catatan (modal konfirmasi muncul)
- [ ] Lihat laporan dan profil
- [ ] Logout berhasil

---

## Update Kode (Redeploy)

Setiap ada update:

```bash
cd /home/username/buku-ternak

git pull origin main

composer install --no-dev --optimize-autoloader

php8.2 artisan migrate --force

php8.2 artisan optimize:clear
php8.2 artisan optimize
```

---

## Troubleshooting

| Error | Solusi |
|---|---|
| Halaman putih / blank | Set `APP_DEBUG=true` sementara, cek `storage/logs/laravel.log` |
| `500 Internal Server Error` | Cek permission: `chmod -R 775 storage bootstrap/cache` |
| `APP_KEY` missing | Jalankan `php8.2 artisan key:generate` |
| Login berhasil tapi balik ke login lagi | Cek kolom `sessions.user_id` harus `VARCHAR(36)`, bukan `bigint` |
| `composer: command not found` | Gunakan `php8.2 composer.phar` atau cek path PHP di cPanel |
| Database connection refused | Pastikan `DB_HOST=localhost` (bukan IP) di shared hosting |
| File upload gagal | `chmod -R 775 storage/app/public` |
| CSS/JS tidak muncul | Pastikan `APP_URL` sudah benar dan HTTPS aktif |
| `migrate` error hak akses | Pastikan user MySQL dapat `CREATE TABLE` |
| Symlink tidak bisa dibuat | Gunakan Cara B (salin + edit `index.php`) |
