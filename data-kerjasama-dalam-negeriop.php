<?php
include 'navbar.php';
require 'helper/helper.php';
$h=new Helper();
$sid="";
$smitra="";
$sid_mitra="";
$sbidang="";
$sjudul="";
$sno_dokumen="";
$sjenis_perjanjian="";
$sruang_lingkup="";
$swaktu_penanda_tangan="";
$smasa_berlaku="";
$smasa_berakhir="";
$spic="";
$sjabatan_pic="";
$ssatker="";
$sdokumen="";
$sketerangan="";
if(isset($_GET['id'])){
$data=$h->read("SELECT data_kerjasama_dn.id,data_mitra.id as id_mitra,data_mitra.nama, bidang, judul, no_dokumen, jenis_perjanjian, ruang_lingkup, waktu_penanda_tangan, masa_berlaku, masa_berakhir, pic, jabatan_pic, satker, data_kerjasama_dn.keterangan FROM data_kerjasama_dn LEFT JOIN data_mitra ON data_kerjasama_dn.id_mitra=data_mitra.id WHERE data_kerjasama_dn.id=?",array($_GET['id']));
foreach ($data as $value) {
  $sid=$value['id'];
  $smitra=$value['nama'];
  $sid_mitra=$value['id_mitra'];
  $sbidang=$value['bidang'];
  $sjudul=$value['judul'];
  $sno_dokumen=$value['no_dokumen'];
  $sjenis_perjanjian=$value['jenis_perjanjian'];
  $sruang_lingkup=$value['ruang_lingkup'];
  $swaktu_penanda_tangan=$value['waktu_penanda_tangan'];
  $smasa_berlaku=$value['masa_berlaku'];
  $smasa_berakhir=$value['masa_berakhir'];
  $spic=$value['pic'];
  $sjabatan_pic=$value['jabatan_pic'];
  $ssatker=$value['satker'];
  $sketerangan=$value['keterangan'];
}
}

if(isset($_POST['simpan'])){
  $id_mitra=$_POST['id_mitra'];
  $bidang=$_POST['bidang'];
  $judul=$_POST['judul'];
  $no_dokumen=$_POST['no_dokumen'];
  $jenis_perjanjian=$_POST['jenis_perjanjian'];
  $ruang_lingkup=$_POST['ruang_lingkup'];
  $waktu_penanda_tangan=$_POST['waktu_penanda_tangan'];
  $masa_berlaku=$_POST['masa_berlaku'];
  $masa_berakhir=$_POST['masa_berakhir'];
  $pic=$_POST['pic'];
  $jabatan_pic=$_POST['jabatan_pic'];
  $satker=$_POST['satker'];
  $keterangan=$_POST['keterangan'];
  if($sid == ""){
    $h->exec("INSERT INTO data_kerjasama_dn(id_mitra, bidang, judul, no_dokumen, jenis_perjanjian, ruang_lingkup, waktu_penanda_tangan, masa_berlaku, masa_berakhir, pic, jabatan_pic, satker, keterangan) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)",
    array($id_mitra, $bidang, $judul, $no_dokumen, $jenis_perjanjian, $ruang_lingkup, $waktu_penanda_tangan, $masa_berlaku, $masa_berakhir, $pic, $jabatan_pic, $satker, $keterangan));
    echo "<script>alert('Data Berhasil Diinput'); window.location.replace('data-kerjasama-dalam-negeriop.php');</script>";
  }else{
    $h->exec("UPDATE data_kerjasama_dn SET id_mitra=?, bidang=?, judul=?, no_dokumen=?, jenis_perjanjian=?, ruang_lingkup=?, waktu_penanda_tangan=?, masa_berlaku=?, masa_berakhir=?, pic=?, jabatan_pic=?, satker=?, keterangan=? WHERE id=?",
    array($id_mitra, $bidang, $judul, $no_dokumen, $jenis_perjanjian, $ruang_lingkup, $waktu_penanda_tangan, $masa_berlaku, $masa_berakhir, $pic, $jabatan_pic, $satker,$keterangan,$sid));
    echo "<script>alert('Data Berhasil Diupdate'); window.location.replace('data-kerjasama-dalam-negeriop.php');</script>";
  }

}

$datamitra=$h->read("SELECT id,nama FROM data_mitra ORDER BY nama ASC",null);

?>
<div class="page-inner">
    <div class="page-breadcrumb">
        <ol class="breadcrumb container">
            <li><a href="index.php">Home</a></li>
            <li class="active">Input Data Kerjasama Dalam Negeri</li>
        </ol>
    </div>
    <div class="page-title">
        <div class="container">
            <h3>Data Kegiatan</h3>
        </div>
    </div>
    <div id="main-wrapper" class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">Data Kegiatan</h4>
                    </div>
                    <div class="panel-body">
      <br>
        <form class="" action="" method="post">
          <label for="">Mitra</label>
          <select class="form-control" data-live-search="true" name="id_mitra">
            <option value="<?php echo $sid_mitra ?>"><?php echo $smitra ?></option>
            <?php foreach ($datamitra as $value): ?>
                <option value="<?php echo $value['id'] ?>" data-tokens="<?php echo $value['nama'] ?>"><?php echo $value['nama'] ?></option>
            <?php endforeach; ?>
          </select>
          <label for="">Judul</label>
          <input type="text" name="judul" value="<?php echo $sjudul;?>" class="form-control" autocomplete="off">
          <label for="">Bidang</label>
          <input type="text" name="bidang" value="<?php echo $sbidang;?>" class="form-control" autocomplete="off">
          <label for="">No. Dokumen</label>
          <input type="text" name="no_dokumen" value="<?php echo $sno_dokumen;?>" class="form-control" autocomplete="off">
          <label for="">Jenis Perjanjian</label>
          <input type="text" name="jenis_perjanjian" value="<?php echo $sjenis_perjanjian;?>" class="form-control" autocomplete="off">
          <label for="">Ruang Lingkup</label>
          <input type="text" name="ruang_lingkup" value="<?php echo $sruang_lingkup;?>" class="form-control">
          <label for="">Waktu Tanda Tangan</label>
          <input type="date" name="waktu_penanda_tangan" value="<?php echo $swaktu_penanda_tangan;?>" class="form-control">
          <label for="">Masa Berlaku</label>
          <input type="date" name="masa_berlaku" value="<?php echo $smasa_berlaku;?>" class="form-control">
          <label for="">Masa Berakhir</label>
          <input type="date" name="masa_berakhir" value="<?php echo $smasa_berakhir;?>" class="form-control">
          <label for="">PIC</label>
          <input type="text" name="pic" value="<?php echo $spic;?>" class="form-control">
          <label for="">Jabatan PIC</label>
          <input type="text" name="jabatan_pic" value="<?php echo $sjabatan_pic;?>" class="form-control">
          <label for="">Satker</label>
          <input type="text" name="satker" value="<?php echo $ssatker;?>" class="form-control">
          <label for="">Keterangan</label>
          <input type="text" name="keterangan" value="<?php echo $sketerangan;?>" class="form-control">
          <button type="submit" name="simpan" class="btn btn-outline-primary" style="margin-top:10px;">Simpan</button>
        </form>
      </div>
    </div>
      </div>
  </div>
</div>
<?php include 'footer.php'; ?>
