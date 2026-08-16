<div class="container py-5">
    <div class="row g-4">
        <!-- Sidebar Filters -->
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 mb-4">
                <h4 class="mb-3">Categories</h4>
                <div class="list-group list-group-flush">
                    <a href="/shop" class="list-group-item list-group-item-action border-0 px-0 <?= empty($currentCategory) ? 'fw-bold text-danger' : '' ?>">
                        All Categories
                    </a>
                    <?php foreach ($categories as $cat): ?>
                        <a href="/shop?category=<?= $cat['id'] ?>" class="list-group-item list-group-item-action border-0 px-0 <?= $currentCategory == $cat['id'] ? 'fw-bold text-danger' : '' ?>">
                            <?= htmlspecialchars($cat['name']) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Main Product Grid -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <p class="text-muted mb-0">Showing <?= count($products) ?> items</p>
                <form method="GET" class="d-flex align-items-center gap-2">
                    <?php if ($currentCategory): ?>
                        <input type="hidden" name="category" value="<?= $currentCategory ?>">
                    <?php endif; ?>
                    <label class="text-nowrap small text-muted">Sort By:</label>
                    <select name="sort" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="latest" <?= $currentSort === 'latest' ? 'selected' : '' ?>>Latest First</option>
                        <option value="price_low" <?= $currentSort === 'price_low' ? 'selected' : '' ?>>Price: Low to High</option>
                        <option value="price_high" <?= $currentSort === 'price_high' ? 'selected' : '' ?>>Price: High to Low</option>
                        <option value="popular" <?= $currentSort === 'popular' ? 'selected' : '' ?>>Popularity</option>
                    </select>
                </form>
            </div>

            <div class="row g-4">
                <?php if (empty($products)): ?>
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-cookie-bite text-muted display-1 mb-3"></i>
                        <h3>No items found in this category</h3>
                        <a href="/shop" class="btn btn-primary-custom mt-2">View All Products</a>
                    </div>
                <?php else: ?>
                    <?php foreach ($products as $p): ?>
                        <div class="col-md-6 col-lg-4" data-aos="fade-up">
                            <article class="card border-0 rounded-4 overflow-hidden h-100 product-card">
                                <div class="position-relative overflow-hidden pc-img" style="padding-top:75%;">
                                    <img 
                                        src="<?= !empty($p['image']) ? $p['image'] : 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=400&auto=format&fit=crop' ?>" 
                                        alt="<?= htmlspecialchars($p['name']) ?>"
                                        class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"
                                        loading="lazy">
                                    <?php if (!empty($p['best_seller'])): ?>
                                        <span class="badge position-absolute top-0 start-0 m-3 px-3 py-2 rounded-pill" style="background:var(--primary);">
                                            <i class="fas fa-star me-1" aria-hidden="true"></i> Best Seller
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="card-body p-4 d-flex flex-column">
                                    <span class="text-uppercase text-muted mb-1" style="font-size:.7rem;letter-spacing:1px;font-weight:600;"><?= htmlspecialchars($p['category_name'] ?? 'Bakery') ?></span>
                                    <h3 class="h6 fw-bold mb-2">
                                        <a href="/product/<?= $p['slug'] ?>" class="text-dark stretched-link">
                                            <?= htmlspecialchars($p['name']) ?>
                                        </a>
                                    </h3>
                                    <div class="fw-bold mb-3" style="color:var(--primary);font-size:1.1rem;">
                                        ৳<?= number_format($p['price'], 2) ?>
                                    </div>
                                    <div class="mt-auto d-flex flex-column gap-2">
                                        <button class="btn btn-sm btn-outline-danger w-100 rounded-pill btn-add-cart" data-product-id="<?= $p['id'] ?>" style="position:relative;z-index:10;">
                                            <i class="fas fa-shopping-bag me-1"></i> Add to Cart
                                        </button>
                                        <button class="btn btn-sm w-100 rounded-pill btn-buy-now" data-product-id="<?= $p['id'] ?>" style="position:relative;z-index:10;">
                                            <i class="fas fa-bolt me-1"></i> Buy Now
                                        </button>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
