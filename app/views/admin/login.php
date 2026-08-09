<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Adil's Signature Kitchen</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="bg-light d-flex align-items-center min-vh-100">
    <div class="container">
        <div class="max-w-400 mx-auto">
            <div class="card border-0 shadow-lg rounded-4 p-4 bg-white">
                <div class="text-center mb-4">
                    <h3 class="brand-font text-danger">Adil's Admin</h3>
                    <p class="text-muted small">Signature Kitchen Control Panel</p>
                </div>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger small p-2"><?= htmlspecialchars($_SESSION['error']) ?></div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <form action="/admin/login" method="POST">
                    <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Admin Email</label>
                        <input type="email" name="email" class="form-control" value="admin@adilskitchen.com" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>
                    <button type="submit" class="btn btn-primary-custom w-100 py-2">Login To Dashboard</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
