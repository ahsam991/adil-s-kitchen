<div class="container py-5">
    <div class="max-w-500 mx-auto">
        <div class="card border-0 shadow-md rounded-4 p-4 bg-white">
            <h2 class="brand-font text-center mb-1">Create Account</h2>
            <p class="text-muted text-center mb-4">Join Adil's Signature Kitchen family</p>

            <form action="/register" method="POST">
                <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">First Name *</label>
                        <input type="text" name="first_name" class="form-control form-control-lg" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Last Name *</label>
                        <input type="text" name="last_name" class="form-control form-control-lg" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">Email Address *</label>
                        <input type="email" name="email" class="form-control form-control-lg" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">Phone Number *</label>
                        <input type="text" name="phone" class="form-control form-control-lg" placeholder="01303721109" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">Password *</label>
                        <input type="password" name="password" class="form-control form-control-lg" minlength="8" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary-custom btn-lg w-100 mt-2">Create Account</button>
                    </div>
                </div>
            </form>

            <div class="text-center mt-4 pt-3 border-top">
                <span class="text-muted">Already registered?</span> <a href="/login" class="fw-bold text-danger">Sign In</a>
            </div>
        </div>
    </div>
</div>
