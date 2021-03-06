<?php
include 'navbar.php';
require 'helper/helper.php';
$h=new Helper();
$snama="";
$salamat="";
$snohp="";
$sid="";
if(isset($_GET['id'])){
$data=$h->read("SELECT id, nama, alamat, nohp FROM data_satker WHERE id=?",array($_GET['id']));
foreach ($data as $value) {
  $sid=$value['id'];
  $snama=$value['nama'];
  $salamat=$value['alamat'];
  $snohp=$value['nohp'];
}
}

if(isset($_POST['simpan'])){
  $nama=$_POST['nama'];
  $alamat=$_POST['alamat'];
  $nohp=$_POST['nohp'];
  if($sid == ""){
    $h->exec("INSERT INTO data_satker(nama,alamat,nohp) VALUES (?,?,?)",
    array($nama,$alamat,$nohp));
    echo "<script>alert('Data Berhasil Diinput'); window.location.replace('data-satker.php');</script>";
  }else{
    $h->exec("UPDATE data_satker SET nama=?, alamat=?, nohp=? WHERE id=?",
    array($nama,$alamat,$nohp,$sid));
    echo "<script>alert('Data Berhasil Diupdate'); window.location.replace('data-satker.php');</script>";
  }

}
?>


<div class="page-inner">
    <div class="page-breadcrumb">
        <ol class="breadcrumb container">
            <li><a href="index.php">Home</a></li>
            <li><a href="data-satker.php">Data Satker</a></li>
            <li class="active">Input Data Satker</li>
        </ol>
    </div>
    <div class="page-title">
        <div class="container">
            <h3>Input Data Satker</h3>
        </div>
    </div>
    <div id="main-wrapper" class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">Input Data Satker</h4>
                    </div>
                    <div class="panel-body">
      <br>
        <form class="" action="" method="post">
          <label for="">Nama</label>
          <input type="text" name="nama" value="<?php echo $snama;?>" class="form-control" required=required autocomplete="off">
          <label for="">Alamat</label>
          <input type="text" name="alamat" value="<?php echo $salamat;?>" class="form-control" autocomplete="off">
          <label for="">Telepon</label>
          <input type="text" name="nohp" value="<?php echo $snohp;?>" class="form-control" autocomplete="off">
          <button type="submit" name="simpan" id="simpan" class="btn btn-primary" style="margin-top:10px;">Simpan</button>
        </form>
      </div>
    </div>
      </div>
  </div>
</div>
<?php include 'footer.php'; ?>
