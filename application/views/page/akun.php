<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body class="min-vh-100 d-flex align-items-center">
    <?php foreach($user as $users): ?>
    <div class="card w-75 m-auto p-3">
        <h3 class="text-center">Akun</h3>
        <form action="<?php echo base_url('admin/aksi_ubah_akun')?>" enctype="multipart/form-data"
                        method="post" class="row">
            <div class="mb-3 col-6">
                <label for="nama" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $users->email?>">
            </div>
            <div class="mb-3 col-6">
                <label for="alamat" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username"  value="<?php echo $users->username?>">
            </div>
            <div class="mb-3 col-6">
                <label for="alamat" class="form-label">Password Baru</label>
                <input type="text" class="form-control" id="password_baru" name="password_baru">
            </div>
            <div class="mb-3 col-6">
                <label for="alamat" class="form-label">Konfirmasi Password</label>
                <input type="text" class="form-control" id="konfirmasi_password" name="konfirmasi_password">
            </div>
            <div class="col-1 text-start">
                <a href="<?php echo base_url('Admin'); ?>" class="btn btn-danger px-3">Kembali</a>
            </div>
            <div class="col-11 text-end">
                <button type="submit" class="btn btn-primary px-3" name="submit">Ubah</button>
            </div>
        </form>
    </div>
    <?php endforeach?>
</body>

</html>