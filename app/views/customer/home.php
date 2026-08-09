<?php
/**
 * Home Page View — Adil's Signature Kitchen
 * On-page SEO: H1/H2/H3 hierarchy, keywords, schema injected via $pageSchema
 */

// ── Page-specific SEO variables (read by header.php) ─────────────────────────
$seoTitle       = "Adil's Signature Kitchen | Best Homemade Cakes & Fast Food Dhaka";
$metaDescription = "Order fresh homemade birthday cakes, dream cakes, cupcakes, burgers & samusas in Dhaka. Custom cake designer. Call 01303721109. Halal. Delivery available.";
$metaKeywords   = "homemade cake Dhaka, birthday cake Bangladesh, dream cake delivery, custom birthday cake, cupcake Dhaka, burger roll samusa, Adil's Kitchen";

// ── FAQ Schema for Voice Search & Featured Snippets ──────────────────────────
$pageSchema = '{
  "@type": "FAQPage",
  "@id": "https://adilskitchen.com/#faq",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "What is Adil\'s Signature Kitchen?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Adil\'s Signature Kitchen is a homemade bakery and fast food brand in Dhaka, Bangladesh offering custom birthday cakes, dream cakes, cupcakes, burgers, rolls, and samusas made with 100% halal ingredients."
      }
    },
    {
      "@type": "Question",
      "name": "How do I order a custom birthday cake?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Use our Custom Cake Designer at adilskitchen.com/custom-cake or WhatsApp us at 01303721109. We need at least 2-3 days advance notice for custom cakes."
      }
    },
    {
      "@type": "Question",
      "name": "Do you deliver in Dhaka?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Yes! We offer fast delivery across Dhaka, Bangladesh. Delivery charge is ৳60. Free delivery for orders above ৳1500."
      }
    },
    {
      "@type": "Question",
      "name": "Is the food halal?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Yes, 100% halal certified ingredients are used in all our products at Adil\'s Signature Kitchen."
      }
    },
    {
      "@type": "Question",
      "name": "What is the best homemade cake in Bangladesh?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Adil\'s Signature Kitchen is widely known as the best homemade cake brand in Bangladesh, offering Belgian Dream Cakes, custom birthday cakes, cupcakes, and tub cakes made fresh daily."
      }
    }
  ]
}';
?>

<!-- ═══════════════════════════════════════════════════════════
     HERO SECTION
     ═══════════════════════════════════════════════════════════ -->
