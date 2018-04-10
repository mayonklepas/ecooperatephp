<?php
require_once 'helper/helper.php';
include_once 'navbar.php';
$h=new Helper();
$sid=$_GET['id'];
$kat=$_GET['kat'];
$sjudul="";
$sdokumen="";
if(isset($_GET['id'])){
  $id=$_GET['id'];
  $datafile=$h->read("SELECT judul,dokumen FROM data_kerjasama_dn WHERE id=?",array($id));
  foreach ($datafile as $value) {
    $sjudul=$value['judul'];
    $sdokumen=$value['dokumen'];
  }
}
$notif="";
if(isset($_POST['simpan'])){
  $namafile=$_FILES['file']['name'];
  $filetipe=$_FILES['file']['type'];
  $tmp_file=$_FILES['file']['tmp_name'];
  $size=filesize($tmp_file);
  $rawext=explode(".",$namafile);
  $ext=end($rawext);
  $namabarufile=$sid."-".$sjudul."-".date("dmyhis").".".$ext;
  if($size <= 3000000){
    if($sdokumen=="" || $sdokumen=="na" || $sdokumen=="none"){

  }else {
        unlink("file/".$sdokumen);
  }

    try {
      move_uploaded_file($tmp_file,"file/".$namabarufile);
        $h->exec("UPDATE data_kerjasama_dn SET dokumen=? WHERE id=? ",array($namabarufile,$id));
        $notif="<div class='alert alert-success'><b>Data Berhasil Disimpan</b>
         <a href='data-kerjasama-dalam-negeri.php' style='color:red;'> <i class='pe-7s-back'></i> Kembali ke Data </a></div>";
    } catch (Exception $e) {
      echo $e->getMessage();
    }

  }else{
    $notif="<div class='alert alert-danger'>Upload gagal, pastikan tipe file adalah pdf,rtf,word,xls dan ukuran lebih kecil dari 300kb</div>";
  }
}


?>

<script type="text/javascript">
  $(document).ready(function(){
    $(".aksi").submit(function(event){
      $(".simpan").html("<i class='fa fa-spinner'></i> Sedang Menyimpan");
      $(this).submit();
      event.preventDefault();
    });
    $(".alert").click(function(){
      //$(this).text("Sedang Menyimpan...");
      $(this).hide();
    });
  });
</script>


<div class="page-inner">
    <div class="page-title">
        <h3>Upload Dokumen</h3>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li><a href="data-kegiatan.php" class="active">Data Kegiatan</a></li>
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
                      <?php echo $notif ?>
                      <div class="alert alert-warning">
                        Nama File : <?php echo $sdokumen ?>
                      </div>
                      <form class="aksi" action="" method="post" enctype="multipart/form-data">
                        <?php if ($kat=="foto"): ?>
                          <label for="">Pas Foto (JPG/JPEG/PNG)</label>
                        <?php else: ?>
                            <label for="">File Data (DOC/XLS/PDF)</label>
                        <?php endif; ?>
                        <input type="file" name="file" value="" class="form-control" required>
                        <br>
                        <button type="submit" name="simpan" class="btn btn-primary simpan"> <i class="pe-7s-diskette"></i> Simpan</button>
                      </form>
                    </div>

                      </ul>

                    </div>
                </div>
            </div>


        </div>
    </div>

<?php include 'footer.php';?>
