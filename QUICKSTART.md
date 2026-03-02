# ⚡ Quick Start Guide - DINAMIKA Forum

Panduan cepat untuk mulai menggunakan DINAMIKA Forum dalam 5 menit!

## 🎯 Prerequisites Check

Pastikan sudah terinstall:
- ✅ PHP >= 8.1
- ✅ Composer
- ✅ Node.js >= 16
- ✅ MySQL
- ✅ Git

---

## 🚀 Quick Setup (5 Langkah)

### 1️⃣ Install Dependencies

```bash
# PHP Dependencies
composer install

# JavaScript Dependencies
npm install
```

### 2️⃣ Setup Environment

```bash
# Copy .env file
copy .env.example .env

# Generate app key
php artisan key:generate
```

### 3️⃣ Configure Database

Edit `.env`:

```env
APP_URL=http://localhost:8000
DB_DATABASE=dinamika_forum
DB_USERNAME=root
DB_PASSWORD=
```

Buat database:

```bash
# Via Laravel command
php artisan db:create dinamika_forum

# Atau manual via MySQL
mysql -u root -p
CREATE DATABASE dinamika_forum;
exit;
```

### 4️⃣ Setup Database

```bash
# Migrate & Seed
php artisan migrate:fresh --seed

# Create storage link
php artisan storage:link
```

### 5️⃣ Run Application

**Terminal 1** - Frontend:
```bash
npm run dev
```

**Terminal 2** - Backend (new terminal):
```bash
php artisan serve
```

**Open Browser:** http://localhost:8000

---

## 🔐 Default Accounts

Login dengan akun default:

**Admin:**
- Email: `admin@dinamika.ac.id`
- Password: `password`

**User:**
- Email: `user@dinamika.ac.id`
- Password: `password`

---

## 🎉 You're Ready!

Sekarang Anda bisa:
- ✅ Browse discussions
- ✅ Create new discussions
- ✅ Comment and reply
- ✅ Like/upvote posts
- ✅ Edit profile

---

## 🔧 Common Commands

```bash
# Clear all cache
php artisan optimize:clear

# Fresh database with seed
php artisan migrate:fresh --seed

# Create new user
php artisan tinker
>>> User::factory()->create(['email' => 'test@example.com'])

# Watch for file changes (auto-reload)
npm run dev

# Build for production
npm run build
```

---

## 🐛 Quick Troubleshooting

### Port already in use?
```bash
php artisan serve --port=8001
```

### Database connection error?
- Check MySQL is running
- Verify credentials in `.env`

### Assets not loading?
```bash
npm run build
php artisan config:clear
```

### Google login tidak muncul / gagal redirect?
```env
GOOGLE_CLIENT_ID=your_client_id
GOOGLE_CLIENT_SECRET=your_client_secret
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```

Lalu jalankan:
```bash
php artisan optimize:clear
```

### Permission errors (Linux/Mac)?
```bash
chmod -R 775 storage bootstrap/cache
```

---

## 📚 Next Steps

1. **Customize branding** - Edit `resources/views/layouts/app.blade.php`
2. **Add tags** - Edit `database/seeders/TagSeeder.php`
3. **Setup Google OAuth** - See [INSTALLATION.md](INSTALLATION.md#setup-google-oauth)
4. **Deploy** - See deployment guide

---

## 💡 Tips

- Use `php artisan tinker` untuk testing
- Check `storage/logs/laravel.log` untuk errors
- Use Laravel Debugbar: `composer require barryvdh/laravel-debugbar --dev`

---

## ❓ Need Help?

See full documentation:
- 📖 [README.md](README.md) - Overview
- 🛠️ [INSTALLATION.md](INSTALLATION.md) - Detailed setup
- 📁 [PROJECT_STRUCTURE.md](PROJECT_STRUCTURE.md) - Code structure
- 🤝 [CONTRIBUTING.md](CONTRIBUTING.md) - Contribution guide

---

**Happy Coding! 🎉**
