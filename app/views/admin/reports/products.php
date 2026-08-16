<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="brand-font mb-0">Top Selling Products</h2>
    <a href="/admin/reports" class="btn btn-outline-custom"><i class="fas fa-arrow-left me-1"></i> Back</a>
</div>

<div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
    <table class="table align-middle">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Units Sold</th>
                <th>Total Revenue Generated</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($topProducts as $tp): ?>
                <tr>
                    <td class="fw-bold"><?= htmlspecialchars($tp['name']) ?></td>
                    <td><?= $tp['total_sold'] ?></td>
                    <td class="text-danger fw-bold">৳<?= number_format($tp['total_revenue'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
