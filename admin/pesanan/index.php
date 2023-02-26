<?php
include "../../koneksi.php";


session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
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
                    <a href="#" class="sidebar__nav__link">
                        <i class="fa-sharp fa-solid fa-newspaper"></i>
                        <span class="sidebar__nav__text">Pemesan</span>
                    </a>
                </li>
                <li>
                    <a href="../lapangan/index.php" class="sidebar__nav__link">
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
        <a class="btn btn-success" href="tambah.php">Tambah Info Lapangan</a><br /><br />
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped table-hover ">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pemesan</th>
                                <th>Nohp</th>
                                <th>Tanggal Pesan</th>
                                <th>Tanggal Main</th>
                                <th>Jam Main</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($conn, "SELECT * FROM pesanan order by id_pesanan asc");
                            $no = 1;
                            while ($data = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $data['nama']; ?></td>
                                    <td><?php echo $data['nohp']; ?></td>
                                    <td><?php echo $data['tgl']; ?></td>
                                    <td><?php echo $data['tgl_pesan']; ?></td>
                                    <td><?php echo $data['jam']; ?></td>
                                    <td><img style="width: 100px;" src="../../image/<?php echo $data['gambar']; ?>"></td>
                                    <td>
                                        <!-- <a style="width:72px; margin:3%;" href="edit.php?id=<?php echo $data['id_pesanan']; ?>" class="btn btn-warning">Edit</a> -->
                                        <a href="delete.php?id=<?php echo $data['id_pesanan']; ?>" class="btn btn-danger text-center">Hapus</a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>