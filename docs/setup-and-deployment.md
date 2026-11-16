# PANDUAN INSTALASI, PENGEMBANGAN, & DEPLOYMENT
# WEBSITE PUSKOR (PUSAT KOORDINASI PENGEMBANGAN DAN PENERAPAN TEKNOLOGI)
### Universitas Jenderal Soedirman

**Versi:** 1.0  
**Target Environment:** Local (Windows/Laragon) & Production (Linux Nginx / PHP 8.2+)

---

## 1. PERSYARATAN SISTEM (SYSTEM REQUIREMENTS)

Sebelum memulai instalasi, pastikan lingkungan kerja telah memenuhi dependensi minimal berikut:

- **PHP:** Versi 8.2 atau 8.3 (dengan ekstensi: `bcmath`, `ctype`, `curl`, `dom`, `fileinfo`, `gd` / `imagick`, `mbstring`, `openssl`, `pdo_mysql`, `tokenizer`, `xml`)
- **Composer:** Versi 2.6+
- **Node.js:** Versi 20.x LTS atau 22.x LTS
- **Package Manager:** NPM / PNPM
- **Database Engine:** MySQL 8.0+ atau MariaDB 10.11+
- **Web Server:** Nginx (disarankan untuk produksi) atau Apache (Laragon lokal)

---

## 2. PANDUAN PENGEMBANGAN LOKAL (LOCAL SETUP - LARAGON)

### 2.1 Kloning & Instalasi Dependensi
Buka terminal PowerShell atau Git Bash di direktori proyek:

```bash
# 1. Masuk ke direktori proyek
cd c:\laragon\www\puskor

# 2. Install dependensi backend (Composer)
composer install

# 3. Install dependensi frontend (NPM)
npm install
```

### 2.2 Konfigurasi Environment (`.env`)
Salin file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

Sesuaikan parameter database di file `.env`:
```env
APP_NAME="PUSKOR UNSOED"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_TIMEZONE=Asia/Jakarta
APP_URL=http://puskor.test

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=puskor_db
DB_USERNAME=root
DB_PASSWORD=

FILESYSTEM_DISK=public
```

### 2.3 Generate Key, Migrasi, & Storage Link
Jalankan runtutan perintah artisan berikut:

```bash
# 1. Generate App Key unik
php artisan key:generate

# 2. Buat database di MySQL (via terminal atau phpMyAdmin: CREATE DATABASE puskor_db;)
# 3. Jalankan migrasi tabel beserta seeder data awal (Program SINERGI, DORTEK, dll)
php artisan migrate --seed

# 4. Buat symlink storage publik agar gambar dapat diakses browser
php artisan storage:link
```

### 2.4 Menjalankan Server Pengembangan
Jalankan server Vite untuk mengaktifkan Hot Module Replacement (HMR) Vue 3:

```bash
# Terminal 1: Kompilasi aset frontend
npm run dev

# Terminal 2: Server Laravel (jika tidak menggunakan virtual host Laragon)
php artisan serve
```
Akses website melalui peramban di `http://127.0.0.1:8000` atau `http://puskor.test`.

---

## 3. PANDUAN DEPLOYMENT KE SERVER PRODUKSI (UBUNTU / NGINX)

### 3.1 Konfigurasi Virtual Host Nginx
Simpan konfigurasi berikut pada `/etc/nginx/sites-available/puskor.unsoed.ac.id`:

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name puskor.unsoed.ac.id;
    return 301 https://$host$request_uri;
}

server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name puskor.unsoed.ac.id;

    root /var/www/puskor/public;
    index index.php index.html;

    # SSL Certificates (Let's Encrypt)
    ssl_certificate /etc/letsencrypt/live/puskor.unsoed.ac.id/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/puskor.unsoed.ac.id/privkey.pem;
    include /etc/letsencrypt/options-ssl-nginx.conf;
    ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem;

    # Security Headers
    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-XSS-Protection "1; mode=block";
    add_header X-Content-Type-Options "nosniff";
    add_header Referrer-Policy "strict-origin-when-cross-origin";

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

    # Cache Control untuk aset statis Vite & Gambar
    location ~* \.(jpg|jpeg|png|gif|ico|webp|svg|css|js|woff2|woff|ttf)$ {
        expires 30d;
        add_header Cache-Control "public, no-transform";
        access_log off;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }

    client_max_body_size 20M;
}
```

### 3.2 Prosedur Rilis Produksi (Production Deployment Script)
Jalankan script bash berikut saat melakukan update atau rilis ke server produksi:

```bash
#!/bin/bash
set -e

echo "=== Memulai Deployment PUSKOR UNSOED ==="

# 1. Tarik kode terbaru
git pull origin main

# 2. Install dependensi PHP tanpa dev packages
composer install --no-dev --optimize-autoloader

# 3. Install dan bangun aset frontend Vue 3
npm ci
npm run build

# 4. Jalankan migrasi database
php artisan migrate --force

# 5. Buat tautan storage jika belum ada
php artisan storage:link

# 6. Bersihkan dan cache konfigurasi, rute, dan view
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 7. Set izin hak akses file
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache

# 8. Reload PHP-FPM
sudo systemctl reload php8.2-fpm

echo "=== Deployment Berhasil Selesai! ==="
```

---

## 4. STRATEGI CADANGAN & PEMULIHAN (BACKUP & RECOVERY)

1. **Backup Database Harian (Automated Cron)**:
   ```bash
   mysqldump -u puskor_user -p'strong_password' puskor_db | gzip > /backups/db/puskor_$(date +\%F).sql.gz
   ```
2. **Backup Media Unggahan (`storage/app/public/`)**:
   ```bash
   rsync -avz /var/www/puskor/storage/app/public/ /backups/storage/
   ```
3. **Retensi Cadangan**:
   - Backup harian disimpan selama 7 hari.
   - Backup mingguan disimpan selama 4 minggu.
   - Backup bulanan disimpan selama 12 bulan di storage terpisah (misal: S3 / Google Drive / Server Backup UNSOED).

