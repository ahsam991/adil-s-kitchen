-- =================================================
-- ADIL'S SIGNATURE KITCHEN - DATABASE SEEDER
-- MySQL 8+ Compatible Seed Data
-- =================================================

USE `adils_kitchen`;

-- Seed Roles
INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'super_admin', 'Super Administrator with full permissions'),
(2, 'admin', 'Store Administrator'),
(3, 'customer', 'Registered Customer');

-- Seed Admin User (Password: admin123)
INSERT INTO `users` (`id`, `email`, `password`, `first_name`, `last_name`, `phone`, `is_active`) VALUES
(1, 'admin@adilskitchen.com', '$2y$10$C0np3KFKF.eumGvCPIhOyuXSwKNEY59T90veTurjSu5ptyIIruYg2', 'Adil', 'Admin', '01303721109', 1);

INSERT INTO `user_roles` (`user_id`, `role_id`) VALUES (1, 1);

-- Seed Categories
INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `image`, `sort_order`) VALUES
(1, 'Cake', 'cake', 'Delicious homemade birthday, celebration and tiered cakes', '/assets/images/categories/cake.jpg', 1),
(2, 'Cup Cake', 'cup-cake', 'Soft and creamy frosted bite-sized cupcakes', '/assets/images/categories/cupcake.jpg', 2),
(3, 'Tub Cake', 'tub-cake', 'Rich dessert tubs layered with fresh cream and flavors', '/assets/images/categories/tubcake.jpg', 3),
(4, 'Dream Cake', 'dream-cake', '5-Layer viral chocolate dream cakes', '/assets/images/categories/dreamcake.jpg', 4),
(5, 'Burger', 'burger', 'Juicy homemade chicken & beef burgers', '/assets/images/categories/burger.jpg', 5),
(6, 'Roll', 'roll', 'Crispy chicken roll and savory wraps', '/assets/images/categories/roll.jpg', 6),
(7, 'Samusa', 'samusa', 'Golden crispy chicken & beef samusa', '/assets/images/categories/samusa.jpg', 7);

