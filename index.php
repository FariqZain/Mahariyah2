<?php

session_start();
if (isset($_SESSION["ses_username"]) == "") {
    header("location:login");

} else {
    $data_id = $_SESSION["ses_id"];
    $data_nama = $_SESSION["ses_nama"];
    $data_user = $_SESSION["ses_username"];
    $data_level = $_SESSION["ses_level"];
    $data_foto = $_SESSION["ses_foto"];
}
include "inc/url.php";
$base_url = "x";
include "inc/koneksi.php";

?>

<!DOCTYPE html>
<html
lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="plugins/assets/"
  data-template="vertical-menu-template">

<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
      <meta name="description" content="" />
    <title>Panic</title>
    <link rel="icon" href="plugins/assets/img/sicimollogo.png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
      rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="plugins/assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="plugins/assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="plugins/assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="plugins/assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="plugins/assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="plugins/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="plugins/assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="plugins/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="plugins/assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="plugins/assets/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="plugins/assets/vendor/libs/swiper/swiper.css" />
    <link rel="stylesheet" href="plugins/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="plugins/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet" href="plugins/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css" />
    <link rel="stylesheet" href="plugins/assets/vendor/libs/animate-css/animate.css" />

    <link rel="stylesheet" href="plugins/assets/vendor/libs/datatables-select-bs5/select.bootstrap5.css" />

    <link rel="stylesheet" href="plugins/assets/vendor/libs/datatables-fixedcolumns-bs5/fixedcolumns.bootstrap5.css" />
    <link rel="stylesheet" href="plugins/assets/vendor/libs/datatables-fixedheader-bs5/fixedheader.bootstrap5.css" />

    <link rel="stylesheet" href="plugins/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />
    <link rel="stylesheet" href="plugins/assets/vendor/libs/flatpickr/flatpickr.css" />
    <!-- Row Group CSS -->
    <link rel="stylesheet" href="plugins/assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css" />
    <!-- Page CSS -->
    <link rel="stylesheet" href="plugins/assets/vendor/css/pages/cards-advance.css" />
    <link rel="stylesheet" href="plugins/assets/vendor/css/pages/page-profile.css" />
    <link rel="stylesheet" href="plugins/assets/vendor/libs/@form-validation/umd/styles/index.min.css" />

<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
    <!-- Helpers -->
    <script src="plugins/assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="plugins/assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="plugins/assets/js/config.js"></script>
    <!-- Font Awesome -->




    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


</head>
<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
<div class="app-brand demo">
            <a href="index.html" class="app-brand-link">

            <span class="app-brand-text demo menu-text fw-bold">SiCimol</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
              <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
              <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
            </a>
          </div>
