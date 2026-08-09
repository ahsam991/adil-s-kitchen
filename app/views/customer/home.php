<!-- HERO SECTION -->
<section id="hero" style="position:relative; overflow:hidden; background:linear-gradient(135deg, rgba(106, 27, 46, 0.04) 0%, rgba(212, 163, 115, 0.12) 100%); padding: 60px 0 80px 0;">
    <div class="container">
        <div class="row align-items-center g-5" style="min-height: 80vh;">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="hbadge mb-3 d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill">
                    <div class="hbi rounded-circle bg-danger text-white px-2 py-1"><i class="fas fa-heart"></i></div>
                    <span class="fw-semibold">100% Homemade With Love</span>
                </div>
                <h1 class="htitle display-4 brand-font fw-bold mb-3">Delicious <span class="hl text-danger">Handcrafted Cakes</span> & Fast Food</h1>
                <p class="hdesc text-muted lead fs-6 mb-4">Freshly baked custom birthday cakes, 5-layer dream cakes, soft cupcakes, chicken burgers, rolls, and crispy samusas made to order with premium halal ingredients.</p>
                <div class="d-flex flex-wrap gap-3 mb-4">
                    <a href="/shop" class="btn btn-red btn-lg px-4 py-3 rounded-pill text-white fw-bold"><i class="fas fa-utensils me-2"></i>Order Menu Now</a>
                    <a href="/custom-cake" class="btn btn-outline-danger btn-lg px-4 py-3 rounded-pill fw-bold"><i class="fas fa-birthday-cake me-2"></i>Custom Cake Designer</a>
                </div>
                <div class="hstats d-flex gap-4 flex-wrap mt-4 pt-3 border-top">
                    <div class="hstat"><span class="snum fs-3 fw-bold text-danger">5,000<em>+</em></span><br><small class="text-muted">Happy Customers</small></div>
                    <div class="hstat"><span class="snum fs-3 fw-bold text-danger">100<em>%</em></span><br><small class="text-muted">Halal & Fresh</small></div>
                    <div class="hstat"><span class="snum fs-3 fw-bold text-danger">01303721109</span><br><small class="text-muted">WhatsApp Hotline</small></div>
                </div>
            </div>
            <div class="col-lg-6 text-center" data-aos="fade-left">
                <div style="position:relative; display:inline-block;">
                    <div class="hcircle" style="border-radius: 50%; overflow: hidden; box-shadow: 0 20px 60px rgba(106, 27, 46, 0.2); max-width: 460px; margin: 0 auto;">
                        <img src="https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=600&auto=format&fit=crop" alt="Signature Chocolate Cake" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- MARQUEE TICKER -->
<div class="mqsec bg-dark text-white py-3">
    <div class="mqtrack d-flex justify-content-around align-items-center fw-semibold text-uppercase small text-warning" style="letter-spacing:1px;">
        <div class="mqitem"><i class="fas fa-birthday-cake me-2 text-danger"></i>Custom Birthday Cakes</div>
        <div class="mqitem"><i class="fas fa-star me-2 text-warning"></i>5-Layer Dream Cake</div>
        <div class="mqitem"><i class="fas fa-cookie me-2 text-success"></i>Bite-Sized Cupcakes</div>
        <div class="mqitem"><i class="fas fa-hamburger me-2 text-danger"></i>Crispy Chicken Burger</div>
        <div class="mqitem"><i class="fas fa-utensils me-2 text-warning"></i>Fresh Samusa & Rolls</div>
    </div>
</div>

