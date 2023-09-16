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
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-4 lg:gap-8">
  <div class="h-32 rounded-lg bg-gray-100 w-64">
<p class= "text-xl ml-4 mt-2 font-medium">Jumlah Kelas</p>
<p class = "ml-4 mt-4 text-3xl"><?php echo $kelas?></p>
  </div>
  <div class="h-32 rounded-lg bg-gray-100 w-64">
  <p class= "text-xl ml-4 mt-2 font-medium">Jumlah Siswa</p>
<p class = "ml-4 mt-4 text-3xl"><?php echo $siswa?></p>
  </div>
  <div class="h-32 rounded-lg bg-gray-100 w-64">
  <p class= "text-xl ml-4 mt-2 font-medium">Jumlah Mapel</p>
<p class = "ml-4 mt-4 text-3xl"><?php echo $mapel?></p>
  </div>
  <div class="h-32 rounded-lg bg-gray-100 w-64">
  <p class= "text-xl ml-4 mt-2 font-medium">Jumlah Guru</p>
<p class = "ml-4 mt-4 text-3xl"><?php echo $guru?></p>
  </div>
</div>
    </div>
</body>
</html>
