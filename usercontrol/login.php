<?php
require_once '../helper/helper.php';
$h=new Helper();
$notif="";
if(isset($_POST['login'])){
  $nip="";
  $nama="";
  $jabatan="";
  $jumlah=0;
  $username=$_POST['nip'];
  $password=$_POST['password'];
  $datalogin=$h->read("SELECT COUNT(nip) AS jumlah, nip, nama_pegawai, jabatan FROM data_pegawai WHERE nip=? AND nip=? LIMIT 1",array($username,$password));
  foreach ($datalogin as  $value) {
    $nama=$value['nama_pegawai'];
    $jabatan=$value['jabatan'];
    $jumlah=$value['jumlah'];
  }
  if($jumlah==1){
    session_start();
    $_SESSION['nama']=$nama;
    $_SESSION['jabatan']=$jabatan;
    $_SESSION['nip']=$username;
    header("location:index.php");
  }else{
    $notif="<div class='alert alert-danger'>User atau password salah</div>";
  }

}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>
      ECOPERATE ADMIN PANEL
    </title>
    <style media="screen">
    @import "bourbon";

body {
background-image: url("assets/img/bg.jpg");
background-size: cover;
}

.wrapper {
margin-top: 80px;
margin-bottom: 80px;
}

.form-signin {
max-width: 380px;
padding: 15px 35px 45px;
margin: 0 auto;
background-color: #fff;
border: 1px solid rgba(0,0,0,0.1);

.form-signin-heading,
.checkbox {
  margin-bottom: 30px;
}

.checkbox {
  font-weight: normal;
}

.form-control {
  position: relative;
  font-size: 16px;
  height: auto;
  padding: 10px;
  @include box-sizing(border-box);

  &:focus {
    z-index: 2;
  }
}

input[type="text"] {
  margin-bottom: -1px;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
}

input[type="password"] {
  margin-bottom: 20px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
}

    </style>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  </head>
  <body>
    <div class="wrapper">
  <form class="form-signin" method="post">
    <h3 class="form-signin-heading">ECOPERATE Login</h3>
    <label for="">NIP</label>
    <input type="text" class="form-control" name="nip" placeholder="Email Address" required="" autofocus="" />
    <label for="">Password</label>
    <input type="password" class="form-control" name="password" placeholder="Password" required=""/>
    <!--<label class="checkbox">
      <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
    </label>-->
    <br>
    <button class="btn btn-lg btn-primary btn-block" type="submit" name="login" style="margin-bottom:10px;">Login</button>
    <?php echo $notif ?>
  </form>
</div>
  </body>
</html>