<!-- FEATURED CATEGORIES -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="text-uppercase text-danger fw-bold tracking-wider">Explore Menu</span>
            <h2 class="display-6 brand-font fw-bold mt-1">Bakery & Fast Food Categories</h2>
            <p class="text-muted">Handcrafted delights baked fresh every single day</p>
        </div>

        <div class="row g-4">
            <?php foreach ($categories as $cat): ?>
                <div class="col-6 col-md-4 col-lg-3" data-aos="zoom-in">
                    <a href="/shop?category=<?= $cat['id'] ?>" class="card border-0 shadow-sm rounded-4 p-3 text-center h-100 bg-white hover-up transition">
                        <img src="<?= !empty($cat['image']) ? $cat['image'] : 'https://images.unsplash.com/photo-1550617931-e17a7b70dce2?w=150&auto=format&fit=crop' ?>" alt="<?= htmlspecialchars($cat['name']) ?>" class="rounded-circle mx-auto mb-3 object-fit-cover border border-3 border-warning p-1" style="width: 100px; height: 100px;">
                        <h4 class="h6 fw-bold mb-1 text-dark"><?= htmlspecialchars($cat['name']) ?></h4>
                        <span class="text-danger small fw-semibold">Order Fresh <i class="fas fa-arrow-right ms-1"></i></span>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- FEATURED PRODUCTS -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4" data-aos="fade-up">
            <div>
                <span class="text-uppercase text-danger fw-bold">Chef's Recommendations</span>
                <h2 class="display-6 brand-font fw-bold mb-0">Featured Creations</h2>
            </div>
            <a href="/shop" class="btn btn-outline-danger rounded-pill px-4">View All Menu <i class="fas fa-arrow-right ms-1"></i></a>
        </div>

        <div class="row g-4">
            <?php foreach ($featuredProducts as $p): ?>
                <div class="col-md-6 col-lg-3" data-aos="fade-up">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 product-card">
                        <div class="position-relative overflow-hidden" style="padding-top: 75%;">
                            <img src="<?= !empty($p['image']) ? $p['image'] : 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=400&auto=format&fit=crop' ?>" alt="<?= htmlspecialchars($p['name']) ?>" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover">
                            <?php if ($p['best_seller']): ?>
                                <span class="badge bg-danger position-absolute top-0 start-0 m-3 px-3 py-2 rounded-pill"><i class="fas fa-star me-1"></i> Best Seller</span>
                            <?php endif; ?>
                        </div>
                        <div class="card-body p-4 d-flex flex-column">
                            <span class="text-uppercase text-muted small fw-bold mb-1"><?= htmlspecialchars($p['category_name'] ?? 'Bakery') ?></span>
                            <h3 class="h5 fw-bold mb-2"><a href="/product/<?= $p['slug'] ?>" class="text-dark"><?= htmlspecialchars($p['name']) ?></a></h3>
                            <div class="fs-5 fw-bold text-danger mb-3">
                                ৳<?= number_format($p['price'], 2) ?>
                            </div>
                            <div class="mt-auto">
                                <button class="btn btn-red w-100 rounded-pill btn-add-cart" data-product-id="<?= $p['id'] ?>">
                                    <i class="fas fa-shopping-bag me-1"></i> Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CUSTOM CAKE CTA -->
<section class="py-5 text-white" style="background: linear-gradient(rgba(106, 27, 46, 0.92), rgba(106, 27, 46, 0.92)), url('https://images.unsplash.com/photo-1535141192574-5d4897c13136?w=1200&auto=format&fit=crop') center/cover fixed;">
    <div class="container text-center py-4" data-aos="zoom-in">
        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold text-uppercase mb-3">Custom Cake Builder</span>
        <h2 class="display-5 text-white brand-font fw-bold mb-3">Have a Specific Cake Design in Mind?</h2>
        <p class="lead max-w-700 mx-auto text-white-50 mb-4">Upload your reference photo, select shape, flavor, size, cream type, and delivery date. Our expert baker will make your exact dream cake!</p>
        <a href="/custom-cake" class="btn btn-warning btn-lg px-5 py-3 rounded-pill fw-bold text-dark"><i class="fas fa-magic me-2"></i>Design Custom Cake Now</a>
    </div>
</section>
