<?php
include 'navbar.php';
require '../helper/helper.php';
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
<div class="container-fluid" style="margin-top:20px;margin-bottom:20px;">
<div class="row justify-content-center">
<div class="col-lg-8">
  <div class="card">
    <div class="card-body">
      <h5 class="card-tittle">Input Data Kegiatan</h5>
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
</body>
</html>
