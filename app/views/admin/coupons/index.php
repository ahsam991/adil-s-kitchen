<div class="row g-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
            <h4 class="brand-font mb-3">Create Coupon Code</h4>
            <form action="/admin/coupons" method="POST">
                <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
                <div class="mb-3">
                    <label class="form-label fw-bold">Coupon Code *</label>
                    <input type="text" name="code" class="form-control text-uppercase" placeholder="E.G. CAKE10" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Discount Type *</label>
                    <select name="type" class="form-select">
                        <option value="percentage">Percentage (%)</option>
                        <option value="fixed">Fixed Amount (BDT)</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Discount Value *</label>
                    <input type="number" step="0.01" name="value" class="form-control" placeholder="10 or 100" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Minimum Order Purchase</label>
                    <input type="number" step="0.01" name="min_purchase" class="form-control" value="500">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Expiry Date *</label>
                    <input type="date" name="expiry_date" class="form-control" value="<?= date('Y-12-31') ?>" required>
                </div>
                <button type="submit" class="btn btn-primary-custom w-100">Create Coupon</button>
            </form>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
            <h4 class="brand-font mb-3">Active Coupons</h4>
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Discount</th>
                        <th>Min Order</th>
                        <th>Expiry</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($coupons as $cp): ?>
                        <tr>
                            <td class="fw-bold text-danger"><code><?= htmlspecialchars($cp['code']) ?></code></td>
                            <td><?= $cp['type'] === 'percentage' ? $cp['value'] . '%' : '৳' . $cp['value'] ?></td>
                            <td>৳<?= number_format($cp['min_purchase'], 2) ?></td>
                            <td><?= $cp['expiry_date'] ?></td>
                            <td>
                                <form action="/admin/coupons/<?= $cp['id'] ?>/delete" method="POST" class="d-inline">
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
