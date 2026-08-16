<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="brand-font mb-0">Order Management</h2>
</div>

<div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Order Status</th>
                    <th>Payment Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $ord): ?>
                    <tr>
                        <td class="fw-bold"><?= htmlspecialchars($ord['order_number']) ?></td>
                        <td><?= htmlspecialchars($ord['customer_name']) ?></td>
                        <td><?= htmlspecialchars($ord['customer_phone']) ?></td>
                        <td><?= date('Y-m-d H:i', strtotime($ord['created_at'])) ?></td>
                        <td class="fw-bold text-danger">৳<?= number_format($ord['total_amount'], 2) ?></td>
                        <td><span class="badge bg-danger text-capitalize"><?= htmlspecialchars($ord['order_status']) ?></span></td>
                        <td><span class="badge bg-success text-capitalize"><?= htmlspecialchars($ord['payment_status']) ?></span></td>
                        <td>
                            <a href="/admin/orders/<?= $ord['id'] ?>" class="btn btn-sm btn-outline-primary me-1">View / Edit</a>
                            <a href="/admin/orders/<?= $ord['id'] ?>/invoice" target="_blank" class="btn btn-sm btn-outline-secondary"><i class="fas fa-print"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
