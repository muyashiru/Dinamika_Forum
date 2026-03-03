# 🚀 Panduan Deploy DINAMIKA Forum ke Railway

## 📋 Prerequisites

- [x] Akun GitHub (project sudah di push ke GitHub)
- [x] Akun Railway (gratis) - https://railway.app
- [x] Project Laravel sudah berjalan di local

---

## 🎯 Step 1: Persiapan Project

### 1.1 Buat File `Procfile`

Buat file baru `Procfile` (tanpa extension) di root project:

```
web: php artisan migrate --force && php artisan config:cache && php artisan route:cache && php artisan view:cache && php -S 0.0.0.0:$PORT -t public
```

### 1.2 Buat File `nixpacks.toml`

Buat file `nixpacks.toml` di root project:

```toml
[phases.setup]
nixPkgs = ['php82', 'php82Packages.composer', 'nodejs', 'npm']

[phases.install]
cmds = [
    'composer install --no-dev --optimize-autoloader',
    'npm ci',
    'npm run build'
]

[start]
cmd = 'php artisan migrate --force && php artisan config:cache && php artisan view:cache && php -S 0.0.0.0:$PORT -t public'
```

### 1.3 Update `.gitignore`

Pastikan file-file ini **TIDAK** di-gitignore:

```gitignore
# .gitignore

# Jangan ignore ini (Railway butuh)
# /vendor
# /node_modules
# composer.lock
# package-lock.json

# Yang harus tetap di-ignore:
.env
.env.backup
storage/*.key
```

**PENTING:** Comment out atau hapus `/vendor` dari `.gitignore`

### 1.4 Commit & Push Changes

```bash
git add .
git commit -m "Prepare for Railway deployment"
git push origin main
```

---

## 🚂 Step 2: Setup Railway

### 2.1 Buat Akun Railway

1. Kunjungi https://railway.app
2. Klik **"Start a New Project"**
3. Login dengan GitHub
4. Authorize Railway untuk akses repository Anda

### 2.2 Deploy dari GitHub

1. Klik **"Deploy from GitHub repo"**
2. Pilih repository **`Dinamika_Forum`**
3. Klik **"Deploy Now"**

Railway akan otomatis:
- Detect Laravel project
- Install dependencies
- Build assets
- Deploy application

---

## 🗄️ Step 3: Setup Database MySQL

### 3.1 Tambah MySQL Service

1. Di Railway dashboard, klik project Anda
2. Klik **"+ New"** → **"Database"** → **"Add MySQL"**
3. Railway akan create MySQL instance otomatis

### 3.2 Link Database ke App

Railway otomatis menyediakan environment variables:
- `MYSQL_URL`
- `MYSQL_HOST`
- `MYSQL_PORT`
- `MYSQL_DATABASE`
- `MYSQL_USER`
- `MYSQL_PASSWORD`

### 3.3 Ambil Credentials

1. Klik service **MySQL**
2. Tab **"Variables"**
3. Copy nilai:
   - `MYSQLHOST`
   - `MYSQLPORT`
   - `MYSQLDATABASE`
   - `MYSQLUSER`
   - `MYSQLPASSWORD`

---

## ⚙️ Step 4: Configure Environment Variables

### 4.1 Set Variables di Railway

1. Klik service **Laravel app** Anda (bukan MySQL)
2. Tab **"Variables"**
3. Klik **"+ New Variable"**
4. Tambahkan satu per satu:

```env
APP_NAME="DINAMIKA Forum"
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:+5TjMd+lz3hkL8qzH7HwvgVj3r/UNxQ/TDT7u4A52s4=

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=${MYSQLHOST}
DB_PORT=${MYSQLPORT}
DB_DATABASE=${MYSQLDATABASE}
DB_USERNAME=${MYSQLUSER}
DB_PASSWORD=${MYSQLPASSWORD}

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="noreply@dinamika.com"
MAIL_FROM_NAME="${APP_NAME}"
```

