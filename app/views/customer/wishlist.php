<div class="container py-5">
    <h1 class="display-6 brand-font mb-4">My Saved Wishlist</h1>

    <?php if (empty($items)): ?>
        <div class="text-center py-5">
            <i class="far fa-heart display-1 text-muted mb-3"></i>
            <h3>Your wishlist is empty</h3>
            <p class="text-muted">Save your favorite cakes and bakery items here.</p>
            <a href="/shop" class="btn btn-primary-custom mt-2">Explore Menu</a>
        </div>
    <?php else: ?>
        <div class="row g-4">
            <?php foreach ($items as $item): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="product-card">
                        <div class="product-img-wrapper">
                            <img src="<?= !empty($item['image']) ? $item['image'] : 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=400&auto=format&fit=crop' ?>" alt="<?= htmlspecialchars($item['product_name']) ?>">
                        </div>
                        <div class="product-body">
                            <h3 class="product-title"><a href="/product/<?= $item['product_slug'] ?>"><?= htmlspecialchars($item['product_name']) ?></a></h3>
                            <div class="product-price">৳<?= number_format($item['price'], 2) ?></div>
                            <div class="d-flex gap-2">
                                <button class="btn btn-primary-custom btn-add-cart w-100" data-product-id="<?= $item['product_id'] ?>">
                                    Add to Cart
                                </button>
                                <form action="/wishlist/remove" method="POST">
                                    <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                    <button type="submit" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