<div class="menu-inner-shadow"></div>


        <!-- Sidebar Menu -->
        <ul class="menu-inner py-1">

            <!-- Menu Items -->
            <?php if ($data_level == "admin"): ?>
                <!-- Dashboard -->
                <li class="menu-item active open">
                    <a href="?page=admin" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-smart-home"></i>
                    <div data-i18n="">Home</div>
                    </a>
                </li>

                <!-- Master Data -->
                <li class="menu-item">
                    <a href="#" class="menu-link menu-toggle">

                    <i class="menu-icon tf-icons ti ti-users"></i>
                        <div data-i18n="master">master</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="<?php echo $base_url ?>?page=MyApp/data_pengguna" class="menu-link">

                            <div data-i18n="akun user">akun user</div>
                            </a>
                        </li>
                    </ul>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="<?php echo $base_url ?>?page=MyApp/suhu" class="menu-link">

                            <div data-i18n="Data Suhu Control">Data Suhu Control</div>
                            </a>
                        </li>
                    </ul>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="<?php echo $base_url ?>?page=edit_cara" class="menu-link">

                            <div data-i18n="isi panduan">isi panduan</div>
                            </a>
                        </li>
                    </ul>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="<?php echo $base_url ?>?page=tim" class="menu-link">

                            <div data-i18n="Data Tim">Data Tim</div>
                            </a>
                        </li>
                    </ul>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="<?php echo $base_url ?>?page=berita" class="menu-link">

                            <div data-i18n="Data berita">Data berita</div>
                            </a>
                        </li>
                    </ul>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="<?php echo $base_url ?>?page=darurat" class="menu-link">

                            <div data-i18n="Data Kontak Developer">Data Kontak Developer</div>
                            </a>
                        </li>
                    </ul>
                    
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="<?php echo $base_url ?>?page=darurat" class="menu-link">

                            <div data-i18n="Kalkulator BMI">Kalkulator BMI</div>
                            </a>
                        </li>
                    </ul>

                </li>
                <li class="menu-item">
                    <a href="<?php echo $base_url ?>?page=suhu_desa" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-book"></i>
                    <div data-i18n="Suhu Desa">Suhu Desa</div>
                    </a>
                </li>
                <li class="menu-item">
                 <a href="https://www.bmkg.go.id/cuaca/prakiraan-cuaca.bmkg?AreaID=5008220&Prov=12&lang=EN" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-book"></i>
                    <div data-i18n="Cuaca">Cuaca</div>
                    </a>
                </li>



                <!-- Informasi User -->
                <li class="menu-item">
                    <a href="<?php echo $base_url ?>?page=list" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-book"></i>
                        <div data-i18n="Informasi User">Informasi User</div>
                    </a>
                </li>

                <!-- Setting -->

                <li class="menu-item">
                    <a href="<?php echo $base_url ?>?page=MyApp/admin_profil" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-users"></i>
                        <div data-i18n="Profil Akun">Profil Akun</div>
                    </a>
                </li>


  <?php elseif ($data_level == "user"): ?>
                <!-- Dashboard -->
                <!-- <li class="menu-item">
                    <a href="<?php echo $base_url ?>?page=user" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-smart-home"></i>
                    </a>
                </li>-->
              
                <li class="menu-item">
                    <a href="<?php echo $base_url ?>?page=pushupdata" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-book"></i>
                    <div data-i18n="Data Push-Up">Data Push-Up</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="<?php echo $base_url ?>?page=kalkulator" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-map"></i>
                    <div data-i18n="Temukan Porsi Latihan & Gaya Hidup Anda Berdasarkan BMI">Temukan Porsi Latihan & Gaya Hidup Anda</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo $base_url ?>?page=cara" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-map"></i>
                    <div data-i18n="Tutorial dan Tips">Tutorial dan Tips</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo $base_url ?>?page=v_berita" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-book"></i>
                    <div data-i18n="Yang Perlu Kamu Ketahui">Yang Perlu Kamu Ketahui</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo $base_url ?>?page=makanan" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-book"></i>
                    <div data-i18n="Rekomendasi Makanan Sehat">Rekomendasi Makanan Sehat</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="https://www.bmkg.go.id/cuaca/prakiraan-cuaca.bmkg?AreaID=5008220&Prov=12&lang=EN" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-book"></i>
                    <div data-i18n="Cuaca">Cuaca</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="https://news.detik.com/" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-book"></i>
                    <div data-i18n="Berita Terkini">Berita Terkini</div>
                    </a>
                </li>
  
                <li class="menu-item">
                    <a href="<?php echo $base_url ?>?page=profil" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-user"></i>
                    <div data-i18n="Profile Akun">Profile Akun</div>
                    </a>
                </li>

                
                <li class="menu-item">
                    <a href="<?php echo $base_url ?>?page=v_tim" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-users"></i>
                    <div data-i18n="Tim Kami">Tim Kami</div>
                    </a>
                </li>
                
                <li class="menu-item">
                    <a href="<?php echo $base_url ?>?page=v_darurat" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-users"></i>
                    <div data-i18n="Kontak Darurat">Kontak Darurat</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo $base_url ?>?page=Jadwal" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-map"></i>
                    <div data-i18n="Jadwal">Jadwal</div>
                    </a>
                </li>
            <?php endif;?>


            <!-- Logout -->
            <li class="menu-item">
                <a href="logout.php" onclick="return confirm('Anda yakin keluar dari aplikasi ?')" class="menu-link">
                <i class="menu-icon tf-icons ti ti-lock"></i>
                    <div data-i18n="Log-out">Log-out</div>
                </a>
            </li>
        </ul>

