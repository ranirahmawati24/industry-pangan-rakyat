<?php

require 'koneksi.php';

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflace.com/ajax/libs/font-awesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            body{
                margin: 0;
                padding: 0;
                height: 100vh; /* memastikan body mengambil seluruh tinggi viewport */
                background-image: url(assets/img/beras.png.jpeg);        
                background-size: cover; /* memastikan gambar mencakup seluruh area */
                background-repeat: no-repeat; /* memastikan gambar tidak diulang */
                background-position: center; /* memastikan gambar diposisikan di tengah */
            }
            .card-body {
  /* flex: 1 1 auto; */
  /* padding: var(--bs-card-spacer-y) var(--bs-card-spacer-x); */
  color: var(--bs-card-color);
  padding: 10px
}
        </style>
    </head>
    <body class="bg-dark">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center mt-5">
                            <div class="col-lg-5 mt-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">




                                        <form method="post">
                                            <div class="form-group">
                                                <label class="mb-1" for="inputEmailAddress"><h5>Username</h5></label>
                                                <input class="form-control" id="inputEmailAddress" name="username" type="text" placeholder="Enter username" required/>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="mb-1" for="inputPassword"><h5>Password</h5></label>
                                                <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Enter Password" required/>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button type="submit" name="login" class="btn btn-primary">Login</button>
                                            </div>
                                        </form>




                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
