<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
// INCLUDE KONEKSI KE DATABASE
include_once("../../koneksi.php");
session_start();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    //lakukan sesuatu dengan variabel $id
} else {
    echo "Indeks array tidak didefinisikan";
}
if (isset($_POST['update'])) {

    // AMBIL ID DATA
    // $id = $_POST['id'];

    // AMBIL NAMA FILE FOTO SEBELUMNYA
    $data = mysqli_query($conn, "SELECT gambar FROM lapangan WHERE id_lapangan='$id'");
    $dataImage = mysqli_fetch_assoc($data);
    $oldImage = $dataImage['gambar'];

    // AMBIL DATA DATA DIDALAM INPUT
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $durasi = mysqli_real_escape_string($conn, $_POST['durasi']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $harga = mysqli_real_escape_string($conn, $_POST['harga']);
    $filename = $_FILES['newImage']['name'];

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

        // JIKA FOTO DI GANTI
        if (!empty($filename)) {
            $filetmpname = $_FILES['newImage']['tmp_name'];
            $folder = "image/";

            // GAMBAR LAMA DI DELETE
            unlink($folder . $oldImage) or die("GAGAL");

            // GAMBAR BARU DI MASUKAN KE FOLDER
            move_uploaded_file($filetmpname, $folder . $filename);

            // NAMA FILE FOTO + DATA YANG DI GANTIBARU DIMASUKAN
            $result = mysqli_query($conn, "UPDATE lapangan SET nama='$nama',durasi='$durasi',status='$status',harga='$harga',gambar='$filename' WHERE id_lapangan=$id");
        }

        // MEMASUKAN DATA YANG DI UPDATE KECUALI GAMBAR
        $result = mysqli_query($conn, "UPDATE lapangan SET nama='$nama',durasi='$durasi',status='$status',harga='$harga' WHERE id_lapangan=$id");

        // REDIRECT KE HALAMAN INDEX.PHP
        echo "<script>alert('Data berhasil di update');window.location='index.php'</script>";
    }
}
?>
<?php
// AMBIL ID DARI URL
$id = $_GET['id'];

// AMBIL DATA BERDASARKAN ID
$result = mysqli_query($conn, "SELECT * FROM lapangan WHERE id_lapangan=$id");

while ($res = mysqli_fetch_array($result)) {
    $nama = $res['nama'];
    $durasi = $res['durasi'];
    $status = $res['status'];
    $harga = $res['harga'];
    $image = $res['gambar'];
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
                            <td><input class="form-control" type="text" name="nama" value="<?php echo $nama ?>" /></td>
                        </tr>
                        <tr>
                            <td>Durasi</td>
                            <td>
                                <select class="form-select" name="durasi">
                                    <option selected><?php echo $durasi ?></option>
                                    <option value="12.00-13.00">12.00-13.00</option>
                                    <option value="13.00-14.00">13.00-14.00</option>
                                    <option value="14.00-15.00">14.00-15.00</option>
                                    <option value="15.00-16.00">15.00-16.00</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                <select class="form-select" name="status">
                                    <option selected><?php echo $status ?></option>
                                    <option value="kosong">kosong</option>
                                    <option value="ada">ada</option>
                                </select>
                            </td>
                            <!-- <td><input type="text" name="status" /></td> -->
                        </tr>
                        <tr>
                            <td>Harga Lapangan</td>
                            <td><input class="form-control" type="text" name="harga" value="<?php echo $harga ?>" /></td>
                        </tr>
                        <tr>
                            <td>Gambar</td>
                            <td><img width="100" src="image/<?php echo $image ?>"><br><br><input type="file" name="newImage"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input class="btn btn-success" type="submit" name="update" value="Posting" /></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>