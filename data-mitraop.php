<?php
include 'navbar.php';
require 'helper/helper.php';
$h=new Helper();
$sid="";
$snama="";
$sketerangan="";
if(isset($_GET['id'])){
$data=$h->read("SELECT nama, keterangan FROM data_mitra WHERE nik=?",array($_GET['nik']));
foreach ($data as $value) {
  $snama=$value['nama'];
  $sketerangan=$value['keterangan'];
}
}

if(isset($_POST['simpan'])){
  $nama=$_POST['nama'];
  $keterangan=$_POST['keterangan'];
  if($sid == ""){
    $h->exec("INSERT INTO data_mitra(nama,keterangan) VALUES (?,?)",
    array($nama,$keterangan));
    echo "<script>alert('Data Berhasil Diinput'); window.location.replace('data-mitraop.php');</script>";
  }else{
    $h->exec("UPDATE data_mitra SET nama=?, keterangan=? WHERE id=?",
    array($nama,$keterangan));
    echo "<script>alert('Data Berhasil Diupdate'); window.location.replace('data-mitraop.php');</script>";
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
            <li class="active">Data Kegiatan</li>
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
          <label for="">Nama</label>
          <input type="text" name="nama" value="<?php echo $snama;?>" class="form-control" required=required autocomplete="off">
          <label for="">Keterangan</label>
          <input type="text" name="keterangan" value="<?php echo $sketerangan;?>" class="form-control" autocomplete="off">
          <button type="submit" name="simpan" id="simpan" class="btn btn-outline-primary" style="margin-top:10px;" >Simpan</button>
        </form>
      </div>
    </div>
      </div>
  </div>
</div>
<?php include 'footer.php'; ?>
