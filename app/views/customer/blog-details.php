<div class="container py-5">
    <div class="max-w-800 mx-auto">
        <h1 class="display-5 brand-font mb-3"><?= htmlspecialchars($blog['title']) ?></h1>
        <p class="text-muted mb-4"><i class="far fa-calendar-alt me-2"></i> Published on <?= date('F j, Y', strtotime($blog['published_at'] ?? 'now')) ?></p>
        <img src="<?= !empty($blog['image']) ? $blog['image'] : 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=800&auto=format&fit=crop' ?>" class="img-fluid rounded-4 mb-4 w-100" alt="<?= htmlspecialchars($blog['title']) ?>">
        <div class="blog-content fs-5 leading-relaxed">
            <?= nl2br(htmlspecialchars($blog['content'])) ?>
        </div>
        <div class="mt-5 border-top pt-4">
            <a href="/blog" class="btn btn-outline-custom"><i class="fas fa-arrow-left me-2"></i> Back to Blog</a>
        </div>
    </div>
</div>
