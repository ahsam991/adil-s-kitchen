# 🚀 Hostinger Deployment Guide — Adil's Signature Kitchen

## ✅ Upload File Structure

On Hostinger your account has a folder structure like this:

```
/home/u123456789/          ← Your Hostinger account root
├── app/                   ← Upload here (PHP logic, protected)
├── config/                ← Upload here (DB credentials, protected)
├── database/              ← Upload here (SQL files, protected)
├── storage/               ← Upload here (logs/invoices, protected)
│   ├── logs/
│   └── invoices/
└── public_html/           ← This is your website root (web accessible)
    ├── .htaccess          ← From project: public/.htaccess
    ├── index.php          ← From project: public/index.php
    ├── assets/            ← From project: public/assets/
    │   ├── css/
    │   ├── js/
    │   ├── images/
    │   └── webfonts/
    └── uploads/           ← From project: public/uploads/
        ├── products/
        ├── cakes/
        ├── gallery/
        └── blog/
```

---

## 📁 What Goes Where (Mapping)

| Local Project Folder/File | Upload To (On Hostinger) |
|--------------------------|--------------------------|
| `app/` | `/home/u.../app/` |
| `config/` | `/home/u.../config/` |
| `database/` | `/home/u.../database/` |
| `storage/` | `/home/u.../storage/` |
| `public/index.php` | `/home/u.../public_html/index.php` |
| `public/.htaccess` | `/home/u.../public_html/.htaccess` |
| `public/assets/` | `/home/u.../public_html/assets/` |
| `public/uploads/` | `/home/u.../public_html/uploads/` |

> ⚠️ **Do NOT upload the `CSS Ref/` folder or `.git/` folder.**

---

## 🗄️ Step 1 — Create MySQL Database

1. Login to **Hostinger hPanel** → **Databases** → **MySQL Databases**
2. Create a new database: `adils_kitchen`
3. Create a new DB user and set a strong password
4. Assign the user to the database with **ALL privileges**
5. Note down: **host**, **db name**, **username**, **password**

---

## ⚙️ Step 2 — Update Database Credentials

Edit `config/database.php` before uploading:

```php
return [
    'host'     => 'localhost',           // Hostinger MySQL host (usually localhost)
    'database' => 'u123456789_kitchen',  // Your database name from hPanel
    'username' => 'u123456789_admin',    // Your DB username
    'password' => 'YourStrongPass123!',  // Your DB password
    'charset'  => 'utf8mb4',
    // ... rest stays the same
];
```

---

## 📤 Step 3 — Upload via FTP / File Manager

### Option A: Hostinger File Manager (easy)
1. Go to hPanel → **File Manager**
2. Navigate to `/home/u.../`
3. Create folders: `app`, `config`, `database`, `storage`, `storage/logs`, `storage/invoices`
4. Upload all files as per the mapping table above
5. Upload `public/index.php` and `public/.htaccess` into `public_html/`
6. Upload `public/assets/` folder into `public_html/assets/`
7. Upload `public/uploads/` folder into `public_html/uploads/`

### Option B: FTP (FileZilla recommended)
1. Get FTP credentials from hPanel → **FTP Accounts**
2. Connect with FileZilla
3. Upload per the structure above

---

## 🏗️ Step 4 — Import Database Schema

1. Go to hPanel → **Databases** → **phpMyAdmin**
2. Select your `adils_kitchen` database
3. Click **Import** tab
4. Choose file: `database/schema.sql`
5. Click **Go** → Wait for success
6. *(Optional)* Import `database/seeder.sql` for demo data

---

## 🔐 Step 5 — Set Folder Permissions

Via File Manager or FTP, set these permissions:

| Path | Permission |
|------|-----------|
| `public_html/uploads/products/` | `755` |
| `public_html/uploads/cakes/` | `755` |
| `public_html/uploads/gallery/` | `755` |
| `public_html/uploads/blog/` | `755` |
| `/home/u.../storage/logs/` | `755` |
| `/home/u.../storage/invoices/` | `755` |

---

## ✅ Step 6 — Verify Installation

Open your browser and visit your domain:

| Page | URL |
|------|-----|
| Homepage | `https://yourdomain.com/` |
| Shop | `https://yourdomain.com/shop` |
| Custom Cake | `https://yourdomain.com/custom-cake` |
| Admin Login | `https://yourdomain.com/admin/login` |

**Admin Credentials (change after first login):**
- Email: `admin@adilskitchen.com`
- Password: `admin123`

---

## 🛠️ Troubleshooting

| Problem | Solution |
|---------|----------|
| Blank white page | Enable error logging in `config/app.php`, check `storage/logs/error.log` |
| 404 on all pages | Check `.htaccess` in `public_html/` is uploaded; confirm mod_rewrite is enabled |
| 500 Server Error | Check PHP version ≥ 8.0 in hPanel → PHP Configuration |
| Can't connect to DB | Double-check `config/database.php` credentials match hPanel DB |
| Images not showing | Verify `public_html/assets/images/` was uploaded correctly |
| CSS/JS not loading | Check browser console (F12) for 404 errors on asset URLs |

---

## 📞 WhatsApp Order Link
The site uses: `https://wa.me/8801303721109`

Update in `config/app.php`:
```php
'whatsapp' => '8801303721109',
```
