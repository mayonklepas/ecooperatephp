<?php
include 'navbar.php';
require 'helper/helper.php';
$h=new Helper();
$sid="";
$stanggal="";
$sid_status="";
$sstatus="";
$sketerangan="";
$id_kerjasama=$_GET['id_kerjasama'];
if(isset($_GET['id'])){
$sid=$_GET['id'];
$data=$h->read("SELECT tanggal,id_status,data_master_status.nama,keterangan FROM data_status_dn WHERE id=?",array($_GET['id']));
foreach ($data as $value) {
  $stanggal=$value['tanggal'];
  $sstatus=$value['nama'];
  $sid_status=$value['id_status'];
  $sketerangan=$_POST['keterangan'];
}
}

if(isset($_POST['simpan'])){
  $tanggal=$_POST['tanggal'];
  $status=$_POST['status'];
  $keterangan=$_POST['keterangan'];
  if($sid == ""){
    $h->exec("INSERT INTO data_status_dn(id_kerjasama, tanggal, id_status,keterangan) VALUES (?,?,?,?)",
    array($id_kerjasama,$tanggal,$status,$keterangan));
    echo "<script>alert('Data Berhasil Diinput'); window.location.replace('data-status-dn.php?id=".$id_kerjasama."');</script>";
  }else{
    $h->exec("UPDATE data_status_dn SET id_kerjasama=?, tanggal=?, status=?,keterangan=? WHERE id=?",
    array($id_kerjasama,$tanggal,$status,$keterangan,$sid ));
    echo "<script>alert('Data Berhasil Diupdate'); window.location.replace('data-status-dn.php?id=".$id_kerjasama."');</script>";
  }

}
$datastatus=$h->read("SELECT id,nama FROM data_master_status WHERE kategori='Kerjasama'",null);
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
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">Input Data Status Dalam Negeri</h4>
                    </div>
                    <div class="panel-body">
      <br>
        <form class="" action="" method="post">
          <label for="">Tanggal</label>
          <input type="date" name="tanggal" value="<?php echo $stanggal;?>" class="form-control" required=required autocomplete="off">
          <label for="">Status</label>
          <select class="form-control" name="status">
            <option value="<?php echo $sstatus ?>"><?php echo $sstatus ?></option>
            <?php foreach ($datastatus as $value): ?>
              <option value="<?php echo $value['id'] ?>"><?php echo $value['nama'] ?></option>
            <?php endforeach; ?>
          </select>
          <label for="">Keterangan</label>
          <input type="text" name="keterangan" value="<?php echo $sketerangan;?>" class="form-control" required=required autocomplete="off">
          <button type="submit" name="simpan" id="simpan" class="btn btn-outline-primary" style="margin-top:10px;" >Simpan</button>
        </form>
      </div>
    </div>
      </div>
  </div>
</div>
<?php include 'footer.php'; ?>
