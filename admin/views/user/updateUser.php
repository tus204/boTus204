<div class="container mt-5">
    <h2 class="mb-4">Update User</h2>
    <form method="post" enctype="multipart/form-data" action="">
        <div class="mb-3">
            <label for="full_name" class="form-label">Full Name:</label>
            <input type="text" class="form-control" name="full_name" value="<?= $user['full_name'] ?? ''; ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" name="email" value="<?= $user['email'] ?? ''; ?>" required>
        </div>
        <div class="mb-3">
            <label for="mobile" class="form-label">Mobile:</label>
            <input type="text" class="form-control" name="mobile" value="<?= $user['mobile'] ?? ''; ?>">
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role:</label>
            <select class="form-select" name="role" required>
                <option value="Admin" <?= ($user['role'] ?? '') === 'Admin' ? 'selected' : ''; ?>>Admin</option>
                <option value="Client" <?= ($user['role'] ?? '') === 'Client' ? 'selected' : ''; ?>>Client</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image:</label>
            <input type="file" class="form-control" name="image" id="image">
            <img src="<?= $user['image'] ?? ''; ?>" alt="User Image" width="50" class="mt-2">
        </div>
        <div class="mb-3">
            <label for="gender" class="form-label">Gender:</label>
            <select class="form-select" name="gender" required>
                <option value="Nam" <?= ($user['gender'] ?? '') === 'Nam' ? 'selected' : ''; ?>>Nam</option>
                <option value="Nữ" <?= ($user['gender'] ?? '') === 'Nữ' ? 'selected' : ''; ?>>Nữ</option>
                <option value="Khác" <?= ($user['gender'] ?? '') === 'Khác' ? 'selected' : ''; ?>>Khác</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>