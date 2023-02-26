<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include "../../koneksi.php";

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}
if (isset($_POST['Submit'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $durasi = mysqli_real_escape_string($conn, $_POST['durasi']);
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $harga = mysqli_real_escape_string($conn, $_POST['harga']);
    $filename = $_FILES['gambar']['name'];

    // CEK DATA TIDAK BOLEH KOSONG
    if (empty($nama) || empty($durasi) || empty($status) || empty($harga)) {

        if (empty($nama)) {
            echo "<font color='red'>Kolom Nama tidak boleh kosong.</font><br/>";
        }

        if (empty($durasi)) {
            echo "<font color='red'>Kolom durasi tidak boleh kosong.</font><br/>";
        }

        if (empty($status)) {
            echo "<font color='red'>Kolom status tidak boleh kosong.</font><br/>";
        }

        if (empty($harga)) {
            echo "<font color='red'>Kolom harga tidak boleh kosong.</font><br/>";
        }
    } else {
        // JIKA SEMUANYA TIDAK KOSONG
        $filetmpname = $_FILES['gambar']['tmp_name'];

        // FOLDER DIMANA GAMBAR AKAN DI SIMPAN
        $folder = 'image/';
        // GAMBAR DI SIMPAN KE DALAM FOLDER
        move_uploaded_file($filetmpname, $folder . $filename);

        // MEMASUKAN DATA DATA + NAMA GAMBAR KE DALAM DATABASE
        $result = mysqli_query($conn, "INSERT INTO lapangan(nama,durasi,tanggal,status,harga,gambar) VALUES('$nama', '$durasi','$tanggal', '$status','$harga', '$filename')");

        // MENAMPILKAN PESAN BERHASIL
        echo "<script>alert('Data berhasil disimpan.');window.location='index.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin | Badminton GOR JAMBON</title>
    <link href="../assets/img/logo png.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&display=swap" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/sidebar.css" />
</head>

<body>
    <aside class="sidebar">
        <nav>
            <ul class="sidebar__nav">
                <li>
                    <a href="../index.php" class="sidebar__nav__link">
                        <i class="fa-solid fa-user"></i>
                        <span class="sidebar__nav__text">User</span>
                    </a>
                </li>
                <li>
                    <a href="../pesanan/index.php" class="sidebar__nav__link">
                        <i class="fa-sharp fa-solid fa-newspaper"></i>
                        <span class="sidebar__nav__text">Pemesan</span>
                    </a>
                </li>
                <li>
                    <a href="index.php" class="sidebar__nav__link">
                        <i class="fa-solid fa-file"></i>
                        <span class="sidebar__nav__text">Jadwal Lapangan</span>
                    </a>
                </li>
                <li>
                    <a href="../logout.php" class="sidebar__nav__link">
                        <i class="mdi mdi-logout"></i>
                        <span class="sidebar__nav__text">Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>
    <div style="margin-left: 5%;" class="container" style="z-index: 1;">
        <?php echo "<h4 class='pt-5'>Selamat Datang, " . $_SESSION['username'] . "!" . "</h4>"; ?>
        <div class="row">
            <div class="col-lg-12">
                <form action="" method="post" name="form1" enctype="multipart/form-data">
                    <table class="table table-bordered table-hover" width="25%" border="0">
                        <tr>
                            <td>Nama Lapangan</td>
                            <td><input class="form-control" type="text" name="nama" /></td>
                        </tr>
                        <tr>
                            <td>Durasi</td>
                            <td>
                                <select class="form-select" name="durasi">
                                    <option selected>--- PILIH ---</option>
                                    <option value="12.00-13.00">12.00-13.00</option>
                                    <option value="13.00-14.00">13.00-14.00</option>
                                    <option value="14.00-15.00">14.00-15.00</option>
                                    <option value="15.00-16.00">15.00-16.00</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td><input class="form-control" type="date" name="tanggal" /></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                <select class="form-select" name="status">
                                    <option selected>--- PILIH ---</option>
                                    <option value="kosong">kosong</option>
                                    <option value="ada">ada</option>
                                </select>
                            </td>
                            <!-- <td><input type="text" name="status" /></td> -->
                        </tr>
                        <tr>
                            <td>Harga Lapangan</td>
                            <td><input class="form-control" type="text" name="harga" /></td>
                        </tr>
                        <tr>
                            <td>Gambar</td>
                            <td><input type="file" name="gambar" /></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input class="btn btn-success" type="submit" name="Submit" value="Posting" /></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>