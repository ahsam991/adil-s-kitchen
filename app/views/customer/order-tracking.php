<div class="container py-5">
    <div class="max-w-700 mx-auto">
        <div class="text-center mb-5">
            <h1 class="display-5 brand-font mb-2">Live Order Tracking</h1>
            <p class="text-muted lead">Track your fresh cake & food delivery status in real-time</p>
        </div>

        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
            <form action="/order-tracking" method="GET" class="d-flex gap-2">
                <input type="text" name="order" class="form-control form-control-lg" placeholder="Enter Order Number (e.g. ASK-20260809-1234)" value="<?= htmlspecialchars($searchOrder ?? '') ?>" required>
                <button type="submit" class="btn btn-primary-custom px-4"><i class="fas fa-search me-1"></i> Track</button>
            </form>
        </div>

        <?php if ($order): ?>
            <div class="card border-0 shadow-md rounded-4 p-4 bg-white">
                <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                    <div>
                        <h4 class="brand-font mb-0 text-danger">Order #<?= htmlspecialchars($order['order_number']) ?></h4>
                        <small class="text-muted">Placed on <?= date('F j, Y, g:i a', strtotime($order['created_at'])) ?></small>
                    </div>
                    <span class="badge bg-danger fs-6 px-3 py-2 text-capitalize"><?= htmlspecialchars($order['order_status']) ?></span>
                </div>

                <!-- Order Timeline Progress Bar -->
                <div class="d-flex justify-content-between text-center my-4 position-relative">
                    <?php
                    $statuses = ['pending' => 'Pending', 'confirmed' => 'Confirmed', 'preparing' => 'Baking', 'out_for_delivery' => 'On Way', 'delivered' => 'Delivered'];
                    $currentIdx = array_search($order['order_status'], array_keys($statuses));
                    if ($currentIdx === false) $currentIdx = 0;
                    ?>
                    <?php $i = 0; foreach ($statuses as $stKey => $stLabel): ?>
                        <div class="flex-fill">
                            <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center mb-2 <?= $i <= $currentIdx ? 'bg-danger text-white' : 'bg-light text-muted' ?>" style="width: 45px; height: 45px;">
                                <i class="fas fa-check"></i>
                            </div>
                            <small class="fw-bold <?= $i <= $currentIdx ? 'text-danger' : 'text-muted' ?>"><?= $stLabel ?></small>
                        </div>
                    <?php $i++; endforeach; ?>
                </div>

                <div class="bg-light p-3 rounded-3 mb-4">
                    <h6>Delivery Details:</h6>
                    <p class="mb-1"><strong>Customer:</strong> <?= htmlspecialchars($order['customer_name']) ?> (<?= htmlspecialchars($order['customer_phone']) ?>)</p>
                    <p class="mb-0"><strong>Address:</strong> <?= htmlspecialchars($order['shipping_address']) ?></p>
                </div>

                <h5>Ordered Items:</h5>
                <ul class="list-group list-group-flush mb-3">
                    <?php foreach ($items as $item): ?>
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span><?= htmlspecialchars($item['product_name']) ?> x <?= $item['quantity'] ?></span>
                            <span class="fw-bold">৳<?= number_format($item['total'], 2) ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <div class="d-flex justify-content-between fs-5 fw-bold border-top pt-3 text-danger">
                    <span>Total Amount:</span>
                    <span>৳<?= number_format($order['total_amount'], 2) ?></span>
                </div>
            </div>
        <?php elseif ($searchOrder): ?>
            <div class="alert alert-warning text-center">
                <i class="fas fa-exclamation-triangle me-2"></i> No order found for "<?= htmlspecialchars($searchOrder) ?>". Please double check your order ID.
            </div>
        <?php endif; ?>
    </div>
</div>
