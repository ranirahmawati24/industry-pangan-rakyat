<?php

require 'koneksi.php';

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
        <title>Stock Beras</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <style>
        .px-4 {
        padding-right: 1.5rem !important;
        padding-left: 243px!important;
        margin-top: 90px;
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
                    </div>
                </nav>
            </div>
            
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Stok Beras </h1>
                        <ol class="breadcrumb mb-4">
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Jumlah Beras </div>
                                </div>
                            </div>   
                        </div>

                        <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-info mb-4" data-bs-toggle="modal" data-bs-target="#myModal">
                            Tambah Beras Baru
                        </button>


                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Data Beras
                            </div>
                            <div class="card-body">
                            <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Perkiloan</th>
                                    <th>Stock</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $get = mysqli_query($conn, "SELECT * FROM produk");
                                $i = 1;
                                
                                while($p = mysqli_fetch_array($get)) {
                                    $namaproduk = $p['namaproduk'];
                                    $perkiloan = $p['perkiloan'];
                                    $stock = $p['stock'];
                                    $harga = $p['harga'];
                                    $idproduk = $p['idproduk'];
                                ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $namaproduk; ?></td>
                                        <td><?= $perkiloan; ?></td>
                                        <td><?= $stock; ?></td>
                                        <td>Rp<?= number_format($harga); ?></td>
                                        <td>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $idproduk; ?>">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $idproduk; ?>">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>

                                                    <!-- Modal edit -->
                                                    <div class="modal fade" id="edit<?=$idproduk;?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Ubah <?=$namaproduk;?></h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <form method="post">

                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <input type="text" name="namaproduk" class="form-control" placeholder="Nama produk" value="<?=$namaproduk;?>">
                                                            <input type="num" name="perkiloan" class="form-control mt-2" placeholder="perkiloan" value="<?=$perkiloan;?>">
                                                            <input type="num" name="stock" class="form-control mt-2" placeholder="Stock" value="<?=$stock;?>">
                                                            <input type="num" name="harga" class="form-control mt-2" placeholder="Harga Produk" value="<?=$harga;?>">
                                                            <input type="hidden" name="idp" value="<?=$idproduk;?>">
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success" name="editbarang">Submit</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                    </div>

                                                    <!-- Modal delete -->
                                                    <div class="modal fade" id="delete<?= $idproduk; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <!-- Modal Header -->
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Hapus <?= $namaproduk; ?></h4>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                </div>

                                                                <form method="post">
                                                                    <!-- Modal body -->
                                                                    <div class="modal-body">
                                                                        Apakah anda yakin ingin menghapus beras ini?
                                                                        <input type="hidden" name="idproduk" value="<?= $idproduk; ?>">
                                                                    </div>
                                                                    <!-- Modal footer -->
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-success" name="hapusstok">Submit</button>
                                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                }; //end of while
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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
                    <h4 class="modal-title">Tambah Beras Baru</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form method="post">

                <!-- Modal body -->
                <div class="modal-body">
                    <input type="text" name="namaproduk" class="form-control" placeholder="Nama produk">
                    <input type="num" name="perkiloan" class="form-control mt-2" placeholder="perkiloan">
                    <input type="num" name="stock" class="form-control mt-2" placeholder="Stock Awal">
                    <input type="num" name="harga" class="form-control mt-2" placeholder="Harga Produk">
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="tambahbarang">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
                </form>
                </div>
            </div>
            </div>
            </html>