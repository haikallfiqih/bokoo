<?php 

require 'functions.php';
$buku = query("SELECT * FROM buku");

?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Bukooo | Katalog Buku</title>
  </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="#">Bukoo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="tambah.php">Tambah Buku</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">

    <div class="row mt-3 ">
        <div class="col">
             <h2>Daftar Buku</h2>
        </div> 
    </div>

    <div class="row">
        <?php foreach( $buku as $b) : ?>
        <div class="col-md-4 col-sm-6">
         <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="img/<?= $b['Gambar']  ?>" class="img-fluid rounded-start" alt="<?= $b['Judul'] ?>">
                </div>
                <div class="col-md-8">
                <div class="card-body">
                    <span class="position-absolute top-0 end-0 bg-dark text-white px-2 py-1 opacity-75"><small><?= $b['Kategori'] ?></small></span>
                    <h5 class="card-title"><?= $b['Judul'] ?></h5>
                    <p class="card-text"><small class="text-muted"><?= $b['Penulis'] ?> | <?= $b['Penerbit'] ?></small></p>
                </div>
                    <a href="ubah.php?Id=<?= $b['Id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="hapus.php?Id=<?= $b['Id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus Data?')">Hapus</a>
                </div>
            </div>
            </div>
        </div>
        <?php endforeach ?>

    </div>

      
</div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>