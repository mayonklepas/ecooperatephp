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
  $tanggal=$_POST['tanggal'];
  $status=$_POST['status'];
  if($sid == ""){
    $h->exec("INSERT INTO data_status(id_kegiatan, tanggal, id_status) VALUES (?,?,?)",
    array($id_kegiatan,$tanggal,$status));
    echo "<script>alert('Data Berhasil Diinput'); window.location.replace('data-status-kegiatan.php?id=".$id_kegiatan."');</script>";
  }else{
    $h->exec("UPDATE data_status SET id_kegiatan=?, tanggal=?, id_status=? WHERE id=?",
    array($id_kegiatan,$tanggal,$status,$sid ));
    echo "<script>alert('Data Berhasil Diupdate'); window.location.replace('data-status-kegiatan.php?id=".$id_kegiatan."');</script>";
  }

}

$datastatus=$h->read("SELECT id,nama FROM data_master_status WHERE kategori='Kegiatan'",null);
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
    <div class="page-title">
        <h3>Input Data Status Kegiatan</h3>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li><a href="data-status-kegiatan.php?id=<?php echo $id_kegiatan?>" class="active">Data Status Kegiatan</a></li>
            </ol>
        </div>
    </div>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">Input Data Kerjasama Dalam Negeri </h4>
                    </div>
                    <div class="panel-body">
      <br>
        <form class="" action="" method="post">
          <label for="">Tanggal</label>
          <input type="date" name="tanggal" value="<?php echo $stanggal;?>" class="form-control" required=required autocomplete="off">
          <label for="">Status</label>
          <select class="form-control" name="status">
            <option value="<?php echo $sid_status ?>"><?php echo $sstatus ?></option>
            <?php foreach ($datastatus as $value): ?>
              <option value="<?php echo $value['id'] ?>"><?php echo $value['nama'] ?></option>
            <?php endforeach; ?>
          </select>
          <button type="submit" name="simpan" id="simpan" class="btn btn-outline-primary" style="margin-top:10px;" >Simpan</button>
        </form>
      </div>
    </div>
      </div>
  </div>
</div>
<?php include 'footer.php'; ?>