</aside>
<div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item menu-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="ti ti-menu-2 ti-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">


              <ul class="navbar-nav flex-row align-items-center ms-auto">

                <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                  <a class="menu-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <i class="ti ti-md"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                        <span class="align-middle"><i class="ti ti-sun me-2"></i>Light</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                        <span class="align-middle"><i class="ti ti-moon me-2"></i>Dark</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                        <span class="align-middle"><i class="ti ti-device-desktop me-2"></i>System</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!-- / Style Switcher-->
                &nbsp;&nbsp; &nbsp;
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="menu-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="dist/img/<?php echo $data_foto; ?>" alt class="h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="pages-account-settings-account.html">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="dist/img/<?php echo $data_foto; ?>" alt class="h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-medium d-block"><?php echo $data_nama; ?></span>
                            <small class="text-muted"><?php echo $data_level; ?></small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="<?php echo $base_url ?>?page=MyApp/admin_profil">
                        <i class="ti ti-user-check me-2 ti-sm"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="logout.php" onclick="return confirm('Anda yakin keluar dari aplikasi ?')" >
                        <i class="ti ti-logout me-2 ti-sm"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>

            <!-- Search Small Screens -->
            <div class="navbar-search-wrapper search-input-wrapper d-none">
              <input
                type="text"
                class="form-control search-input container-xxl border-0"
                placeholder="Search..."
                aria-label="Search..." />
              <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
            </div>
          </nav>

          <!-- / Navbar -->

        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">

                <?php
if (isset($_GET['page'])) {
    $hal = $_GET['page'];

    switch ($hal) {

        //-------------home--------------
        case 'home':
            include "view/home.php";
            break;

//-------------------------admin & user---------------
        case 'admin':
            include "view/home/admin.php";
            break;
        case 'user':
            include "view/home/user.php";
            break;

//----------------------------------
        //admin
        case 'MyApp/data_pengguna':
            include "view/admin/pengguna/data_pengguna.php";
            break;
        case 'MyApp/add_pengguna':
            include "view/admin/pengguna/add_pengguna.php";
            break;
        case 'MyApp/edit_pengguna':
            include "view/admin/pengguna/edit_pengguna.php";
            break;
        case 'MyApp/del_pengguna':
            include "view/admin/pengguna/del_pengguna.php";
            break;
        case 'MyApp/del_all':
            include "view/admin/pengguna/del_all.php";
            break;
        //admin_control data suhu
        case 'MyApp/suhu':
            include "view/admin/su/suhu.php";
            break;
        case 'MyApp/delete_suhu':
            include "view/admin/su/delete.php";
            break;
        //-----------list user view
        case 'list':
            include "view/list.php";
            break;
//----------------------button
        case 'status':
            include "view/suhu/konfir.php";
            break;
        // Profil admin
        case 'MyApp/admin_profil':
            include "view/admin/profil/profile.php";
            break;
        //data suhu
        case 'suhu_desa':
            include "view/suhu/suhu.php";
            break;
///konek suhu
        case 'konek_suhu':
            include "view/suhu/konek.php";
            break;
        case 'MyApp/data_suhu':
            include "view/suhu/get_data.php";
            break;
//--------------panduan---------------
        case 'cara':
            include "view/user/panduan/panduan.php";
            break;
        case 'edit':
            include "view/user/panduan/edit.php";
            break;
        case 'delet_panduan':
            include "view/user/panduan/delete.php";
            break;
        case 'edit_cara':
            include "view/user/panduan/edit_panduan.php";
            break;

//--------------user---------------
        // Profil user
        case 'profil':
            include "view/user/profil/profile.php";
            break;
        //data per user
        case 'data_user':
            include "view/user/data/data_user.php";
            break;
        case 'list_usr':
            include "view/user/list/list.php";
            break;

//---------push ups---
        case 'pushupdata':
            include "view/user/pushup/pushupdata.php";
            break;
//---------makanan---
        case 'makanan':
            include "view/user/rekomendasi/makanan.php";
            break;
//---------tim---
        case 'v_tim':
            include "view/user/tim/view_tim.php";
            break;
        case 'tim':
            include "view/user/tim/tim.php";
            break;
        case 'edit_tim':
            include "view/user/tim/edit_tim.php";
            break;
        case 'delet_tim':
            include "view/user/tim/delet_tim.php";
            break;
        //---------berita---
        case 'v_berita':
            include "view/user/berita/v_berita.php";
            break;
        case 'berita':
            include "view/user/berita/berita.php";
            break;
        case 'edit_berita':
            include "view/user/berita/edit_berita.php";
            break;
        case 'delet_berita':
            include "view/user/berita/delet_berita.php";
            break;
        // -----------kontak darurat
        case 'darurat':
            include "view/user/dr/darurat.php";
            break;
        case 'edit_darurat':
            include "view/user/dr/edit_darurat.php";
            break;
        case 'v_darurat':
            include "view/user/dr/v_dr.php";
            break;

            //----------------------------------
        //KALKULATOR BMI
        case 'kalkulator':
            include "view/user/KALKULATOR BMI/kalkulator.php";
            break;
          //Jadwal
        case 'Jadwal':
            include "view/user/Jadwal/Jadwal.php";
            break;
//--------------------------------------
        // soal add -------------
        case 'ist_add':
            include "view/user/add/ist.php";
            break;
        case '16pf_add':
            include "view/user/add/16pf.php";
            break;
        case 'soal3_add':
            include "view/user/add/soal3.php";
            break;
//--------------------------------------
        // soal delet all-------------
        case 'ist_del_all':
            include "view/user/delet/ist_all.php";
            break;
        case '16pf_del_all':
            include "view/user/delet/16pf_all.php";
            break;
        case 'soal3_del_all':
            include "view/user/delet/soal3_all.php";
            break;
//--------------------------------------
        // soal delet id-------------
        case 'ist_del':
            include "view/user/delet/ist.php";
            break;

        case '16pf_del':
            include "view/user/delet/16pf.php";
            break;
        case 'soal3_del':
            include "view/user/delet/soal3.php";
            break;
//------------------------------------------
        // soal edit -------------
        case 'ist':
            include "view/user/edit/ist.php";
            break;

        case '16pf':
            include "view/user/edit/16pf.php";
            break;
        case 'soal3':
            include "view/user/edit/soal3.php";
            break;
//----------------
        //default
        default:
            echo "<center><br><br><br><br><br><br><br><br><br>
               <h1> Halaman tidak ditemukan !</h1></center>";
            break;
    }
} else {
    if ($data_level == "admin") {
        include "view/home/admin.php";
    } elseif ($data_level == "user") {
        include "view/home/user.php";
    }
}
?>

