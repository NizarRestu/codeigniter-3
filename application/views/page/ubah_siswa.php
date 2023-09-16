<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body class="min-vh-100 d-flex align-items-center">
    <div class="card w-75 m-auto p-3">
        <h3 class="text-center">Update</h3>
        <?php foreach ($siswa as $row): ?>
        <form action="<?php echo base_url('admin/ubah_siswa_form') ?>" enctype="multipart/form-data"
                        method="post" class="row">
                        <input type="hidden" class="form-control" id="id_siswa" name="id_siswa" value="<?php echo $row->id_siswa ?>">
            <div class="mb-3 col-6">
                <label for="nama" class="form-label">Nama Siswa</label>
                <input type="text" class="form-control" id="nama" name="nama_siswa" value="<?php echo $row->nama_siswa ?>">
            </div>
            <div class="mb-3 col-6">
                <label for="alamat" class="form-label">NISN</label>
                <input type="text" class="form-control" id="nisn" name="nisn" value="<?php echo $row->nisn ?>">
            </div>
            <div class="mb-3 col-6">
                <label for="gender" class="form-label">Gender</label>
                <select name="gender" class="form-select">
                    <option selected value="<?php echo $row->gender ?>"><?php echo $row->gender ?></option>
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="mb-3 col-6">
                <label for="kelas" class="form-label">Kelas</label>
                <select name="id_kelas" class="form-select">
                    <option selected value="<?php echo $row->id_kelas ?>"><?php echo tampil_full_kelas_byid($row->id_kelas) ?></option>
                    <?php foreach ($kelas as $row): ?>
                    <option value="<?php echo $row->id ?>"><?php echo $row->tingkat_kelas . ' ' . $row->jurusan_kelas ?></option>
                    <?php endforeach?>
                </select>
            </div>
            <div class="col-1 text-start">
                <a href="<?php echo base_url('admin/siswa')?>" class="btn btn-danger px-3">Kembali</a>
            </div>
            <div class="col-11 text-end">
                <button type="submit" class="btn btn-primary px-3" name="submit">Submit</button>
            </div>
        </form>
        <?php endforeach?>
    </div>
</body>

</html>