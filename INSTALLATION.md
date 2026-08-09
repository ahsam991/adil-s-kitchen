# Installation & Deployment Guide - Hostinger / cPanel

Follow this guide to deploy **Adil's Signature Kitchen** on Shared Hosting (Hostinger, cPanel, or Local XAMPP/WAMP).

---

## 📋 System Requirements

- **PHP**: 8.1 or PHP 8.3+
- **MySQL**: 8.0+ / MariaDB 10.4+
- **Apache Extensions**: `mod_rewrite`, `pdo_mysql`, `gd` / `fileinfo`

---

## 🛠 Step 1: Database Setup (phpMyAdmin)

1. Log in to your hosting cPanel or Hostinger hPanel.
2. Go to **MySQL Databases** and create a new database named `adils_kitchen`.
3. Create a database user and assign all privileges to `adils_kitchen`.
4. Open **phpMyAdmin**, select `adils_kitchen`.
5. Click **Import**, upload `database/schema.sql`, and execute.
6. Click **Import** again, upload `database/seeder.sql`, and execute.

---

## 📁 Step 2: Upload Project Files

1. Compress the project files into a `.zip` archive.
2. Open cPanel **File Manager** (or Hostinger File Manager).
3. Upload all files into your domain's root directory (`public_html`).
4. Ensure `.htaccess` in both root and `/public` directories are uploaded.

---

## ⚙️ Step 3: Configure Database Connection

Open `config/database.php` and set your credentials:

```php
return [
    'host' => 'localhost',
    'database' => 'your_db_name',
    'username' => 'your_db_user',
    'password' => 'your_db_password',
    'charset' => 'utf8mb4',
];
```

---

## 🔑 Step 4: Login Credentials

### Admin Dashboard Login
- **URL**: `https://yourdomain.com/admin/login`
- **Email**: `admin@adilskitchen.com`
- **Password**: `admin123`

---

## 🔒 Step 5: Directory Permissions

Ensure write permissions (755 or 777) for the following folders:
- `/storage/logs`
- `/storage/invoices`
- `/public/uploads/products`
- `/public/uploads/cakes`
- `/public/uploads/gallery`
- `/public/uploads/blog`
