<div class="container py-5">
    <div class="max-w-450 mx-auto">
        <div class="card border-0 shadow-md rounded-4 p-4 bg-white">
            <h2 class="brand-font text-center mb-1">Welcome Back</h2>
            <p class="text-muted text-center mb-4">Login to your Adil's Signature Kitchen account</p>

            <form action="/login" method="POST">
                <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
                <div class="mb-3">
                    <label class="form-label fw-bold">Email Address</label>
                    <input type="email" name="email" class="form-control form-control-lg" required>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <label class="form-label fw-bold">Password</label>
                        <a href="/forgot-password" class="small text-muted">Forgot Password?</a>
                    </div>
                    <input type="password" name="password" class="form-control form-control-lg" required>
                </div>
                <button type="submit" class="btn btn-primary-custom btn-lg w-100 mt-3">Sign In</button>
            </form>

            <div class="text-center mt-4 pt-3 border-top">
                <span class="text-muted">Don't have an account?</span> <a href="/register" class="fw-bold text-danger">Register Now</a>
            </div>
        </div>
    </div>
</div>
