<!DOCTYPE html>
<html lang="en-BD" prefix="og: https://ogp.me/ns#">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">

    <!-- ═══════════════════════════════════════════════
         PRIMARY SEO META TAGS
         ═══════════════════════════════════════════════ -->
    <title><?= htmlspecialchars($seoTitle ?? $pageTitle ?? "Adil's Signature Kitchen | Homemade Cakes & Fast Food Dhaka") ?></title>
    <meta name="description" content="<?= htmlspecialchars($metaDescription ?? "Order fresh homemade cakes, custom birthday cakes, dream cakes, cupcakes, burgers & rolls from Adil's Signature Kitchen. Delivered in Dhaka, Bangladesh. Call 01303721109") ?>">
    <meta name="keywords" content="<?= htmlspecialchars($metaKeywords ?? "homemade cake Dhaka, birthday cake Bangladesh, dream cake, custom cake order, cupcake delivery Dhaka, Adil's Kitchen, burger roll samusa Bangladesh") ?>">
    <meta name="author" content="Adil's Signature Kitchen">
    <meta name="robots" content="<?= $noIndex ?? 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' ?>">
    <meta name="googlebot" content="index, follow">
    <meta name="revisit-after" content="3 days">
    <meta name="language" content="English">
    <meta name="geo.region" content="BD-13">
    <meta name="geo.placename" content="Dhaka, Bangladesh">
    <meta name="geo.position" content="23.8103;90.4125">
    <meta name="ICBM" content="23.8103, 90.4125">

    <!-- ═══════════════════════════════════════════════
         CANONICAL URL
         ═══════════════════════════════════════════════ -->
    <?php
    $protocol   = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host       = $_SERVER['HTTP_HOST'] ?? 'adilskitchen.com';
    $canonicalUrl = isset($canonicalUrl) ? $canonicalUrl : $protocol . '://' . $host . strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
    ?>
    <link rel="canonical" href="<?= htmlspecialchars($canonicalUrl) ?>">

    <!-- ═══════════════════════════════════════════════
         OPEN GRAPH (Facebook, WhatsApp, LinkedIn)
         ═══════════════════════════════════════════════ -->
    <meta property="og:type" content="<?= $ogType ?? 'website' ?>">
    <meta property="og:site_name" content="Adil's Signature Kitchen">
    <meta property="og:title" content="<?= htmlspecialchars($ogTitle ?? $seoTitle ?? $pageTitle ?? "Adil's Signature Kitchen") ?>">
    <meta property="og:description" content="<?= htmlspecialchars($metaDescription ?? "Homemade cakes, custom birthday cakes, fast food delivered in Dhaka.") ?>">
    <meta property="og:url" content="<?= htmlspecialchars($canonicalUrl) ?>">
    <meta property="og:image" content="<?= $ogImage ?? $protocol . '://' . $host . '/assets/images/og-image.jpg' ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Adil's Signature Kitchen — Homemade Cakes &amp; Fast Food">
    <meta property="og:locale" content="en_BD">

    <!-- ═══════════════════════════════════════════════
         TWITTER / X CARD
         ═══════════════════════════════════════════════ -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@adilskitchen">
    <meta name="twitter:title" content="<?= htmlspecialchars($ogTitle ?? $pageTitle ?? "Adil's Signature Kitchen") ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($metaDescription ?? "Fresh homemade cakes & fast food in Dhaka, Bangladesh.") ?>">
    <meta name="twitter:image" content="<?= $ogImage ?? $protocol . '://' . $host . '/assets/images/og-image.jpg' ?>">

    <!-- ═══════════════════════════════════════════════
         FAVICON & BRAND ICONS
         ═══════════════════════════════════════════════ -->
    <link rel="icon" type="image/x-icon" href="/assets/images/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/apple-touch-icon.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="theme-color" content="#6A1B2E">
    <meta name="msapplication-TileColor" content="#6A1B2E">

    <!-- ═══════════════════════════════════════════════
         PERFORMANCE — PRECONNECT & PRELOAD
         ═══════════════════════════════════════════════ -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="//www.googletagmanager.com">
    <link rel="dns-prefetch" href="//www.google-analytics.com">

    <!-- ═══════════════════════════════════════════════
         GOOGLE FONTS (Non-render-blocking)
         ═══════════════════════════════════════════════ -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=Poppins:wght@300;400;500;600;700&family=Dancing+Script:wght@700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=Poppins:wght@300;400;500;600;700&family=Dancing+Script:wght@700&display=swap"></noscript>

    <!-- ═══════════════════════════════════════════════
         CSS — Critical First
         ═══════════════════════════════════════════════ -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/aos.css">
    <link rel="stylesheet" href="/assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="/assets/css/style.css">

    <!-- ═══════════════════════════════════════════════
         BRAND CSS OVERRIDES (Adil's Burgundy Theme)
         ═══════════════════════════════════════════════ -->
    <style>
        :root {
            --primary:   #6A1B2E;
            --primary-h: #521323;
            --secondary: #D4A373;
            --cream:     #F8F3EE;
            --dark:      #1A1A1A;
            --text:      #2B2B2B;
        }
        body { font-family: 'Poppins', sans-serif; color: var(--text); }
        h1,h2,h3,h4,h5 { font-family: 'Playfair Display', serif; }
        a { transition: all .3s; text-decoration: none; }
        img { max-width: 100%; height: auto; }
        /* Lazy-load placeholder */
        img[data-src] { opacity: 0; transition: opacity .4s; }
        img.loaded    { opacity: 1; }
        /* Sticky WhatsApp CTA */
        .wa-sticky {
            position: fixed; bottom: 24px; right: 24px;
            width: 56px; height: 56px; border-radius: 50%;
            background: #25D366; color: #fff;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem; z-index: 9999;
            box-shadow: 0 4px 20px rgba(37,211,102,.4);
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%,100% { box-shadow: 0 0 0 0 rgba(37,211,102,.6); }
            50%      { box-shadow: 0 0 0 12px rgba(37,211,102,0); }
        }
    </style>

    <!-- ═══════════════════════════════════════════════
         GOOGLE ANALYTICS 4
         Replace G-XXXXXXXXXX with your GA4 Measurement ID
         ═══════════════════════════════════════════════ -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-XXXXXXXXXX', {
            'page_title': document.title,
            'page_location': window.location.href
        });
    </script>

    <!-- ═══════════════════════════════════════════════
         SCHEMA.ORG — Organisation + LocalBusiness + Bakery
         Injected on every page for Knowledge Graph & AI Search
         ═══════════════════════════════════════════════ -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@graph": [
        {
          "@type": ["Organization","LocalBusiness","Bakery","FoodEstablishment"],
          "@id": "https://adilskitchen.com/#organization",
          "name": "Adil's Signature Kitchen",
          "alternateName": ["Adil's Kitchen","Adil Kitchen","Adil Homemade Kitchen"],
          "description": "Adil's Signature Kitchen is a homemade bakery and fast food brand in Dhaka, Bangladesh, offering custom birthday cakes, dream cakes, cupcakes, tub cakes, burgers, rolls, and samusas made with 100% halal ingredients.",
          "slogan": "Homemade With Love",
          "url": "https://adilskitchen.com",
          "logo": {
            "@type": "ImageObject",
            "url": "https://adilskitchen.com/assets/images/logo.png",
            "width": 400,
            "height": 400
          },
          "image": "https://adilskitchen.com/assets/images/og-image.jpg",
          "telephone": "+8801303721109",
          "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+8801303721109",
            "contactType": "customer service",
            "availableLanguage": ["Bengali","English"],
            "contactOption": "TollFree"
          },
          "address": {
            "@type": "PostalAddress",
            "addressLocality": "Dhaka",
            "addressRegion": "Dhaka Division",
            "addressCountry": "BD"
          },
          "geo": {
            "@type": "GeoCoordinates",
            "latitude": 23.8103,
            "longitude": 90.4125
          },
          "openingHoursSpecification": [
            {
              "@type": "OpeningHoursSpecification",
              "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Saturday","Sunday"],
              "opens": "09:00",
              "closes": "22:00"
            }
          ],
          "servesCuisine": ["Bakery","Fast Food","Desserts"],
          "priceRange": "৳৳",
          "currenciesAccepted": "BDT",
          "paymentAccepted": "Cash, bKash, Nagad",
          "hasMap": "https://www.google.com/maps?q=Adil's+Signature+Kitchen+Dhaka",
          "sameAs": [
            "https://www.facebook.com/adilskitchen",
            "https://www.instagram.com/adilskitchen"
          ],
          "foundingDate": "2020",
          "areaServed": {
            "@type": "City",
            "name": "Dhaka"
          },
          "keywords": "homemade cake, birthday cake, dream cake, custom cake, cupcake, burger, roll, samusa, Dhaka, Bangladesh"
        },
        {
          "@type": "WebSite",
          "@id": "https://adilskitchen.com/#website",
          "url": "https://adilskitchen.com",
          "name": "Adil's Signature Kitchen",
          "description": "Homemade cakes, custom birthday cakes, fast food delivery in Dhaka, Bangladesh.",
          "inLanguage": "en-BD",
          "publisher": { "@id": "https://adilskitchen.com/#organization" },
          "potentialAction": {
            "@type": "SearchAction",
            "target": {
              "@type": "EntryPoint",
              "urlTemplate": "https://adilskitchen.com/shop?q={search_term_string}"
            },
            "query-input": "required name=search_term_string"
          }
        }
        <?php if (isset($pageSchema)): ?>,
        <?= $pageSchema ?>
        <?php endif; ?>
      ]
    }
    </script>

    <?php if (isset($breadcrumbSchema)): ?>
    <!-- Breadcrumb Schema -->
    <script type="application/ld+json">
    <?= $breadcrumbSchema ?>
    </script>
    <?php endif; ?>

