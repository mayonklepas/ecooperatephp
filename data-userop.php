<?php
include 'navbar.php';
require 'helper/helper.php';
$h=new Helper();
$snik="";
$snama="";
$sjabatan="";
$semail="";
$stelepon="";
$spassword="";
$snip="";
$stipe="";
$stipenama="";
if(isset($_GET['nik'])){
$data=$h->read("SELECT nama, jabatan, email, telepon, password, nik, nip,tipe FROM data_user WHERE nik=?",array($_GET['nik']));
foreach ($data as $value) {
  $snama=$value['nama'];
  $sjabatan=$value['jabatan'];
  $semail=$value['email'];
  $stelepon=$value['telepon'];
  $spassword=$value['password'];
  $snip=$value['nip'];
  $snik=$value['nik'];
  $stipe=$value['tipe'];
  if($stipe==1){
    $stipenama="Admin";
  }else if($stipe==2){
    $stipenama="Kerjasama Dalam Negeri";
  }else if($stipe==1){
    $stipenama="Kerjasama Luar Negeri";
  }else if($stipe==1){
    $stipenama="Permohonan";
  }
}
}

if(isset($_POST['simpan'])){
  $nik=$_POST['nik'];
  $nama=$_POST['nama'];
  $jabatan=$_POST['jabatan'];
  $email=$_POST['email'];
  $telepon=$_POST['telepon'];
  $password=$_POST['password'];
  $nip=$_POST['nip'];
  $tipe=$_POST['tipe'];
  if($snik == ""){
    $h->exec("INSERT INTO data_user(nama, jabatan, email, telepon, password, nik, nip,tipe) VALUES (?,?,?,?,?,?,?,?)",
    array($nama,$jabatan,$email,$telepon,$password,$nik,$nip,$tipe));
    echo "<script>alert('Data Berhasil Diinput'); window.location.replace('data-user.php');</script>";
  }else{
    $h->exec("UPDATE data_user SET nama=?, jabatan=?, email=?, telepon=?, password=?, nik=?, nip=?,tipe=? WHERE nik=?",
    array($nama,$jabatan,$email,$telepon,$password,$nik,$nip,$tipe,$snik));
    echo "<script>alert('Data Berhasil Diupdate'); window.location.replace('data-user.php');</script>";
  }

}
?>

<script type="text/javascript">
  $(document).ready(function () {
    $("#repassword").keyup(function(){
        var pas=$("#password").val();
        if($(this).val()==pas){
          $("#simpan").prop("disabled",false);
          $("#lrepas").html(" <b style='color:green'>Password Cocok<b>");
        }else{
          $("#simpan").prop("disabled",true);
          $("#lrepas").html(" <b style='color:red'>Password Tidak Cocok<b>");
        }
    });


  });
</script>

<div class="page-inner">
    <div class="page-breadcrumb">
        <ol class="breadcrumb container">
            <li><a href="index.php">Home</a></li>
            <li><a href="data-user.php">Data User</a></li>
            <li class="active">Input Data User</li>
        </ol>
    </div>
    <div class="page-title">
        <div class="container">
            <h3>Data User</h3>
        </div>
    </div>
    <div id="main-wrapper" class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">Data User</h4>
                    </div>
                    <div class="panel-body">
      <br>
        <form class="" action="" method="post">
          <label for="">NIK</label>
          <input type="text" name="nik" value="<?php echo $snik;?>" class="form-control" required=required autocomplete="off">
          <label for="">NIP</label>
          <input type="text" name="nip" value="<?php echo $snip;?>" class="form-control" autocomplete="off">
          <label for="">Nama</label>
          <input type="text" name="nama" value="<?php echo $snama;?>" class="form-control" autocomplete="off">
          <label for="">Jabatan</label>
          <input type="text" name="jabatan" value="<?php echo $sjabatan;?>" class="form-control" autocomplete="off">
          <label for="">Email</label>
          <input type="email" name="email" value="<?php echo $semail;?>" class="form-control">
          <label for="">Telepon</label>
          <input type="tel" name="telepon" value="<?php echo $stelepon;?>" class="form-control" >
          <label for="">Tipe</label>
          <select class="form-control" name="tipe">
            <option value="<?php echo $stipe ?>"><?php echo $stipe ?></option>
            <option value="1">Admin</option>
            <option value="2">Kerjasama Dalam Negeri</option>
            <option value="3">Kerjasama Luar Negeri</option>
            <option value="4">Permohonan</option>
          </select>
          <label for="">Password</label>
          <input type="password" name="password" id="password" value="<?php echo $spassword;?>" class="form-control">
          <label for="" id="lrepas" >Retype Password</label>
          <input type="password" name="repassword" id="repassword" value="" class="form-control">
          <button type="submit" name="simpan" id="simpan" class="btn btn-outline-primary" style="margin-top:10px;" disabled=true >Simpan</button>
        </form>
      </div>
    </div>
      </div>
  </div>
</div>
<?php include 'footer.php'; ?>
