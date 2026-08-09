<div class="container py-5">
    <div class="max-w-900 mx-auto">
        <div class="text-center mb-5">
            <h1 class="display-5 brand-font mb-2">Custom Cake Designer</h1>
            <p class="text-muted lead">Design your dream cake step-by-step. Select shape, flavor, weight, cream type, and upload reference photos!</p>
        </div>

        <div class="cake-builder-card">
            <form action="/custom-cake" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">

                <h4 class="mb-4 text-danger brand-font border-bottom pb-2">1. Select Cake Specifications</h4>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Cake Shape</label>
                        <select name="shape" class="form-select form-select-lg">
                            <option value="Round">Classic Round</option>
                            <option value="Square">Modern Square</option>
                            <option value="Heart">Romantic Heart</option>
                            <option value="2-Tier">2-Tiered Celebration Cake</option>
                            <option value="3-Tier">3-Tiered Royal Wedding Cake</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Flavor</label>
                        <select name="flavor" class="form-select form-select-lg">
                            <option value="Belgian Chocolate">Rich Belgian Chocolate Fudge</option>
                            <option value="Red Velvet">Classic Red Velvet</option>
                            <option value="Vanilla Strawberry">Vanilla & Fresh Strawberry</option>
                            <option value="Black Forest">Black Forest Cherry</option>
                            <option value="Butterscotch">Butterscotch Crunch</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Weight / Size</label>
                        <select name="weight" id="cake-weight" class="form-select form-select-lg">
                            <option value="1" selected>1 Kg (Serves 6-8)</option>
                            <option value="1.5">1.5 Kg (Serves 10-12)</option>
                            <option value="2">2 Kg (Serves 15-18)</option>
                            <option value="3">3 Kg (Serves 25-30)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Cream Type</label>
                        <select name="cream_type" id="cream-type" class="form-select form-select-lg">
                            <option value="Whipped Cream" data-extra="0">Light Whipped Cream (+৳0)</option>
                            <option value="Buttercream" data-extra="100">Rich Italian Buttercream (+৳100)</option>
                            <option value="Cream Cheese" data-extra="200">Silky Cream Cheese (+৳200)</option>
                            <option value="Ganache" data-extra="250">Pure Dark Chocolate Ganache (+৳250)</option>
                        </select>
                    </div>
                </div>

                <h4 class="mb-4 text-danger brand-font border-bottom pb-2">2. Design & Reference Upload</h4>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Upload Cake Reference Image (Optional)</label>
                        <input type="file" name="photo" class="form-control form-control-lg" accept="image/*">
                        <div class="form-text">Attach a photo from Pinterest, Instagram, or Google.</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Occasion</label>
                        <input type="text" name="occasion" class="form-control form-control-lg" placeholder="Birthday, Anniversary, Wedding...">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">Cake Text / Written Message</label>
                        <input type="text" name="cake_message" class="form-control form-control-lg" placeholder="e.g. Happy Birthday Tanvir!">
                    </div>
                </div>

                <h4 class="mb-4 text-danger brand-font border-bottom pb-2">3. Customer Information</h4>
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Your Name *</label>
                        <input type="text" name="customer_name" class="form-control form-control-lg" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Phone / WhatsApp Number *</label>
                        <input type="text" name="customer_phone" class="form-control form-control-lg" placeholder="01303721109" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Email Address *</label>
                        <input type="email" name="customer_email" class="form-control form-control-lg" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Delivery Date *</label>
                        <input type="date" name="delivery_date" class="form-control form-control-lg" required min="<?= date('Y-m-d', strtotime('+2 days')) ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Budget Expectation (BDT)</label>
                        <input type="number" name="budget" class="form-control form-control-lg" placeholder="e.g. 1500">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">Special Requests / Notes</label>
                        <textarea name="notes" class="form-control" rows="3" placeholder="Tell us specific colors, decorations, eggless options, etc."></textarea>
                    </div>
                </div>

                <div class="p-4 bg-light rounded-4 text-center mb-4">
                    <span class="text-muted fs-6">Estimated Cost starting from:</span>
                    <h3 class="text-danger display-6 brand-font mb-0" id="estimated-price-display">৳800.00</h3>
                    <small class="text-muted">Final price verified by baker upon order confirmation.</small>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary-custom btn-lg px-5 py-3 fs-5">
                        <i class="fas fa-paper-plane me-2"></i> Submit Custom Cake Order
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
