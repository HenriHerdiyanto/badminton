<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include "koneksi.php";
session_start();
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
<?php
if (isset($_POST['Submit'])) {
  $nama = mysqli_real_escape_string($conn, $_POST['nama']);
  $nohp = mysqli_real_escape_string($conn, $_POST['nohp']);
  $tgl = mysqli_real_escape_string($conn, $_POST['tgl']);
  $tgl_pesan = mysqli_real_escape_string($conn, $_POST['tgl_pesan']);
  $jam = mysqli_real_escape_string($conn, $_POST['durasi']);
  $filename = $_FILES['gambar']['name'];

  // CEK DATA TIDAK BOLEH KOSONG
  if (empty($nama) || empty($nohp) || empty($tgl) || empty($tgl_pesan)) {

    if (empty($nama)) {
      echo "<font color='red'>Kolom Nama tidak boleh kosong.</font><br/>";
    }

    if (empty($nohp)) {
      echo "<font color='red'>Kolom nohp tidak boleh kosong.</font><br/>";
    }

    if (empty($tgl)) {
      echo "<font color='red'>Kolom tgl tidak boleh kosong.</font><br/>";
    }

    if (empty($tgl_pesan)) {
      echo "<font color='red'>Kolom tgl_pesan tidak boleh kosong.</font><br/>";
    }
  } else {
    // JIKA SEMUANYA TIDAK KOSONG
    $filetmpname = $_FILES['gambar']['tmp_name'];

    // FOLDER DIMANA GAMBAR AKAN DI SIMPAN
    $folder = 'image/';
    // GAMBAR DI SIMPAN KE DALAM FOLDER
    move_uploaded_file($filetmpname, $folder . $filename);

    // MEMASUKAN DATA DATA + NAMA GAMBAR KE DALAM DATABASE
    $result = mysqli_query($conn, "INSERT INTO pesanan(nama,nohp,tgl,tgl_pesan,jam,gambar) VALUES('$nama', '$nohp', '$tgl','$tgl_pesan','$jam', '$filename')");

    // MENAMPILKAN PESAN BERHASIL
    echo "<script>alert('Data berhasil disimpan.');window.location='detail-pesanan.php';</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Badminton GOR JAMBON</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.html">Arsha</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto " href="index.php #hero">Home</a></li>
          <li><a class="nav-link scrollto" href="index.php #about">About</a></li>
          <li><a class="nav-link scrollto" href="index.php #services">Services</a></li>
          <li><a class="nav-link  active scrollto" href="index.php #portfolio">Portfolio</a></li>
          <li><a class="nav-link scrollto" href="index.php #team">Team</a></li>
          <li><a class="nav-link scrollto" href="index.php #contact">Contact</a></li>
          <li><a class="getstarted scrollto" href="lapangan.php">Cek Lapangan</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="index.php">Home</a></li>
          <li>Boking</li>
        </ol>
        <h2>Halaman Boking</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container portfolio-info">
        <div class="row">
          <div class="col-lg-6">
            <small style="color:red;"><b>Jumlah Transfer Harus Di Upload Sesuai harga yang tercantum</b></small><br>
            <form action="" method="post" enctype="multipart/form-data">
              <table class="table table-bordered table-hover mt-2" width="25%" border="0">
                <tr>
                  <td>Nama Lengkap</td>
                  <td><input class="form-control" type="text" name="nama" required></td>
                </tr>
                <tr>
                  <td>Nomor Handphone</td>
                  <td><input class="form-control" type="text" name="nohp" required></td>
                </tr>
                <tr>
                  <td>Tanggal Pemesanan</td>
                  <td><input class="form-control" type="date" name="tgl_pesan" required></td>
                </tr>
                <tr>
                  <td>Tanggal Main</td>
                  <td><input class="form-control" type="date" name="tgl" required></td>
                </tr>
                <tr>
                  <td>Jam Main</td>
                  <td>
                    <select class="form-select" name="durasi">
                      <option selected>--- PILIH ---</option>
                      <option value="<?php echo $durasi ?>"><?php echo $durasi ?></option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>Bukti Transfer</td>
                  <td><input class="form-control" type="file" name="gambar" required></td>
                </tr>
                <tr>
                  <td></td>
                  <td><input class="btn btn-success" type="submit" name="Submit" value="Booking" /></td>
                </tr>
              </table>
            </form>
          </div>
          <div class="col-lg-6">
            <div class="portfolio-info">
              <h3><?php echo $nama ?></h3>
              <p style="font-size: 2rem;">HARGA : <?php echo $harga ?></p>
              <p style="font-size: 2rem;">DURASI MAIN : <?php echo $durasi ?></p>
            </div>
          </div>
        </div>
      </div>


      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-newsletter">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <h4>Join Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Arsha</h3>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br><br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Social Networks</h4>
            <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
              <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span>Arsha</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>