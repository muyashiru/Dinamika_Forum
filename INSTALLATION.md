# 🚀 PANDUAN INSTALASI DINAMIKA FORUM

Panduan lengkap untuk setup dan menjalankan DINAMIKA Forum di local development.

## 📋 Prerequisites

Pastikan sistem Anda sudah terinstall:

- **PHP** >= 8.1 (dengan ekstensi: mbstring, openssl, PDO, tokenizer, xml, ctype, json, bcmath, fileinfo)
- **Composer** >= 2.0
- **Node.js** >= 16.x
- **NPM** atau **Yarn**
- **MySQL** >= 5.7 atau **MariaDB** >= 10.3
- **Git**

### Cek Versi

```bash
php -v
composer -v
node -v
npm -v
mysql --version
```

---

## 🛠️ Langkah Instalasi

### 1. Clone atau Setup Project

Jika Anda sudah memiliki project ini:

```bash
cd d:\Projectku\Dinamika_Forum
```

### 2. Install Dependencies PHP

```bash
composer install
```

Jika Anda belum punya vendor dependencies, ini akan mengdownload semua package Laravel dan dependencies yang diperlukan.

### 3. Install Dependencies JavaScript

```bash
npm install
```

Atau jika menggunakan Yarn:

```bash
yarn install
```

### 4. Setup Environment File

Copy file `.env.example` menjadi `.env`:

```bash
# Windows PowerShell
copy .env.example .env

# Windows CMD
copy .env.example .env

# Linux/Mac
cp .env.example .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Konfigurasi Database

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dinamika_forum
DB_USERNAME=root
DB_PASSWORD=
```

### 7. Buat Database

Buat database baru di MySQL:

```sql
CREATE DATABASE dinamika_forum CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Atau menggunakan command line:

```bash
# Login ke MySQL
mysql -u root -p

# Buat database
CREATE DATABASE dinamika_forum CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
exit;
```

### 8. Migrasi Database

Jalankan migrasi untuk membuat tabel-tabel:

```bash
php artisan migrate
```

### 9. Seed Database (Opsional)

Populate database dengan data dummy untuk testing:

```bash
php artisan db:seed
```

Atau jika ingin fresh start dengan seeding sekaligus:

```bash
php artisan migrate:fresh --seed
```

**Data default setelah seeding:**
- Admin: `admin@dinamika.ac.id` / `password`
- User: `user@dinamika.ac.id` / `password`

### 10. Create Storage Link

Buat symbolic link untuk storage:

```bash
php artisan storage:link
```

### 11. Build Assets

**Development mode** (dengan hot reload):

```bash
npm run dev
```

**Production mode**:

```bash
npm run build
```

### 12. Run Application

Buka terminal baru (biarkan `npm run dev` tetap jalan) dan jalankan:

```bash
php artisan serve
```

Aplikasi akan berjalan di: **http://localhost:8000**

---

## 🔐 Setup Google OAuth (Opsional)

Untuk mengaktifkan login dengan Google:

### 1. Buat Project di Google Cloud Console

1. Buka [Google Cloud Console](https://console.cloud.google.com/)
2. Buat project baru atau pilih existing project
3. Enable **Google+ API**

### 2. Buat OAuth 2.0 Credentials

1. Go to **APIs & Services** > **Credentials**
2. Click **Create Credentials** > **OAuth client ID**
3. Application type: **Web application**
4. Name: `DINAMIKA Forum`
5. Authorized redirect URIs:
   ```
   http://localhost:8000/auth/google/callback
   ```
6. Save dan copy **Client ID** dan **Client Secret**

### 3. Update .env File

```env
GOOGLE_CLIENT_ID=your_client_id_here
GOOGLE_CLIENT_SECRET=your_client_secret_here
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```

### 4. Clear Config Cache

```bash
php artisan config:clear
```

---

## 📧 Setup Email (Opsional)

Untuk email verification dan password reset:

### Menggunakan Mailtrap (Recommended untuk Development)

1. Daftar di [Mailtrap.io](https://mailtrap.io/)
2. Buat inbox baru
3. Copy SMTP credentials

Update `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@dinamika-forum.com"
MAIL_FROM_NAME="DINAMIKA Forum"
```

### Menggunakan Gmail (Production)

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@dinamika-forum.com"
MAIL_FROM_NAME="DINAMIKA Forum"
```

**Note:** Untuk Gmail, gunakan [App Password](https://support.google.com/accounts/answer/185833) bukan password biasa.

---

## 🧪 Testing

Run tests:

```bash
php artisan test
```

---

## 🎨 Development Workflow

### 1. Terminal 1: Vite Dev Server

```bash
npm run dev
```

### 2. Terminal 2: Laravel Server

```bash
php artisan serve
```

### 3. Terminal 3: Commands (optional)

```bash
# Watch untuk perubahan
php artisan queue:work

# atau commands lainnya
```

---

## 🐛 Troubleshooting

### Error: "The stream or file could not be opened"

```bash
# Windows
mkdir storage\logs
echo. > storage\logs\laravel.log

# Linux/Mac
mkdir -p storage/logs
touch storage/logs/laravel.log
```

Kemudian set permissions (Linux/Mac):

```bash
chmod -R 775 storage bootstrap/cache
```

### Error: "No application encryption key has been specified"

```bash
php artisan key:generate
```

### Error: "SQLSTATE[HY000] [2002] Connection refused"

- Pastikan MySQL service sudah running
- Cek kredensial database di `.env`
- Pastikan database sudah dibuat

### Error: "Vite manifest not found"

```bash
npm run build
```

### Error: "Class not found"

```bash
composer dump-autoload
php artisan config:clear
php artisan cache:clear
```

### Port 8000 sudah digunakan

```bash
# Gunakan port lain
php artisan serve --port=8001
```

---

## 📚 Command Reference

### Artisan Commands

```bash
# Development
php artisan serve                    # Run server
php artisan migrate                  # Run migrations
php artisan db:seed                  # Seed database
php artisan migrate:fresh --seed    # Fresh migration + seed

# Cache
php artisan config:clear             # Clear config cache
php artisan cache:clear              # Clear application cache
php artisan view:clear               # Clear compiled views
php artisan route:clear              # Clear route cache

# Database
php artisan migrate:status           # Check migration status
php artisan migrate:rollback         # Rollback last migration
php artisan db:wipe                  # Drop all tables

# Queue
php artisan queue:work               # Start queue worker
php artisan queue:restart            # Restart queue workers

# Storage
php artisan storage:link             # Create storage symlink
```

### NPM Commands

```bash
npm run dev          # Development dengan hot reload
npm run build        # Production build
npm run preview      # Preview production build
```

---

## 🚀 Production Setup

Untuk deploy ke production, lihat file [DEPLOYMENT.md](DEPLOYMENT.md)

---

## 💡 Tips

1. **Gunakan .env.local untuk development pribadi**
   ```bash
   copy .env .env.local
   ```

2. **Install Laravel Debugbar (Development)**
   ```bash
   composer require barryvdh/laravel-debugbar --dev
   ```

3. **Install Laravel IDE Helper**
   ```bash
   composer require --dev barryvdh/laravel-ide-helper
   php artisan ide-helper:generate
   ```

4. **Format Code dengan Laravel Pint**
   ```bash
   ./vendor/bin/pint
   ```

---

## 📞 Bantuan

Jika mengalami kesulitan:

1. Cek dokumentasi Laravel: https://laravel.com/docs
2. Cek GitHub Issues
3. Hubungi maintainer

---

**Selamat coding! 🎉**
