<?php 

require 'functions.php';
$Id = $_GET['Id'];

if(hapus($Id) > 0 ) {
    echo "<script>
              alert('Data berhasil dihapus!');
              document.location.href = 'index.php';
    
          </script>";
}  



?>