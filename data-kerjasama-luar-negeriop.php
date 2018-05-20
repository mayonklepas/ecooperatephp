<?php
include 'navbar.php';
require 'helper/helper.php';
$h=new Helper();
$sid="";
$sjudul="";
$sbidang="";
$sidkategori="";
$skategori="";
$sidnegara="";
$snegara="";
$stanggal_ttd_mulai="";
$stanggal_ttd_akhir="";
$spic="";
$sketerangan="";
$scheck_keterangan="";
if(isset($_GET['id'])){
$data=$h->read("SELECT data_kerjasama_ln.id, judul, bidang,kategori,data_kategori_kerjasama_ln.nama AS nama_kategori,negara, data_negara.nama AS nama_negara,tanggal_ttd_mulai,tanggal_ttd_akhir, pic,data_kerjasama_ln.keterangan,check_keterangan FROM data_kerjasama_ln INNER JOIN data_kategori_kerjasama_ln ON data_kerjasama_ln.kategori=data_kategori_kerjasama_ln.id INNER JOIN data_negara ON data_kerjasama_ln.negara=data_negara.id WHERE data_kerjasama_ln.id=?",array($_GET['id']));
foreach ($data as $value) {
  $sid=$value['id'];
  $sjudul=$value['judul'];
  $sbidang=$value['bidang'];
  $sidkategori=$value['kategori'];
  $skategori=$value['nama_kategori'];
  $sidnegara=$value['negara'];
  $snegara=$value['nama_negara'];
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
    echo "<script>alert('Data Berhasil Diinput'); window.location.replace('data-kerjasama-luar-negeri.php');</script>";
  }else{
    $h->exec("UPDATE data_kerjasama_ln SET judul=?, bidang=?, kategori=?, negara=?,tanggal_ttd_mulai=?,tanggal_ttd_akhir=?,
       pic=?,keterangan=?,check_keterangan=? WHERE id=?",
    array($judul, $bidang, $kategori, $negara,$tanggal_ttd_mulai,$tanggal_ttd_akhir, $pic,$keterangan,$check_keterangan,$sid));
    echo "<script>alert('Data Berhasil Diupdate'); window.location.replace('data-kerjasama-luar-negeri.php');</script>";
  }

}

$datanegara=$h->read("SELECT id,nama FROM data_negara",null);
$datakategori=$h->read("SELECT id,nama FROM data_kategori_kerjasama_ln",null);
?>
<div class="page-inner">
    <div class="page-breadcrumb">
        <ol class="breadcrumb container">
            <li><a href="index.php">Home</a></li>
            <li><a href="data-kerjasama-luar-negeri.php">Data Kerjasama Luar Negeri</a></li>
            <li class="active">Input Data Kerjasama Luar Negeri</li>
        </ol>
    </div>
    <div class="page-title">
        <div class="container">
            <h3>Input Data Kerjasama Luar Negeri</h3>
        </div>
    </div>
    <div id="main-wrapper" class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">Input Data Kerjasama Luar Negeri</h4>
                    </div>
                    <div class="panel-body">
      <br>
        <form class="" action="" method="post">
          <label for="">Judul</label>
          <input type="text" name="judul" value="<?php echo $sjudul;?>" class="form-control" required=required list="daftar-kegiatan">
          <label for="">Bidang</label>
          <input type="text" name="bidang" value="<?php echo $sbidang;?>" class="form-control" autocomplete="off">
          <label for="">Kategori</label>
          <select class="form-control" data-live-search="true" name="kategori">
            <option value="<?php echo $sidkategori ?>"><?php echo $skategori ?></option>
            <?php foreach ($datakategori as $value): ?>
                <option value="<?php echo $value['id'] ?>" data-tokens="<?php echo $value['nama'] ?>"><?php echo $value['nama'] ?></option>
            <?php endforeach; ?>
          </select>
          <label for="">Negara</label>
          <select class="form-control" data-live-search="true" name="negara">
            <option value="<?php echo $sidnegara ?>"><?php echo $snegara ?></option>
            <?php foreach ($datanegara as $value): ?>
                <option value="<?php echo $value['id'] ?>" data-tokens="<?php echo $value['nama'] ?>"><?php echo $value['nama'] ?></option>
            <?php endforeach; ?>
          </select>
          <label for="">Tanggal TTD Mulai</label>
          <input type="date" name="tanggal_ttd_mulai" value="<?php echo $stanggal_ttd_mulai;?>" class="form-control">
          <label for="">Tanggal TTD AKhir</label>
          <input type="date" name="tanggal_ttd_akhir" value="<?php echo $stanggal_ttd_akhir;?>" class="form-control">
          <label for="">PIC</label>
          <input type="text" name="pic" value="<?php echo $spic;?>" class="form-control" autocomplete="off">
          <label for="">Keterangan</label>
          <input type="text" name="keterangan" value="<?php echo $sketerangan;?>" class="form-control" autocomplete="off">
          <label for="">Checklist Keterangan</label>
          <select class="form-control" name="check_keterangan">
            <option value="<?php echo $scheck_keterangan;?>"><?php echo $scheck_keterangan;?></option>
            <option value="Pengembangan SDM">Pengembangan SDM</option>
            <option value="Penelitian dan Pengembangan">Penelitian dan Pengembangan</option>
            <option value="Infrastruktur">Infrastruktur</option>
            <option value="Promosi di Dunia International">Promosi di Dunia International</option>
            <option value="Komitmen Anggaran">Komitmen Anggaran</option>
            <option value="Transfer of Technology">Transfer of Technology</option>
          </select>
          <button type="submit" name="simpan" class="btn btn-primary" style="margin-top:10px;">Simpan</button>
        </form>
      </div>
    </div>
      </div>
  </div>
</div>
<?php include 'footer.php'; ?>
