<div class="container py-5">
    <div class="row g-5">
        <div class="col-lg-5">
            <h1 class="display-6 brand-font mb-3">Get in Touch</h1>
            <p class="text-muted">Have a question or custom cake inquiry? Contact us via phone, WhatsApp or send us a message directly.</p>

            <div class="d-flex align-items-center mb-4 p-3 bg-white rounded-3 shadow-sm">
                <i class="fab fa-whatsapp fs-1 text-success me-3"></i>
                <div>
                    <h6 class="mb-0 fw-bold">WhatsApp Hotline</h6>
                    <span class="text-muted fs-5">01303721109</span>
                </div>
            </div>
            <div class="d-flex align-items-center mb-4 p-3 bg-white rounded-3 shadow-sm">
                <i class="fas fa-envelope fs-1 text-danger me-3"></i>
                <div>
                    <h6 class="mb-0 fw-bold">Email Us</h6>
                    <span class="text-muted">info@adilskitchen.com</span>
                </div>
            </div>
            <div class="d-flex align-items-center p-3 bg-white rounded-3 shadow-sm">
                <i class="fas fa-map-marker-alt fs-1 text-primary me-3"></i>
                <div>
                    <h6 class="mb-0 fw-bold">Location</h6>
                    <span class="text-muted">Dhaka, Bangladesh</span>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                <h3 class="brand-font mb-4">Send Us a Message</h3>
                <form action="/contact" method="POST">
                    <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Your Name *</label>
                            <input type="text" name="name" class="form-control form-control-lg" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Email Address *</label>
                            <input type="email" name="email" class="form-control form-control-lg" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Phone Number</label>
                            <input type="text" name="phone" class="form-control form-control-lg">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Subject</label>
                            <input type="text" name="subject" class="form-control form-control-lg">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Message *</label>
                            <textarea name="message" class="form-control" rows="5" required></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary-custom btn-lg w-100">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
