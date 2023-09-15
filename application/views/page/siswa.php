<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
    <div class="flex">
        <div>
            <?php $this->load->view('component/sidebar')?>
        </div>

        <div class="ml-16 mt-12">
        <?php $this->load->view('component/navbar')?>

<div class="overflow-x-auto overflow-y-auto">
<a
            href="tambah_siswa"
            class="inline-block rounded bg-sky-600 px-4 py-2 text-xs font-medium text-white hover:bg-sky-700"
          >
            Tambah
          </a>
  <table class=" divide-y-2 divide-gray-200 bg-white text-sm w-[900px] overflow-x-auto overflow-y-auto">
    <thead class="">
      <tr>
        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
          No
        </th>
        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
         Nama Siswa
        </th>
        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
          NISN
        </th>
        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
          Gender
        </th>
        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
         Kelas
        </th>
        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
          Aksi
        </th>
      </tr>
    </thead>

    <tbody class="divide-y divide-gray-200">
      <?php $no = 0;foreach ($siswa as $row): $no++?>
	      <tr>
	        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-center">
	         <?php echo $no ?>
	        </td>
	        <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center">  <?php echo $row->nama_siswa ?></td>
	        <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center"><?php echo $row->nisn ?></td>
	        <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center"><?php echo $row->gender ?></td>
	        <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center"><?php echo tampil_full_kelas_byid($row->id_kelas) ?></td>
	        <td class="whitespace-nowrap px-4 py-2 text-center">
	          <a
	            href="#"
	            class="inline-block rounded bg-sky-600 px-4 py-2 text-xs font-medium text-white hover:bg-sky-700"
	          >
	            Ubah
	          </a>
	          <button
	           onclick= "hapus(<?php echo $row->id_siswa ?>)"
	            class="inline-block rounded bg-red-600 px-4 py-2 text-xs font-medium text-white hover:bg-red-700"
	          >
	            Hapus
	          </button>
	        </td>
	      </tr>
	      <?php endforeach?>
    </tbody>
  </table>
</div>
        </div>
    </div>
    <script>
      function hapus(id) {
        var yes = confirm("Yakin mau dihapus?")
        if(yes == true) {
          window.location.href= "<?php echo base_url('admin/hapus_siswa/') ?>" + id;
        }
      }
    </script>
</body>
</html>