**PENTING:**
- Gunakan `${MYSQLHOST}` untuk reference variable MySQL
- Set `APP_DEBUG=false` untuk production
- `APP_KEY` copy dari `.env` local Anda

### 4.2 Generate APP_KEY (Jika Belum Ada)

Di local terminal:
```bash
php artisan key:generate --show
```

Copy output dan paste ke `APP_KEY` di Railway.

---

## 🌐 Step 5: Setup Domain

### 5.1 Get Railway Domain

1. Di Railway dashboard, klik service Laravel app
2. Tab **"Settings"**
3. Section **"Domains"**
4. Klik **"Generate Domain"**
5. Railway akan berikan domain: `xxx.up.railway.app`

### 5.2 Update APP_URL

1. Tab **"Variables"**
2. Edit `APP_URL` → ganti dengan domain Railway Anda
3. Contoh: `https://dinamika-forum-production.up.railway.app`

### 5.3 Custom Domain (Opsional)

Jika punya domain sendiri:
1. Tab **"Settings"** → **"Domains"**
2. Klik **"Custom Domain"**
3. Input domain Anda: `forum.dinamika.com`
4. Copy CNAME record yang diberikan
5. Tambahkan CNAME di DNS provider Anda:
   ```
   Type: CNAME
   Name: forum (atau www)
   Value: xxx.up.railway.app
   TTL: Auto
   ```

---

## 📦 Step 6: Run Migrations & Seeder

### 6.1 Connect ke Railway CLI

Install Railway CLI:
```bash
npm i -g @railway/cli
```

Login:
```bash
railway login
```

Link ke project:
```bash
railway link
```

### 6.2 Run Migrations

```bash
railway run php artisan migrate --force
```

### 6.3 Run Seeder (Opsional)

```bash
railway run php artisan db:seed --force
```

### 6.4 Clear Cache

```bash
railway run php artisan config:clear
railway run php artisan cache:clear
railway run php artisan view:clear
railway run php artisan route:clear
```

---

## 📁 Step 7: Setup Storage (File Upload)

Laravel butuh symlink untuk storage:

### 7.1 Via Railway CLI

```bash
railway run php artisan storage:link
```

### 7.2 Update Procfile (Alternative)

Edit `Procfile`:
```
web: php artisan storage:link && php artisan migrate --force && php artisan config:cache && php -S 0.0.0.0:$PORT -t public
```

Commit & push:
```bash
git add Procfile
git commit -m "Add storage:link to Procfile"
git push
```

---

## 🔧 Step 8: Troubleshooting

### Issue: 500 Internal Server Error

**Check Logs:**
1. Railway dashboard → Service Laravel
2. Tab **"Deployments"**
3. Klik deployment terakhir
4. Lihat logs untuk error

**Common fixes:**
```bash
# Clear all cache
railway run php artisan config:clear
railway run php artisan cache:clear
railway run php artisan view:clear

# Re-cache for production
railway run php artisan config:cache
railway run php artisan route:cache
railway run php artisan view:cache
```

### Issue: Database Connection Failed

**Check:**
1. MySQL service sudah running
2. Environment variables sudah benar
3. Format: `${MYSQLHOST}` bukan `$MYSQLHOST`

**Test connection:**
```bash
railway run php artisan tinker
>>> DB::connection()->getPdo();
```

### Issue: Assets Not Loading (CSS/JS)

**Check:**
1. `APP_URL` di environment variables sudah benar
2. Assets sudah di-build: `npm run build`
3. Check public path di `config/app.php`

**Force rebuild assets:**
```bash
railway run npm run build
```

### Issue: File Upload Not Working

**Check:**
1. Storage link sudah dibuat
2. Folder `storage/app/public` exists
3. Permission sudah benar

**Re-link storage:**
```bash
railway run php artisan storage:link --force
```

---

## 🎉 Step 9: Verify Deployment

### 9.1 Test Website

