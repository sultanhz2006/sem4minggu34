<?php
include 'config.php';

if(isset($_POST['simpan'])){

// escape string
$kode = mysqli_real_escape_string($conn, $_POST['kode']);
$nama = mysqli_real_escape_string($conn, $_POST['nama']);
$satuan = mysqli_real_escape_string($conn, $_POST['satuan']);
$ket = mysqli_real_escape_string($conn, $_POST['keterangan']);

$harga_beli = $_POST['harga_beli'];
$harga_jual = $_POST['harga_jual'];
$jumlah = $_POST['jumlah'];
$tanggal = $_POST['tanggal'];

// VALIDASI INPUT
if(!preg_match("/^[a-zA-Z\s]+$/",$nama)){
    echo "Nama barang tidak boleh mengandung angka";
    exit();
}

if(empty($kode) || empty($nama)){
    echo "Kode dan Nama barang wajib diisi!";
    exit();
}

// upload foto
$foto = $_FILES['foto']['name'];
$tmp = $_FILES['foto']['tmp_name'];

if(!empty($foto)){
    move_uploaded_file($tmp,"upload/".$foto);
}else{
    $foto = "default.png"; // optional fallback
}

// PREPARED STATEMENT
$stmt = $conn->prepare("INSERT INTO barang 
(kode_barang,nama_barang,satuan,harga_beli,harga_jual,jumlah,tanggal_masuk,keterangan,foto) 
VALUES (?,?,?,?,?,?,?,?,?)");

$stmt->bind_param(
"sssddisss",
$kode,
$nama,
$satuan,
$harga_beli,
$harga_jual,
$jumlah,
$tanggal,
$ket,
$foto
);

$stmt->execute();

header("Location: index.php");
exit();

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Tambah Barang</title>
<link rel="stylesheet" href="style.css">

<style>
body{
display:flex;
justify-content:center;
align-items:center;
min-height:100vh;
}

.container{
max-width:500px;
width:100%;
}
</style>

</head>

<body>

<div class="container">

<form method="POST" enctype="multipart/form-data">

<h2 style="text-align:center;">Tambah Barang</h2>

<label>Kode Barang</label>
<input type="text" name="kode" required>

<label>Nama Barang</label>
<input type="text" name="nama" pattern="[A-Za-z\s]+" required>

<label>Satuan</label>
<input type="text" name="satuan">

<label>Harga Beli</label>
<input type="number" name="harga_beli" required>

<label>Harga Jual</label>
<input type="number" name="harga_jual" required>

<label>Jumlah</label>
<input type="number" name="jumlah" required>

<label>Tanggal Masuk</label>
<input type="date" name="tanggal" required>

<label>Keterangan</label>
<textarea name="keterangan"></textarea>

<label>Foto</label>
<input type="file" name="foto" required>

<button type="submit" name="simpan">Simpan</button>

</form>

</div>

</body>
</html>