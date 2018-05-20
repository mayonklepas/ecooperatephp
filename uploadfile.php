<?php
require_once 'helper/helper.php';
include_once 'navbar.php';
$h=new Helper();
$sid=$_GET['id'];
$kat=$_GET['kat'];
$stanggal="";
$snip="";
$snama="";
$snopasport="";
$snama_kegiatan="";
$sdurasi="";
$sid_negara="";
$snama_negara="";
$skota="";
$fieldkat="";
$headerkat="";
$namafiledidb="";
if($kat=="undangan"){
  $fieldkat="surat_undangan";
  $headerkat="SURAT UNDANGAN";
}elseif ($kat=="deputi") {
  $fieldkat="surat_deputi";
  $headerkat="SURAT DEPUTI";
}elseif ($kat=="persetujuan") {
  $fieldkat="surat_persetujuan";
  $headerkat="SURAT PERSETUJUAN";
}else {
  $fieldkat="pas_foto";
  $headerkat="Foto";
}
if(isset($_GET['id'])){
  $id=$_GET['id'];
  $datafile=$h->read("  SELECT data_permohonan.id, tanggal,data_permohonan.nip,data_pegawai.nama_pegawai,no_passport,
    nama_kegiatan,durasi,id_negara,data_negara.nama AS nama_negara,kota,".$fieldkat." FROM data_permohonan
    INNER JOIN data_pegawai ON data_permohonan.nip=data_pegawai.nip
    INNER JOIN data_negara ON data_permohonan.id_negara=data_negara.id WHERE data_permohonan.id=?",array($id));
  foreach ($datafile as $value) {
    $sid=$value['id'];
    $stanggal=$value['tanggal'];
    $snip=$value['nip'];
    $snama=$value['nama_pegawai'];
    $snopasport=$value['no_passport'];
    $snama_kegiatan=$value['nama_kegiatan'];
    $sdurasi=$value['durasi'];
    $sid_negara=$value['id_negara'];
    $sid_negara=$value['id_negara'];
    $snama_negara=$value['nama_negara'];
    $skota=$value['kota'];
    $namafiledidb=$value[$fieldkat];
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
  $namabarufile=$sid."-".$snip."-".$snama."-".$snama_kegiatan."-".$kat."-".date("dmyhis").".".$ext;
  if($size <= 3000000){
    if($namafiledidb=="" || $namafiledidb=="na" || $namafiledidb=="none"){

  }else {
        unlink("file/".$namafiledidb);
  }

    try {
      move_uploaded_file($tmp_file,"file/".$namabarufile);
        $h->exec("UPDATE data_permohonan SET ".$fieldkat."=? WHERE id=? ",array($namabarufile,$id));
        $notif="<div class='alert alert-success'><b>Data Berhasil Disimpan</b>
         <a href='data-permohonan.php' style='color:red;'> <i class='pe-7s-back'></i> Kembali ke Data </a></div>";
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
    <div class="page-breadcrumb">
        <ol class="breadcrumb container">
            <li><a href="index.php">Home</a></li>
          <li><a href="data-permohonan.php?" class="active">Data Kegiatan</a></li>
          <li class="active"> Upload File Kegiatan</li>
        </ol>
    </div>
    <div class="page-title">
        <div class="container">
            <h3>Upload File Kegiatan</h3>
        </div>
    </div>
    <div id="main-wrapper" class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">Upload File Kegiatan</h4>
                    </div>
                    <div class="panel-body">
                      <?php echo $notif ?>
                      <div class="alert alert-warning">
                        Nama File : <?php echo $namafiledidb ?>
                        <?php if ($namafiledidb == "" || $namafiledidb =="na" || $namafiledidb =="NULL" ): ?>

                        <?php else :?>
                           <a href="file/<?php echo $namafiledidb ?>" class="">Download</a>
                        <?php endif; ?>
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
