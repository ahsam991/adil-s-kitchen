<div class="row g-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
            <h4 class="brand-font mb-3">Add Category</h4>
            <form action="/admin/categories" method="POST">
                <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
                <div class="mb-3">
                    <label class="form-label fw-bold">Category Name *</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Description</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="0">
                </div>
                <button type="submit" class="btn btn-primary-custom w-100">Save Category</button>
            </form>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
            <h4 class="brand-font mb-3">Categories List</h4>
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Sort</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $cat): ?>
                        <tr>
                            <td class="fw-bold"><?= htmlspecialchars($cat['name']) ?></td>
                            <td><code><?= htmlspecialchars($cat['slug']) ?></code></td>
                            <td><?= $cat['sort_order'] ?></td>
                            <td>
                                <a href="/admin/categories/<?= $cat['id'] ?>/edit" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>
                                <form action="/admin/categories/<?= $cat['id'] ?>/delete" method="POST" class="d-inline" onsubmit="return confirm('Delete category?')">
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
