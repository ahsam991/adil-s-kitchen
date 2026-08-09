<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="brand-font mb-0">Daily Sales Reports</h2>
    <div>
        <a href="/admin/reports/sales" class="btn btn-primary-custom me-2">Sales Report</a>
        <a href="/admin/reports/products" class="btn btn-outline-custom">Top Products</a>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
    <table class="table align-middle">
        <thead>
            <tr>
                <th>Date</th>
                <th>Total Orders</th>
                <th>Total Revenue</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dailySales as $ds): ?>
                <tr>
                    <td class="fw-bold"><?= $ds['sale_date'] ?></td>
                    <td><?= $ds['total_orders'] ?></td>
                    <td class="text-danger fw-bold">৳<?= number_format($ds['total_revenue'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
