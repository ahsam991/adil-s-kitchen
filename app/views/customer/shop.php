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
                        <div class="col-md-6 col-lg-4">
                            <div class="product-card">
                                <div class="product-img-wrapper">
                                    <img src="<?= !empty($p['image']) ? $p['image'] : 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=400&auto=format&fit=crop' ?>" alt="<?= htmlspecialchars($p['name']) ?>">
                                </div>
                                <div class="product-body">
                                    <span class="product-category"><?= htmlspecialchars($p['category_name'] ?? 'Bakery') ?></span>
                                    <h3 class="product-title"><a href="/product/<?= $p['slug'] ?>"><?= htmlspecialchars($p['name']) ?></a></h3>
                                    <div class="product-price">
                                        ৳<?= number_format($p['price'], 2) ?>
                                    </div>
                                    <div class="product-actions">
                                        <button class="btn btn-primary-custom btn-add-cart w-100" data-product-id="<?= $p['id'] ?>">
                                            <i class="fas fa-shopping-bag me-1"></i> Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
