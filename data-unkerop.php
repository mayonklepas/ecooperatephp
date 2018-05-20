<?php
include 'navbar.php';
require 'helper/helper.php';
$h=new Helper();
$sid="";
$snama="";
$sid_satker="";
$snama_satker="";
if(isset($_GET['id'])){
$data=$h->read("SELECT data_unker.id, data_unker.nama, id_satker,data_satker.nama AS nama_satker FROM data_unker
  INNER JOIN data_satker ON data_unker.id_satker=data_satker.id WHERE data_unker.id=?",array($_GET['id']));
foreach ($data as $value) {
  $sid=$value['id'];
  $snama=$value['nama'];
  $sid_satker=$value['id_satker'];
  $snama_satker=$value['nama_satker'];
}
}
$datasatker=$h->read("SELECT id,nama FROM data_satker",null);
if(isset($_POST['simpan'])){
  $nama=$_POST['nama'];
  $id_satker=$_POST['id_satker'];
  if($sid == ""){
    $h->exec("INSERT INTO data_unker(nama,id_satker) VALUES (?,?)",
    array($nama,$id_satker));
    echo "<script>alert('Data Berhasil Diinput'); window.location.replace('data-unker.php');</script>";
  }else{
    $h->exec("UPDATE data_unker SET nama=?, id_satker=? WHERE id=?",
    array($nama,$id_satker,$sid));
    echo "<script>alert('Data Berhasil Diupdate'); window.location.replace('data-unker.php');</script>";
  }

}
?>


<div class="page-inner">
    <div class="page-breadcrumb">
        <ol class="breadcrumb container">
            <li><a href="index.php">Home</a></li>
            <li><a href="data-satker.php">Data Unker</a></li>
            <li class="active">Input Data Unker</li>
        </ol>
    </div>
    <div class="page-title">
        <div class="container">
            <h3>Input Data Unker</h3>
        </div>
    </div>
    <div id="main-wrapper" class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">Input Data Unker</h4>
                    </div>
                    <div class="panel-body">
      <br>
        <form class="" action="" method="post">
          <label for="">Nama</label>
          <input type="text" name="nama" value="<?php echo $snama;?>" class="form-control" required=required autocomplete="off">
          <label for="">Satuan Kerja</label>
          <select class="form-control" name="id_satker">
            <option value="<?php echo $sid_satker ?>"><?php echo $snama_satker ?></option>
            <?php foreach ($datasatker as $value): ?>
              <option value="<?php echo $value['id'] ?>"><?php echo $value['nama'] ?></option>
            <?php endforeach; ?>
          </select>
          <button type="submit" name="simpan" id="simpan" class="btn btn-primary" style="margin-top:10px;">Simpan</button>
        </form>
      </div>
    </div>
      </div>
  </div>
</div>
<?php include 'footer.php'; ?>
