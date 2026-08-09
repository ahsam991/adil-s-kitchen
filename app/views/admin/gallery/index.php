<div class="row g-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
            <h4 class="brand-font mb-3">Upload Gallery Photo</h4>
            <form action="/admin/gallery" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
                <div class="mb-3">
                    <label class="form-label fw-bold">Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Chocolate Dream Cake">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Image File *</label>
                    <input type="file" name="image" class="form-control" accept="image/*" required>
                </div>
                <button type="submit" class="btn btn-primary-custom w-100">Upload Image</button>
            </form>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
            <h4 class="brand-font mb-3">Gallery Photos</h4>
            <div class="row g-3">
                <?php foreach ($items as $item): ?>
                    <div class="col-6 col-md-4">
                        <div class="position-relative border rounded-3 overflow-hidden">
                            <img src="<?= htmlspecialchars($item['image']) ?>" class="w-100 object-fit-cover" style="height: 120px;" alt="">
                            <form action="/admin/gallery/<?= $item['id'] ?>/delete" method="POST" class="position-absolute top-0 end-0 p-1">
                                <button type="submit" class="btn btn-sm btn-danger py-0 px-1"><i class="fas fa-times"></i></button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
