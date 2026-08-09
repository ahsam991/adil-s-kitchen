# Adil's Signature Kitchen - E-Commerce & Admin Platform

> **"Homemade With Love"**  
> A Commercial-Grade Pure PHP MVC E-Commerce Website & Admin Management System built for Adil's Signature Kitchen.

---

## 🌟 Project Overview

**Adil's Signature Kitchen** is a high-performance commercial bakery and e-commerce platform designed for homemade cakes, desserts, fast food (burgers, rolls, samusas), and custom cake orders.

The application follows strict pure **PHP 8.3+ MVC (Model-View-Controller)** architecture, avoiding bloated frameworks so it runs at lightning speed on any Shared Hosting (Hostinger / cPanel / Apache / Nginx) using MySQL/phpMyAdmin.

---

## 🏗 Project Architecture & Structure

```
c:\Users\V2\Downloads\Adil's Kitchen\
├── .htaccess                 # Apache root rewrite & security headers
├── .gitignore                # Environment & storage ignores
├── README.md                 # Complete system documentation
├── INSTALLATION.md           # Step-by-step deployment guide for Hostinger/cPanel
├── ER_DIAGRAM.md             # Complete Database Entity Relationship documentation
│
├── config/
│   ├── app.php               # Application, session & delivery settings
│   └── database.php          # Database PDO connection config
│
├── database/
│   ├── schema.sql            # MySQL 8+ Schema with 22 tables
│   └── seeder.sql            # Realistic seed data for bakery products & admin
│
├── storage/
│   ├── logs/                 # System error logs
│   └── invoices/             # PDF / HTML order invoices
│
├── public/
│   ├── index.php             # Front Controller & main entry point
│   ├── .htaccess             # Public folder rewrite rules
│   ├── assets/
│   │   ├── css/style.css     # Luxury bakery custom stylesheet
│   │   └── js/main.js        # Dynamic AJAX cart, wishlist & cake estimator
│   └── uploads/
│       ├── products/         # Product catalog images
│       ├── cakes/            # Custom cake upload references
│       ├── gallery/          # Bakery gallery photos
│       └── blog/             # Article cover photos
│
└── app/
    ├── core/                 # Core framework engine
    │   ├── Controller.php    # Base Controller with CSRF & view renderer
    │   ├── Database.php      # PDO Singleton Connection manager
    │   ├── Model.php         # Base Model with Repository/CRUD helper
    │   └── Router.php        # Pattern matching URI Router
    │
    ├── models/               # Application Models (User, Product, Order, etc.)
    ├── repositories/         # Repository pattern classes
    ├── services/             # Service layer (Auth, Cart, Order, CustomCake)
    ├── middleware/           # Auth, Admin & CSRF security middleware
    │
    ├── controllers/          # Customer-facing controllers
    │   └── Admin/            # Admin Panel controllers
    │
    └── views/                # Modular view templates
        ├── layouts/          # Header, Footer, Base Layouts
        ├── customer/         # 18 Customer web pages
        └── admin/            # Admin Panel views
```

---

## 🎨 Key Features & Modules

### 1. Customer Website
- **Home Page**: Hero banner, featured categories, best sellers, customer reviews, custom cake callout.
- **Shop & Filtering**: Product grid with category filtering, price sorting, and instant search.
- **Product Details**: Product gallery, variation selection (weight/flavor), customer ratings and reviews.
- **Custom Cake Designer**: Interactive builder (Shape, Flavor, Weight, Cream, Decoration, Reference photo upload, Delivery date, Live cost estimation).
- **Shopping Cart**: Dynamic AJAX add/update/remove, coupon discount code support, delivery charge calculation.
- **Checkout & Payment**: Guest & registered checkout, Cash on Delivery, bKash, Nagad, Rocket, Bank Transfer.
- **Live Order Tracking**: Instant tracking by Order Number (`ASK-2026xxxx-xxxx`).
- **Customer Account**: Profile management, order history, address book, password change.

### 2. Admin Management System
- **Secure Admin Dashboard**: Today's orders & revenue, monthly revenue, pending orders, recent customer orders.
- **Order Management**: Order timeline tracking, status update (Pending -> Confirmed -> Preparing -> Ready -> Out For Delivery -> Delivered), printable PDF-style invoices.
- **Product & Category CRUD**: Complete product management with image upload, sale prices, inventory stock.
- **Inventory & Ingredients Tracker**: Manage raw ingredients (Cake flour, butter, sugar, cream, chocolate) with low-stock alerts.
- **Review Moderation**: Approve or reject customer product reviews.
- **Coupon Management**: Percentage and fixed discount codes with expiration dates and usage limits.
- **Gallery & Blog CRUD**: Upload cake gallery photos and publish baking articles.
- **Analytics & Reports**: Daily/Monthly sales reports, top selling products report.
- **Store Settings**: Edit store name, phone, WhatsApp hotline, address, and delivery charges.

---

## 🔐 Security Features

- **Session Hardening**: HTTP-only, SameSite Lax session cookies.
- **CSRF Protection**: Form token validation on all POST requests.
- **SQL Injection Prevention**: PDO Prepared Statements throughout the application.
- **XSS Protection**: HTML escaping on input sanitization.
- **Password Security**: BCRYPT password hashing using `password_hash()`.

---

## 📞 Support & Contact

- **Phone / WhatsApp**: 01303721109
- **Email**: info@adilskitchen.com
- **Brand Tagline**: "Homemade With Love"
