<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body class="min-vh-100 d-flex align-items-center">
    <div class="card w-75 m-auto p-3">
        <h3 class="text-center">Create</h3>
        <form action="<?php echo base_url('keuangan/aksi_tambah_pembayaran') ?>" enctype="multipart/form-data"
                        method="post" class="row">
             <div class="mb-3 col-6">
                <label for="siswa" class="form-label">Siswa</label>
                <select name="siswa" class="form-select">
                        <option selected>Pilih Siswa</option>
                            <?php foreach ($siswa as $row): ?>
                        <option value="<?php echo $row->id_siswa ?>"><?php echo $row->nama_siswa ?></option>
                   <?php endforeach?>
                </select>
            </div>
            <div class="mb-3 col-6">
                <label for="jenis" class="form-label">Jenis Pembayaran</label>
                <select name="jenis" class="form-select">
                    <option selected>Pilih Jenis</option>
                    <option value="Pembayaran SPP">Pembayaran SPP</option>
                    <option value="Pembayaran Uang Gedung">Pembayaran Uang Gedung</option>
                    <option value="Pembayaran Seragam">Pembayaran Seragam</option>
                </select>
            </div>
            <div class="mb-3 col-12">
                <label for="alamat" class="form-label">Total Pembayaran</label>
                <input type="number" class="form-control" id="pembayaran" name="pembayaran">
            </div>
            <div class=" col-1 text-start">
                <a href="pembayaran" class="btn btn-danger px-3">Kembali</a>
            </div>
            <div class="col-11 text-end">
                <button type="submit" class="btn btn-primary px-3" name="submit">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>