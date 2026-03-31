<?php
include 'config.php';

$id = $_GET['id'] ?? 0;

// prepared statement (AMAN)
$stmt = $conn->prepare("DELETE FROM barang WHERE id_barang=?");
$stmt->bind_param("i",$id);
$stmt->execute();

header("location:index.php");
exit();
?>