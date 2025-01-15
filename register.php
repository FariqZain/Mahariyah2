<?php
include "inc/koneksi.php";

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register</title>
    <link rel="icon" href="dist/img/logo.png">
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>
<style>
.login-page {
    background: #fff;
    /* background: -webkit-linear-gradient(left, #00ea00, #ffff, #b984ff); */
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
    <div class="login-box" style="background-color:#fff;border-radius: 50px 10px;">
        <div class="login-logo">
            <br>

            <a href="#">
                <img style="filter: drop-shadow(0 0 0.75rem  #3333);" src="plugins/assets/img/sicimollogo.png" width="195px">
            </a>
        </div>
        <!-- /.login-logo -->

        <div style="border-radius: 50px 10px;"class="login-box-body">
        <div class="login-header text-center">
            <div style="box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;border-radius:20px;"class="btn-group" role="group" aria-label="Tombol Masuk dan Register">
                <a style="border-radius:20px;" href="register" class="btn btn-danger">Daftar</a>
                <a style="border-radius:20px;" href="login" class="btn btn-light">Masuk</a>
            </div>
        </div>

                </div>
                <form action="#" method="post">
                <div class="form-group has-feedback">
                    <label>Nama</label>
                    <input style="border-radius:20px;" type="text" class="form-control" name="nama_pengguna" placeholder="Nama" required>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <label>Email</label>
                    <input style="border-radius:20px;" type="text" class="form-control" name="username" placeholder="Email" required>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <label>Password</label>
                    <input style="border-radius:20px;" type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <label>Konfirmasi Password</label>
                    <input style="border-radius:20px;" type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Konfirmasi Password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <input type="hidden" name="level" value="user">
                <div class="row">
                    <div class="col-xs-12">
                        <button style="border-radius:40px;" type="submit" class="btn btn-danger btn-lg btn-block" name="btnRegister" title="Register"><b>Submit</b></button>
                        <br>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <!-- /.social-auth-links -->
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
if (isset($_POST['btnRegister'])) {
    // Mengambil data dari formulir
    $nama_pengguna = mysqli_real_escape_string($koneksi, $_POST['nama_pengguna']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($koneksi, $_POST['confirm_password']);
    $level = mysqli_real_escape_string($koneksi, $_POST['level']);

    // Validasi bahwa password dan konfirmasi password cocok satu sama lain
    if ($password !== $confirm_password) {
        echo "<script>
                    Swal.fire({title: 'Registrasi Gagal',text: 'Password dan konfirmasi password tidak cocok',icon: 'error',confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                            window.location = 'register';
                        }
                    })</script>";
        exit;
    }

    // Query untuk memasukkan data registrasi ke dalam database
    $sql_register = "INSERT INTO tb_pengguna (username, password, nama_pengguna, level)
                    VALUES ('$username', '$password', '$nama_pengguna', '$level' )";

    if (mysqli_query($koneksi, $sql_register)) {
        echo "<script>
//                     Swal.fire({title: 'Registrasi Berhasil,Mohon Minta Konfirmasi Admin',text: 'Registrasi berhasil.',icon: 'success',confirmButtonText: 'OK'
//                     })
                    
                    
//                     Swal.fire({
//   title: 'Registrasi Berhasil',
//   text: 'Registrasi berhasil. Mohon Minta Konfirmasi Admin',
//   icon: 'success',
//   confirmButtonText: 'OK',
//   allowOutsideClick: false // agar pengguna tidak dapat menutup pesan tanpa mengklik tombol OK
// }).then((result) => {
//   if (result.isConfirmed) {
//     window.location.href = 'https://wa.me/6281212343821?text=Hallo%20admin%20sipitung,%20saya%20sudah%20registrasi.%0A%0ANama%20%3A%0AEmail%20%3A%0AMohon%20dikonfirmasi.'; // mengarahkan ke WhatsApp dengan format yang diinginkan
//   }
// });

// .then((result) => {
//                         if (result.value) {
//                             window.location = 'login';
//                         }

Swal.fire({
  title: 'Registrasi Berhasil',
  text: 'Registrasi berhasil. Mohon Minta Konfirmasi Admin',
  icon: 'success',
  confirmButtonText: 'OK',
  allowOutsideClick: false // agar pengguna tidak dapat menutup pesan tanpa mengklik tombol OK
}).then((result) => {
  if (result.isConfirmed) {
    // Mengarahkan ke WhatsApp dengan format yang diinginkan
    window.location.href = 'https://wa.me/6281212343821?text=Hallo%20admin%20sipitung,%20saya%20sudah%20registrasi.%0A%0ANama%20%3A%0AEmail%20%3A%0A%0AMohon%20dikonfirmasi.';
    
    // Menunggu 3 detik sebelum mengarahkan ke halaman login
    setTimeout(function() {
      window.location.href = 'login'; // Mengarahkan ke halaman login
    }, 1000);
  } else {
    window.location.href = 'login'; // jika pengguna tidak mengkonfirmasi, maka diarahkan ke halaman login
  }

                    })</script>";
        exit;
    } else {
        echo "<script>
                    Swal.fire({title: 'Registrasi Gagal',text: 'Error: " . mysqli_error($koneksi) . "',icon: 'error',confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                            window.location = 'register';
                        }
                    })</script>";
        exit;
    }

    mysqli_close($koneksi);
}
?>