</head>
<body>

<!-- ═══════════════════════════════════════════════════════════
     ACCESSIBILITY SKIP LINK
     ═══════════════════════════════════════════════════════════ -->
<a href="#main-content" class="visually-hidden-focusable position-absolute top-0 start-0 bg-danger text-white p-2 rounded m-2" style="z-index:10000;">Skip to main content</a>

<!-- ═══════════════════════════════════════════════════════════
     TOP BAR — Contact & Social
     ═══════════════════════════════════════════════════════════ -->
<div id="topbar" role="banner" aria-label="Contact information">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div class="top-contact d-flex flex-wrap gap-3" itemscope itemtype="https://schema.org/LocalBusiness">
                <span itemprop="telephone">
                    <a href="tel:+8801303721109" class="text-white-50">
                        <i class="fas fa-phone-alt" aria-hidden="true"></i> 01303721109
                    </a>
                </span>
                <span>
                    <a href="https://wa.me/8801303721109" target="_blank" rel="noopener" class="text-white-50" aria-label="WhatsApp Order">
                        <i class="fab fa-whatsapp" aria-hidden="true"></i> WhatsApp Order
                    </a>
                </span>
                <span itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
                    <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                    <span itemprop="addressLocality">Dhaka</span>, <span itemprop="addressCountry">Bangladesh</span>
                </span>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="ttag"><i class="fas fa-heart me-1" aria-hidden="true"></i>"Homemade With Love"</span>
                <div class="tsoc" aria-label="Social media links">
                    <a href="https://facebook.com/adilskitchen" target="_blank" rel="noopener me" aria-label="Follow on Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://instagram.com/adilskitchen" target="_blank" rel="noopener me" aria-label="Follow on Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="/order-tracking" aria-label="Track your order"><i class="fas fa-truck text-white"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════
     NAVBAR
     ═══════════════════════════════════════════════════════════ -->
