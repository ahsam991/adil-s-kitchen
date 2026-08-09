# Adil's Signature Kitchen 🍰

A custom-built, lightweight PHP E-Commerce platform designed specifically for Adil's Signature Kitchen. 

## 🚀 Features
* **Custom MVC Architecture:** Built from scratch using native PHP.
* **Customer Dashboard:** Order tracking, cart management, and wishlist.
* **Admin Panel:** Complete management of products, categories, users, and orders.
* **Optimized for Shared Hosting:** Designed with a flat structure for seamless deployment directly into Hostinger's `public_html` directory.
* **Automated Testing:** PHPUnit integration for reliable code (Unit and Integration tests).

## 🛠️ Tech Stack
* **Backend:** PHP 8+
* **Frontend:** HTML5, CSS3, JavaScript (Bootstrap 5, Swiper, AOS, Magnific Popup)
* **Database:** MySQL 8+
* **Testing:** PHPUnit (Composer required)

## 📦 Local Setup

1. **Clone the repository:**
   ```bash
   git clone https://github.com/ahsam991/adil-s-kitchen.git
   cd adil-s-kitchen
   ```

2. **Database Configuration:**
   * Create a local MySQL database.
   * Duplicate `config/env.php.example` to `config/env.php` (or configure your own credentials).
   * Import the latest SQL dump (from `database/install_database.sql`).

3. **Install Testing Dependencies (Optional):**
   ```bash
   composer install
   ```

4. **Run the local server:**
   You can serve the project using XAMPP, or directly via PHP's built-in server:
   ```bash
   php -S localhost:8000
   ```

## 🌐 Deployment (Hostinger)
This project is configured with a "flat" structure. 
1. Upload **ALL** files directly into your `public_html/` folder on Hostinger.
2. Edit `config/env.php` to match your Hostinger database credentials.
3. Import your database into Hostinger's phpMyAdmin.

---
*Built with ❤️ for Adil's Signature Kitchen.*
