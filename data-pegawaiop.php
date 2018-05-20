<?php
include 'navbar.php';
require 'helper/helper.php';
$h=new Helper();
$sid="";
$snip="";
$snama_pegawai="";
$snama_unker="";
$sid_unker="";
$sid_satker="";
$sjabatan="";
if(isset($_GET['id'])){
$data=$h->read("SELECT data_pegawai.id, nip, nama_pegawai, id_unker,data_unker.nama AS nama_unker,jabatan FROM data_pegawai
  INNER JOIN data_unker ON data_pegawai.id_unker=data_unker.id WHERE data_pegawai.id=?",array($_GET['id']));
foreach ($data as $value) {
  $sid=$value['id'];
  $snip=$value['nip'];
  $snama_pegawai=$value['nama_pegawai'];
  $snama_unker=$value['nama_unker'];
  $sid_unker=$value['id_unker'];
  $sjabatan=$value['jabatan'];
}
}

$dataunker=$h->read("SELECT id,nama FROM data_unker",null);

if(isset($_POST['simpan'])){
  $nip=$_POST['nip'];
  $nama_pegawai=$_POST['nama_pegawai'];
  $id_unker=$_POST['id_unker'];
  $jabatan=$_POST['jabatan'];
  if($sid == ""){
    $h->exec("INSERT INTO data_pegawai(nip, nama_pegawai,jabatan, id_unker) VALUES (?,?,?,?)",
    array($nip,$nama_pegawai,$jabatan,$id_unker));
    echo "<script>alert('Data Berhasil Diinput'); window.location.replace('data-pegawai.php');</script>";
  }else{
    $h->exec("UPDATE data_pegawai SET nip=?, nama_pegawai=?,jabatan=?, id_unker=? WHERE id=?",
    array($nip,$nama_pegawai,$jabatan,$id_unker,$sid));
    echo "<script>alert('Data Berhasil Diupdate'); window.location.replace('data-pegawai.php');</script>";
  }

}
?>

<div class="page-inner">
    <div class="page-breadcrumb">
        <ol class="breadcrumb container">
            <li><a href="index.php">Home</a></li>
            <li><a href="data-pemohon.php">Data Pegawai</a></li>
            <li class="active">Input Data Pemohon</li>
        </ol>
    </div>
    <div class="page-title">
        <div class="container">
            <h3>Data Pegawai</h3>
        </div>
    </div>
    <div id="main-wrapper" class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">Data Pegawai</h4>
                    </div>
                    <div class="panel-body">
      <br>
        <form class="" action="" method="post">
          <label for="">NIP</label>
          <input type="text" name="nip" value="<?php echo $snip;?>" class="form-control" autocomplete="off">
          <label for="">Nama</label>
          <input type="text" name="nama_pegawai" value="<?php echo $snama_pegawai;?>" class="form-control" autocomplete="off">
          <label for="">Jabatan</label>
          <input type="text" name="jabatan" value="<?php echo $sjabatan;?>" class="form-control" autocomplete="off">
          <label for="">Unit Kerja</label>
          <select class="form-control" name="id_unker">
            <option value="<?php echo $sid_unker ?>"><?php echo $snama_unker ?></option>
            <?php foreach ($dataunker as $value): ?>
              <option value="<?php echo $value['id'] ?>"><?php echo $value['nama'] ?></option>
            <?php endforeach; ?>
          </select>
          <button type="submit" name="simpan" id="simpan" class="btn btn-outline-primary" style="margin-top:10px;">Simpan</button>
        </form>
      </div>
    </div>
      </div>
  </div>
</div>
<?php include 'footer.php'; ?>
