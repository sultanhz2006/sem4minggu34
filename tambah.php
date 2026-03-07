<?php
include 'config.php';

if(isset($_POST['simpan'])){

$kode = $_POST['kode'];
$nama = $_POST['nama'];
$satuan = $_POST['satuan'];
$harga_beli = $_POST['harga_beli'];
$harga_jual = $_POST['harga_jual'];
$jumlah = $_POST['jumlah'];
$tanggal = $_POST['tanggal'];
$ket = $_POST['keterangan'];

$foto = $_FILES['foto']['name'];
$tmp = $_FILES['foto']['tmp_name'];

move_uploaded_file($tmp,"upload/".$foto);

mysqli_query($conn,"INSERT INTO barang VALUES(
NULL,
'$kode',
'$nama',
'$satuan',
'$harga_beli',
'$harga_jual',
'$jumlah',
'$tanggal',
'$ket',
'$foto'
)");

header("location:index.php");

}
?>

<h2>Tambah Barang</h2>

<form method="POST" enctype="multipart/form-data">

Kode Barang<br>
<input type="text" name="kode"><br>

Nama Barang<br>
<input type="text" name="nama"><br>

Satuan<br>
<input type="text" name="satuan"><br>

Harga Beli<br>
<input type="number" name="harga_beli"><br>

Harga Jual<br>
<input type="number" name="harga_jual"><br>

Jumlah<br>
<input type="number" name="jumlah"><br>

Tanggal Masuk<br>
<input type="date" name="tanggal"><br>

Keterangan<br>
<textarea name="keterangan"></textarea><br>

Foto<br>
<input type="file" name="foto"><br><br>

<button type="submit" name="simpan">Simpan</button>

</form>