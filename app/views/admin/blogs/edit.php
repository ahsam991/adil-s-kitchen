<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="brand-font mb-0">Edit Article</h2>
    <a href="/admin/blogs" class="btn btn-outline-custom"><i class="fas fa-arrow-left me-1"></i> Back</a>
</div>

<div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
    <form action="/admin/blogs/<?= $blog['id'] ?>" method="POST">
        <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
        <div class="mb-3">
            <label class="form-label fw-bold">Title *</label>
            <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($blog['title']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Content *</label>
            <textarea name="content" class="form-control" rows="8" required><?= htmlspecialchars($blog['content']) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary-custom px-4">Update Article</button>
    </form>
</div>
