<div class="container py-5">
    <div class="row g-4">
        <!-- Account Sidebar -->
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="text-center py-3 border-bottom mb-3">
                    <div class="bg-danger text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2 fs-3" style="width: 70px; height: 70px;">
                        <i class="fas fa-user"></i>
                    </div>
                    <h5 class="mb-0 brand-font"><?= htmlspecialchars($_SESSION['user_name'] ?? 'Customer') ?></h5>
                    <small class="text-muted"><?= htmlspecialchars($_SESSION['user_email'] ?? '') ?></small>
                </div>
                <div class="list-group list-group-flush">
                    <a href="/my-account" class="list-group-item list-group-item-action border-0 px-0 <?= empty($viewSection) ? 'fw-bold text-danger' : '' ?>"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
                    <a href="/my-account/orders" class="list-group-item list-group-item-action border-0 px-0 <?= ($viewSection ?? '') === 'orders' ? 'fw-bold text-danger' : '' ?>"><i class="fas fa-shopping-bag me-2"></i> My Orders</a>
                    <a href="/my-account/profile" class="list-group-item list-group-item-action border-0 px-0 <?= ($viewSection ?? '') === 'profile' ? 'fw-bold text-danger' : '' ?>"><i class="fas fa-user-edit me-2"></i> Edit Profile</a>
                    <a href="/my-account/addresses" class="list-group-item list-group-item-action border-0 px-0 <?= ($viewSection ?? '') === 'addresses' ? 'fw-bold text-danger' : '' ?>"><i class="fas fa-map-marker-alt me-2"></i> Address Book</a>
                    <a href="/my-account/password" class="list-group-item list-group-item-action border-0 px-0 <?= ($viewSection ?? '') === 'password' ? 'fw-bold text-danger' : '' ?>"><i class="fas fa-key me-2"></i> Password</a>
                    <a href="/logout" class="list-group-item list-group-item-action border-0 px-0 text-danger mt-3"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
                </div>
            </div>
        </div>

        <!-- Main Account Content -->
        <div class="col-lg-9">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                <?php if (empty($viewSection)): ?>
                    <h3 class="brand-font mb-3">Welcome to Your Account</h3>
                    <p class="text-muted">From your account dashboard, you can view your recent orders, manage your shipping addresses, and edit your profile password.</p>

                    <h5 class="mt-4 mb-3">Recent Orders</h5>
                    <?php if (!empty($recentOrders)): ?>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Date</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recentOrders as $o): ?>
                                        <tr>
                                            <td class="fw-bold"><?= htmlspecialchars($o['order_number']) ?></td>
                                            <td><?= date('Y-m-d', strtotime($o['created_at'])) ?></td>
                                            <td class="text-danger fw-bold">৳<?= number_format($o['total_amount'], 2) ?></td>
                                            <td><span class="badge bg-secondary text-capitalize"><?= htmlspecialchars($o['order_status']) ?></span></td>
                                            <td><a href="/my-account/order/<?= $o['id'] ?>" class="btn btn-sm btn-outline-custom">View</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-muted">You haven't placed any orders yet.</p>
                    <?php endif; ?>

                <?php elseif ($viewSection === 'orders'): ?>
                    <h3 class="brand-font mb-4">My Order History</h3>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($orders as $o): ?>
                                    <tr>
                                        <td class="fw-bold"><?= htmlspecialchars($o['order_number']) ?></td>
                                        <td><?= date('Y-m-d', strtotime($o['created_at'])) ?></td>
                                        <td class="text-danger fw-bold">৳<?= number_format($o['total_amount'], 2) ?></td>
                                        <td><span class="badge bg-danger text-capitalize"><?= htmlspecialchars($o['order_status']) ?></span></td>
                                        <td><a href="/my-account/order/<?= $o['id'] ?>" class="btn btn-sm btn-outline-custom">Details</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                <?php elseif ($viewSection === 'profile'): ?>
                    <h3 class="brand-font mb-4">Edit Profile</h3>
                    <form action="/my-account/profile" method="POST">
                        <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">First Name</label>
                                <input type="text" name="first_name" class="form-control form-control-lg" value="<?= htmlspecialchars($user['first_name'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Last Name</label>
                                <input type="text" name="last_name" class="form-control form-control-lg" value="<?= htmlspecialchars($user['last_name'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Phone Number</label>
                                <input type="text" name="phone" class="form-control form-control-lg" value="<?= htmlspecialchars($user['phone'] ?? '') ?>">
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary-custom btn-lg">Save Profile</button>
                            </div>
                        </div>
                    </form>

                <?php elseif ($viewSection === 'password'): ?>
                    <h3 class="brand-font mb-4">Change Password</h3>
                    <form action="/my-account/password" method="POST">
                        <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Current Password</label>
                            <input type="password" name="current_password" class="form-control form-control-lg" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">New Password</label>
                            <input type="password" name="new_password" class="form-control form-control-lg" minlength="8" required>
                        </div>
                        <button type="submit" class="btn btn-primary-custom btn-lg">Update Password</button>
                    </form>

                <?php elseif ($viewSection === 'addresses'): ?>
                    <h3 class="brand-font mb-4">Address Book</h3>
                    <?php foreach ($addresses as $addr): ?>
                        <div class="p-3 border rounded-3 mb-3 bg-light">
                            <h6><?= htmlspecialchars($addr['address_line1']) ?></h6>
                            <p class="mb-0 text-muted"><?= htmlspecialchars($addr['city']) ?>, <?= htmlspecialchars($addr['country']) ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
