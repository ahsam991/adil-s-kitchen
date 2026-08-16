<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="brand-font mb-0">Customer: <?= htmlspecialchars($customer['first_name'] . ' ' . $customer['last_name']) ?></h2>
    <a href="/admin/customers" class="btn btn-outline-custom"><i class="fas fa-arrow-left me-1"></i> Back</a>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
            <h5 class="brand-font mb-3">Customer Details</h5>
            <p class="mb-1"><strong>Email:</strong> <?= htmlspecialchars($customer['email']) ?></p>
            <p class="mb-1"><strong>Phone:</strong> <?= htmlspecialchars($customer['phone']) ?></p>
            <p class="mb-0"><strong>Joined:</strong> <?= date('Y-m-d', strtotime($customer['created_at'])) ?></p>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
            <h5 class="brand-font mb-3">Order History</h5>
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $o): ?>
                        <tr>
                            <td class="fw-bold"><?= htmlspecialchars($o['order_number']) ?></td>
                            <td><?= date('Y-m-d', strtotime($o['created_at'])) ?></td>
                            <td class="text-danger fw-bold">৳<?= number_format($o['total_amount'], 2) ?></td>
                            <td><span class="badge bg-danger"><?= htmlspecialchars($o['order_status']) ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
