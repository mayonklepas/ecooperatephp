<?php
include 'navbar.php';
require 'helper/helper.php';
$h=new Helper();
$sid="";
$stanggal="";
$sstatus="";
$sid_status="";
$id_kegiatan=$_GET['id_kegiatan'];
if(isset($_GET['id'])){
$sid=$_GET['id'];
$data=$h->read("SELECT id_kegiatan,tanggal,id_status,data_master_status.nama FROM data_status LEFT JOIN data_master_status ON data_status.id_status=data_master_status.id WHERE data_status.id=?",array($_GET['id']));
foreach ($data as $value) {
  $stanggal=$value['tanggal'];
  $sstatus=$value['nama'];
  $sid_status=$value['id_status'];
}
}

if(isset($_POST['simpan'])){
  $status=$_POST['status'];
  if($sid == ""){
    $h->exec("INSERT INTO data_status_permohonan(id_permohonan, id_status) VALUES (?,?)",
    array($id_kegiatan,$status));
    echo "<script>alert('Data Berhasil Diinput'); window.location.replace('data-status-permohonan.php?id=".$id_kegiatan."');</script>";
  }else{
    $h->exec("UPDATE data_status_permohonan SET id_permohonan=?, id_status=? WHERE id=?",
    array($id_kegiatan,$status,$sid ));
    echo "<script>alert('Data Berhasil Diupdate'); window.location.replace('data-status-permohonan.php?id=".$id_kegiatan."');</script>";
  }

}

$datastatus=$h->read("SELECT id,nama FROM data_master_status WHERE kategori='1'",null);
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
          <li><a href="data-status-permohonan.php?id=<?php echo $id_kegiatan?>" class="active">Data Status Kegiatan</a></li>
          <li class="active">Input Data Status Kegiatan</li>
        </ol>
    </div>
    <div class="page-title">
        <div class="container">
            <h3>Input Data Status Kegiatan</h3>
        </div>
    </div>
    <div id="main-wrapper" class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">Input Data Status Kegiatan</h4>
                    </div>
                    <div class="panel-body">
      <br>
        <form class="" action="" method="post">
          <label for="">Status</label>
          <select class="form-control" name="status">
            <option value="<?php echo $sid_status ?>"><?php echo $sstatus ?></option>
            <?php foreach ($datastatus as $value): ?>
              <option value="<?php echo $value['id'] ?>"><?php echo $value['nama'] ?></option>
            <?php endforeach; ?>
          </select>
          <button type="submit" name="simpan" id="simpan" class="btn btn-primary" style="margin-top:10px;" >Simpan</button>
        </form>
      </div>
    </div>
      </div>
  </div>
</div>
<?php include 'footer.php'; ?>
