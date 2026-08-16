<div class="container py-5">
    <h1 class="display-6 brand-font mb-4">Shopping Cart</h1>

    <?php if (empty($items)): ?>
        <div class="text-center py-5">
            <i class="fas fa-shopping-bag display-1 text-muted mb-3"></i>
            <h3>Your cart is currently empty</h3>
            <p class="text-muted">Browse our delicious homemade cakes, burgers and desserts!</p>
            <a href="/shop" class="btn btn-primary-custom mt-2">Explore Menu</a>
        </div>
    <?php else: ?>
        <p class="text-muted small mb-4"><i class="fas fa-lock-open me-1 text-success" aria-hidden="true"></i>No account? You can <a href="/checkout" class="fw-bold text-danger">checkout as a guest</a> — no signup needed.</p>
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="table-responsive cart-table">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $item): ?>
                                <?php $effPrice = !empty($item['sale_price']) && $item['sale_price'] > 0 ? $item['sale_price'] : $item['price']; ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="<?= !empty($item['product_image']) ? $item['product_image'] : 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=100&auto=format&fit=crop' ?>" width="60" height="60" class="rounded-3 object-fit-cover" alt="">
                                            <div>
                                                <h6 class="mb-0 fw-bold"><?= htmlspecialchars($item['product_name']) ?></h6>
                                                <?php if (!empty($item['options'])): ?>
                                                    <?php $opts = json_decode($item['options'], true); ?>
                                                    <small class="text-muted">
                                                        <?= isset($opts['weight']) ? "Weight: {$opts['weight']} " : '' ?>
                                                        <?= isset($opts['flavor']) ? "Flavor: {$opts['flavor']}" : '' ?>
                                                    </small>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="fw-bold">৳<?= number_format($effPrice, 2) ?></td>
                                    <td>
                                        <input type="number" class="form-control form-control-sm cart-qty-input w-75" data-cart-item-id="<?= $item['id'] ?>" value="<?= $item['quantity'] ?>" min="1">
                                    </td>
                                    <td class="fw-bold text-danger">৳<?= number_format($effPrice * $item['quantity'], 2) ?></td>
                                    <td>
                                        <form action="/cart/remove" method="POST" class="d-inline">
                                            <input type="hidden" name="cart_item_id" value="<?= $item['id'] ?>">
                                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="summary-card">
                    <h4 class="brand-font mb-4">Order Summary</h4>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span class="fw-bold">৳<?= number_format($subtotal, 2) ?></span>
                    </div>
                    <?php if ($discount > 0): ?>
                        <div class="d-flex justify-content-between mb-2 text-success">
                            <span>Discount</span>
                            <span class="fw-bold">-৳<?= number_format($discount, 2) ?></span>
                        </div>
                    <?php endif; ?>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Delivery Charge</span>
                        <span class="fw-bold">৳<?= number_format($deliveryCharge, 2) ?></span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4 fs-5">
                        <span class="fw-bold">Total Amount</span>
                        <span class="fw-bold text-danger">৳<?= number_format($total, 2) ?></span>
                    </div>
                    <a href="/checkout" class="btn btn-primary-custom btn-lg w-100 py-3">Proceed to Checkout <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
