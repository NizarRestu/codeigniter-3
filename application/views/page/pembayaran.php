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
            <?php $this->load->view('component/sidebar_keuangan')?>
        </div>

        <div class="ml-16 mt-12">
        <?php $this->load->view('component/navbar')?>

<div class="overflow-x-auto overflow-y-auto">
<a
            href="tambah_pembayaran"
            class="inline-block rounded bg-sky-600 px-4 py-2 text-xs font-medium text-white hover:bg-sky-700"
          >
            Tambah
          </a>
<a
  href="<?php echo base_url('Keuangan/exportToExcel'); ?>"
            class="inline-block rounded bg-sky-600 px-4 py-2 text-xs font-medium text-white hover:bg-sky-700"
          >
            Export
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
         Jenis Pembayaran
        </th>
        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
          Total Pembayaran
        </th>
        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
          Aksi
        </th>
      </tr>
    </thead>

    <tbody class="divide-y divide-gray-200">
      <?php $no = 0;foreach ($pembayaran as $row): $no++?>
	      <tr>
	        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900 text-center">
	         <?php echo $no ?>
	        </td>
	        <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center">  <?php echo  tampil_full_siswa_byid($row->id_siswa) ?></td>
	        <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center"><?php echo $row->jenis_pembayaran ?></td>
	        <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center"><?php echo convRupiah($row->total_pembayaran) ?></td>
	        <td class="whitespace-nowrap px-4 py-2 text-center">
	          <a
            href="<?php echo base_url('Keuangan/ubah_pembayaran/').$row->id?>"
	            class="inline-block rounded bg-sky-600 px-4 py-2 text-xs font-medium text-white hover:bg-sky-700"
	          >
	            Ubah
	          </a>
	          <button
	           onclick= "hapus(<?php echo $row->id ?>)"
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
          window.location.href= "<?php echo base_url('keuangan/hapus_pembayaran/') ?>" + id;
        }
      }
    </script>
</body>
</html>