#!/bin/bash

# ==============================================================================
# Script Otomatis Deployment - Inovasi Hilirisasi (PUSKOR) UNSOED
# Framework  : Laravel 11 + Vue 3 Inertia (Vite)
# ==============================================================================
# Cara Penggunaan di SSH / Terminal cPanel:
#   chmod +x deploy.sh
#   ./deploy.sh
#
# Opsi Tambahan:
#   ./deploy.sh --skip-build    (Lewati proses build frontend npm)
#   ./deploy.sh --skip-composer (Lewati composer install)
#   ./deploy.sh --skip-migrate  (Lewati migrasi database)
#   ./deploy.sh --seed          (Jalankan database seeder / isi data awal)
# ==============================================================================

# Hentikan eksekusi jika terjadi error kritis di luar blok penanganan
set -e

# ------------------------------------------------------------------------------
# 1. Konfigurasi Path & Environment
# ------------------------------------------------------------------------------
REPO_URL="${REPO_URL:-}"
BRANCH="${BRANCH:-master}"

# Path direktori proyek saat ini
PROJECT_PATH="$(pwd)"
PROJECT_DIR="$(basename "$PROJECT_PATH")"

# Executables
PHP_BIN="php"
COMPOSER_BIN="composer"
NPM_BIN="npm"

# Flag Opsi Default
SKIP_BUILD=false
SKIP_COMPOSER=false
SKIP_MIGRATE=false
RUN_SEED=false

for arg in "$@"; do
    case $arg in
        --skip-build|--skip-npm)
            SKIP_BUILD=true
            shift
            ;;
        --skip-composer)
            SKIP_COMPOSER=true
            shift
            ;;
        --skip-migrate)
            SKIP_MIGRATE=true
            shift
            ;;
        --seed)
            RUN_SEED=true
            shift
            ;;
    esac
done

echo "===================================================================="
echo "🚀 MEMULAI DEPLOYMENT: INOVASI HILIRISASI UNSOED"
echo "📂 Project Directory : $PROJECT_PATH"
echo "🕒 Tanggal/Waktu     : $(date '+%Y-%m-%d %H:%M:%S')"
echo "===================================================================="

# ------------------------------------------------------------------------------
# 2. Pembersihan File Hot Dev Server (Penyebab Utama Layar Blank Putih)
# ------------------------------------------------------------------------------
echo "🧹 [1/8] Membersihkan file dev hot server (anti layar blank putih)..."
rm -f public/hot 2>/dev/null || true

# ------------------------------------------------------------------------------
# 3. Verifikasi File .env
# ------------------------------------------------------------------------------
echo "🔍 [2/8] Memeriksa konfigurasi environment (.env)..."
if [ ! -f ".env" ]; then
    if [ -f ".env.production" ]; then
        echo "   📄 Menyalin .env.production ke .env..."
        cp .env.production .env
    elif [ -f ".env.example" ]; then
        echo "   ⚠️ File .env tidak ditemukan! Menyalin dari .env.example..."
        cp .env.example .env
        $PHP_BIN artisan key:generate --force
    else
        echo "   ❌ ERROR: File .env tidak ditemukan!"
        exit 1
    fi
fi

# ------------------------------------------------------------------------------
# 4. Mode Maintenance Sementara
# ------------------------------------------------------------------------------
echo "🚧 [3/8] Mengaktifkan Maintenance Mode sementara..."
if $PHP_BIN artisan --version >/dev/null 2>&1; then
    $PHP_BIN artisan down --render="errors::503" 2>/dev/null || true
fi

# ------------------------------------------------------------------------------
# 5. Tarik Pembaruan dari Git (Jika Repository Dikonfigurasi)
# ------------------------------------------------------------------------------
echo "📥 [4/8] Memeriksa pembaruan Git..."
if [ -n "$REPO_URL" ]; then
    if [ -d ".git" ]; then
        git remote set-url origin "$REPO_URL" 2>/dev/null || true
        git fetch origin "$BRANCH" 2>/dev/null || true
        git stash 2>/dev/null || true
        if ! git pull origin "$BRANCH"; then
            echo "   ⚠️ Terjadi konflik lokal, menyinkronkan paksa ke origin/$BRANCH..."
            git reset --hard "origin/$BRANCH" || true
        fi
    else
        echo "   ℹ️ Inisialisasi Git remote ke $REPO_URL..."
        git init
        git remote add origin "$REPO_URL" 2>/dev/null || true
        git fetch origin "$BRANCH" 2>/dev/null || true
        git pull origin "$BRANCH" 2>/dev/null || true
    fi
