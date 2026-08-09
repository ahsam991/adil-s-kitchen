<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="brand-font mb-0">Registered Customers</h2>
</div>

<div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Total Orders</th>
                    <th>Total Spent</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $c): ?>
                    <tr>
                        <td class="fw-bold"><?= htmlspecialchars($c['first_name'] . ' ' . $c['last_name']) ?></td>
                        <td><?= htmlspecialchars($c['email']) ?></td>
                        <td><?= htmlspecialchars($c['phone']) ?></td>
                        <td><?= $c['total_orders'] ?></td>
                        <td class="fw-bold text-danger">৳<?= number_format($c['total_spent'], 2) ?></td>
                        <td><a href="/admin/customers/<?= $c['id'] ?>" class="btn btn-sm btn-outline-primary">View Profile</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
