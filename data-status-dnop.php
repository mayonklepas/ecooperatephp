<?php
include 'navbar.php';
require 'helper/helper.php';
$h=new Helper();
$sid="";
$sid_kerjasama=$_GET['id_kerjasama'];
$stanggal="";
$snama_status="";
if(isset($_GET['id'])){
$sid=$_GET['id'];
$data=$h->read("SELECT tanggal,nama_status FROM data_status_kerjasama_dn WHERE id=?",array($_GET['id']));
foreach ($data as $value) {
  $stanggal=$value['tanggal'];
  $snama_status=$value['nama_status'];
}
}

if(isset($_POST['simpan'])){
  $nama_status=$_POST['nama_status'];
  if($sid == ""){
    $h->exec("INSERT INTO data_status_kerjasama_dn(id_kerjasama, nama_status) VALUES (?,?)",
    array($sid_kerjasama,$nama_status));
    echo "<script>alert('Data Berhasil Diinput'); window.location.replace('data-status-dn.php?id=".$sid_kerjasama."');</script>";
  }else{
    $h->exec("UPDATE data_status_kerjasama_dn SET nama_status=? WHERE id=?",
    array($nama_status,$sid ));
    echo "<script>alert('Data Berhasil Diupdate'); window.location.replace('data-status-dn.php?id=".$sid_kerjasama."');</script>";
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
            <li><a href="index.php"></a>Home</li>
            <li><a href="data-status-dn.phpid=<?php echo $id_kerjasama?>">Data Status Dalam Negeri</a></li>
            <li class="active">Input Data Status Dalam Negeri</li>
        </ol>
    </div>
    <div class="page-title">
        <div class="container">
            <h3>Input Data Status Dalam Negeri</h3>
        </div>
    </div>
    <div id="main-wrapper" class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">Input Data Status Dalam Negeri</h4>
                    </div>
                    <div class="panel-body">
      <br>
        <form class="" action="" method="post">
          <label for="">Status</label>
          <input type="text" name="nama_status" value="<?php echo $snama_status;?>" class="form-control" required=required autocomplete="off">
          <button type="submit" name="simpan" id="simpan" class="btn btn-outline-primary" style="margin-top:10px;" >Simpan</button>
        </form>
      </div>
    </div>
      </div>
  </div>
</div>
<?php include 'footer.php'; ?>