<nav class="navbar navbar-expand-lg" id="nav" role="navigation" aria-label="Main navigation">
    <div class="container">
        <a class="navbar-brand" href="/" aria-label="Adil's Signature Kitchen - Homepage">
            <div class="blogo">
                <div class="bico" style="background:var(--primary);color:#fff;border-radius:8px;padding:8px;"><i class="fas fa-birthday-cake" aria-hidden="true"></i></div>
                <div>
                    <div class="bname" style="font-family:'Playfair Display',serif;font-weight:700;font-size:1.1rem;">Adil's <span style="color:var(--secondary);">Kitchen</span></div>
                    <div class="bsub" style="font-size:.65rem;color:#888;font-weight:500;text-transform:uppercase;letter-spacing:1px;">Homemade Bakery & Fast Food</div>
                </div>
            </div>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu" aria-controls="navmenu" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars" style="color:var(--primary);font-size:1.35rem;" aria-hidden="true"></i>
        </button>

        <div class="collapse navbar-collapse" id="navmenu">
            <ul class="navbar-nav mx-auto" role="list">
                <li class="nav-item" role="listitem"><a class="nav-link" href="/" aria-label="Home">Home</a></li>
                <li class="nav-item" role="listitem"><a class="nav-link" href="/shop" aria-label="Shop all products">Shop Menu</a></li>
                <li class="nav-item" role="listitem">
                    <a class="nav-link fw-bold" href="/custom-cake" style="color:var(--primary);" aria-label="Design your custom cake">
                        <i class="fas fa-birthday-cake me-1" aria-hidden="true"></i>Custom Cake
                    </a>
                </li>
                <li class="nav-item" role="listitem"><a class="nav-link" href="/gallery" aria-label="Photo Gallery">Gallery</a></li>
                <li class="nav-item" role="listitem"><a class="nav-link" href="/blog" aria-label="Bakery Blog">Blog</a></li>
                <li class="nav-item" role="listitem"><a class="nav-link" href="/about" aria-label="About Us">About</a></li>
                <li class="nav-item" role="listitem"><a class="nav-link" href="/contact" aria-label="Contact Us">Contact</a></li>
            </ul>

            <div class="d-flex align-items-center gap-2">
                <a href="/wishlist" class="btn btn-sm btn-outline-secondary rounded-pill" aria-label="Wishlist">
                    <i class="far fa-heart" aria-hidden="true"></i>
                </a>
                <a href="/cart" class="btn btn-sm rounded-pill text-white fw-bold px-3" style="background:var(--primary);" aria-label="Shopping Cart" id="cart-btn">
                    <i class="fas fa-shopping-bag me-1" aria-hidden="true"></i>Cart
                    <span class="cart-count badge bg-warning text-dark ms-1 rounded-pill" id="cart-badge" style="display:none;"></span>
                </a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="/my-account" class="btn btn-sm btn-outline-dark rounded-pill" aria-label="My Account">
                        <i class="fas fa-user me-1" aria-hidden="true"></i>Account
                    </a>
                <?php else: ?>
                    <a href="/login" class="btn btn-sm btn-outline-dark rounded-pill" aria-label="Login">
                        <i class="fas fa-sign-in-alt me-1" aria-hidden="true"></i>Login
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<!-- ═══════════════════════════════════════════════════════════
     STICKY WHATSAPP CTA — Conversion SEO
     ═══════════════════════════════════════════════════════════ -->
<a href="https://wa.me/8801303721109?text=Hi%20Adil%27s%20Kitchen%2C%20I%20want%20to%20order!"
   class="wa-sticky"
   target="_blank"
   rel="noopener"
   aria-label="Order via WhatsApp - Call 01303721109"
   title="Order on WhatsApp">
    <i class="fab fa-whatsapp" aria-hidden="true"></i>
</a>

<!-- Main content landmark -->
<main id="main-content">
