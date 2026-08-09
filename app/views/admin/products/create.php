<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="brand-font mb-0">Add New Product</h2>
    <a href="/admin/products" class="btn btn-outline-custom"><i class="fas fa-arrow-left me-1"></i> Back</a>
</div>

<div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
    <form action="/admin/products" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">

        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label fw-bold">Product Name *</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Category *</label>
                <select name="category_id" class="form-select" required>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Price (BDT) *</label>
                <input type="number" step="0.01" name="price" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Sale Price (Optional)</label>
                <input type="number" step="0.01" name="sale_price" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Stock Quantity *</label>
                <input type="number" name="stock" class="form-control" value="20" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">SKU</label>
                <input type="text" name="sku" class="form-control" placeholder="CAKE-101">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Weight / Size</label>
                <input type="text" name="weight" class="form-control" value="1 Kg">
            </div>
            <div class="col-12">
                <label class="form-label fw-bold">Short Description</label>
                <textarea name="short_description" class="form-control" rows="2"></textarea>
            </div>
            <div class="col-12">
                <label class="form-label fw-bold">Full Description</label>
                <textarea name="description" class="form-control" rows="5"></textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Product Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Status</label>
                <select name="status" class="form-select">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <div class="col-12 mt-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="featured" id="feat" value="1">
                    <label class="form-check-label" for="feat">Featured Product</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="best_seller" id="best" value="1">
                    <label class="form-check-label" for="best">Best Seller</label>
                </div>
            </div>
            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-primary-custom px-5">Save Product</button>
            </div>
        </div>
    </form>
</div>
