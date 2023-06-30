<div class="modal-body">
    <div class="mb-3">
        <label for="full_name">Nama</label>
        <input type="text" class="form-control" id="full_name">
    </div>

    <div class="mb-3">
        <label for="email">Email</label>
        <input type="text" class="form-control" id="email">
    </div>

    <div class="mb-3">
        <label for="no_hp">No Hp</label>
        <input type="text" class="form-control" id="no_hp">
    </div>

    <div class="mb-3">
        <label for="role">Role</label>
        <select class="form-select" name="role" id="role">
            <option selected disabled value="">Pilih Role</option>
            <?php foreach($roles as $role) : ?>
            <option value="<?= $role['id']; ?>"><?= ucfirst($role['rolename']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
<div class="modal-footer">
    <button type="button" id="tombol_edit_pengguna" class="btn btn-success">Edit</button>
</div>