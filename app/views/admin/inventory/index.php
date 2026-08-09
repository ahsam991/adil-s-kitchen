<div class="row g-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
            <h4 class="brand-font mb-3">Add Ingredient</h4>
            <form action="/admin/inventory" method="POST">
                <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
                <div class="mb-3">
                    <label class="form-label fw-bold">Item Name *</label>
                    <input type="text" name="item_name" class="form-control" placeholder="Cake Flour, Sugar, Butter..." required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Unit *</label>
                    <input type="text" name="unit" class="form-control" placeholder="Kg, Liter, Pcs" value="Kg" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Initial Stock</label>
                    <input type="number" step="0.01" name="current_stock" class="form-control" value="10">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Low Stock Warning Alert Level</label>
                    <input type="number" step="0.01" name="alert_stock" class="form-control" value="5">
                </div>
                <button type="submit" class="btn btn-primary-custom w-100">Add Ingredient</button>
            </form>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
            <h4 class="brand-font mb-3">Raw Ingredients Inventory</h4>
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Ingredient</th>
                        <th>Unit</th>
                        <th>Current Stock</th>
                        <th>Alert Threshold</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($inventoryItems as $inv): ?>
                        <tr>
                            <td class="fw-bold"><?= htmlspecialchars($inv['item_name']) ?></td>
                            <td><?= htmlspecialchars($inv['unit']) ?></td>
                            <td class="fw-bold"><?= number_format($inv['current_stock'], 2) ?></td>
                            <td><?= number_format($inv['alert_stock'], 2) ?></td>
                            <td>
                                <?php if ($inv['current_stock'] <= $inv['alert_stock']): ?>
                                    <span class="badge bg-danger"><i class="fas fa-exclamation-triangle me-1"></i> Low Stock</span>
                                <?php else: ?>
                                    <span class="badge bg-success">In Stock</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