-- Seed Products
INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `sku`, `short_description`, `description`, `price`, `sale_price`, `stock`, `weight`, `image`, `featured`, `best_seller`, `status`) VALUES
(1, 1, 'Royal Chocolate Fudge Cake', 'royal-chocolate-fudge-cake', 'CAKE-001', 'Rich dark chocolate cake layered with Belgian chocolate ganache.', 'Indulge in our signature Royal Chocolate Fudge Cake. Baked fresh with premium cocoa, layered with luscious Belgian dark chocolate ganache, and decorated with chocolate curls.', 1200.00, 1100.00, 15, '1 Kg', '/assets/images/products/chocolate-cake.jpg', 1, 1, 'active'),
(2, 1, 'Vanilla Strawberry Delight Cake', 'vanilla-strawberry-delight-cake', 'CAKE-002', 'Soft vanilla sponge cake with fresh strawberry cream layer.', 'Light and airy vanilla sponge cake layered with real strawberry compote and whipped cream frosting.', 1050.00, NULL, 10, '1 Kg', '/assets/images/products/strawberry-cake.jpg', 1, 0, 'active'),
(3, 2, 'Red Velvet Cream Cheese Cupcake (6 Pcs)', 'red-velvet-cream-cheese-cupcake-6-pcs', 'CUP-001', 'Classic red velvet cupcakes topped with rich cream cheese frosting.', 'Set of 6 handcrafted Red Velvet cupcakes made with pure butter and cocoa, topped with silky cream cheese frosting.', 450.00, 420.00, 25, '500g', '/assets/images/products/red-velvet-cupcake.jpg', 1, 1, 'active'),
(4, 3, 'Mango Mousse Tub Cake', 'mango-mousse-tub-cake', 'TUB-001', 'Seasonal fresh mango mousse layered cake tub.', 'Creamy tropical mango mousse, soft vanilla sponge, and fresh mango puree in an elegant tub container.', 350.00, NULL, 30, '350g', '/assets/images/products/mango-tub.jpg', 0, 1, 'active'),
(5, 4, '5-Layer Belgian Chocolate Dream Cake', '5-layer-belgian-chocolate-dream-cake', 'DREAM-001', 'The iconic 5-layer chocolate shell dream cake.', 'Layer 1: Chocolate Sponge. Layer 2: Chocolate Mousse. Layer 3: Milk Chocolate Ganache. Layer 4: Hard Chocolate Crack Shell. Layer 5: Dusting Cocoa Powder.', 950.00, 890.00, 20, '750g', '/assets/images/products/dream-cake.jpg', 1, 1, 'active'),
(6, 5, 'Special Loaded Chicken Burger', 'special-loaded-chicken-burger', 'BURG-001', 'Crispy chicken patty with cheese and signature secret sauce.', 'Handcrafted crispy fried chicken breast, melted cheddar cheese, fresh lettuce, tomatoes, and secret Adil sauce in a toasted brioche bun.', 220.00, NULL, 50, '250g', '/assets/images/products/chicken-burger.jpg', 1, 1, 'active'),
(7, 6, 'Crispy Chicken Roll (4 Pcs)', 'crispy-chicken-roll-4-pcs', 'ROLL-001', 'Golden crispy chicken rolls stuffed with spiced chicken filing.', '4 pieces of golden fried egg rolls stuffed with minced chicken, garlic, and freshly ground spices.', 180.00, NULL, 40, '300g', '/assets/images/products/chicken-roll.jpg', 0, 1, 'active'),
(8, 7, 'Special Chicken Samusa (6 Pcs)', 'special-chicken-samusa-6-pcs', 'SAM-001', 'Crispy triangular samusa filled with seasoned minced chicken.', '6 pieces of golden crunchy samusas packed with flavorful chicken stuffing and herbs.', 150.00, NULL, 50, '300g', '/assets/images/products/samusa.jpg', 0, 1, 'active');

-- Seed Coupons
INSERT INTO `coupons` (`code`, `type`, `value`, `min_purchase`, `expiry_date`, `usage_limit`) VALUES
('WELCOME10', 'percentage', 10.00, 500.00, '2026-12-31', 500),
('FREESHIP', 'fixed', 60.00, 1000.00, '2026-12-31', 200);

-- Seed Testimonials
INSERT INTO `testimonials` (`name`, `role`, `comment`, `rating`) VALUES
('Nusrat Jahan', 'Verified Customer', 'The Dream Cake from Adil\'s Signature Kitchen was mind blowing! So rich and fresh. 10/10 recommend!', 5),
('Tanvir Ahmed', 'Regular Buyer', 'Ordered a custom cake for my daughter\'s birthday. It was beautifully crafted and tasted delicious.', 5),
('Farhana Islam', 'Foodie', 'Best homemade samusa and burgers in Dhaka. Super hygienic and crispy!', 5);

-- Seed Inventory
INSERT INTO `inventory` (`item_name`, `unit`, `current_stock`, `alert_stock`) VALUES
('Cake Flour', 'Kg', 150.00, 20.00),
('Refined Sugar', 'Kg', 100.00, 15.00),
('Unsalted Butter', 'Kg', 50.00, 10.00),
('Heavy Cream', 'Liter', 40.00, 8.00),
('Belgian Chocolate', 'Kg', 30.00, 5.00),
('Fresh Milk', 'Liter', 60.00, 10.00);

-- Seed Settings
INSERT INTO `settings` (`setting_key`, `setting_value`) VALUES
('store_name', 'Adil\'s Signature Kitchen'),
('store_tagline', 'Homemade With Love'),
('store_phone', '01303721109'),
('store_whatsapp', '01303721109'),
('store_email', 'info@adilskitchen.com'),
('store_address', 'Dhaka, Bangladesh'),
('currency', 'BDT'),
('currency_symbol', '৳'),
('delivery_fee', '60'),
('free_delivery_threshold', '1500');
