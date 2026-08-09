<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'Admin Panel - Adil\'s Signature Kitchen') ?></title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="bg-light">

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Navigation -->
        <div class="col-md-3 col-lg-2 admin-sidebar px-0">
            <div class="text-center py-4 border-bottom border-secondary">
                <h4 class="text-white brand-font mb-0">Adil's Admin</h4>
                <small class="text-warning">Signature Kitchen</small>
            </div>
            <ul class="nav flex-column mt-3">
                <li class="nav-item"><a class="nav-link" href="/admin/dashboard"><i class="fas fa-chart-line me-2"></i> Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin/orders"><i class="fas fa-shopping-cart me-2"></i> Orders</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin/products"><i class="fas fa-birthday-cake me-2"></i> Products</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin/categories"><i class="fas fa-tags me-2"></i> Categories</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin/customers"><i class="fas fa-users me-2"></i> Customers</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin/inventory"><i class="fas fa-boxes me-2"></i> Inventory</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin/reviews"><i class="fas fa-star me-2"></i> Reviews</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin/coupons"><i class="fas fa-ticket-alt me-2"></i> Coupons</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin/gallery"><i class="fas fa-images me-2"></i> Gallery</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin/blogs"><i class="fas fa-newspaper me-2"></i> Blog Articles</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin/reports"><i class="fas fa-file-invoice-dollar me-2"></i> Reports</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin/settings"><i class="fas fa-cog me-2"></i> Settings</a></li>
                <li class="nav-item"><a class="nav-link" href="/admin/users"><i class="fas fa-user-shield me-2"></i> Users & Roles</a></li>
                <li class="nav-item mt-4"><a class="nav-link text-danger" href="/admin/logout"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
            </ul>
        </div>

        <!-- Main Content Area -->
        <div class="col-md-9 col-lg-10 p-4">
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> <?= htmlspecialchars($_SESSION['success']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php
            if (isset($viewContent) && file_exists($viewContent)) {
                include $viewContent;
            } elseif (isset($view) && file_exists(__DIR__ . '/../' . $view . '.php')) {
                include __DIR__ . '/../' . $view . '.php';
            }
            ?>
        </div>
    </div>
</div>

<script src="/assets/js/jquery-3.7.1.min.js"></script>
<script src="/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
