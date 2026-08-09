<div class="container py-5">
    <h1 class="display-6 brand-font mb-4">Checkout</h1>

    <form action="/checkout" method="POST">
        <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
                    <h4 class="brand-font text-danger mb-4">1. Customer & Delivery Address</h4>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">First Name *</label>
                            <input type="text" name="first_name" class="form-control form-control-lg" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Last Name *</label>
                            <input type="text" name="last_name" class="form-control form-control-lg" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Email Address *</label>
                            <input type="email" name="email" class="form-control form-control-lg" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Phone Number *</label>
                            <input type="text" name="phone" class="form-control form-control-lg" placeholder="01303721109" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Delivery Address *</label>
                            <textarea name="address" class="form-control" rows="3" placeholder="House/Road, Area, Sector..." required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">City *</label>
                            <input type="text" name="city" class="form-control form-control-lg" value="Dhaka" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Order Notes / Delivery Time Instructions</label>
                            <textarea name="order_notes" class="form-control" rows="2" placeholder="e.g. Please deliver around 5 PM"></textarea>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                    <h4 class="brand-font text-danger mb-4">2. Select Payment Method</h4>
                    <div class="form-check p-3 border rounded-3 mb-3">
                        <input class="form-check-input ms-0 me-3" type="radio" name="payment_method" id="pay_cod" value="cod" checked>
                        <label class="form-check-label fw-bold" for="pay_cod">
                            <i class="fas fa-money-bill-wave me-2 text-success"></i> Cash on Delivery (COD)
                        </label>
                    </div>
                    <div class="form-check p-3 border rounded-3 mb-3">
                        <input class="form-check-input ms-0 me-3" type="radio" name="payment_method" id="pay_bkash" value="bkash">
                        <label class="form-check-label fw-bold" for="pay_bkash">
                            <span class="badge bg-danger me-2">bKash</span> Send Money / Payment (01303721109)
                        </label>
                    </div>
                    <div class="form-check p-3 border rounded-3 mb-3">
                        <input class="form-check-input ms-0 me-3" type="radio" name="payment_method" id="pay_nagad" value="nagad">
                        <label class="form-check-label fw-bold" for="pay_nagad">
                            <span class="badge bg-warning text-dark me-2">Nagad</span> Payment (01303721109)
                        </label>
                    </div>
                    <div class="form-check p-3 border rounded-3">
                        <input class="form-check-input ms-0 me-3" type="radio" name="payment_method" id="pay_bank" value="bank_transfer">
                        <label class="form-check-label fw-bold" for="pay_bank">
                            <i class="fas fa-university me-2 text-primary"></i> Bank Transfer
                        </label>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="summary-card">
                    <h4 class="brand-font mb-4">Your Order</h4>
                    <div class="mb-4">
                        <?php foreach ($items as $item): ?>
                            <?php $effPrice = !empty($item['sale_price']) && $item['sale_price'] > 0 ? $item['sale_price'] : $item['price']; ?>
                            <div class="d-flex justify-content-between mb-2 small">
                                <span><?= htmlspecialchars($item['product_name']) ?> (x<?= $item['quantity'] ?>)</span>
                                <span class="fw-bold">৳<?= number_format($effPrice * $item['quantity'], 2) ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span class="fw-bold">৳<?= number_format($subtotal, 2) ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Delivery Fee</span>
                        <span class="fw-bold">৳<?= number_format($deliveryCharge, 2) ?></span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4 fs-5">
                        <span class="fw-bold">Total Payble</span>
                        <span class="fw-bold text-danger">৳<?= number_format($total, 2) ?></span>
                    </div>
                    <button type="submit" class="btn btn-primary-custom btn-lg w-100 py-3 fs-5">
                        <i class="fas fa-check-circle me-2"></i> Place Order Now
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
