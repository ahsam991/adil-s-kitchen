<div class="container py-5">
    <div class="row g-5">
        <div class="col-lg-6">
            <img src="<?= !empty($product['image']) ? $product['image'] : 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=600&auto=format&fit=crop' ?>" class="img-fluid rounded-4 shadow-sm w-100" alt="<?= htmlspecialchars($product['name']) ?>">
        </div>
        <div class="col-lg-6">
            <span class="badge bg-danger mb-2"><?= htmlspecialchars($product['category_name'] ?? 'Bakery') ?></span>
            <h1 class="display-6 brand-font mb-2"><?= htmlspecialchars($product['name']) ?></h1>
            <div class="fs-3 fw-bold text-danger mb-3">
                ৳<?= number_format($product['price'], 2) ?>
            </div>
            <p class="text-muted lead fs-6"><?= htmlspecialchars($product['short_description'] ?? $product['description']) ?></p>

            <form class="mt-4">
                <div class="mb-3">
                    <label class="form-label fw-bold">Quantity</label>
                    <input type="number" id="quantity-input" class="form-control form-control-lg w-25" value="1" min="1">
                </div>
                <div class="d-flex gap-3 mt-4">
                    <button type="button" class="btn btn-primary-custom btn-lg btn-add-cart px-4" data-product-id="<?= $product['id'] ?>">
                        <i class="fas fa-shopping-bag me-2"></i> Add To Cart
                    </button>
                    <button type="button" class="btn btn-outline-custom btn-lg btn-wishlist px-3" data-product-id="<?= $product['id'] ?>">
                        <i class="far fa-heart"></i>
                    </button>
                </div>
            </form>

            <div class="mt-5 border-top pt-4">
                <h5>Product Details</h5>
                <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
            </div>
        </div>
    </div>
</div>
