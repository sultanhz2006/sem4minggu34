<?php
include 'config.php';

$id = $_GET['id'];

// ambil data barang
$stmt = $conn->prepare("SELECT * FROM barang WHERE id_barang=?");
$stmt->bind_param("i",$id);
$stmt->execute();
$result = $stmt->get_result();
$d = $result->fetch_assoc();

if(isset($_POST['update'])){

// escape string
$kode = mysqli_real_escape_string($conn,$_POST['kode']);
$nama = mysqli_real_escape_string($conn,$_POST['nama']);
$satuan = mysqli_real_escape_string($conn,$_POST['satuan']);
$ket = mysqli_real_escape_string($conn,$_POST['keterangan']);

$harga_beli = $_POST['harga_beli'];
$harga_jual = $_POST['harga_jual'];
$jumlah = $_POST['jumlah'];
$tanggal = $_POST['tanggal'];

$foto = $_FILES['foto']['name'];
$tmp = $_FILES['foto']['tmp_name'];

// validasi nama
if(!preg_match("/^[a-zA-Z\s]+$/",$nama)){
    echo "Nama barang tidak boleh mengandung angka";
    exit();
}

// jika upload foto baru
if($foto != ""){

move_uploaded_file($tmp,"upload/".$foto);

$stmt = $conn->prepare("UPDATE barang SET 
kode_barang=?, nama_barang=?, satuan=?, harga_beli=?, harga_jual=?, jumlah=?, tanggal_masuk=?, keterangan=?, foto=? 
WHERE id_barang=?");

$stmt->bind_param(
"sssddisssi",
$kode,
$nama,
$satuan,
$harga_beli,
$harga_jual,
$jumlah,
$tanggal,
$ket,
$foto,
$id
);

}else{

$stmt = $conn->prepare("UPDATE barang SET 
kode_barang=?, nama_barang=?, satuan=?, harga_beli=?, harga_jual=?, jumlah=?, tanggal_masuk=?, keterangan=? 
WHERE id_barang=?");

$stmt->bind_param(
"sssddissi",
$kode,
$nama,
$satuan,
$harga_beli,
$harga_jual,
$jumlah,
$tanggal,
$ket,
$id
);

}

$stmt->execute();

header("location:index.php");
exit();

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Barang</title>
<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

<h2>Edit Barang</h2>

<form method="POST" enctype="multipart/form-data">

<label>Kode Barang</label>
<input type="text" name="kode" value="<?= $d['kode_barang']; ?>" required>

<label>Nama Barang</label>
<input type="text" name="nama" value="<?= $d['nama_barang']; ?>" pattern="[A-Za-z\s]+" required>

<label>Satuan</label>
<input type="text" name="satuan" value="<?= $d['satuan']; ?>">

<label>Harga Beli</label>
<input type="number" name="harga_beli" value="<?= $d['harga_beli']; ?>" required>

<label>Harga Jual</label>
<input type="number" name="harga_jual" value="<?= $d['harga_jual']; ?>" required>

<label>Jumlah</label>
<input type="number" name="jumlah" value="<?= $d['jumlah']; ?>" required>

<label>Tanggal Masuk</label>
<input type="date" name="tanggal" value="<?= $d['tanggal_masuk']; ?>" required>

<label>Keterangan</label>
<textarea name="keterangan"><?= $d['keterangan']; ?></textarea>

<label>Foto Baru (opsional)</label>
<input type="file" name="foto">

<br><br>

<img src="upload/<?= $d['foto']; ?>" width="120">

<button type="submit" name="update">Update</button>

</form>

</div>

</body>
</html>