<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="brand-font mb-0">Blog Articles</h2>
    <a href="/admin/blogs/create" class="btn btn-primary-custom"><i class="fas fa-plus me-1"></i> New Article</a>
</div>

<div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
    <table class="table align-middle">
        <thead>
            <tr>
                <th>Title</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($blogs as $b): ?>
                <tr>
                    <td class="fw-bold"><?= htmlspecialchars($b['title']) ?></td>
                    <td><code><?= htmlspecialchars($b['slug']) ?></code></td>
                    <td><span class="badge bg-success"><?= $b['status'] ?></span></td>
                    <td><?= date('Y-m-d', strtotime($b['published_at'])) ?></td>
                    <td>
                        <a href="/admin/blogs/<?= $b['id'] ?>/edit" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                        <form action="/admin/blogs/<?= $b['id'] ?>/delete" method="POST" class="d-inline">
                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
