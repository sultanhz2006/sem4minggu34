<?php
include 'config.php';
$data = mysqli_query($conn,"SELECT * FROM barang");
?>

<h2>Data Inventaris</h2>

<a href="tambah.php">Tambah Barang</a>

<table border="1" cellpadding="10">
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
<td><?= $d['harga_beli']; ?></td>
<td><?= $d['harga_jual']; ?></td>
<td><?= $d['jumlah']; ?></td>
<td><?= $d['tanggal_masuk']; ?></td>

<td>
<img src="upload/<?= $d['foto']; ?>" width="80">
</td>

<td>

<a href="edit.php?id=<?= $d['id_barang']; ?>">Edit</a>
<a href="hapus.php?id=<?= $d['id_barang']; ?>">Hapus</a>

</td>

</tr>

<?php } ?>

</table>