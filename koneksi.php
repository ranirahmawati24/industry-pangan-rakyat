<?php
session_start();
$servername = "localhost";
$database = "kasir";
$username = "root";
$password = "";

// Buat koneksi
$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Modify the query to also select the role
    $check = mysqli_query($conn, "SELECT * FROM user WHERE username='$username' and password='$password'");
    $hitung = mysqli_num_rows($check);

    if($hitung > 0) {
        $data = mysqli_fetch_assoc($check); // Fetch the user data
        $_SESSION['login'] = 'True';
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $data['role']; // Save the role in the session

        // Redirect based on the role
        if ($data['role'] == 1) {
            header('location:index.php'); // Redirect to admin dashboard
        } else {
            header('location:index.php'); // Redirect to user dashboard
        }
    } else {
        echo '
        <script>alert("Username atau Password salah");
        window.location.href="login.php"
        </script>
        ';
    }
}


//fungsi tambah stok barang
if(isset($_POST['tambahbarang'])){
    $namaproduk = $_POST['namaproduk'];
    $perkiloan = $_POST['perkiloan'];
    $stock = $_POST['stock'];
    $harga = $_POST['harga'];

    $insert = mysqli_query($conn,"insert into produk (namaproduk,perkiloan,stock,harga) values ('$namaproduk','$perkiloan','$stock','$harga')");

    if($insert){
        header('location:stock.php');
    } else {
        echo '
       <script>alert("Gagal menambah barang baru");
       window.location.href="stock.php"
       </script>
       ';
    }
};

//edit barang stok barang 
if(isset($_POST['editbarang'])){
    $np = $_POST['namaproduk'];
    $perkiloan = $_POST['perkiloan'];
    $stock = $_POST['stock'];
    $harga = $_POST['harga'];
    $idp = $_POST['idp']; //idproduk

    $query = mysqli_query($conn, "update produk set namaproduk='$np',perkiloan='$perkiloan', stock='$stock', harga='$harga' where idproduk='$idp'");

    if(query){
        header('location:stock.php');
    } else {
        echo '
        <script>alert("Gagal");
        window.location.href="stock.php"
        </script>
        ';
    }
}

//fungsi hapus stok barang 
if(isset($_POST['hapusstok'])){
    $idp = $_POST['idproduk'];

    $query = mysqli_query($conn, "DELETE FROM produk WHERE idproduk='$idp'");
    if($query){
        header('Location: stock.php');
    } else {
        echo '
        <script>alert("Gagal");
        window.location.href="stock.php"
        </script>
        ';
    }
}


//fungsi tambah  pelanggan
if(isset($_POST['tambahpelanggan'])){
    $namapelanggan = $_POST['namapelanggan'];
    $notelp = $_POST['notelp'];
    $alamat = $_POST['alamat'];

    $insert = mysqli_query($conn,"insert into pelanggan (namapelanggan,notelp,alamat) values ('$namapelanggan','$notelp','$alamat')");

    if($insert){
        header('location:pelanggan.php');
    } else {
        echo '
       <script>alert("Gagal menambah pelanggan baru");
       window.location.href="pelanggan.php"
       </script>
       ';
    }
}


//fungsi tambah data pelanggan
if (isset($_POST['tambahpesanan'])) {
    $idpelanggan = $_POST['idpelanggan'];
    $tanggal = date("Y-m-d"); // Menggunakan tanggal saat ini

    $sql = "INSERT INTO pesanan (idpelanggan, tanggal) VALUES ('$idpelanggan', '$tanggal')";

    if (mysqli_query($conn, $sql)) {
        echo "Pesanan baru berhasil ditambahkan!";
        header("Location: data_pelanggan.php"); // Redirect ke halaman data pelanggan
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}


//fungsi hapus pelanggan
if (isset($_POST['hapuskelolapelanggan'])) {
    $idorder = $_POST['idorder'];

    $deleteQuery = "DELETE FROM pesanan WHERE idorder = $idorder";
    if (mysqli_query($conn, $deleteQuery)) {
        header("Location: data_pelanggan.php");
        exit();
    } else {
        header("Location: data_pelanggan.php?error=delete_failed");
        exit();
    }
}



// Fungsi untuk menambah barang masuk
if (isset($_POST['barangmasuk'])) {
    $idproduk = $_POST['idproduk'];
    $tanggal =date("Y-m-d");

    $insertbarangmasuk = mysqli_query($conn, "INSERT INTO masuk (idproduk, tanggal) VALUES ('$idproduk', '$tanggal')");
    if ($insertbarangmasuk) {
        header('Location: masuk.php');
    } else {
        echo '
        <script>
            alert("Gagal menambahkan barang masuk");
            window.location.href="masuk.php";
        </script>
        ';
    }
}


// Fungsi untuk menghapus barang masuk
if (isset($_POST['hapusmasuk'])) {
    $idproduk = $_POST['idproduk'];
    
    $deleteQuery = "DELETE FROM masuk WHERE idproduk = $idproduk";
    if (mysqli_query($conn, $deleteQuery)) {
        header("Location: masuk.php");
        exit();
    } else {
        header("Location: masuk.php?error=delete_failed");
        exit();
    }
}

// edit pengguna
if (isset($_POST['editadmin'])) {
    $iduser = $_POST['iduser'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $update = mysqli_query($conn, "UPDATE user SET username='$username', password='$password', role='$role' WHERE iduser='$iduser'");

    if ($update) {
        echo "<script>alert('User updated successfully');</script>";
    } else {
        echo "<script>alert('Failed to update user');</script>";
    }
}

//fungsi tambah pengguna
if (isset($_POST['tambahpengguna'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypting password
    $role = $_POST['role'];

    $query = mysqli_query($conn, "INSERT INTO user (username, password, role) VALUES ('$username', '$password', '$role')");

    if ($query) {
        header('Location: admin.php');
    } else {
        echo "<script>alert('Failed to add user');</script>";
    }
}

// hapus pengguna
if (isset($_POST['hapuspengguna'])) {
    $iduser = $_POST['iduser'];

    $delete = mysqli_query($conn, "DELETE FROM user WHERE iduser='$iduser'");

    if ($delete) {
        echo "<script>alert('User deleted successfully');</script>";
    } else {
        echo "<script>alert('Failed to delete user');</script>";
    }
}



//edit pelanggan
if(isset($_POST['editpelanggan'])){
    $np = $_POST['namapelanggan'];
    $notelp = $_POST['notelp'];
    $alamat = $_POST['alamat'];
    $idpl = $_POST['idpl']; 

    $query = mysqli_query($conn, "update pelanggan set namapelanggan='$np', notelp='$notelp', alamat='$alamat' where idpelanggan='$idpl'");

    if(query){
        header('location:pelanggan.php');
    } else {
        echo '
        <script>alert("Gagal");
        window.location.href="pelanggan.php"
        </script>
        ';
    }
}

//fungsi hapus pelanggan
if (isset($_POST['hapuspelanggan'])) {
    $idpl = $_POST['idpl'];

    $deleteQuery = "DELETE FROM pelanggan WHERE idpelanggan = $idpl";
    if (mysqli_query($conn, $deleteQuery)) {
        header("Location: pelanggan.php");
        exit();
    } else {
        header("Location: pelanggan.php?error=delete_failed");
        exit();
    }
}

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


?>