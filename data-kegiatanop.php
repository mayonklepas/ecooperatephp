<?php
include 'navbar.php';
require 'helper/helper.php';
$h=new Helper();
$sid="";
$snik="";
$snama_kegiatan="";
$sdurasi="";
$snegara="";
$skota="";
$datakegiatan=$h->read("SELECT nik,nama FROM data_pemohon ORDER BY NIK ASC",null);
if(isset($_GET['id'])){
  $sid=$_GET['id'];
$data=$h->read("SELECT id, nik, nama_kegiatan, durasi, negara, kota FROM data_kegiatan WHERE id=?",array($_GET['id']));
foreach ($data as $value) {
  $snik=$value['nik'];
  $snama_kegiatan=$value['nama_kegiatan'];
  $sdurasi=$value['durasi'];
  $snegara=$value['negara'];
  $skota=$value['kota'];
}
}

if(isset($_POST['simpan'])){
  $nik=$_POST['nik'];
  $nama_kegiatan=$_POST['nama_kegiatan'];
  $durasi=$_POST['durasi'];
  $negara=$_POST['negara'];
  $kota=$_POST['kota'];
  if($sid == ""){
    $h->exec("INSERT INTO data_kegiatan(nik, nama_kegiatan, durasi, negara, kota) VALUES (?,?,?,?,?)",
    array($nik,$nama_kegiatan,$durasi,$negara,$kota));
    echo "<script>alert('Data Berhasil Diinput'); window.location.replace('data-kegiatanop.php');</script>";
  }else{
    $h->exec("UPDATE data_kegiatan SET nik=?, nama_kegiatan=?, durasi=?, negara=?, kota=? WHERE id=?",
    array($nik,$nama_kegiatan,$durasi,$negara,$kota,$sid));
    echo "<script>alert('Data Berhasil Diupdate'); window.location.replace('data-kegiatanop.php');</script>";
  }

}
?>
<div class="page-inner">
    <div class="page-title">
        <h3>Input Data Kegiatan</h3>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li><a href="data-kegiatan.php" class="active">Data Kegiatan</a></li>
            </ol>
        </div>
    </div>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">Input Data Kegiatan </h4>
                    </div>
                    <div class="panel-body">
      <br>
        <form class="" action="" method="post">
          <label for="">NIK</label>
          <input type="text" name="nik" value="<?php echo $snik;?>" class="form-control" required=required list="daftar-kegiatan">
          <datalist class="" id="daftar-kegiatan">
            <?php foreach ($datakegiatan as $value): ?>
              <option value="<?php echo $value['nik'] ?>"><?php echo $value['nama'] ?></option>
            <?php endforeach; ?>
          </datalist>
          <label for="">Kegiatan</label>
          <input type="text" name="nama_kegiatan" value="<?php echo $snama_kegiatan;?>" class="form-control" autocomplete="off">
          <label for="">Durasi</label>
          <input type="text" name="durasi" value="<?php echo $sdurasi;?>" class="form-control" autocomplete="off">
          <label for="">Negara</label>
          <input type="text" name="negara" value="<?php echo $snegara;?>" class="form-control" autocomplete="off">
          <label for="">Kota</label>
          <input type="text" name="kota" value="<?php echo $skota;?>" class="form-control">
          <button type="submit" name="simpan" class="btn btn-outline-primary" style="margin-top:10px;">Simpan</button>
        </form>
      </div>
    </div>
      </div>
  </div>
</div>
</div>
<?php include 'footer.php'; ?>
