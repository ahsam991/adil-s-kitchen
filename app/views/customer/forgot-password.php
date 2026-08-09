<div class="container py-5">
    <div class="max-w-450 mx-auto">
        <div class="card border-0 shadow-md rounded-4 p-4 bg-white">
            <h3 class="brand-font text-center mb-2">Reset Password</h3>
            <p class="text-muted text-center mb-4">Enter your registered email address to receive password reset instructions.</p>

            <form action="/forgot-password" method="POST">
                <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
                <div class="mb-3">
                    <label class="form-label fw-bold">Email Address</label>
                    <input type="email" name="email" class="form-control form-control-lg" required>
                </div>
                <button type="submit" class="btn btn-primary-custom btn-lg w-100 mt-2">Send Reset Link</button>
            </form>

            <div class="text-center mt-4">
                <a href="/login" class="text-muted"><i class="fas fa-arrow-left me-1"></i> Back to Login</a>
            </div>
        </div>
    </div>
</div>