</div>
        </div>

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl">
                <div
                  class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
                  <div>
                    ©
                    <script>
                      document.write(new Date().getFullYear());
                    </script>
                    , SiCimol MAHARIYAH2 2024
                  </div>
                  <div class="d-none d-lg-inline-block">

                  </div>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->


    <script src="plugins/assets/vendor/libs/popper/popper.js"></script>
    <script src="plugins/assets/vendor/js/bootstrap.js"></script>
    <script src="plugins/assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="plugins/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="plugins/assets/vendor/libs/hammer/hammer.js"></script>
    <script src="plugins/assets/vendor/libs/i18n/i18n.js"></script>
    <script src="plugins/assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="plugins/assets/vendor/js/menu.js"></script>
    <script src="plugins/assets/vendor/libs/moment/moment.js"></script>
    <script src="plugins/assets/vendor/libs/flatpickr/flatpickr.js"></script>
    <!-- endbuild -->
    <!-- Form Validation -->
    <script src="plugins/assets/vendor/libs/@form-validation/umd/bundle/popular.min.js"></script>
    <script src="plugins/assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js"></script>
    <script src="plugins/assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js"></script>
    <!-- Vendors JS -->
    <script src="plugins/assets/vendor/libs/apex-charts/apexcharts.js"></script>
    <script src="plugins/assets/vendor/libs/swiper/swiper.js"></script>
    <script src="plugins/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="plugins/assets/js/tables-datatables-extensions.js"></script>
    <!-- Main JS -->
    <script src="plugins/assets/js/main.js"></script>
 <!-- Page JS -->
 <script src="plugins/assets/js/tables-datatables-basic.js"></script>
     <!-- Page JS -->
     <script src="plugins/assets/js/tables-datatables-advanced.js"></script>
    <!-- Page JS -->
    <script src="plugins/assets/js/dashboards-analytics.js"></script>
        <!-- jQuery 2.2.3 -->
        <!-- <script src="plugins/jQuery/jquery-2.2.3.min.js"></script> -->
<!-- Page JS -->

        <script src="plugins/assets/vendor/libs/jquery/jquery.js"></script>

        <script src="plugins/select2/select2.full.min.js"></script>
        <!-- DataTables -->
        <script src="plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

        <!-- AdminLTE App -->
        <script src="dist/js/app.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="dist/js/demo.js"></script>
        <!-- page script -->

        <script>
        $(function() {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
        </script>
        <script>
        $(function() {

            $(".select2").select2();
        });
        </script>
    </div>
</body>

</html>