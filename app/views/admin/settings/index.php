<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="brand-font mb-0">Store Settings</h2>
</div>

<div class="card border-0 shadow-sm rounded-4 p-4 bg-white max-w-700">
    <form action="/admin/settings" method="POST">
        <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">

        <div class="mb-3">
            <label class="form-label fw-bold">Store Name</label>
            <input type="text" name="store_name" class="form-control" value="<?= htmlspecialchars($settings['store_name']) ?>" required>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label fw-bold">Phone Number</label>
                <input type="text" name="store_phone" class="form-control" value="<?= htmlspecialchars($settings['store_phone']) ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">WhatsApp Hotline</label>
                <input type="text" name="store_whatsapp" class="form-control" value="<?= htmlspecialchars($settings['store_whatsapp']) ?>" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Contact Email</label>
            <input type="email" name="store_email" class="form-control" value="<?= htmlspecialchars($settings['store_email']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Store Address</label>
            <input type="text" name="store_address" class="form-control" value="<?= htmlspecialchars($settings['store_address']) ?>">
        </div>
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <label class="form-label fw-bold">Delivery Charge (BDT)</label>
                <input type="number" name="delivery_fee" class="form-control" value="<?= htmlspecialchars($settings['delivery_fee']) ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Free Delivery Minimum Order</label>
                <input type="number" name="free_delivery_threshold" class="form-control" value="<?= htmlspecialchars($settings['free_delivery_threshold']) ?>">
            </div>
        </div>
        <button type="submit" class="btn btn-primary-custom px-4">Save Store Settings</button>
    </form>
</div>
