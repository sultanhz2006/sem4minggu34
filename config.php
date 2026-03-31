<?php

$conn = mysqli_connect("localhost","root","","inventaris");

// cek koneksi
if(!$conn){
    die("Koneksi gagal: " . mysqli_connect_error());
}

?>