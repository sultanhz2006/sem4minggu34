<?php
session_start();

if(!isset($_SESSION['login'])){
    if(isset($_COOKIE['login'])){
        $_SESSION['login'] = true;
    } else {
        header("Location: login.php");
        exit();
    }
}

include 'config.php';

// DATA
$data = mysqli_query($conn, "SELECT * FROM barang");
$total_barang = mysqli_num_rows($data);

$stok = mysqli_query($conn, "SELECT SUM(jumlah) as total FROM barang");
$stok_data = mysqli_fetch_assoc($stok);
$total_stok = $stok_data['total'] ? $stok_data['total'] : 0;
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>

<style>
*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:"Segoe UI",sans-serif;
}

body{
padding:30px;
color:white;

background:
radial-gradient(circle at 20% 30%,#1e293b,transparent 40%),
radial-gradient(circle at 80% 70%,#0f172a,transparent 50%),
#020617;
}

/* NAVBAR */
.navbar{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:25px;
}

.nav-title{
font-size:20px;
font-weight:600;
}

.nav-right{
display:flex;
gap:10px;
}

.nav-right a{
padding:8px 14px;
border-radius:6px;
text-decoration:none;
color:white;
background:rgba(255,255,255,0.08);
}

/* SEARCH */
#search{
padding:8px 12px;
border:none;
border-radius:6px;
background:rgba(255,255,255,0.08);
color:white;
}

/* STATS */
.stats{
display:flex;
gap:20px;
margin-bottom:25px;
}

.stat{
flex:1;
padding:20px;
border-radius:12px;

background:rgba(20,20,25,0.6);
backdrop-filter:blur(18px);

border:1px solid rgba(255,255,255,0.08);
}

.stat h3{
font-size:28px;
}

.stat p{
opacity:0.7;
}

/* CARD */
.card{
padding:15px;
border-radius:12px;

background:rgba(20,20,25,0.6);
backdrop-filter:blur(18px);

border:1px solid rgba(255,255,255,0.08);
}

/* BUTTON */
.btn{
padding:8px 14px;
border-radius:6px;
text-decoration:none;
color:white;
font-size:13px;
display:inline-block;
}

.add{background:#4f46e5;}
.edit{background:#10b981;}
.delete{background:#ef4444;}

/* TABLE */
table{
width:100%;
border-collapse:collapse;
margin-top:10px;
}

th, td{
padding:12px;
text-align:center;
}

th{
background:rgba(255,255,255,0.05);
}

tr:hover{
background:rgba(255,255,255,0.04);
}

img{
width:60px;
border-radius:6px;
}

/* EMPTY */
.empty{
padding:20px;
text-align:center;
opacity:0.6;
}
</style>

</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="nav-title">📦 Inventaris ATK</div>

    <div class="nav-right">
        <input type="text" id="search" placeholder="Cari barang...">
        <a href="tambah.php">+ Tambah</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<!-- STATS -->
<div class="stats">

    <div class="stat">
        <h3><?php echo $total_barang; ?></h3>
        <p>Total Barang</p>
    </div>

    <div class="stat">
        <h3><?php echo $total_stok; ?></h3>
        <p>Total Stok</p>
    </div>

    <div class="stat">
        <h3><?php echo date("d M Y"); ?></h3>
        <p>Tanggal</p>
    </div>

</div>

<!-- TABLE -->
<div class="card">

<table id="tbl">

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

<?php if($total_barang > 0){ ?>
<?php while($d = mysqli_fetch_assoc($data)){ ?>

<tr>
<td><?php echo htmlspecialchars($d['kode_barang']); ?></td>
<td><?php echo htmlspecialchars($d['nama_barang']); ?></td>
<td><?php echo htmlspecialchars($d['satuan']); ?></td>
<td>Rp <?php echo number_format($d['harga_beli']); ?></td>
<td>Rp <?php echo number_format($d['harga_jual']); ?></td>
<td><?php echo $d['jumlah']; ?></td>
<td><?php echo $d['tanggal_masuk']; ?></td>

<td>
<img src="upload/<?php echo htmlspecialchars($d['foto']); ?>">
</td>

<td>
<a href="edit.php?id=<?php echo $d['id_barang']; ?>" class="btn edit">Edit</a>
<a href="hapus.php?id=<?php echo $d['id_barang']; ?>" class="btn delete">Hapus</a>
</td>

</tr>

<?php } ?>
<?php } else { ?>

<tr>
<td colspan="9" class="empty">Tidak ada data</td>
</tr>

<?php } ?>

</table>

</div>

<script>
// SEARCH FIX (aman dari error null)
var search = document.getElementById("search");

if(search){
search.addEventListener("keyup", function(){
    var val = this.value.toLowerCase();
    var rows = document.querySelectorAll("#tbl tr");

    rows.forEach(function(r, i){
        if(i === 0) return;
        r.style.display = r.innerText.toLowerCase().includes(val) ? "" : "none";
    });
});
}
</script>

</body>
</html>