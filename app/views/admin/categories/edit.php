<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="brand-font mb-0">Edit Category: <?= htmlspecialchars($category['name']) ?></h2>
    <a href="/admin/categories" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-1"></i> Back to Categories</a>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
            <form action="/admin/categories/<?= $category['id'] ?>/update" method="POST">
                <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
                <div class="mb-3">
                    <label class="form-label fw-bold">Category Name *</label>
                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($category['name']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Description</label>
                    <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($category['description'] ?? '') ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="<?= $category['sort_order'] ?>">
                </div>
                <button type="submit" class="btn btn-primary-custom w-100"><i class="fas fa-save me-1"></i> Update Category</button>
            </form>
        </div>
    </div>
</div>
