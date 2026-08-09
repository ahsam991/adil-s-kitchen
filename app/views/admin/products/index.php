<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="brand-font mb-0">Product Catalog</h2>
    <a href="/admin/products/create" class="btn btn-primary-custom"><i class="fas fa-plus me-1"></i> Add Product</a>
</div>

<div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $p): ?>
                    <tr>
                        <td>
                            <img src="<?= !empty($p['image']) ? $p['image'] : 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=80&auto=format&fit=crop' ?>" width="50" height="50" class="rounded-3 object-fit-cover" alt="">
                        </td>
                        <td class="fw-bold"><?= htmlspecialchars($p['name']) ?></td>
                        <td><?= htmlspecialchars($p['category_name'] ?? 'General') ?></td>
                        <td class="text-danger fw-bold">৳<?= number_format($p['price'], 2) ?></td>
                        <td><?= $p['stock'] ?></td>
                        <td><span class="badge bg-<?= $p['status'] === 'active' ? 'success' : 'secondary' ?>"><?= $p['status'] ?></span></td>
                        <td>
                            <a href="/admin/products/<?= $p['id'] ?>/edit" class="btn btn-sm btn-outline-primary me-1"><i class="fas fa-edit"></i></a>
                            <form action="/admin/products/<?= $p['id'] ?>/delete" method="POST" class="d-inline" onsubmit="return confirm('Delete this product?')">
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