<section id="hero" aria-label="Hero — Adil's Signature Kitchen" style="background:linear-gradient(135deg,rgba(106,27,46,.05) 0%,rgba(212,163,115,.1) 100%);padding:60px 0 80px;">
    <div class="container">
        <div class="row align-items-center g-5" style="min-height:80vh;">

            <!-- Left: Text + CTA -->
            <div class="col-lg-6" data-aos="fade-right">
                <!-- Breadcrumb for SEO -->
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList" style="font-size:.8rem;background:transparent;padding:0;margin:0;">
                        <li class="breadcrumb-item active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <span itemprop="name">Home</span>
                            <meta itemprop="position" content="1">
                        </li>
                    </ol>
                </nav>

                <!-- Badge -->
                <div class="d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill mb-3" style="background:rgba(106,27,46,.08);">
                    <div class="rounded-circle text-white px-2 py-1 small" style="background:var(--primary);"><i class="fas fa-heart" aria-hidden="true"></i></div>
                    <span class="fw-semibold small" style="color:var(--primary);">100% Homemade With Love — Dhaka, Bangladesh</span>
                </div>

                <!-- H1 — Primary Keyword: homemade cakes Dhaka -->
                <h1 class="display-5 fw-bold mb-3" style="font-family:'Playfair Display',serif;color:#1a1a1a;line-height:1.2;">
                    Best <span style="color:var(--primary);">Homemade Cakes</span><br>
                    &amp; Fast Food in <span style="color:var(--secondary);">Dhaka</span>
                </h1>

                <p class="lead text-muted mb-4" style="font-size:1rem;max-width:500px;">
                    Freshly baked <strong>custom birthday cakes</strong>, 5-layer <strong>dream cakes</strong>, soft cupcakes, mango tub cakes, crispy <strong>chicken burgers</strong>, rolls and samusas — made daily with premium halal ingredients.
                </p>

                <!-- CTA Buttons -->
                <div class="d-flex flex-wrap gap-3 mb-4">
                    <a href="/shop" class="btn btn-lg px-4 py-3 rounded-pill text-white fw-bold" style="background:var(--primary);" aria-label="Browse our menu">
                        <i class="fas fa-utensils me-2" aria-hidden="true"></i>Order Now
                    </a>
                    <a href="/custom-cake" class="btn btn-outline-danger btn-lg px-4 py-3 rounded-pill fw-bold" aria-label="Design a custom cake">
                        <i class="fas fa-birthday-cake me-2" aria-hidden="true"></i>Custom Cake
                    </a>
                    <a href="https://wa.me/8801303721109?text=Hello%20Adil%27s%20Kitchen%2C%20I%20want%20to%20order!" target="_blank" rel="noopener" class="btn btn-outline-success btn-lg px-4 py-3 rounded-pill fw-bold" aria-label="Order on WhatsApp">
                        <i class="fab fa-whatsapp me-2" aria-hidden="true"></i>WhatsApp
                    </a>
                </div>

                <!-- Trust Stats -->
                <div class="d-flex flex-wrap gap-4 pt-3 border-top" itemscope itemtype="https://schema.org/AggregateRating">
                    <div class="text-center">
                        <div class="fw-bold fs-4" style="color:var(--primary);">5,000<small>+</small></div>
                        <small class="text-muted">Happy Customers</small>
                    </div>
                    <div class="text-center">
                        <div class="fw-bold fs-4" style="color:var(--primary);" itemprop="ratingValue">4.9<small>/5</small></div>
                        <small class="text-muted" itemprop="reviewCount">2,000+ Reviews</small>
                    </div>
                    <div class="text-center">
                        <div class="fw-bold fs-4" style="color:var(--primary);">100<small>%</small></div>
                        <small class="text-muted">Halal & Fresh</small>
                    </div>
                    <div class="text-center">
                        <div class="fw-bold fs-4" style="color:var(--primary);">01303721109</div>
                        <small class="text-muted">WhatsApp Hotline</small>
                    </div>
                </div>
            </div>

            <!-- Right: Hero Image -->
            <div class="col-lg-6 text-center" data-aos="fade-left">
                <div style="position:relative;display:inline-block;">
                    <div style="border-radius:50%;overflow:hidden;box-shadow:0 20px 60px rgba(106,27,46,.2);max-width:420px;margin:0 auto;border:6px solid rgba(212,163,115,.3);">
                        <img src="https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=600&auto=format&fit=crop&q=80"
                             alt="Signature Chocolate Birthday Cake — Adil's Kitchen Dhaka"
                             width="420" height="420"
                             loading="eager"
                             fetchpriority="high"
                             style="width:100%;height:420px;object-fit:cover;">
                    </div>
                    <!-- Floating badges -->
                    <div style="position:absolute;top:20px;left:-10px;background:#fff;border-radius:12px;padding:10px 14px;box-shadow:0 8px 30px rgba(0,0,0,.12);display:flex;align-items:center;gap:8px;">
                        <div style="background:#fff3cd;border-radius:8px;padding:6px;"><i class="fas fa-fire text-danger" aria-hidden="true"></i></div>
                        <div><div class="fw-bold small" style="color:#111;">Hot Deal</div><div class="text-muted" style="font-size:.7rem;">Up to 30% off</div></div>
                    </div>
                    <div style="position:absolute;bottom:20px;right:-10px;background:#fff;border-radius:12px;padding:10px 14px;box-shadow:0 8px 30px rgba(0,0,0,.12);display:flex;align-items:center;gap:8px;">
                        <div style="background:#d1fae5;border-radius:8px;padding:6px;"><i class="fas fa-truck text-success" aria-hidden="true"></i></div>
                        <div><div class="fw-bold small" style="color:#111;">Fast Delivery</div><div class="text-muted" style="font-size:.7rem;">Across Dhaka</div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════
     SCROLLING MARQUEE — Brand Keywords
     ═══════════════════════════════════════════════════════════ -->
