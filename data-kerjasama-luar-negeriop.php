<?php
include 'navbar.php';
require 'helper/helper.php';
$h=new Helper();
$sid="";
$sjudul="";
$sbidang="";
$skategori="";
$snegara="";
$stanggal_ttd_mulai="";
$stanggal_ttd_akhir="";
$spic="";
$sketerangan="";
$scheck_keterangan="";
if(isset($_GET['id'])){
$data=$h->read("SELECT id, judul, bidang, kategori, negara,tanggal_ttd_mulai,tanggal_ttd_akhir, pic,keterangan,check_keterangan FROM data_kerjasama_ln WHERE id=?",array($_GET['nik']));
foreach ($data as $value) {
  $sid=$value['id'];
  $sjudul=$value['judul'];
  $sbidang=$value['bidang'];
  $skategori=$value['kategori'];
  $snegara=$value['negara'];
  $stanggal_ttd_mulai=$value['tanggal_ttd_mulai'];
  $stanggal_ttd_akhir=$value['tanggal_ttd_akhir'];
  $spic=$value['pic'];
  $sketerangan=$value['keterangan'];
  $scheck_keterangan=$value['check_keterangan'];
}
}

if(isset($_POST['simpan'])){
  $judul=$_POST['judul'];
  $bidang=$_POST['bidang'];
  $kategori=$_POST['kategori'];
  $negara=$_POST['negara'];
  $tanggal_ttd_mulai=$_POST['tanggal_ttd_mulai'];
  $tanggal_ttd_akhir=$_POST['tanggal_ttd_akhir'];
  $pic=$_POST['pic'];
  $keterangan=$_POST['keterangan'];
  $check_keterangan=$_POST['check_keterangan'];
  if($sid == ""){
    $h->exec("INSERT INTO data_kerjasama_ln(judul, bidang, kategori, negara,tanggal_ttd_mulai,tanggal_ttd_akhir, pic,keterangan,check_keterangan) VALUES (?,?,?,?,?,?,?,?,?)",
    array($judul, $bidang, $kategori, $negara,$tanggal_ttd_mulai,$tanggal_ttd_akhir, $pic,$keterangan,$check_keterangan));
    echo "<script>alert('Data Berhasil Diinput'); window.location.replace('data-kerjasama-luar-negeriop.php');</script>";
  }else{
    $h->exec("UPDATE data_kerjasama_ln SET judul=?, bidang=?, kategori=?, negara=?,tanggal_ttd_mulai=?,tanggal_ttd_akhir=?,
       pic=?,keterangan=?,check_keterangan=? WHERE id=?",
    array($judul, $bidang, $kategori, $negara,$tanggal_ttd_mulai,$tanggal_ttd_akhir, $pic,$keterangan,$check_keterangan,$sid));
    echo "<script>alert('Data Berhasil Diupdate'); window.location.replace('data-kerjasama-luar-negeriop.php');</script>";
  }

}
?>
<div class="page-inner">
    <div class="page-title">
        <h3>Input Data Kerjasama Luar Negeri</h3>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li><a href="data-kerjasama-dalam-negeri.php" class="active">Data Kerjasama Luar Negeri</a></li>
            </ol>
        </div>
    </div>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">Input Data Kerjasama Luar Negeri </h4>
                    </div>
                    <div class="panel-body">
      <br>
        <form class="" action="" method="post">
          <label for="">Judul</label>
          <input type="text" name="judul" value="<?php echo $sjudul;?>" class="form-control" required=required list="daftar-kegiatan">
          <label for="">Bidang</label>
          <input type="text" name="bidang" value="<?php echo $sbidang;?>" class="form-control" autocomplete="off">
          <label for="">Kategori</label>
          <input type="text" name="kategori" value="<?php echo $skategori;?>" class="form-control" autocomplete="off">
          <label for="">Negara</label>
          <input type="text" name="negara" value="<?php echo $snegara;?>" class="form-control" autocomplete="off">
          <label for="">Tanggal TTD Mulai</label>
          <input type="date" name="tanggal_ttd_mulai" value="<?php echo $stanggal_ttd_mulai;?>" class="form-control">
          <label for="">Tanggal TTD AKhir</label>
          <input type="date" name="tanggal_ttd_akhir" value="<?php echo $stanggal_ttd_akhir;?>" class="form-control">
          <label for="">PIC</label>
          <input type="text" name="pic" value="<?php echo $spic;?>" class="form-control" autocomplete="off">
          <label for="">Keterangan</label>
          <input type="text" name="keterangan" value="<?php echo $sketerangan;?>" class="form-control" autocomplete="off">
          <label for="">Check Keterangan</label>
          <input type="text" name="check_keterangan" value="<?php echo $scheck_keterangan;?>" class="form-control" autocomplete="off">
          <button type="submit" name="simpan" class="btn btn-outline-primary" style="margin-top:10px;">Simpan</button>
        </form>
      </div>
    </div>
      </div>
  </div>
</div>
<?php include 'footer.php'; ?>
