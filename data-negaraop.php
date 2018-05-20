<?php
include 'navbar.php';
require 'helper/helper.php';
$h=new Helper();
$snama="";
$sstatus_visa="";
$sid="";
if(isset($_GET['id'])){
$data=$h->read("SELECT id, nama,status_visa FROM data_negara WHERE id=?",array($_GET['id']));
foreach ($data as $value) {
  $sid=$value['id'];
  $snama=$value['nama'];
  $sstatus_visa=$value['status_visa'];
}
}

if(isset($_POST['simpan'])){
  $nama=$_POST['nama'];
  $status_visa=$_POST['status_visa'];
  if($sid == ""){
    $h->exec("INSERT INTO data_negara(nama,status_visa) VALUES (?,?)",
    array($nama,$status_visa));
    echo "<script>alert('Data Berhasil Diinput'); window.location.replace('data-negara.php');</script>";
  }else{
    $h->exec("UPDATE data_negara SET nama=?, status_visa=?WHERE id=?",
    array($nama,$status_visa,$sid));
    echo "<script>alert('Data Berhasil Diupdate'); window.location.replace('data-negara.php');</script>";
  }

}
?>


<div class="page-inner">
    <div class="page-breadcrumb">
        <ol class="breadcrumb container">
            <li><a href="index.php">Home</a></li>
            <li><a href="data-negara.php">Data Negara</a></li>
            <li class="active">Input Data Negara</li>
        </ol>
    </div>
    <div class="page-title">
        <div class="container">
            <h3>Input Data Negara</h3>
        </div>
    </div>
    <div id="main-wrapper" class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">Input Data Negara</h4>
                    </div>
                    <div class="panel-body">
      <br>
        <form class="" action="" method="post">
          <label for="">Nama</label>
          <input type="text" name="nama" value="<?php echo $snama;?>" class="form-control" required=required autocomplete="off">
          <label for="">Status Visa</label>
          <select class="form-control" name="status_visa">
            <option value="<?php echo $sstatus_visa ?>"><?php echo $sstatus_visa ?></option>
            <option value="Ada"> Ada</option>
            <option value="Tidak"> Tidak</option>
          </select>
          <button type="submit" name="simpan" id="simpan" class="btn btn-primary" style="margin-top:10px;">Simpan</button>
        </form>
      </div>
    </div>
      </div>
  </div>
</div>
<?php include 'footer.php'; ?>
