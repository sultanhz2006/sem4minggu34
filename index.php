<?php
include 'config.php';
$data = mysqli_query($conn,"SELECT * FROM barang");

$total_barang = mysqli_num_rows($data);

$stok = mysqli_query($conn,"SELECT SUM(jumlah) as total FROM barang");
$stok_data = mysqli_fetch_assoc($stok);
$total_stok = $stok_data['total'];
?>

<!DOCTYPE html>
<html>
<head>

<title>Sistem Inventaris ATK</title>
<link rel="stylesheet" href="style.css">

</head>

<body>

<!-- NAVBAR -->

<div class="navbar">

<div class="nav-title">
Inventaris ATK
</div>

<input type="text" id="search" placeholder="🔍 Cari barang...">

</div>


<div class="container">

<h2>Dashboard Inventaris</h2>

<!-- STATS -->

<div class="stats">

<div class="stat-card">
<h3><?= $total_barang ?></h3>
<p>Total Barang</p>
</div>

<div class="stat-card">
<h3><?= $total_stok ?></h3>
<p>Total Stok</p>
</div>

<div class="stat-card">
<h3><?= date("d M Y") ?></h3>
<p>Tanggal</p>
</div>

</div>


<a href="tambah.php" class="btn btn-add">+ Tambah Barang</a>

<div class="card">

<table class="table" id="barangTable">

<tr>
<th>Kode</th>
<th>Nama</th>
<th>Satuan</th>
<th>Harga Beli</th>
<th>Harga Jual</th>
<th>Jumlah</th>
<th>Tanggal</th>
<th>Foto</th>
<th>Aksi</th>
</tr>

<?php while($d=mysqli_fetch_array($data)){ ?>

<tr>

<td><?= $d['kode_barang']; ?></td>
<td><?= $d['nama_barang']; ?></td>
<td><?= $d['satuan']; ?></td>
<td>Rp <?= number_format($d['harga_beli']); ?></td>
<td>Rp <?= number_format($d['harga_jual']); ?></td>
<td><?= $d['jumlah']; ?></td>
<td><?= $d['tanggal_masuk']; ?></td>

<td>
<img src="upload/<?= $d['foto']; ?>" class="foto">
</td>

<td>

<a href="edit.php?id=<?= $d['id_barang']; ?>" class="btn btn-edit">Edit</a>

<button class="btn btn-delete"
onclick="confirmDelete('hapus.php?id=<?= $d['id_barang']; ?>')">
Hapus
</button>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>


<!-- DELETE MODAL -->

<div id="deleteModal" class="modal">

<div class="modal-box">

<p>Yakin ingin menghapus data ini?</p>

<div class="modal-btn">

<button id="yesDelete" class="btn btn-delete">Hapus</button>
<button onclick="closeModal()" class="btn">Batal</button>

</div>

</div>

</div>


<script>

/* SEARCH */

document.getElementById("search").addEventListener("keyup", function(){

let filter = this.value.toLowerCase();
let rows = document.querySelectorAll("#barangTable tr");

rows.forEach((row,i)=>{

if(i===0) return;

let text = row.innerText.toLowerCase();

row.style.display = text.includes(filter) ? "" : "none";

});

});


/* DELETE MODAL */

let deleteLink="";

function confirmDelete(link){

deleteLink=link;

document.getElementById("deleteModal").style.display="flex";

}

function closeModal(){

document.getElementById("deleteModal").style.display="none";

}

document.getElementById("yesDelete").onclick=function(){

window.location=deleteLink;

}

</script>

</body>
</html>
```
