<?php

require 'koneksi.php';

//menampilkan data
$query_data = "SELECT * FROM Tabel: pesanan PREDER BY id ASC";

// hitung jumlah stok barang
$sql = "SELECT SUM(stock) as total_stock FROM produk";
$result = $conn->query($sql);

// Fetch the result
$total_stock = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_stock = $row['total_stock'];
} else {
    echo "0 results";
}

// Kueri untuk menghitung total idorder
$sql = "SELECT COUNT(idorder) AS total_orders FROM pesanan";
$result = $conn->query($sql);

$total_orders = 0;
if ($result->num_rows > 0) {
    // Ambil data dari hasil kueri
    $row = $result->fetch_assoc();
    $total_orders = $row['total_orders'];
}


// Kueri untuk menghitung total idpelanggan
$sql = "SELECT COUNT(idpelanggan) AS total_pelanggan FROM pelanggan";
$result = $conn->query($sql);

$total_pelanggan = 0;
if ($result->num_rows > 0) {
    // Ambil data dari hasil kueri
    $row = $result->fetch_assoc();
    $total_pelanggan = $row['total_pelanggan'];
}

// Kueri untuk menghitung total idmasuk
$sql = "SELECT COUNT(idmasuk) AS total_masuk FROM masuk";
$result = $conn->query($sql);

$total_masuk = 0;
if ($result->num_rows > 0) {
    // Ambil data dari hasil kueri
    $row = $result->fetch_assoc();
    $total_masuk = $row['total_masuk'];
}

$sql = "SELECT namaproduk, stock FROM produk";
$result = $conn->query($sql);

$namaproduk = [];
$stock = [];

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $namaproduk[] = $row["namaproduk"];
    $stock[] = $row["stock"];
  }
} else {
  echo "0 results";
}

$role = $_SESSION['role']; // 1 for admin, 0 for user

?>
<script>
var namaproduk = <?php echo json_encode($namaproduk); ?>;
var stock = <?php echo json_encode($stock); ?>;
</script>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Industri Pangan Rakyat</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

        <style>
                        .px-4 {
                padding-right: 1.5rem !important;
                padding-left: 24px !important;
                margin-top: 0;
            }
        </style>

        </head>
        <body class="sb-nav-fixed">
            <nav class="sb-topnav navbar navbar-expand sb-sidenav-dark">
                <!-- Navbar Brand-->
                <a class="navbar-brand ps-3" href="index.php">Dashboard</a>
                <!-- Sidebar Toggle-->
                <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars text-light"></i></button>
                <!-- Navbar Search-->
                <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                </form>
            </nav>
            <div id="layoutSidenav">
                <div id="layoutSidenav_nav">
                    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                        <div class="sb-sidenav-menu">
                        <div class="nav">
                                <div class="sb-sidenav-menu-heading">Menu</div>
                                </a>
                                <a class="nav-link" href="data_pelanggan.php">
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
                    <main>
                        <div class="container-fluid px-4">
                            <h1 class="mt-4">Dashboard</h1>
                            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">
                    <?php
                    // Display different messages based on the user's role
                    if ($role == 1) {
                        echo "Selamat Datang Admin";
                    } else {
                        echo "Selamat Datang User";
                    }
                    ?>
                </li>
            </ol>
            <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                <div class="card-body"><h5>Data Pelanggan<h5></div>
                    <div class="card-body"><h6><?php echo $total_orders; ?><h6></div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="data_pelanggan.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body"><h5>Stok Beras</h5></div>
                        <div class="card-body"><h6><?php echo $total_stock; ?><h6></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="stock.php">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body"><h5>Beras Masuk<h5></div>
                        <div class="card-body"><h6><?php echo $total_masuk; ?><h6></div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="masuk.php">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body"><h5>Kelola Pelanggan<h5></div>
                    <div class="card-body"><h6><?php echo $total_pelanggan; ?><h6></div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="pelanggan.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
                </div>
            </div>
            <div class="row-container">
            <div class="col-container">
                <div class="charts mb-4">
                    <div class="card-header">
                        <i class="fas fa-envelope-open-text"></i>
                        Stok Beras
                    </div>
                    <div class="card-body">
                        <canvas id="myBarChart" width="100%" height="40"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-container">
                <div class="charts mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-line"></i>
                        Data Pelanggan
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>ID Pesanan</th>
                                    <th>Tanggal</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Alamat</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php
                                            $get = mysqli_query($conn,"select * from pesanan p, pelanggan pl where p.idpelanggan=pl.idpelanggan");
                                            $i = 1;

                                            while($p = mysqli_fetch_array($get)){
                                                $idorder = $p['idorder'];
                                                $tanggal = $p['tanggal'];
                                                $namapelanggan = $p['namapelanggan'];
                                                $alamat = $p['alamat'];
                                            ?>
                                                <tr>
                                                    <td><?=$i++;?></td>
                                                    <td><?=$idorder;?></td>
                                                    <td><?=$tanggal;?></td>
                                                    <td><?=$namapelanggan;?></td>
                                                    <td><?=$alamat;?></td>
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
                    <style>
                        .row-container {
                        display: grid;
                        grid-template-columns: 1fr 1fr;
                        gap: 20px;
                    }

                    .col-container {
                        display: flex;
                        flex-direction: column;
                    }

                    .card {
                        width: 100%;
                    }
                    #datatablesSimple_wrapper {
                        max-height: 400px; /* Atur tinggi sesuai kebutuhan Anda */
                        overflow-y: auto;
                    }
                    .charts {
                        display: flex;
                        flex-direction: column;
                        height: 300px; /* Sesuaikan dengan tinggi total yang diinginkan */
                    }
                    .card-body {
                        overflow: auto; /* Jika ada konten panjang, scroll bar akan muncul */
                    }
                    </style>
                    </div>

                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; PT.Industri Pangan Rakyat</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script>

Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Bar Chart Example
var ctx = document.getElementById("myBarChart");
var myBarChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: namaproduk,
    datasets: [{
      label: "Stock",
      backgroundColor: "rgba(2,117,216,1)",
      borderColor: "rgba(2,117,216,1)",
      data: stock,
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 6
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: Math.max.apply(Math, stock) + 10, // dynamically set max based on data
          maxTicksLimit: 5
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    }
  }
});
</script>

    </body>
</html>
