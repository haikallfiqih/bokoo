<?php 

function koneksi(){
// koneksi ke mysql & memilih DB

$conn = mysqli_connect('localhost', 'id17972791_bukoo_user', 'KGFUQ6Oo(!hKLl@i', 'id17972791_bukoo') or die('Koneksi ke database gagal');

return $conn;
}


function query($query){
    $conn = koneksi();
    $result = mysqli_query($conn, $query) or die('Query gagal'. mysqli_error($conn) );

    $rows = [];
    while($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
    }

    return $rows;
}

function tambah($data){
    $conn = koneksi();

    // sanitasi data
    $Judul =mysqli_real_escape_string($conn, htmlspecialchars($data['Judul']));
    $Penulis =mysqli_real_escape_string($conn, htmlspecialchars($data['Penulis']));
    $Penerbit =mysqli_real_escape_string($conn, htmlspecialchars($data['Penerbit']));
    $Kategori =mysqli_real_escape_string($conn, htmlspecialchars($data['Kategori']));
    // $Gambar =mysqli_real_escape_string($conn, htmlspecialchars($data['Gambar']));


//upload gambar
$Gambar = upload();
if(!$Gambar){
    return false;
}



    // query insert data

    $query = "INSERT INTO buku
                VALUES(null, '$Judul', '$Penulis', '$Penerbit', '$Kategori', '$Gambar' )";

    // insert data ke table buku

    mysqli_query($conn, $query) or die('Query Gagal'.mysqli_error($conn));

    // return nilai berhasil

    return mysqli_affected_rows($conn);

}

function hapus($Id){
    $conn = koneksi();

    // hapus file gambar jika bukan default
    $buku = query("SELECT * FROM buku WHERE Id = $Id")[0];
    if ($buku['Gambar'] !== 'default.jpg') {
        unlink('img/' . $buku['Gambar'] );
    }


  mysqli_query($conn, "DELETE FROM buku WHERE Id = $Id") or die('Query gagal'. mysqli_error($conn) );

    return mysqli_affected_rows($conn);
}



function ubah($data){
    $conn = koneksi();

    // sanitasi data
    $Id = $data['Id'];
    $Judul =mysqli_real_escape_string($conn, htmlspecialchars($data['Judul']));
    $Penulis =mysqli_real_escape_string($conn, htmlspecialchars($data['Penulis']));
    $Penerbit =mysqli_real_escape_string($conn, htmlspecialchars($data['Penerbit']));
    $Kategori =mysqli_real_escape_string($conn, htmlspecialchars($data['Kategori']));
    $gambarLama =mysqli_real_escape_string($conn, htmlspecialchars($data['gambarLama']));

    // upload gambar

    $Gambar = upload();

    // jika tidak ada gambar baru yg d upload

    if($Gambar === 'default.jpg'){
        $Gambar = $gambarLama;
    } else {
        // hapus gambar lama
        // cek jika gambar default
        if ($gambarLama !== 'default.jpg'){
            unlink('img/' . $gambarLama);
        }
    }

    // query update data

    $query = "UPDATE buku
            SET 
            Judul = '$Judul',
            Penulis = '$Penulis',
            Penerbit = '$Penerbit',
            Kategori = '$Kategori',
            Gambar = '$Gambar'
                WHERE Id = $Id
            ";

    // update data dari table buku

    mysqli_query($conn, $query) or die('Query Gagal'.mysqli_error($conn));

    // return nilai berhasil

    return mysqli_affected_rows($conn);

}


function upload(){

    // Ambil data gambar
    $namaFile = $_FILES['Gambar']['name'];
    $tipeFile = $_FILES['Gambar']['type'];
    $ukuranFile = $_FILES['Gambar']['size'];
    $error = $_FILES['Gambar']['error'];
    $tmpName = $_FILES['Gambar']['tmp_name'];
    $ekstensiFile = pathinfo($namaFile, PATHINFO_EXTENSION);

    //check apakah ada gambar yg di upload

    if($error === 4){
        return 'default.jpg';
    }
    // cek apakah file yg d upload adalah gambar

    $tipeGambarValid = ['image/jpg', 'image/jpeg', 'image/png'];

    if(!in_array($tipeFile, $tipeGambarValid)) {
        echo "<script>
                alert('Yang anda upload bukan gambar');
                
              </script>";

            return false;
    }
    // cek ukuran

    if($ukuranFile > 2000000){
        echo "<script>
                alert('Ukuran gambar terlalu besar');
                
              </script>";
    }  
    // gambar siap d upload

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiFile;

    // upload gambar
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
    return $namaFileBaru;
}

?>