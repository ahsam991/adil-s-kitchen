<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="brand-font mb-0">Order Details #<?= htmlspecialchars($order['order_number']) ?></h2>
    <a href="/admin/orders/<?= $order['id'] ?>/invoice" target="_blank" class="btn btn-secondary-custom"><i class="fas fa-print me-1"></i> Print Invoice</a>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
            <h5 class="brand-font mb-3">Order Items</h5>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['product_name']) ?></td>
                                <td>৳<?= number_format($item['price'], 2) ?></td>
                                <td><?= $item['quantity'] ?></td>
                                <td class="fw-bold">৳<?= number_format($item['total'], 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between fs-5 border-top pt-3 text-danger fw-bold">
                <span>Total Amount:</span>
                <span>৳<?= number_format($order['total_amount'], 2) ?></span>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
            <h5 class="brand-font mb-3">Update Order Status</h5>
            <form action="/admin/orders/<?= $order['id'] ?>/status" method="POST">
                <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
                <div class="mb-3">
                    <label class="form-label fw-bold">Order Fulfillment Status</label>
                    <select name="order_status" class="form-select">
                        <option value="pending" <?= $order['order_status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="confirmed" <?= $order['order_status'] === 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
                        <option value="preparing" <?= $order['order_status'] === 'preparing' ? 'selected' : '' ?>>Preparing / Baking</option>
                        <option value="ready" <?= $order['order_status'] === 'ready' ? 'selected' : '' ?>>Ready for Pickup</option>
                        <option value="out_for_delivery" <?= $order['order_status'] === 'out_for_delivery' ? 'selected' : '' ?>>Out For Delivery</option>
                        <option value="delivered" <?= $order['order_status'] === 'delivered' ? 'selected' : '' ?>>Delivered</option>
                        <option value="cancelled" <?= $order['order_status'] === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Payment Status</label>
                    <select name="payment_status" class="form-select">
                        <option value="pending" <?= $order['payment_status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="paid" <?= $order['payment_status'] === 'paid' ? 'selected' : '' ?>>Paid</option>
                        <option value="failed" <?= $order['payment_status'] === 'failed' ? 'selected' : '' ?>>Failed</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary-custom w-100">Update Status</button>
            </form>
        </div>

        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
            <h5 class="brand-font mb-3">Customer Info</h5>
            <p class="mb-1"><strong>Name:</strong> <?= htmlspecialchars($order['customer_name']) ?></p>
            <p class="mb-1"><strong>Phone:</strong> <?= htmlspecialchars($order['customer_phone']) ?></p>
            <p class="mb-1"><strong>Email:</strong> <?= htmlspecialchars($order['customer_email']) ?></p>
            <p class="mb-0"><strong>Address:</strong> <?= htmlspecialchars($order['shipping_address']) ?></p>
        </div>
    </div>
</div>
