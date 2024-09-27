<?php

require 'koneksi.php';

if(isset($_POST['change_password'])) {
    $username = $_SESSION['username']; // Pastikan username disimpan dalam sesi saat login
    $old_password = $_POST['password_lama'];
    $new_password = $_POST['password_baru'];
    $confirm_password = $_POST['konfirmasi_password'];

    if($new_password === $confirm_password) {
        $check = mysqli_query($conn, "SELECT * FROM user WHERE username='$username' AND password='$old_password'");
        $hitung = mysqli_num_rows($check);

        if($hitung > 0) {
            $update = mysqli_query($conn, "UPDATE user SET password='$new_password' WHERE username='$username'");
            
            if($update) {
                echo '
                <script>alert("Password berhasil diubah");
                window.location.href="index.php"
                </script>
                ';
            } else {
                echo '
                <script>alert("Terjadi kesalahan saat mengubah password");
                window.location.href="ganti_password.php"
                </script>
                ';
            }
        } else {
            echo '
            <script>alert("Password lama salah");
            window.location.href="ganti_password.php"
            </script>
            ';
        }
    } else {
        echo '
        <script>alert("Konfirmasi password tidak sesuai");
        window.location.href="ganti_password.php"
        </script>
        ';
    }
}

$role = $_SESSION['role']; // 1 for admin, 0 for user

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Ganti Password</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

        <style>
            .px-4 {
            padding-right: 1.5rem !important;
            padding-left: 24px !important;
            margin-top: 0;
            }
            .container,
            .container-fluid,
            .container-xxl,
            .container-xl,
            .container-lg,
            .container-md,
            .container-sm {
            width: 50%;
            }
            input, button, select, optgroup, textarea {
                margin: 7px;
            }
            .mt-4 {
            text-align: center;
            }
            .text-muted {
            font-size: 12px
            }
        </style>
        
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand sb-sidenav-dark">
        <a class="navbar-brand ps-3" href="index.php">Dashboard</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars text-light"></i></button>
            
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                    <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menu</div>
                            </a>
                            <a class="nav-link" href="pelanggan.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-line"></i></div>
                                Data Pelanggan
                            </a>
                            <a class="nav-link" href="stock.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-envelope-open-text"></i></div>
                                Stok Beras
                            </a>
                            <a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-cart-arrow-down"></i></div>
                                Beras Masuk
                            </a>
                            <a class="nav-link" href="pelanggan.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-plus"></i></div>
                                Kelola Pelanggan
                            </a>
                            <a class="nav-link" href="ganti_password.php">
                                <div class="sb-nav-link-icon"><i class="fa fa-cog"></i></div>
                                Ganti Password
                            </a>
                            <?php if ($role == 1): // Only show this section if the user is an admin ?>
                            <a class="nav-link" href="admin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-bullhorn"></i></div>
                                Akses Admin
                            </a>
                            <?php endif; ?>
                            <a class="nav-link" href="logout.php">
                                Logout
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
            <div class="container-fluid px-4">
                        <h1 class="mt-4">Ganti Password</h1>
                        <ol class="breadcrumb mb-4">
                        </ol> 
           
            <div class="card">
                <div class="card-header bg-danger text-white">
                 Ganti Password Anda (*abaikan jika tidak ingin ganti password)
            </div>
                <div class="card-body">
                <form method="POST" action="ganti_password.php">
                    <label>Masukkan Password Lama Anda:</label>
                    <input type="password" name="password_lama" required><br>
                    <label>Masukkan Password Baru Anda:</label>
                    <input type="password" name="password_baru" required><br>
                    <label>Konfirmasi Password Baru Anda:</label>
                    <input type="password" name="konfirmasi_password" required><br>
                    <input type="submit" name="change_password" value="Proses">
                </form>
                </div>



                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; PT.Industri Pangan Rakyat</div>
                        </div>
                    </div>
                </footer>
            </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
    
    
     <!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Tambah Barang</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal">&times;</button>
      </div>

      <form method="post">

      <!-- Modal body -->
      <div class="modal-body">
        Pilih Barang
        <select name="idproduk" class="form-control">
        
        <?php
        $getproduk = mysqli_query($conn,"select * from produk");

        while($pl=mysqli_fetch_array($getproduk)){
            $namaproduk = $pl['namaproduk'];
            $stock = $pl['stock'];
            $idproduk = $pl['idproduk'];
        
        ?>

        <option value="<?=$idproduk;?>"><?=$namaproduk;?> (Stock: <?=$stock;?>)</option>

        <?php
        }
        ?>

        </select>

        <input type="hidden" name="idp" value="<?=$idp;?>">
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" name="barangmasuk">Submit</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

      </form>

    </div>
  </div>
</div>




</html>