<div style="background:#1a1a1a;padding:14px 0;overflow:hidden;" aria-hidden="true">
    <div class="mqtrack d-flex gap-5 fw-semibold text-uppercase" style="font-size:.75rem;letter-spacing:2px;white-space:nowrap;animation:marquee 30s linear infinite;">
        <?php
        $items = ['🎂 Birthday Cakes','✨ Dream Cake','🧁 Cupcakes','🍫 Tub Cake','🍔 Chicken Burger','🫔 Fresh Rolls','🥟 Crispy Samusa','🎨 Custom Cake Designer','🚀 Delivery Across Dhaka','💯 100% Halal'];
        for ($i=0;$i<3;$i++) foreach($items as $it) echo '<span style="color:#D4A373;margin-right:40px;">'.$it.'</span>';
        ?>
    </div>
</div>
<style>
@keyframes marquee { from{transform:translateX(0)} to{transform:translateX(-33.33%)} }
</style>

<!-- ═══════════════════════════════════════════════════════════
     PRODUCT CATEGORIES — H2 Level
     ═══════════════════════════════════════════════════════════ -->
<section class="py-5" style="background:var(--cream);" aria-labelledby="categories-heading">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <p class="fw-bold text-uppercase mb-1" style="color:var(--primary);letter-spacing:2px;font-size:.8rem;">What We Offer</p>
            <h2 id="categories-heading" style="font-family:'Playfair Display',serif;font-size:2rem;font-weight:700;">Our Homemade <span style="color:var(--primary);">Bakery Menu</span></h2>
            <p class="text-muted">Handcrafted with love in Dhaka — fresh every single day</p>
        </div>

        <div class="row g-3">
            <?php foreach ($categories as $cat): ?>
                <div class="col-6 col-md-4 col-lg-3" data-aos="zoom-in">
                    <a href="/shop?category=<?= htmlspecialchars($cat['slug'] ?? '') ?>"
                       class="d-block text-center p-3 rounded-4 bg-white shadow-sm text-decoration-none h-100"
                       aria-label="Shop <?= htmlspecialchars($cat['name']) ?> category"
                       style="transition:.3s;border:2px solid transparent;"
                       onmouseover="this.style.borderColor='var(--secondary)';this.style.transform='translateY(-4px)'"
                       onmouseout="this.style.borderColor='transparent';this.style.transform='none'">
                        <img src="<?= !empty($cat['image']) ? htmlspecialchars($cat['image']) : '/assets/images/menu/1.jpg' ?>"
                             alt="<?= htmlspecialchars($cat['name']) ?> — Adil's Kitchen Dhaka"
                             class="rounded-circle mb-2 object-fit-cover"
                             width="90" height="90"
                             loading="lazy"
                             style="border:3px solid var(--secondary);padding:3px;">
                        <h3 class="h6 fw-bold mb-1" style="color:#1a1a1a;"><?= htmlspecialchars($cat['name']) ?></h3>
                        <span class="small fw-semibold" style="color:var(--primary);">Order Fresh <i class="fas fa-arrow-right ms-1" aria-hidden="true"></i></span>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════
     FEATURED PRODUCTS — H2 Level
     ═══════════════════════════════════════════════════════════ -->
