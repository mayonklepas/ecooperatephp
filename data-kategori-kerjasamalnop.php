<?php
include 'navbar.php';
require 'helper/helper.php';
$h=new Helper();
$sid="";
$sketerangan="";
$snama="";
if(isset($_GET['id'])){
$sid=$_GET['id'];
$data=$h->read("SELECT id, keterangan, nama FROM data_kategori_kerjasama_ln WHERE id=?",array($_GET['id']));
foreach ($data as $value) {
  $sid=$value['id'];
  $sketerangan=$value['keterangan'];
  $snama=$value['nama'];
}
}

if(isset($_POST['simpan'])){
  $keterangan=$_POST['keterangan'];
  $nama=$_POST['nama'];
  if($sid == ""){
    $h->exec("INSERT INTO data_kategori_kerjasama_ln(keterangan, nama) VALUES (?,?)",
    array($keterangan,$nama));
    echo "<script>alert('Data Berhasil Diinput'); window.location.replace('data-kategori-kerjasamaln.php');</script>";
  }else{
    $h->exec("UPDATE data_kategori_kerjasama_ln SET keterangan=?, nama=? WHERE id=?",
    array($keterangan,$nama,$sid));
    echo "<script>alert('Data Berhasil Diupdate'); window.location.replace('data-kategori-kerjasamaln.php');</script>";
  }

}
?>


<div class="page-inner">
    <div class="page-breadcrumb">
        <ol class="breadcrumb container">
            <li><a href="index.php">Home</a></li>
            <li><a href="data-data_kategori_kerjasama_ln.php">Data Kategori Kerjasama Luar Negeri</a></li>
            <li class="active">Input Data Kategori Kerjasama Luar Negeri</li>
        </ol>
    </div>
    <div class="page-title">
        <div class="container">
            <h3>Input Data Kategori Kerjasama Luar Negeri</h3>
        </div>
    </div>
    <div id="main-wrapper" class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">Input Data Kategori Kerjasama Luar Negeri</h4>
                    </div>
                    <div class="panel-body">
      <br>
        <form class="" action="" method="post">
          <label for="">Nama </label>
          <input type="text" name="nama" value="<?php echo $snama;?>" class="form-control" >
          <label for="">Keterangan</label>
          <input type="text" name="keterangan" value="<?php echo $sketerangan;?>" class="form-control" >
          <button type="submit" name="simpan" id="simpan" class="btn btn-primary" style="margin-top:10px;" >Simpan</button>
        </form>
      </div>
    </div>
      </div>
  </div>
</div>
<?php include 'footer.php'; ?>
