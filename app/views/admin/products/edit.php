<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="brand-font mb-0">Edit Product</h2>
    <a href="/admin/products" class="btn btn-outline-custom"><i class="fas fa-arrow-left me-1"></i> Back</a>
</div>

<div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
    <form action="/admin/products/<?= $product['id'] ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">

        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label fw-bold">Product Name *</label>
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($product['name']) ?>" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Category *</label>
                <select name="category_id" class="form-select" required>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>" <?= $product['category_id'] == $cat['id'] ? 'selected' : '' ?>><?= htmlspecialchars($cat['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Price (BDT) *</label>
                <input type="number" step="0.01" name="price" class="form-control" value="<?= $product['price'] ?>" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Sale Price (Optional)</label>
                <input type="number" step="0.01" name="sale_price" class="form-control" value="<?= $product['sale_price'] ?>">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Stock Quantity *</label>
                <input type="number" name="stock" class="form-control" value="<?= $product['stock'] ?>" required>
            </div>
            <div class="col-12">
                <label class="form-label fw-bold">Description</label>
                <textarea name="description" class="form-control" rows="5"><?= htmlspecialchars($product['description']) ?></textarea>
            </div>
            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-primary-custom px-5">Update Product</button>
            </div>
        </div>
    </form>
</div>