<section class="py-5 bg-white" aria-labelledby="featured-heading">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3" data-aos="fade-up">
            <div>
                <p class="fw-bold text-uppercase mb-1" style="color:var(--primary);letter-spacing:2px;font-size:.8rem;">Chef's Recommendations</p>
                <h2 id="featured-heading" style="font-family:'Playfair Display',serif;font-size:2rem;font-weight:700;margin-bottom:0;">Featured <span style="color:var(--primary);">Creations</span></h2>
            </div>
            <a href="/shop" class="btn btn-outline-danger rounded-pill px-4 fw-semibold" aria-label="View all products">View All Menu <i class="fas fa-arrow-right ms-1" aria-hidden="true"></i></a>
        </div>

        <div class="row g-4">
            <?php foreach ($featuredProducts as $p): ?>
                <div class="col-md-6 col-lg-3" data-aos="fade-up" itemscope itemtype="https://schema.org/Product">
                    <article class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                        <div class="position-relative overflow-hidden" style="padding-top:75%;">
                            <img
                                data-src="<?= !empty($p['image']) ? htmlspecialchars($p['image']) : '/assets/images/menu/1.jpg' ?>"
                                src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                alt="<?= htmlspecialchars($p['name']) ?> — Buy Online Dhaka"
                                itemprop="image"
                                class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"
                                width="400" height="300"
                                loading="lazy">
                            <?php if (!empty($p['best_seller'])): ?>
                                <span class="badge position-absolute top-0 start-0 m-3 px-3 py-2 rounded-pill" style="background:var(--primary);">
                                    <i class="fas fa-star me-1" aria-hidden="true"></i> Best Seller
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="card-body p-4 d-flex flex-column">
                            <span class="text-uppercase text-muted mb-1" style="font-size:.7rem;letter-spacing:1px;font-weight:600;"><?= htmlspecialchars($p['category_name'] ?? 'Bakery') ?></span>
                            <h3 class="h6 fw-bold mb-2" itemprop="name">
                                <a href="/product/<?= htmlspecialchars($p['slug']) ?>" class="text-dark stretched-link" itemprop="url">
                                    <?= htmlspecialchars($p['name']) ?>
                                </a>
                            </h3>
                            <div class="fw-bold mb-3" style="color:var(--primary);font-size:1.1rem;" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                                <span itemprop="price" content="<?= number_format($p['price'], 2) ?>">৳<?= number_format($p['price'], 2) ?></span>
                                <meta itemprop="priceCurrency" content="BDT">
                                <meta itemprop="availability" content="https://schema.org/InStock">
                            </div>
                            <div class="mt-auto">
                                <button class="btn w-100 rounded-pill text-white fw-bold btn-add-cart"
                                        style="background:var(--primary);"
                                        data-product-id="<?= (int)$p['id'] ?>"
                                        data-product-name="<?= htmlspecialchars($p['name']) ?>"
                                        data-price="<?= number_format($p['price'], 2) ?>"
                                        aria-label="Add <?= htmlspecialchars($p['name']) ?> to cart">
                                    <i class="fas fa-shopping-bag me-1" aria-hidden="true"></i> Add to Cart
                                </button>
                            </div>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════
     CUSTOM CAKE CTA BANNER — H2 Level
     ═══════════════════════════════════════════════════════════ -->
