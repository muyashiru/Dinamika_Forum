# DINAMIKA Forum

Rollback

![DINAMIKA Forum](https://img.shields.io/badge/DINAMIKA-Forum-blue?style=for-the-badge)
![Laravel](https://img.shields.io/badge/Laravel-10-red?style=for-the-badge&logo=laravel)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3-38B2AC?style=for-the-badge&logo=tailwind-css)

## 📖 Tentang DINAMIKA Forum

**DINAMIKA** (Dinasti Mahasiswa Teknik Informatika) Forum adalah platform diskusi modern untuk mahasiswa Teknik Informatika. Forum ini dirancang khusus untuk memfasilitasi diskusi akademik, berbagi pengetahuan, dan kolaborasi antar mahasiswa.

### ✨ Fitur Utama

- 🔐 **Autentikasi Lengkap**
  - Register & Login
  - Email Verification
  - Reset Password
  - Google OAuth Integration

- 💬 **Sistem Diskusi**
  - Create, Read, Update, Delete Discussions
  - Markdown Editor Support
  - Rich Text Formatting
  - Syntax Highlighting untuk Code

- 💭 **Komentar & Interaksi**
  - Nested Comments
  - Best Answer Selection
  - Mark Discussion as Solved
  - Edit & Delete Comments

- 👍 **Reaction System**
  - Like/Unlike Discussions
  - Upvote/Downvote Comments
  - Real-time Reaction Counter

- 🏷️ **Tag & Kategorisasi**
  - Multiple Tags per Discussion
  - Filter by Tags
  - Popular Tags

- 👤 **Profil User**
  - Custom Avatar
  - User Statistics
  - Activity History
  - Profile Settings

- 🔍 **Search & Filter**
  - Full-text Search
  - Filter by Categories
  - Sort by Popular, Recent, Solved
  - Advanced Filtering

## 🚀 Tech Stack

### Backend
- **Laravel 10** - PHP Framework
- **MySQL** - Database
- **Laravel Sanctum** - API Authentication
- **Laravel Socialite** - OAuth Provider

### Frontend
- **TailwindCSS 3** - Utility-first CSS
- **Alpine.js** - Lightweight JavaScript
- **Vite** - Modern Build Tool
- **CommonMark** - Markdown Parser

## 📋 Prerequisites

Sebelum memulai, pastikan sistem Anda memiliki:

- PHP >= 8.1
- Composer
- Node.js >= 16.x
- NPM atau Yarn
- MySQL >= 5.7 atau MariaDB >= 10.3

## 🛠️ Instalasi

### 1. Clone Repository

```bash
git clone <repository-url> dinamika-forum
cd dinamika-forum
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### 3. Environment Configuration

```bash
# Copy environment file
copy .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Setup

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dinamika_forum
DB_USERNAME=root
DB_PASSWORD=
```

Kemudian jalankan migrasi:

```bash
php artisan migrate:fresh --seed
```

### 5. Google OAuth Setup (Opsional)

1. Buat project di [Google Cloud Console](https://console.cloud.google.com/)
2. Enable Google+ API
3. Create OAuth 2.0 Credentials
4. Tambahkan ke `.env`:

```env
GOOGLE_CLIENT_ID=your_client_id
GOOGLE_CLIENT_SECRET=your_client_secret
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```

### 6. Build Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### 7. Run Application

```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## 🎯 Default Accounts (Seeder)

Setelah menjalankan seeder, Anda dapat login dengan:

**Admin:**
- Email: admin@dinamika.ac.id
- Password: password

**User Test:**
- Email: user@dinamika.ac.id
- Password: password

## 📁 Struktur Project

```
dinamika-forum/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   ├── DiscussionController.php
│   │   │   ├── CommentController.php
│   │   │   └── ProfileController.php
│   │   └── Middleware/
│   ├── Models/
│   │   ├── User.php
│   │   ├── Discussion.php
│   │   ├── Comment.php
│   │   ├── Tag.php
│   │   └── Reaction.php
│   └── Providers/
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── factories/
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   ├── components/
│   │   ├── discussions/
│   │   └── auth/
│   ├── css/
│   └── js/
├── routes/
│   ├── web.php
│   └── api.php
├── public/
└── storage/
```

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter DiscussionTest
```

## 🚢 Deployment

### Production Checklist

- [ ] Set `APP_ENV=production`
- [ ] Set `APP_DEBUG=false`
- [ ] Configure proper database credentials
- [ ] Run `composer install --optimize-autoloader --no-dev`
- [ ] Run `php artisan config:cache`
- [ ] Run `php artisan route:cache`
- [ ] Run `php artisan view:cache`
- [ ] Run `npm run build`
- [ ] Setup proper file permissions
- [ ] Configure web server (Apache/Nginx)
- [ ] Setup SSL certificate
- [ ] Configure backup strategy

## 🤝 Contributing

Kontribusi sangat diterima! Silakan buat Pull Request atau buka Issue untuk melaporkan bug atau request fitur.

### Development Guidelines

1. Fork repository
2. Create feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Open Pull Request

## 📝 License

Project ini dilisensikan di bawah [MIT License](LICENSE).

## 👥 Tim Pengembang

**DINAMIKA** - Dinasti Mahasiswa Teknik Informatika

## 📞 Kontak & Support

- Email: support@dinamika-forum.com
- Website: https://dinamika-forum.com
- GitHub Issues: [Report Bug](../../issues)

## 🙏 Acknowledgments

- Terinspirasi dari [Devover Forum](https://github.com/devoverid/forum)
- Laravel Community
- TailwindCSS Team
- Semua kontributor open source

---

**Made with ❤️ by DINAMIKA Team**
