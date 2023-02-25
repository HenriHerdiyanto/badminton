<?php
include "../../koneksi.php";
session_start();

$id = $_GET['id'];

$result = mysqli_query($conn, "DELETE FROM lapangan WHERE id_lapangan=$id");
echo "<script>alert('Data berhasil di hapus');window.location='index.php'</script>";
