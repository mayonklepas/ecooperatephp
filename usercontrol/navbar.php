<?php
session_start();
if (!isset($_SESSION['nip'])) {
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
                    <link href="../assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
                    <link href="../assets/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/>
                    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
                    <link href="../assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
                    <link href="../assets/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/>
                    <link href="../assets/plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>
                    <link href="../assets/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css"/>
                    <link href="../assets/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css"/>
                    <link href="../assets/plugins/slidepushmenus/css/component.css" rel="stylesheet" type="text/css"/>
                    <link href="../assets/plugins/datatables/css/jquery.datatables.min.css" rel="stylesheet" type="text/css"/>
                    <link href="../assets/plugins/datatables/css/jquery.datatables_themeroller.css" rel="stylesheet" type="text/css"/>
                    <link href="../assets/plugins/x-editable/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" type="text/css">
                    <link href="../assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css"/>
                    <link href="../assets/swal/swal.css" rel="stylesheet" type="text/css"/>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

                    <!-- Theme Styles -->
                    <link href="../assets/css/modern.min.css" rel="stylesheet" type="text/css"/>
                    <link href="../assets/css/custom.css" rel="stylesheet" type="text/css"/>

                    <script src="../assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
                    <script src="../assets/plugins/jquery/jquery-2.1.4.min.js"></script>
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
                                    <a href="index.php" class="logo-text"><span>ECOOPERATE</span></a>
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
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown">
                                                    <span class="user-name"><?php echo $_SESSION['nama'] ?><i class="fa fa-angle-down"></i></span>
                                                    <img class="img-circle avatar" src="../assets/images/ava.png" width="40" height="40" alt="">
                                                </a>
                                                <ul class="dropdown-menu dropdown-list" role="menu">
                                                    <!--<li role="presentation"><a href="lock-screen.html"><i class="fa fa-lock"></i>Lock screen</a></li>-->
                                                    <li role="presentation"><a href="../logout.php"><i class="fa fa-sign-out m-r-xs"></i>Log out</a></li>
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
                                </ul>
                            </div><!-- Page Sidebar Inner -->
                        </div><!-- Page Sidebar -->
