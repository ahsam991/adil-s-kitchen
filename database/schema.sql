-- =================================================
-- ADIL'S SIGNATURE KITCHEN - DATABASE SCHEMA
-- MySQL 8+ Compatible
-- =================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+06:00";

CREATE DATABASE IF NOT EXISTS `adils_kitchen` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `adils_kitchen`;

-- =================================================
-- ROLES AND PERMISSIONS
-- =================================================

CREATE TABLE `roles` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL UNIQUE,
    `description` TEXT,
    `created_by` BIGINT UNSIGNED DEFAULT NULL,
    `updated_by` BIGINT UNSIGNED DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`),
    KEY `idx_roles_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `permissions` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL UNIQUE,
    `description` TEXT,
    `created_by` BIGINT UNSIGNED DEFAULT NULL,
    `updated_by` BIGINT UNSIGNED DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`),
    KEY `idx_permissions_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `role_permissions` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `role_id` BIGINT UNSIGNED NOT NULL,
    `permission_id` BIGINT UNSIGNED NOT NULL,
    `created_by` BIGINT UNSIGNED DEFAULT NULL,
    `updated_by` BIGINT UNSIGNED DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`permission_id`) REFERENCES `permissions`(`id`) ON DELETE CASCADE,
    UNIQUE KEY `unique_role_permission` (`role_id`, `permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =================================================
-- USERS
-- =================================================

CREATE TABLE `users` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `first_name` VARCHAR(100),
    `last_name` VARCHAR(100),
    `phone` VARCHAR(20),
    `profile_image` VARCHAR(255),
    `remember_token` VARCHAR(255),
    `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
    `created_by` BIGINT UNSIGNED DEFAULT NULL,
    `updated_by` BIGINT UNSIGNED DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`),
    KEY `idx_users_email` (`email`),
    KEY `idx_users_phone` (`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `user_roles` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` BIGINT UNSIGNED NOT NULL,
    `role_id` BIGINT UNSIGNED NOT NULL,
    `created_by` BIGINT UNSIGNED DEFAULT NULL,
    `updated_by` BIGINT UNSIGNED DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`) ON DELETE CASCADE,
    UNIQUE KEY `unique_user_role` (`user_id`, `role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =================================================
-- CUSTOMERS
-- =================================================

CREATE TABLE `customers` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` BIGINT UNSIGNED DEFAULT NULL,
    `first_name` VARCHAR(100) NOT NULL,
    `last_name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `phone` VARCHAR(20) NOT NULL,
    `total_orders` INT UNSIGNED DEFAULT 0,
    `total_spent` DECIMAL(10,2) DEFAULT 0.00,
    `notes` TEXT,
    `created_by` BIGINT UNSIGNED DEFAULT NULL,
    `updated_by` BIGINT UNSIGNED DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL,
    KEY `idx_customers_email` (`email`),
    KEY `idx_customers_phone` (`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `addresses` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `customer_id` BIGINT UNSIGNED NOT NULL,
    `type` ENUM('shipping', 'billing', 'both') DEFAULT 'shipping',
    `address_line1` VARCHAR(255) NOT NULL,
    `address_line2` VARCHAR(255),
    `city` VARCHAR(100) NOT NULL,
    `state` VARCHAR(100),
    `postal_code` VARCHAR(20),
    `country` VARCHAR(100) DEFAULT 'Bangladesh',
    `is_default` TINYINT(1) DEFAULT 0,
    `created_by` BIGINT UNSIGNED DEFAULT NULL,
    `updated_by` BIGINT UNSIGNED DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`customer_id`) REFERENCES `customers`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =================================================
-- CATEGORIES & PRODUCTS
-- =================================================

CREATE TABLE `categories` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `slug` VARCHAR(100) NOT NULL UNIQUE,
    `description` TEXT,
    `image` VARCHAR(255),
    `sort_order` INT DEFAULT 0,
    `created_by` BIGINT UNSIGNED DEFAULT NULL,
    `updated_by` BIGINT UNSIGNED DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`),
    KEY `idx_categories_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `products` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `category_id` BIGINT UNSIGNED NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `sku` VARCHAR(100) UNIQUE,
    `short_description` TEXT,
    `description` LONGTEXT,
    `price` DECIMAL(10,2) NOT NULL,
    `sale_price` DECIMAL(10,2) DEFAULT NULL,
    `stock` INT DEFAULT 0,
    `weight` VARCHAR(50),
    `image` VARCHAR(255),
    `featured` TINYINT(1) DEFAULT 0,
    `best_seller` TINYINT(1) DEFAULT 0,
    `status` ENUM('active', 'inactive', 'out_of_stock') DEFAULT 'active',
    `seo_title` VARCHAR(255),
    `seo_description` TEXT,
    `created_by` BIGINT UNSIGNED DEFAULT NULL,
    `updated_by` BIGINT UNSIGNED DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE CASCADE,
    KEY `idx_products_slug` (`slug`),
    KEY `idx_products_category` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `product_images` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `product_id` BIGINT UNSIGNED NOT NULL,
    `image_path` VARCHAR(255) NOT NULL,
    `sort_order` INT DEFAULT 0,
    `created_by` BIGINT UNSIGNED DEFAULT NULL,
    `updated_by` BIGINT UNSIGNED DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =================================================
