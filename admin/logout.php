<?php
session_start();
session_destroy();
echo "<script>alert('Anda Telah logout!');window.location='../index.php';</script>";
