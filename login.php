<?php
include "inc/koneksi.php";
include "inc/url.php";
$base_url = "x";
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <link rel="icon" href="dist/img/tombol.png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

</head>
<style>
.login-page {
    background: #fff;
}

.login-box {
    background: #fff;
    color: #000;
}

.login-logo h3 {
    color: #000;
    font-size: 24px;
    font-weight: bold;
    text-align: center;
}

.login-box-msg {
    color: #000;
    text-align: center;
}
button
{
    gap: -10px;
}
</style>

<body class="hold-transition login-page">
    <div class="login-box justify-content-center" >
        <div class="login-logo ">
            <a href="#">
                <img style="filter: drop-shadow(0 0 0.75rem  #3333);" src="plugins/assets/img/sicimollogo.png" width="195px" >
            </a>
        </div>

        <div style="border-radius: 50px 10px;"class="login-box-body">

        <div class="login-header text-center">
            <div style="box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;border-radius:20px;"class="btn-group d-inline-flex justify-content-between" role="group" aria-label="Tombol Masuk dan Register">
                <a style="border-radius:20px;" href="register" class="btn btn-light">Daftar</a>
                <a style="border-radius:20px;" href="login" class="btn btn-danger">Masuk</a>
            </div>
        </div>
                </div>
            <form action="#" method="post">
                <div class="form-group has-feedback">
                    <label>Email</label>
                    <input style="border-radius:20px;" type="text" class="form-control" name="username" placeholder="Email" required>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <label>Password</label>
                    <input style="border-radius:20px;"type="password" class="form-control" name="password" placeholder="Password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <a href="lupa" id="lupaKataSandiBtn">
    <span class="text-danger">Lupa Kata Sandi?</span>
</a>

                <hr>
                <div class="row">
                    <div class="col-xs-12">
                        <button style="border-radius:40px;" type="submit" class="btn btn-danger btn-lg btn-block "
                            name="btnLogin" title="Masuk Sistem">
                            <b>masuk</b>
                        </button>
                    </div>
                </div>
            </form>

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery 2.2.3 -->
    <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!-- sweet alert -->
</body>

</html>
<?php
if (isset($_POST['btnLogin'])) {

    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    $sql_login = "SELECT * FROM tb_pengguna WHERE BINARY username='$username'";
    $query_login = mysqli_query($koneksi, $sql_login);
    $data_login = mysqli_fetch_array($query_login, MYSQLI_ASSOC);
    $jumlah_login = mysqli_num_rows($query_login);

    if ($jumlah_login == 1) {
        if ($data_login['setatus'] == 'belum di konfirmasi') {

            echo "<script>
                    Swal.fire({
                        title: 'Login Gagal',
                        html: 'Akun Anda belum dikonfirmasi oleh admin. Harap tunggu konfirmasi sebelum login.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                            window.location = 'login';
                        }
                    });
                  </script>";
        } else {

            if ($password === $data_login['password']) {
                session_start();
                $_SESSION["ses_id"] = $data_login["id_pengguna"];
                $_SESSION["ses_nama"] = $data_login["nama_pengguna"];
                $_SESSION["ses_username"] = $data_login["username"];
                $_SESSION["ses_nomor"] = $data_login["nomor"];
                $_SESSION["ses_kk"] = $data_login["kk"];
                $_SESSION["ses_kl"] = $data_login["kl"];
                $_SESSION["ses_setatus"] = $data_login["setatus"];
                $_SESSION["ses_password"] = $data_login["password"];
                $_SESSION["ses_level"] = $data_login["level"];
                $_SESSION["ses_foto"] = $data_login["foto"];

                $redirect_url = "";

                switch ($_SESSION["ses_level"]) {
                    case "admin":
                        $redirect_url = "$base_url?page=admin";
                        break;
                    case "user":
                        $redirect_url = "$base_url?page=user";
                        break;
                    default:

                        $redirect_url = "$base_url?page=login";
                        break;
                }

                echo "<script>
                        Swal.fire({
                            title: 'Login Berhasil',
                            text: '',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.value) {
                                window.location = '$redirect_url';
                            }
                        });
                      </script>";
            } else {

                echo "<script>
                        Swal.fire({
                            title: 'Login Gagal',
                            text: 'Cek Username dan Password Anda',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.value) {
                                window.location = '$base_url?page=login';
                            }
                        });
                      </script>";
            }
        }
    } else {

        echo "<script>
                Swal.fire({
                    title: 'Login Gagal',
                    text: 'Cek Username dan Password Anda',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = '$base_url?page=login';
                    }
                });
              </script>";
    }
}
?>
