<?php
session_start();
if (!isset($_SESSION['tipe'])) {
  header('location:login.php');
}

?>
<!DOCTYPE html>
  <html>
        <head>

                    <!-- Title -->
                    <title>ECOOPERATE</title>
                    <meta content="width=device-width, initial-scale=1" name="viewport"/>
                    <meta charset="UTF-8">
                    <meta name="description" content="Admin Dashboard Template" />
                    <meta name="keywords" content="admin,dashboard" />
                    <meta name="author" content="Steelcoders" />
                    <!-- Styles -->
                    <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>
                    <link href="assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
                    <link href="assets/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/>
                    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
                    <link href="assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
                    <link href="assets/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/>
                    <link href="assets/plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>
                    <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css"/>
                    <link href="assets/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css"/>
                    <link href="assets/plugins/slidepushmenus/css/component.css" rel="stylesheet" type="text/css"/>
                    <link href="assets/plugins/datatables/css/jquery.datatables.min.css" rel="stylesheet" type="text/css"/>
                    <link href="assets/plugins/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet" type="text/css"/>
                    <link href="assets/plugins/x-editable/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" type="text/css">
                    <link href="assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css"/>
                    <link href="assets/swal/swal.css" rel="stylesheet" type="text/css"/>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

                    <!-- Theme Styles -->
                    <link href="assets/css/modern.min.css" rel="stylesheet" type="text/css"/>
                    <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>

                    <script src="assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
                    <script src="assets/plugins/jquery/jquery-2.1.4.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>


                    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
                    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
                    <!--[if lt IE 9]>
                    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
                    <![endif]-->

                </head>
                <body class="page-header-fixed compact-menu page-horizontal-bar">
                    <div class="overlay"></div>
                    <main class="page-content content-wrap">
                        <div class="navbar">
                            <div class="navbar-inner container">
                                <div class="sidebar-pusher">
                                    <a href="javascript:void(0);" class="waves-effect waves-button waves-classic push-sidebar">
                                        <i class="fa fa-bars"></i>
                                    </a>
                                </div>
                                <div class="logo-box">
                                    <a href="index.php" class="logo-text"><span>SISATYA</span></a>
                                </div><!-- Logo Box -->
                                <div class="topmenu-outer">
                                    <div class="top-menu">
                                        <ul class="nav navbar-nav navbar-left">
                                            <li>
                                                <a href="javascript:void(0);" class="waves-effect waves-button waves-classic sidebar-toggle"><i class="fa fa-bars"></i></a>
                                            </li>
                                            <!--<li>
                                                <a href="#cd-nav" class="waves-effect waves-button waves-classic cd-nav-trigger"><i class="fa fa-diamond"></i></a>
                                            </li>-->
                                            <li>
                                                <a href="javascript:void(0);" class="waves-effect waves-button waves-classic toggle-fullscreen"><i class="fa fa-expand"></i></a>
                                            </li>
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown">
                                                    <i class="fa fa-cogs"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-md dropdown-list theme-settings" role="menu">
                                                    <li class="li-group">
                                                        <ul class="list-unstyled">
                                                            <li class="no-link" role="presentation">
                                                                Fixed Header
                                                                <div class="ios-switch pull-right switch-md">
                                                                    <input type="checkbox" class="js-switch pull-right fixed-header-check" checked>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="li-group">
                                                        <ul class="list-unstyled">
                                                            <li class="no-link" role="presentation">
                                                                Fixed Sidebar
                                                                <div class="ios-switch pull-right switch-md">
                                                                    <input type="checkbox" class="js-switch pull-right fixed-sidebar-check">
                                                                </div>
                                                            </li>
                                                            <li class="no-link" role="presentation">
                                                                Toggle Sidebar
                                                                <div class="ios-switch pull-right switch-md">
                                                                    <input type="checkbox" class="js-switch pull-right toggle-sidebar-check">
                                                                </div>
                                                            </li>
                                                            <li class="no-link" role="presentation">
                                                                Compact Menu
                                                                <div class="ios-switch pull-right switch-md">
                                                                    <input type="checkbox" class="js-switch pull-right compact-menu-check" checked>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="no-link"><button class="btn btn-default reset-options">Reset Options</button></li>
                                                </ul>
                                            </li>
                                        </ul>
                                        <ul class="nav navbar-nav navbar-right">
                                          <!--<li class="dropdown">
                                              <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown"><i class="fa fa-envelope"></i><span class="badge badge-success pull-right"><?php //echo $jumlahdatapesan ?></span></a>
                                              <ul class="dropdown-menu title-caret dropdown-lg" role="menu">
                                                  <li><p class="drop-title"><?php //echo $jumlahdatapesan ?> Pesan Baru !</p></li>
                                                  <li class="dropdown-menu-list slimscroll messages">
                                                      <ul class="list-unstyled">
                                                          <li>
                                                            <?php //foreach ($datapesan as $value): ?>
                                                              <a href="data-saran-detail.php?id=<?php //echo $value['id']; ?>">
                                                                  <div class="msg-img"><div class="online on"></div><img class="img-circle" src="assets/images/ava.png" alt=""></div>
                                                                  <p class="msg-name"><?php //echo $value['nama_satuan_kerja'] ?></p>
                                                                  <p class="msg-text"><?php //echo $value['judul'] ?></p>
                                                                  <p class="msg-time"><?php //echo date("d/m/y",strtotime($value['tanggal'])) ?></p>
                                                              </a>
                                                            <?php //endforeach; ?>
                                                          </li>
                                                      </ul>
                                                  </li>
                                                  <li class="drop-all"><a href="data-saran.php" class="text-center">Semua Pesan</a></li>
                                              </ul>
                                          </li>
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown"><i class="fa fa-bell"></i><span class="badge badge-success pull-right"><?php //echo $jumlahdata ?></span></a>
                                                <ul class="dropdown-menu title-caret dropdown-lg" role="menu">
                                                    <li><p class="drop-title">Usulan Masuk</p></li>
                                                    <li class="dropdown-menu-list slimscroll tasks">
                                                        <ul class="list-unstyled">
                                                            <li>
                                                              <?php //foreach ($datausulan as $value): ?>
                                                                <a href="#">
                                                                    <div class="task-icon badge badge-info"><i class="icon-flag"></i></div>
                                                                    <span class="badge badge-roundless badge-default pull-right"><?php //echo date("d/m/y",strtotime($value['tanggal'])) ?></span>
                                                                    <p class="task-details"><?php //echo $value['nama_alat'] ?></p>
                                                                </a>
                                                              <?php //endforeach; ?>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="drop-all"><a href="data-usulan.php" class="text-center">Semua Info</a></li>
                                                </ul>
                                            </li>-->
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown">
                                                    <span class="user-name"><?php echo $_SESSION['nama'] ?><i class="fa fa-angle-down"></i></span>
                                                    <img class="img-circle avatar" src="assets/images/ava.png" width="40" height="40" alt="">
                                                </a>
                                                <ul class="dropdown-menu dropdown-list" role="menu">
                                                    <!--<li role="presentation"><a href="lock-screen.html"><i class="fa fa-lock"></i>Lock screen</a></li>-->
                                                    <li role="presentation"><a href="logout.php"><i class="fa fa-sign-out m-r-xs"></i>Log out</a></li>
                                                </ul>
                                            </li>
                                        </ul><!-- Nav -->
                                    </div><!-- Top Menu -->
                                </div>
                            </div>
                        </div><!-- Navbar -->
                        <div class="page-sidebar sidebar horizontal-bar">
                            <div class="page-sidebar-inner">
                                <ul class="menu accordion-menu">
                                    <li class="nav-heading"><span>Navigation</span></li>
                                    <li><a href="index.php"><span class="menu-icon icon-speedometer"></span><p>Dashboard</p></a></li>
                                    <?php if ($_SESSION['tipe']==1): ?>
                                      <li class="droplink"><a href="#"><span class="menu-icon icon-grid"></span><p>Master Data</p><span class="arrow"></span></a>
                                          <ul class="sub-menu">
                                            <li><a href="data-user.php">Data User</a></li>
                                            <li><a href="data-pegawai.php">Data Pegawai</a></li>
                                            <li><a href="data-mitra.php">Data Mitra</a></li>
                                            <li><a href="data-satker.php">Data Satker</a></li>
                                            <li><a href="data-unker.php">Data Unker</a></li>
                                            <li><a href="data-negara.php">Data Negara</a></li>
                                            <li><a href="data-kategori-kerjasamaln.php">Data Kategori Kerjasama Luar Negeri</a></li>
                                            <li><a href="data-master-status.php">Data Master Status</a></li>
                                          </ul>
                                      </li>
                                    <?php endif; ?>
                                    <?php if ($_SESSION['tipe']!=4): ?>
                                      <li class="droplink"><a href="#"><span class="menu-icon icon-grid"></span><p>Data Kerjasama</p><span
                                    <?php endif; ?>
                                     class="arrow"></span></a>
                                        <ul class="sub-menu">
                                          <?php if ($_SESSION['tipe']==1): ?>
                                            <li><a href="data-kerjasama-luar-negeri.php">Kerjasama Luar Negeri</a></li>
                                            <li><a href="data-kerjasama-dalam-negeri.php">Kerjasama Dalam Negeri</a></li>
                                          <?php elseif ($_SESSION['tipe']==2) : ?>
                                            <li><a href="data-kerjasama-dalam-negeri.php">Kerjasama Dalam Negeri</a></li>
                                          <?php elseif ($_SESSION['tipe']==3) : ?>
                                            <li><a href="data-kerjasama-luar-negeri.php">Kerjasama Luar Negeri</a></li>
                                          <?php endif; ?>

                                        </ul>
                                    </li>
                                    <?php if ($_SESSION['tipe']==1 || $_SESSION['tipe']==4): ?>
                                    <li><a href="data-permohonan.php"><span class="menu-icon icon-layers"></span><p>Data Permohonan</p></a></li>
                                  <?php else: ?>
                                    <?php endif; ?>
                                </ul>
                            </div><!-- Page Sidebar Inner -->
                        </div><!-- Page Sidebar -->