1. Buka domain Railway: `https://xxx.up.railway.app`
2. Test:
   - ✅ Homepage load
   - ✅ Register user baru
   - ✅ Login
   - ✅ Buat diskusi
   - ✅ Upload avatar
   - ✅ Comment di diskusi

### 9.2 Test Database

```bash
railway run php artisan tinker
>>> User::count()
>>> Discussion::count()
```

### 9.3 Check Performance

Railway free tier limits:
- 500 MB RAM
- 1 GB Disk
- $5 credit per month (~500 hours runtime)

Monitor usage di dashboard.

---

## 🔄 Step 10: Auto-Deploy Setup

Railway sudah otomatis auto-deploy dari GitHub!

**Workflow:**
1. Kamu push code ke GitHub
2. Railway detect changes
3. Otomatis build & deploy
4. Zero downtime deployment

**Manual redeploy:**
1. Dashboard → Service → Deployments
2. Klik **"Deploy"** button

---

## 📊 Monitoring & Maintenance

### Lihat Logs Real-time

```bash
railway logs
```

Atau di dashboard: **Deployments** → **View Logs**

### Database Backup

**Via Railway CLI:**
```bash
railway run mysqldump -u$MYSQLUSER -p$MYSQLPASSWORD $MYSQLDATABASE > backup.sql
```

**Download database:**
1. Railway dashboard → MySQL service
2. Tab **"Data"** → **"Export"**

### Rollback Deployment

1. Dashboard → Deployments
2. Pilih deployment sebelumnya
3. Klik **"Redeploy"**

---

## 💰 Pricing (Free Tier)

Railway free tier:
- ✅ **$5 credit/month** (~500 hours)
- ✅ Unlimited projects
- ✅ MySQL database included
- ✅ Custom domain support
- ✅ Auto SSL certificate
- ✅ Auto deploy from GitHub

**Estimasi untuk forum kecil-menengah:**
- Traffic rendah: Gratis (dalam limit $5/month)
- Traffic tinggi: ~$5-20/month

**Upgrade jika perlu:**
- Developer: $5/month (20GB disk)
- Team: $20/month (unlimited)

---

## 🎯 Post-Deployment Checklist

- [ ] Website bisa diakses via domain Railway
- [ ] Database connected & migrations done
- [ ] Seeder jalan (user admin exists)
- [ ] Register & Login berfungsi
- [ ] Buat diskusi berfungsi
- [ ] Upload avatar berfungsi
- [ ] Comment berfungsi
- [ ] CSS & JS load dengan benar
- [ ] Email verification (jika enabled)
- [ ] Google OAuth (jika enabled)
- [ ] Custom domain setup (jika ada)
- [ ] SSL certificate active (otomatis from Railway)
- [ ] Backup strategy sudah dibuat

---

## 🆘 Support & Resources

**Railway Docs:**
- https://docs.railway.app

**Railway Discord:**
- https://discord.gg/railway

**Laravel Deployment:**
- https://laravel.com/docs/deployment

**Jika Ada Masalah:**
1. Check logs di Railway dashboard
2. Test command via `railway run`
3. Check database connection
4. Clear cache: `php artisan cache:clear`

---

## 🚀 Next Steps

Setelah deploy berhasil:

1. **Setup Monitoring:**
   - Tambahkan Laravel Telescope (development)
   - Setup error tracking (Sentry/Bugsnag)

2. **Performance:**
   - Enable cache driver Redis (upgrade)
   - Setup CDN untuk assets (Cloudflare)

3. **Security:**
   - Enable HTTPS only
   - Setup rate limiting
   - Enable CSRF protection

4. **Backup:**
   - Schedule database backup
   - Backup uploaded files

5. **Custom Domain:**
   - Buy domain di Namecheap/GoDaddy
   - Point to Railway

---

**Selamat! Project Anda sudah live di Railway! 🎉**

Deploy time: ~30 menit untuk first deployment
Auto-deploy: ~3-5 menit per push

**URL Production:** `https://dinamika-forum-production.up.railway.app`

_Pastikan share link production Anda setelah deploy!_