<section class="py-5 text-white" aria-labelledby="custom-cake-heading"
         style="background:linear-gradient(rgba(106,27,46,.93),rgba(106,27,46,.93)),url('https://images.unsplash.com/photo-1535141192574-5d4897c13136?w=1200&auto=format&fit=crop') center/cover fixed;">
    <div class="container text-center py-4" data-aos="zoom-in">
        <span class="badge px-3 py-2 rounded-pill fw-bold text-uppercase mb-3" style="background:var(--secondary);color:#111;font-size:.75rem;letter-spacing:1px;">Custom Cake Order Dhaka</span>
        <h2 id="custom-cake-heading" class="display-6 text-white fw-bold mb-3" style="font-family:'Playfair Display',serif;">
            Design Your Dream <span style="color:var(--secondary);">Birthday Cake</span>
        </h2>
        <p class="lead text-white-50 mb-4" style="max-width:620px;margin:0 auto;">
            Upload your reference photo, choose flavor, shape, size, cream type &amp; delivery date. Our expert baker will craft your <strong class="text-white">exact dream cake</strong> — guaranteed fresh and delicious!
        </p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="/custom-cake" class="btn btn-lg px-5 py-3 rounded-pill fw-bold" style="background:var(--secondary);color:#111;" aria-label="Start designing your custom cake">
                <i class="fas fa-magic me-2" aria-hidden="true"></i>Design My Custom Cake
            </a>
            <a href="https://wa.me/8801303721109?text=Hi!%20I%20want%20to%20order%20a%20custom%20cake" target="_blank" rel="noopener" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill fw-bold" aria-label="Order custom cake on WhatsApp">
                <i class="fab fa-whatsapp me-2" aria-hidden="true"></i>WhatsApp Order
            </a>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════════
     FAQ SECTION — Voice Search + Featured Snippets
     ═══════════════════════════════════════════════════════════ -->
<section class="py-5" style="background:var(--cream);" aria-labelledby="faq-heading">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-4" data-aos="fade-up">
                    <p class="fw-bold text-uppercase mb-1" style="color:var(--primary);letter-spacing:2px;font-size:.8rem;">Common Questions</p>
                    <h2 id="faq-heading" style="font-family:'Playfair Display',serif;font-size:2rem;font-weight:700;">Frequently Asked <span style="color:var(--primary);">Questions</span></h2>
                </div>
                <div class="accordion" id="homeFaq">
                    <?php
                    $faqs = [
                        ['q'=>"What is Adil's Signature Kitchen?", 'a'=>"Adil's Signature Kitchen is a homemade bakery & fast food brand in Dhaka, Bangladesh. We offer custom birthday cakes, dream cakes, cupcakes, tub cakes, chicken burgers, rolls, and samusas made with 100% halal ingredients."],
                        ['q'=>"How do I order a custom birthday cake?", 'a'=>"Simply visit our Custom Cake Designer page, upload your reference image, choose your flavors, size, and delivery date. Or WhatsApp us at 01303721109. Please order at least 2-3 days in advance."],
                        ['q'=>"Do you deliver in Dhaka?", 'a'=>"Yes! We deliver across Dhaka, Bangladesh. Delivery charge is ৳60. Orders above ৳1500 get FREE delivery."],
                        ['q'=>"Is your food 100% halal?", 'a'=>"Absolutely yes. All our cakes, fast food, and desserts are prepared with 100% halal certified ingredients under strict hygiene standards."],
                        ['q'=>"Where is the best homemade cake in Bangladesh?", 'a'=>"Adil's Signature Kitchen is known as one of the best homemade cake brands in Bangladesh, serving Dhaka with fresh Belgian Dream Cakes, custom cakes, and cupcakes daily."],
                    ];
                    foreach($faqs as $i => $f):
                    ?>
                    <div class="accordion-item border-0 mb-2 rounded-3 shadow-sm" data-aos="fade-up" data-aos-delay="<?= $i * 100 ?>">
                        <h3 class="accordion-header m-0">
                            <button class="accordion-button <?= $i > 0 ? 'collapsed' : '' ?> fw-semibold rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#faq<?= $i ?>" aria-expanded="<?= $i === 0 ? 'true' : 'false' ?>">
                                <?= htmlspecialchars($f['q']) ?>
                            </button>
                        </h3>
                        <div id="faq<?= $i ?>" class="accordion-collapse collapse <?= $i === 0 ? 'show' : '' ?>" data-bs-parent="#homeFaq">
                            <div class="accordion-body text-muted"><?= htmlspecialchars($f['a']) ?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="text-center mt-4">
                    <a href="/faq" class="btn btn-outline-danger rounded-pill px-4 fw-semibold">View All FAQs <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
