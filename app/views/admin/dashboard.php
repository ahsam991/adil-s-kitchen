<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="brand-font mb-0">Dashboard Overview</h2>
    <span class="text-muted"><i class="far fa-calendar-alt me-1"></i> <?= date('F j, Y') ?></span>
</div>

<!-- Stat Cards Row -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="stat-card d-flex align-items-center">
            <div class="stat-icon me-3"><i class="fas fa-shopping-bag"></i></div>
            <div>
                <span class="text-muted small">Today's Orders</span>
                <h3 class="mb-0 fw-bold"><?= $todayCount ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card d-flex align-items-center">
            <div class="stat-icon me-3 text-success bg-success-subtle"><i class="fas fa-money-bill-wave"></i></div>
            <div>
                <span class="text-muted small">Today's Revenue</span>
                <h3 class="mb-0 fw-bold text-success">৳<?= number_format($todayRevenue, 2) ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card d-flex align-items-center">
            <div class="stat-icon me-3 text-primary bg-primary-subtle"><i class="fas fa-calendar-check"></i></div>
            <div>
                <span class="text-muted small">Monthly Revenue</span>
                <h3 class="mb-0 fw-bold text-primary">৳<?= number_format($monthlyRevenue, 2) ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card d-flex align-items-center">
            <div class="stat-icon me-3 text-warning bg-warning-subtle"><i class="fas fa-clock"></i></div>
            <div>
                <span class="text-muted small">Pending Orders</span>
                <h3 class="mb-0 fw-bold text-warning"><?= $pendingOrders ?></h3>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders Table -->
<div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="brand-font mb-0">Recent Customer Orders</h4>
        <a href="/admin/orders" class="btn btn-sm btn-outline-custom">View All Orders</a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recentOrders as $ord): ?>
                    <tr>
                        <td class="fw-bold"><?= htmlspecialchars($ord['order_number']) ?></td>
                        <td><?= htmlspecialchars($ord['customer_name']) ?></td>
                        <td><?= htmlspecialchars($ord['customer_phone']) ?></td>
                        <td class="fw-bold text-danger">৳<?= number_format($ord['total_amount'], 2) ?></td>
                        <td><span class="badge bg-danger text-capitalize"><?= htmlspecialchars($ord['order_status']) ?></span></td>
                        <td><span class="badge bg-secondary text-uppercase"><?= htmlspecialchars($ord['payment_method']) ?></span></td>
                        <td>
                            <a href="/admin/orders/<?= $ord['id'] ?>" class="btn btn-sm btn-outline-primary">Manage</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
