<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-5 brand-font mb-2">Bakery Blog & Baking Secrets</h1>
        <p class="text-muted lead">Recipes, cake maintenance tips, and behind-the-scenes stories from Adil's Signature Kitchen.</p>
    </div>

    <div class="row g-4">
        <?php if (empty($blogs)): ?>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=600&auto=format&fit=crop" class="img-fluid" alt="Chocolate Cake Tips">
                    <div class="p-4">
                        <h4>Secrets to the Perfect 5-Layer Dream Cake Shell</h4>
                        <p class="text-muted">Discover how we craft our signature cracking chocolate shell using Belgian couverture chocolate...</p>
                        <a href="/blog" class="text-danger fw-bold">Read Article <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($blogs as $b): ?>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        <img src="<?= !empty($b['image']) ? $b['image'] : 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=600&auto=format&fit=crop' ?>" class="img-fluid" alt="<?= htmlspecialchars($b['title']) ?>">
                        <div class="p-4">
                            <h4><a href="/blog/<?= $b['slug'] ?>"><?= htmlspecialchars($b['title']) ?></a></h4>
                            <p class="text-muted"><?= htmlspecialchars(substr(strip_tags($b['content']), 0, 140)) ?>...</p>
                            <a href="/blog/<?= $b['slug'] ?>" class="text-danger fw-bold">Read Article <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
