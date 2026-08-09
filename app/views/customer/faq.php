<div class="container py-5">
    <div class="max-w-800 mx-auto">
        <div class="text-center mb-5">
            <h1 class="display-5 brand-font mb-2">Frequently Asked Questions</h1>
            <p class="text-muted lead">Got questions about ordering, custom cakes, or delivery? We've got answers!</p>
        </div>

        <div class="accordion" id="faqAccordion">
            <?php foreach ($faqs as $idx => $f): ?>
                <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 overflow-hidden">
                    <h2 class="accordion-header" id="heading<?= $idx ?>">
                        <button class="accordion-button <?= $idx !== 0 ? 'collapsed' : '' ?> fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $idx ?>">
                            <?= htmlspecialchars($f['question']) ?>
                        </button>
                    </h2>
                    <div id="collapse<?= $idx ?>" class="accordion-collapse collapse <?= $idx === 0 ? 'show' : '' ?>" data-bs-parent="#faqAccordion">
                        <div class="accordion-body text-muted">
                            <?= htmlspecialchars($f['answer']) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
