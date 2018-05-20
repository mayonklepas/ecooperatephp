<?php
include 'navbar.php';
require 'helper/helper.php';
$h=new Helper();
$sid="";
$skategori="";
$snama="";
if(isset($_GET['id'])){
$sid=$_GET['id'];
$data=$h->read("SELECT id, kategori, nama FROM data_master_status WHERE id=?",array($_GET['id']));
foreach ($data as $value) {
  $sid=$value['id'];
  $skategori=$value['kategori'];
  $snama=$value['nama'];
}
}

if(isset($_POST['simpan'])){
  $nama=$_POST['nama'];
  if($sid == ""){
    $h->exec("INSERT INTO data_master_status(nama) VALUES (?)",
    array($kategori,$nama));
    echo "<script>alert('Data Berhasil Diinput'); window.location.replace('data-master-statusop.php');</script>";
  }else{
    $h->exec("UPDATE data_master_status SET nama=? WHERE id=?",
    array($nama,$sid));
    echo "<script>alert('Data Berhasil Diupdate'); window.location.replace('data-master-statusop.php');</script>";
  }

}
?>

<script type="text/javascript">
  $(document).ready(function () {
    $("#repassword").keyup(function(){
        var pas=$("#password").val();
        if($(this).val()==pas){
          $("#simpan").prop("disabled",false);
          $("#lrepas").html(" <b style='color:green'>Password Cocok<b>");
        }else{
          $("#simpan").prop("disabled",true);
          $("#lrepas").html(" <b style='color:red'>Password Tidak Cocok<b>");
        }
    });


  });
</script>

<div class="page-inner">
    <div class="page-breadcrumb">
        <ol class="breadcrumb container">
            <li><a href="index.php">Home</a></li>
            <li><a href="data-data_master_status.php">Data Master Status</a></li>
            <li class="active">Input Data Master Status</li>
        </ol>
    </div>
    <div class="page-title">
        <div class="container">
            <h3>Input Data Master Status</h3>
        </div>
    </div>
    <div id="main-wrapper" class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">Input Data Master Status</h4>
                    </div>
                    <div class="panel-body">
      <br>
        <form class="" action="" method="post">
          <label for="">Nama Status</label>
          <input type="text" name="nama" value="<?php echo $snama;?>" class="form-control" >
          <button type="submit" name="simpan" id="simpan" class="btn btn-primary" style="margin-top:10px;" >Simpan</button>
        </form>
      </div>
    </div>
      </div>
  </div>
</div>
<?php include 'footer.php'; ?>
