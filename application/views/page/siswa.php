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
          <a
  href="<?php echo base_url('Admin/exportToExcel'); ?>"
            class="inline-block rounded bg-sky-600 px-4 py-2 text-xs font-medium text-white hover:bg-sky-700"
          >
            Export
          </a>
          <button  type="button" class="inline-block rounded bg-sky-600 px-4 py-2 text-xs font-medium text-white hover:bg-sky-700" data-bs-toggle="modal" data-bs-target="#exampleModal">
            import
          </button>
  <table class=" divide-y-2 divide-gray-200 bg-white text-sm w-[900px] overflow-x-auto overflow-y-auto">
    <thead class="">
      <tr>
        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
          No
        </th>
        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">
          Foto
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
	        <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center"> <img src="<?php echo base_url('images/siswa/'.$row->foto)?>" alt="" width="50" height="50"></td>
	        <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center">  <?php echo $row->nama_siswa ?></td>
	        <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center"><?php echo $row->nisn ?></td>
	        <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center"><?php echo $row->gender ?></td>
	        <td class="whitespace-nowrap px-4 py-2 text-gray-700 text-center"><?php echo tampil_full_kelas_byid($row->id_kelas) ?></td>
	        <td class="whitespace-nowrap px-4 py-2 text-center">
	          <a
            href="<?php echo base_url('Admin/ubah_siswa/').$row->id_siswa?>"
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
    <div
    id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        class="md:ml-[30%] ml-2 fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full"
      >
        <div class="relative w-full h-full max-w-md md:h-auto">
          <div class="relative bg-white rounded-lg shadow border-2 dark:bg-white text-black ">
            <a
              href="<?php echo base_url('admin/siswa'); ?>"
              class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
            >
              <svg
                aria-hidden="true"
                class="w-5 h-5"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fillRule="evenodd"
                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                  clipRule="evenodd"
                ></path>
              </svg>
              <span class="sr-only">Close modal</span>
            </a>
            <div class="px-6 py-6 lg:px-8">
              <h3 class="mb-4 md:text-2xl text-base font-medium text-black dark:text-black">
                Import Excel
              </h3>
              <form class="space-y-3" method="post" enctype="multipart/form-data" action="<?php echo base_url('Admin/import') ?>">
                <div>
                  <label class="block mb-2 text-lg font-medium text-black dark:text-black">
                    File
                  </label>
                  <input
                  name="file"
                  type="file"
                    class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full md:p-1.5 p-2 dark:bg-white dark:border-gray-500 dark:placeholder-gray-500 dark:text-black"
                    required
                  />
                </div>

                <input
                  type="submit"
                  name="import"
                  value="Import"
                  class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                >
                  
                </input>
              </form>
            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>