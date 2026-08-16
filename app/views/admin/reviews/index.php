<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="brand-font mb-0">Customer Reviews Moderation</h2>
</div>

<div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
    <table class="table align-middle">
        <thead>
            <tr>
                <th>Customer</th>
                <th>Product</th>
                <th>Rating</th>
                <th>Comment</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reviews as $r): ?>
                <tr>
                    <td class="fw-bold"><?= htmlspecialchars($r['customer_name']) ?></td>
                    <td><?= htmlspecialchars($r['product_name'] ?? 'General') ?></td>
                    <td class="text-warning">
                        <?php for ($i = 0; $i < $r['rating']; $i++): ?><i class="fas fa-star"></i><?php endfor; ?>
                    </td>
                    <td class="small"><?= htmlspecialchars($r['comment']) ?></td>
                    <td><span class="badge bg-<?= $r['status'] === 'approved' ? 'success' : ($r['status'] === 'rejected' ? 'danger' : 'warning') ?>"><?= $r['status'] ?></span></td>
                    <td>
                        <form action="/admin/reviews/<?= $r['id'] ?>/approve" method="POST" class="d-inline">
                            <button type="submit" class="btn btn-sm btn-outline-success"><i class="fas fa-check"></i></button>
                        </form>
                        <form action="/admin/reviews/<?= $r['id'] ?>/reject" method="POST" class="d-inline">
                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-times"></i></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
