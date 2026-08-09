<?php include __DIR__ . '/header.php'; ?>

<?php if (isset($_SESSION['success'])): ?>
    <div class="container mt-3">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> <?= htmlspecialchars($_SESSION['success']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="container mt-3">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> <?= htmlspecialchars($_SESSION['error']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<?php
if (isset($viewContent) && file_exists($viewContent)) {
    include $viewContent;
} elseif (isset($view) && file_exists(__DIR__ . '/../' . $view . '.php')) {
    include __DIR__ . '/../' . $view . '.php';
}
?>

<?php include __DIR__ . '/footer.php'; ?>
