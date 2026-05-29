# Panduan Deploy BukuTernak (Laravel) ke VPS

Stack: **Laravel 13 + MySQL + PHP 8.2+ + Nginx + Supervisor**

---

## Prasyarat

- VPS dengan Ubuntu 22.04 / 24.04
- Domain sudah diarahkan ke IP VPS (A record)
- Akses SSH ke VPS

---

## 1. Login & Update Sistem

```bash
ssh root@IP_VPS

apt update && apt upgrade -y
```

---

## 2. Install PHP 8.2 + Ekstensi

```bash
apt install -y software-properties-common
add-apt-repository ppa:ondrej/php -y
apt update

apt install -y php8.2 php8.2-fpm php8.2-cli \
  php8.2-mysql php8.2-mbstring php8.2-xml \
  php8.2-bcmath php8.2-curl php8.2-zip \
  php8.2-tokenizer php8.2-pdo unzip git curl
```

Verifikasi:

```bash
php -v
# PHP 8.2.x
```

---

## 3. Install Composer

```bash
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
composer --version
```

---

## 4. Install MySQL

```bash
apt install -y mysql-server
mysql_secure_installation
```

Buat database dan user:

```bash
mysql -u root -p
```

```sql
CREATE DATABASE buku_ternak CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'ternak_user'@'localhost' IDENTIFIED BY 'password_kuat_di_sini';
GRANT ALL PRIVILEGES ON buku_ternak.* TO 'ternak_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

---

## 5. Install Nginx

```bash
apt install -y nginx
systemctl enable nginx
systemctl start nginx
```

---

## 6. Clone Project

```bash
apt install -y git

git clone https://github.com/USERNAME/buku-ternak-laravel.git /var/www/buku-ternak
cd /var/www/buku-ternak

# Install dependencies (tanpa dev packages)
composer install --no-dev --optimize-autoloader
```

---

## 7. Konfigurasi .env

```bash
cp .env.example .env
nano .env
```

Isi nilai berikut:

```env
APP_NAME=BukuTernak
APP_ENV=production
APP_DEBUG=false
APP_URL=https://domain.com

APP_LOCALE=id
APP_FALLBACK_LOCALE=id

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=buku_ternak
DB_USERNAME=ternak_user
DB_PASSWORD=password_kuat_di_sini

SESSION_DRIVER=database
SESSION_LIFETIME=120

LOG_CHANNEL=stack
LOG_LEVEL=error
```

Generate APP_KEY:

```bash
php artisan key:generate
```

---

## 8. Permission File & Folder

```bash
chown -R www-data:www-data /var/www/buku-ternak
chmod -R 775 /var/www/buku-ternak/storage
chmod -R 775 /var/www/buku-ternak/bootstrap/cache
```

---

## 9. Migrasi Database

```bash
php artisan migrate --force
```

---

## 10. Optimasi untuk Production

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

---

## 11. Konfigurasi Nginx

```bash
nano /etc/nginx/sites-available/buku-ternak
```

Isi dengan konfigurasi berikut (ganti `domain.com` dengan domain kamu):

```nginx
server {
    listen 80;
    server_name domain.com www.domain.com;
    root /var/www/buku-ternak/public;
    index index.php;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Aktifkan konfigurasi:

```bash
ln -s /etc/nginx/sites-available/buku-ternak /etc/nginx/sites-enabled/
nginx -t && systemctl reload nginx
```

---

## 12. HTTPS dengan SSL (Let's Encrypt)

```bash
apt install -y certbot python3-certbot-nginx
certbot --nginx -d domain.com -d www.domain.com
```

Certbot otomatis memperbarui konfigurasi Nginx untuk HTTPS. Pastikan auto-renew aktif:

```bash
systemctl status certbot.timer
# Active: active
```

---

## 13. Setup Supervisor (Queue Worker — opsional)

Jika kamu menambahkan fitur email atau notifikasi di masa depan:

```bash
apt install -y supervisor

nano /etc/supervisor/conf.d/buku-ternak-worker.conf
```

```ini
[program:buku-ternak-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/buku-ternak/artisan queue:work --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=1
redirect_stderr=true
stdout_logfile=/var/www/buku-ternak/storage/logs/worker.log
stopwaitsecs=3600
```

```bash
supervisorctl reread
supervisorctl update
supervisorctl start buku-ternak-worker:*
```

---

## 14. Firewall

```bash
ufw allow 22
ufw allow 80
ufw allow 443
ufw enable
ufw status
```

---

## 15. Verifikasi

Buka browser ke `https://domain.com` — landing page BukuTernak harus muncul.

Test fitur:
- [ ] Register akun baru
- [ ] Login
- [ ] Buat siklus baru
- [ ] Tambah catatan pakan, kematian, biaya, penjualan
- [ ] Lihat laporan
- [ ] Logout

---

## Update / Redeploy

Setiap kali ada update kode:

```bash
cd /var/www/buku-ternak

# Pull kode terbaru
git pull origin main

# Install dependency baru (jika ada)
composer install --no-dev --optimize-autoloader

# Jalankan migrasi baru (jika ada)
php artisan migrate --force

# Refresh cache
php artisan optimize:clear
php artisan optimize

# Fix permission
chown -R www-data:www-data storage bootstrap/cache
```

---

## Hosting Shared (cPanel / Plesk)

Jika menggunakan shared hosting yang mendukung PHP & MySQL:

1. Upload seluruh isi folder project ke `public_html` **kecuali** folder `public`
2. Upload isi folder `public` ke dalam `public_html` langsung
3. Edit `public/index.php` — ubah path ke `bootstrap/app.php`:
   ```php
   require __DIR__.'/../bootstrap/app.php';
   // menjadi:
   require __DIR__.'/../../bootstrap/app.php';
   ```
4. Buat database MySQL via cPanel, lalu isi `.env`
5. Akses terminal (SSH) dan jalankan:
   ```bash
   php artisan key:generate
   php artisan migrate --force
   php artisan optimize
   ```

---

## Troubleshooting

| Error | Solusi |
|---|---|
| `500 Server Error` | Cek `storage/logs/laravel.log`, set `APP_DEBUG=true` sementara |
| Halaman putih kosong | Pastikan `APP_KEY` sudah di-generate |
| `Permission denied` | `chmod -R 775 storage bootstrap/cache` |
| Session tidak tersimpan | Pastikan kolom `sessions.user_id` bertipe `VARCHAR(36)` |
| Migrasi gagal | Pastikan user DB punya privilege `CREATE TABLE` |
| Nginx `502 Bad Gateway` | `systemctl restart php8.2-fpm` |
