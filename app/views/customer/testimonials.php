<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-5 brand-font mb-2">Customer Reviews</h1>
        <p class="text-muted lead">Read genuine reviews from families and cake lovers who ordered from Adil's Signature Kitchen.</p>
    </div>

    <div class="row g-4">
        <?php foreach ($testimonials as $t): ?>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white">
                    <div class="text-warning mb-3">
                        <?php for ($i = 0; $i < ($t['rating'] ?? 5); $i++): ?>
                            <i class="fas fa-star"></i>
                        <?php endfor; ?>
                    </div>
                    <p class="fst-italic text-muted">"<?= htmlspecialchars($t['comment']) ?>"</p>
                    <div class="mt-auto border-top pt-3">
                        <h6 class="mb-0 fw-bold"><?= htmlspecialchars($t['name']) ?></h6>
                        <small class="text-muted"><?= htmlspecialchars($t['role'] ?? 'Happy Customer') ?></small>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
