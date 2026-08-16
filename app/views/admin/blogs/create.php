<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="brand-font mb-0">New Blog Article</h2>
    <a href="/admin/blogs" class="btn btn-outline-custom"><i class="fas fa-arrow-left me-1"></i> Back</a>
</div>

<div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
    <form action="/admin/blogs" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
        <div class="mb-3">
            <label class="form-label fw-bold">Title *</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Cover Image</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Content *</label>
            <textarea name="content" class="form-control" rows="8" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary-custom px-4">Publish Article</button>
    </form>
</div>
