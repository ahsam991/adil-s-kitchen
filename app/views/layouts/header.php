<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? "Adil's Signature Kitchen - Homemade With Love") ?></title>
    <meta name="description" content="Homemade Cakes, Desserts, Fast Food, Bakery, Custom Cake Orders in Dhaka. Homemade With Love.">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=Poppins:wght@300;400;500;600;700&family=Noto+Sans+Bengali:wght@400;600;700&family=Dancing+Script:wght@700&display=swap" rel="stylesheet"/>
    
    <!-- Bootstrap 5.3 -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet"/>
    <!-- AOS Animate on Scroll -->
    <link href="/assets/css/aos.css" rel="stylesheet"/>
    <!-- Swiper Carousel -->
    <link href="/assets/css/swiper-bundle.min.css" rel="stylesheet"/>
    <!-- FontAwesome 6 / Icon Fonts -->
    <link rel="stylesheet" href="/assets/css/all.min.css"/>
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="/assets/css/magnific-popup.css"/>
    <!-- Premium Sarab Style CSS -->
    <link rel="stylesheet" href="/assets/css/style.css"/>

    <style>
        :root {
            --primary: #6A1B2E;
            --primary-hover: #521323;
            --secondary: #D4A373;
            --secondary-hover: #b88656;
            --dark: #1A1A1A;
            --cream: #F8F3EE;
        }
        .blogo .bico { background: var(--primary) !important; color: #fff !important; }
        .blogo .bname span { color: var(--secondary) !important; }
        .btn-red { background: var(--primary) !important; border-color: var(--primary) !important; }
        .btn-red:hover { background: var(--primary-hover) !important; }
        .hbadge { background: rgba(106, 27, 46, 0.08) !important; color: var(--primary) !important; }
        .hbadge .hbi { background: var(--primary) !important; color: #fff !important; }
        .hl { color: var(--primary) !important; }
        .ttag { background: var(--primary) !important; }
    </style>
</head>
<body>

<!-- TOP BAR -->
<div id="topbar">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div class="top-contact d-flex flex-wrap">
                <span><i class="fas fa-phone-alt"></i><a href="https://wa.me/8801303721109" target="_blank" class="text-white-50">01303721109</a></span>
                <span><i class="fab fa-whatsapp"></i><a href="https://wa.me/8801303721109" target="_blank" class="text-white-50">WhatsApp Order</a></span>
                <span><i class="fas fa-map-marker-alt"></i>Dhaka, Bangladesh</span>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="ttag"><i class="fas fa-heart me-1"></i>"Homemade With Love"</span>
                <div class="tsoc">
                    <a href="https://facebook.com/adilskitchen" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://instagram.com/adilskitchen" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="/order-tracking" title="Track Order"><i class="fas fa-truck text-white"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg" id="nav">
    <div class="container">
        <a class="navbar-brand" href="/">
            <div class="blogo">
                <div class="bico"><i class="fas fa-birthday-cake"></i></div>
                <div>
                    <div class="bname">Adil's <span>Kitchen</span></div>
                    <div class="bsub">Homemade Bakery & Fast Food</div>
                </div>
            </div>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
            <i class="fas fa-bars" style="color:var(--primary);font-size:1.35rem;"></i>
        </button>

        <div class="collapse navbar-collapse" id="navmenu">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/shop">Shop Menu</a></li>
                <li class="nav-item"><a class="nav-link fw-bold text-danger" href="/custom-cake"><i class="fas fa-birthday-cake me-1"></i>Custom Cake</a></li>
                <li class="nav-item"><a class="nav-link" href="/gallery">Gallery</a></li>
                <li class="nav-item"><a class="nav-link" href="/blog">Blog</a></li>
                <li class="nav-item"><a class="nav-link" href="/about">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
            </ul>

            <div class="d-flex align-items-center gap-3">
                <a href="/wishlist" class="fs-5 text-dark position-relative" title="Wishlist">
                    <i class="far fa-heart"></i>
                </a>
                <a href="/cart" class="nav-link nav-cta btn-red"><i class="fas fa-shopping-bag me-1"></i>Cart</a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="/my-account" class="btn btn-outline-danger btn-sm rounded-pill"><i class="fas fa-user me-1"></i>Account</a>
                <?php else: ?>
                    <a href="/login" class="btn btn-outline-dark btn-sm rounded-pill"><i class="fas fa-sign-in-alt me-1"></i>Login</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