-- CARTS & WISHLISTS
-- =================================================

CREATE TABLE `carts` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `customer_id` BIGINT UNSIGNED DEFAULT NULL,
    `session_id` VARCHAR(255) NOT NULL,
    `created_by` BIGINT UNSIGNED DEFAULT NULL,
    `updated_by` BIGINT UNSIGNED DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`customer_id`) REFERENCES `customers`(`id`) ON DELETE SET NULL,
    KEY `idx_carts_session` (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `cart_items` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `cart_id` BIGINT UNSIGNED NOT NULL,
    `product_id` BIGINT UNSIGNED NOT NULL,
    `quantity` INT UNSIGNED NOT NULL DEFAULT 1,
    `price` DECIMAL(10,2) NOT NULL,
    `options` JSON DEFAULT NULL,
    `created_by` BIGINT UNSIGNED DEFAULT NULL,
    `updated_by` BIGINT UNSIGNED DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`cart_id`) REFERENCES `carts`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `wishlists` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `customer_id` BIGINT UNSIGNED NOT NULL,
    `product_id` BIGINT UNSIGNED NOT NULL,
    `created_by` BIGINT UNSIGNED DEFAULT NULL,
    `updated_by` BIGINT UNSIGNED DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`customer_id`) REFERENCES `customers`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE,
    UNIQUE KEY `unique_customer_product` (`customer_id`, `product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =================================================
-- ORDERS & CUSTOM CAKES
-- =================================================

CREATE TABLE `orders` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `order_number` VARCHAR(50) NOT NULL UNIQUE,
    `customer_id` BIGINT UNSIGNED DEFAULT NULL,
    `customer_name` VARCHAR(200) NOT NULL,
    `customer_email` VARCHAR(255) NOT NULL,
    `customer_phone` VARCHAR(20) NOT NULL,
    `shipping_address` TEXT NOT NULL,
    `subtotal` DECIMAL(10,2) NOT NULL,
    `delivery_charge` DECIMAL(10,2) DEFAULT 60.00,
    `discount_amount` DECIMAL(10,2) DEFAULT 0.00,
    `total_amount` DECIMAL(10,2) NOT NULL,
    `payment_method` ENUM('cod', 'bkash', 'nagad', 'rocket', 'bank_transfer') NOT NULL DEFAULT 'cod',
    `payment_status` ENUM('pending', 'paid', 'failed') DEFAULT 'pending',
    `transaction_id` VARCHAR(100) DEFAULT NULL,
    `order_status` ENUM('pending', 'confirmed', 'preparing', 'ready', 'out_for_delivery', 'delivered', 'cancelled', 'returned') DEFAULT 'pending',
    `notes` TEXT,
    `created_by` BIGINT UNSIGNED DEFAULT NULL,
    `updated_by` BIGINT UNSIGNED DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`customer_id`) REFERENCES `customers`(`id`) ON DELETE SET NULL,
    KEY `idx_orders_number` (`order_number`),
    KEY `idx_orders_status` (`order_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `order_items` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `order_id` BIGINT UNSIGNED NOT NULL,
    `product_id` BIGINT UNSIGNED DEFAULT NULL,
    `product_name` VARCHAR(255) NOT NULL,
    `quantity` INT UNSIGNED NOT NULL,
    `price` DECIMAL(10,2) NOT NULL,
    `total` DECIMAL(10,2) NOT NULL,
    `options` JSON DEFAULT NULL,
    `created_by` BIGINT UNSIGNED DEFAULT NULL,
    `updated_by` BIGINT UNSIGNED DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `custom_cakes` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `customer_name` VARCHAR(200) NOT NULL,
    `customer_email` VARCHAR(255) NOT NULL,
    `customer_phone` VARCHAR(20) NOT NULL,
    `shape` VARCHAR(100) NOT NULL,
    `flavor` VARCHAR(100) NOT NULL,
    `weight` VARCHAR(50) NOT NULL,
    `cream_type` VARCHAR(100) NOT NULL,
    `decoration` VARCHAR(255),
    `photo` VARCHAR(255),
    `occasion` VARCHAR(100),
    `cake_message` TEXT,
    `delivery_date` DATE NOT NULL,
    `budget` DECIMAL(10,2),
    `notes` TEXT,
    `status` ENUM('pending', 'quoted', 'accepted', 'in_progress', 'completed', 'cancelled') DEFAULT 'pending',
    `created_by` BIGINT UNSIGNED DEFAULT NULL,
    `updated_by` BIGINT UNSIGNED DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =================================================
-- INVENTORY, REVIEWS, COUPONS & BLOG
-- =================================================

CREATE TABLE `inventory` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `item_name` VARCHAR(100) NOT NULL,
    `unit` VARCHAR(20) NOT NULL,
    `current_stock` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    `alert_stock` DECIMAL(10,2) NOT NULL DEFAULT 10.00,
    `created_by` BIGINT UNSIGNED DEFAULT NULL,
    `updated_by` BIGINT UNSIGNED DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `inventory_logs` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `inventory_id` BIGINT UNSIGNED NOT NULL,
    `type` ENUM('in', 'out') NOT NULL,
    `quantity` DECIMAL(10,2) NOT NULL,
    `notes` TEXT,
    `created_by` BIGINT UNSIGNED DEFAULT NULL,
    `updated_by` BIGINT UNSIGNED DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`inventory_id`) REFERENCES `inventory`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `reviews` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `product_id` BIGINT UNSIGNED NOT NULL,
    `customer_name` VARCHAR(100) NOT NULL,
    `customer_email` VARCHAR(255) NOT NULL,
    `rating` TINYINT UNSIGNED NOT NULL DEFAULT 5,
    `comment` TEXT,
    `admin_reply` TEXT,
    `status` ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    `created_by` BIGINT UNSIGNED DEFAULT NULL,
    `updated_by` BIGINT UNSIGNED DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `coupons` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `code` VARCHAR(50) NOT NULL UNIQUE,
    `type` ENUM('percentage', 'fixed') NOT NULL DEFAULT 'percentage',
    `value` DECIMAL(10,2) NOT NULL,
    `min_purchase` DECIMAL(10,2) DEFAULT 0.00,
    `expiry_date` DATE NOT NULL,
    `usage_limit` INT DEFAULT 100,
    `used_count` INT DEFAULT 0,
    `created_by` BIGINT UNSIGNED DEFAULT NULL,
    `updated_by` BIGINT UNSIGNED DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `blogs` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL UNIQUE,
    `content` LONGTEXT NOT NULL,
    `image` VARCHAR(255),
    `status` ENUM('draft', 'published') DEFAULT 'published',
    `published_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `created_by` BIGINT UNSIGNED DEFAULT NULL,
    `updated_by` BIGINT UNSIGNED DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `gallery` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(150),
    `image` VARCHAR(255) NOT NULL,
    `category` VARCHAR(50) DEFAULT 'general',
    `featured` TINYINT(1) DEFAULT 0,
    `sort_order` INT DEFAULT 0,
    `created_by` BIGINT UNSIGNED DEFAULT NULL,
    `updated_by` BIGINT UNSIGNED DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `testimonials` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `role` VARCHAR(100) DEFAULT 'Happy Customer',
    `comment` TEXT NOT NULL,
    `rating` TINYINT DEFAULT 5,
    `avatar` VARCHAR(255),
    `featured` TINYINT(1) DEFAULT 1,
    `status` ENUM('pending', 'approved') DEFAULT 'approved',
    `sort_order` INT DEFAULT 0,
    `created_by` BIGINT UNSIGNED DEFAULT NULL,
    `updated_by` BIGINT UNSIGNED DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `contact_messages` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `phone` VARCHAR(20),
    `subject` VARCHAR(255),
    `message` TEXT NOT NULL,
    `status` ENUM('unread', 'read', 'replied') DEFAULT 'unread',
    `created_by` BIGINT UNSIGNED DEFAULT NULL,
    `updated_by` BIGINT UNSIGNED DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `settings` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `setting_key` VARCHAR(100) NOT NULL UNIQUE,
    `setting_value` LONGTEXT,
    `created_by` BIGINT UNSIGNED DEFAULT NULL,
    `updated_by` BIGINT UNSIGNED DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

COMMIT;
