<table class="table mt-4">
<br>
     <br>
    <h2 class="text-center text-primary mt-3">User List</h2>
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Full Name</th>
            <th scope="col">Email</th>
            <th scope="col">Mobile</th>
            <th scope="col">Role</th>
            <th scope="col">Image</th>
            <th scope="col">Gender</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <th scope="row"><?= $user['user_id'] ?></th>
            <td><?= $user['full_name'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['mobile'] ?></td>
            <td><?= $user['role'] ?></td>
            <td><img src="<?= $user['image'] ?>" alt="User Image" width="50"></td>
            <td><?= $user['gender'] ?></td>
            <td>
                <a href="?act=update-user&user_id=<?= $user['user_id'] ?>" class="btn btn-warning">Edit</a>
                <a href="?act=delete-user&user_id=<?= $user['user_id'] ?>" class="btn btn-danger"
                    onclick="return confirm('Xác nhận xóa người dùng này ?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>