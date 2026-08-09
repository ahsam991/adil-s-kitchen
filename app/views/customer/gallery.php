<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-5 brand-font mb-2">Cake & Bakery Gallery</h1>
        <p class="text-muted lead">Real photos of custom orders, celebration cakes, and freshly baked goods crafted in our kitchen.</p>
    </div>

    <div class="row g-4">
        <?php if (empty($galleryItems)): ?>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=500&auto=format&fit=crop" class="img-fluid" alt="Chocolate Fudge Cake">
                    <div class="p-3 text-center">
                        <h5 class="mb-0">Royal Chocolate Fudge Cake</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1535141192574-5d4897c13136?w=500&auto=format&fit=crop" class="img-fluid" alt="Custom Floral Cake">
                    <div class="p-3 text-center">
                        <h5 class="mb-0">Custom Wedding Floral Cake</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1550617931-e17a7b70dce2?w=500&auto=format&fit=crop" class="img-fluid" alt="Assorted Cupcakes">
                    <div class="p-3 text-center">
                        <h5 class="mb-0">Red Velvet Cupcake Box</h5>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($galleryItems as $item): ?>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        <img src="<?= htmlspecialchars($item['image']) ?>" class="img-fluid" alt="<?= htmlspecialchars($item['title']) ?>">
                        <div class="p-3 text-center">
                            <h5 class="mb-0"><?= htmlspecialchars($item['title']) ?></h5>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
