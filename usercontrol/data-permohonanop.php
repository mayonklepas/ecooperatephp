<?php
include 'navbar.php';
require '../helper/helper.php';
$h=new Helper();
$sid="";
$stanggal="";
$snip="";
$snama="";
$snopasport="";
$snama_kegiatan="";
$sdurasi="";
$sid_negara="";
$snama_negara="";
$skota="";
$ssurat_undangan="";
$ssurat_deputi="";
$ssurat_persetujuan="";
$spas_foto="";
$datapegawai=$h->read("SELECT nip,nama_pegawai FROM data_pegawai ORDER BY nip ASC",null);
$datanegara=$h->read("SELECT id,nama FROM data_negara ORDER BY id ASC",null);
if(isset($_GET['id'])){
  $sid=$_GET['id'];
  $data=$h->read("SELECT data_permohonan.id, tanggal,data_permohonan.nip,data_pegawai.nama_pegawai,no_passport,
  nama_kegiatan,durasi,id_negara,data_negara.nama AS nama_negara,kota,surat_undangan,surat_deputi,
  surat_persetujuan,pas_foto,status,status_terima FROM data_permohonan
  INNER JOIN data_pegawai ON data_permohonan.nip=data_pegawai.nip
  INNER JOIN data_negara ON data_permohonan.id_negara=data_negara.id WHERE data_permohonan.id=?",array($_GET['id']));
foreach ($data as $value) {
    $sid=$value['id'];
    $stanggal=$value['tanggal'];
    $snip=$value['nip'];
    $snama=$value['nama_pegawai'];
    $snopasport=$value['no_passport'];
    $snama_kegiatan=$value['nama_kegiatan'];
    $sdurasi=$value['durasi'];
    $sid_negara=$value['id_negara'];
    $sid_negara=$value['id_negara'];
    $snama_negara=$value['nama_negara'];
    $skota=$value['kota'];
    $ssurat_undangan=$value['surat_undangan'];
    $ssurat_deputi=$value['surat_deputi'];
    $ssurat_persetujuan=$value['surat_persetujuan'];
    $spas_foto=$value['pas_foto'];
}
}

if(isset($_POST['simpan'])){
  $nip=$_SESSION['nip'];
  $nopasport=$_POST['no_passport'];
  $nama_kegiatan=$_POST['nama_kegiatan'];
  $durasi=$_POST['durasi'];
  $id_negara=$_POST['id_negara'];
  $kota=$_POST['kota'];
  if($sid == ""){
    $h->exec("INSERT INTO data_permohonan(nip, no_passport, nama_kegiatan, durasi, id_negara, kota)
    VALUES (?,?,?,?,?,?)",array($nip,$nopasport,$nama_kegiatan,$durasi,$id_negara,$kota));
    echo "<script>alert('Data Berhasil Diinput'); window.location.replace('index.php');</script>";
  }else{
    $h->exec("UPDATE data_permohonan SET nip=?, no_passport=?, nama_kegiatan=?, durasi=?, id_negara=?, kota=? WHERE id=?",
    array($nip,$nopasport,$nama_kegiatan,$durasi,$id_negara,$kota,$sid));
    echo "<script>alert('Data Berhasil Diupdate'); window.location.replace('index.php');</script>";
  }

}
?>
<div class="page-inner">
    <div class="page-breadcrumb">
        <ol class="breadcrumb container">
            <li><a href="index.php">Home</a></li>
            <li class="active">Input Data Permohonan Perjalanan Luar Negeri</li>
        </ol>
    </div>
    <div class="page-title">
        <div class="container">
            <h3>Input Data Permohonan Perjalanan Luar Negeri</h3>
        </div>
    </div>
    <div id="main-wrapper" class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">Input Data Permohonan Perjalanan Luar Negeri</h4>
                    </div>
                    <div class="panel-body">
      <br>
        <form class="" action="" method="post">
          <label for="">No Passport</label>
          <input type="text" name="no_passport" value="<?php echo $snopasport;?>" class="form-control" autocomplete="off">
          <label for="">Kegiatan</label>
          <input type="text" name="nama_kegiatan" value="<?php echo $snama_kegiatan;?>" class="form-control" autocomplete="off">
          <label for="">Durasi</label>
          <input type="number" name="durasi" value="<?php echo $sdurasi;?>" class="form-control" autocomplete="off">
          <label for="">Negara</label>
          <input type="text" name="id_negara" value="<?php echo $sid_negara;?>" class="form-control" required=required list="daftar-negara" autocomplete="off">
          <datalist class="" id="daftar-negara">
            <?php foreach ($datanegara as $value): ?>
              <option value="<?php echo $value['id'] ?>"><?php echo $value['nama'] ?></option>
            <?php endforeach; ?>
          </datalist>
          <label for="">Kota</label>
          <input type="text" name="kota" value="<?php echo $skota;?>" class="form-control">
          <button type="submit" name="simpan" class="btn btn-primary" style="margin-top:10px;">Simpan</button>
        </form>
      </div>
    </div>
      </div>
  </div>
</div>
</div>
<?php include 'footer.php'; ?>
