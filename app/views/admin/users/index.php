<div class="row g-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
            <h4 class="brand-font mb-3">Add Admin User</h4>
            <form action="/admin/users" method="POST">
                <input type="hidden" name="_csrf_token" value="<?= $csrfToken ?>">
                <div class="mb-3">
                    <label class="form-label fw-bold">First Name</label>
                    <input type="text" name="first_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Last Name</label>
                    <input type="text" name="last_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Password</label>
                    <input type="password" name="password" class="form-control" minlength="8" required>
                </div>
                <button type="submit" class="btn btn-primary-custom w-100">Create Admin</button>
            </form>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
            <h4 class="brand-font mb-3">Admin Users & Roles</h4>
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $u): ?>
                        <tr>
                            <td class="fw-bold"><?= htmlspecialchars($u['first_name'] . ' ' . $u['last_name']) ?></td>
                            <td><?= htmlspecialchars($u['email']) ?></td>
                            <td><span class="badge bg-danger text-uppercase"><?= htmlspecialchars($u['role_name'] ?? 'Admin') ?></span></td>
                            <td>
                                <form action="/admin/users/<?= $u['id'] ?>/delete" method="POST" class="d-inline">
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