else
    echo "   ℹ️ REPO_URL tidak diset. Melewati git pull (menggunakan file yang sudah di-upload)."
fi

# ------------------------------------------------------------------------------
# 6. Composer Dependencies (Optimized for Production)
# ------------------------------------------------------------------------------
echo "📦 [5/8] Memeriksa dependensi Composer (PHP)..."
if [ "$SKIP_COMPOSER" = true ]; then
    echo "   ⏭️ Melewati instalasi composer (--skip-composer aktif)."
elif command -v $COMPOSER_BIN >/dev/null 2>&1; then
    $COMPOSER_BIN install --no-dev --prefer-dist --optimize-autoloader --no-interaction --no-scripts || \
    $COMPOSER_BIN install --no-dev --prefer-dist --optimize-autoloader --no-interaction --no-scripts --ignore-platform-reqs || \
    echo "   ⚠️ Composer install dibatasi pada hosting ini, melanjutkan proses..."

    $PHP_BIN artisan package:discover --ansi 2>/dev/null || true
else
    echo "   ℹ️ Composer executable tidak ditemukan di PATH. Menggunakan vendor yang sudah ada."
fi

# ------------------------------------------------------------------------------
# 7. Kompilasi / Pembersihan Aset Frontend (Vite / Vue 3)
# ------------------------------------------------------------------------------
echo "🎨 [6/8] Memeriksa aset frontend produksi..."
# Pastikan sekali lagi file hot terhapus
rm -f public/hot 2>/dev/null || true

if [ "$SKIP_BUILD" = false ]; then
    if command -v $NPM_BIN >/dev/null 2>&1 && [ -f "package.json" ]; then
        echo "   ⚡ Menjalankan npm run build di server..."
        $NPM_BIN run build || true
    else
        echo "   ℹ️ Menggunakan aset build produksi yang sudah ada di public/build."
    fi
else
    echo "   ⏭️ Melewati build frontend (--skip-build aktif)."
fi

# ------------------------------------------------------------------------------
# 8. Migrasi Database & Seeder
# ------------------------------------------------------------------------------
echo "🗄️ [7/8] Menjalankan migrasi database..."
if [ "$SKIP_MIGRATE" = false ]; then
    $PHP_BIN artisan migrate --force
    if [ "$RUN_SEED" = true ]; then
        echo "   🌱 Menjalankan database seeder (pengisian data awal)..."
        $PHP_BIN artisan db:seed --force
    fi
else
    echo "   ⏭️ Melewati migrasi database (--skip-migrate aktif)."
fi

# ------------------------------------------------------------------------------
# 9. Optimasi Cache Laravel, Hak Akses & Storage Link
# ------------------------------------------------------------------------------
echo "⚡ [8/8] Mengoptimasi Cache & Pengaturan Hak Akses (Storage & Cache)..."
# Bersihkan cache lama
$PHP_BIN artisan optimize:clear
$PHP_BIN artisan config:clear
$PHP_BIN artisan cache:clear
$PHP_BIN artisan view:clear
$PHP_BIN artisan route:clear

# Cache baru untuk kecepatan produksi
$PHP_BIN artisan config:cache
$PHP_BIN artisan route:cache
$PHP_BIN artisan view:cache
$PHP_BIN artisan event:cache 2>/dev/null || true

# Pastikan symbolic link storage Laravel aktif
if [ -L "public/storage" ] && [ -e "public/storage" ]; then
    echo "   🔗 Symlink public/storage sudah aktif."
else
    rm -rf public/storage
    $PHP_BIN artisan storage:link 2>/dev/null || true
    echo "   🔗 Symlink public/storage berhasil disinkronkan."
fi

# Atur hak akses permission folder writable
chmod -R 775 storage bootstrap/cache 2>/dev/null || true

# ------------------------------------------------------------------------------
# 10. Matikan Maintenance Mode (Website Online)
# ------------------------------------------------------------------------------
echo "🟢 Mengaktifkan kembali website (php artisan up)..."
$PHP_BIN artisan up 2>/dev/null || true

echo "===================================================================="
echo "✅ DEPLOYMENT BERHASIL SELESAI!"
echo "✨ Website Inovasi Hilirisasi UNSOED Sudah Aktif & Siap Diakses!"
echo "🌐 URL: https://inovasihilirisasi.techsoe.com"
echo "===================================================================="
