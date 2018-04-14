<?php
include 'navbar.php';
require 'helper/helper.php';
$h=new Helper();
$notif="";
$limit=50;
$offset=0;
$jumlahdata=0;
$posisi=0;
if (isset($_GET['page'])) {
  $offset=$_GET['page']*$limit;
  $posisi=$_GET['page'];
  if (isset($_GET['key'])) {
    $key="%".$_GET['key']."%";
    $qjumlahdata=$h->read("SELECT COUNT(id) AS jumlah FROM data_kegiatan WHERE
    nama_kegiatan LIKE ? OR
    negara LIKE ? OR
    kota LIKE ?",array($key,$key,$key));
    foreach ($qjumlahdata as $value) {
      $jumlahdata=$value['jumlah'];
    }
    $data=$h->read("SELECT id, data_kegiatan.nik,data_pemohon.nama, nama_kegiatan, durasi, negara, kota, surat_undangan, surat_deputi, surat_persetujuan, pas_foto,status,(SELECT nama FROM data_status INNER JOIN data_master_status ON data_status.id_status=data_master_status.id WHERE id_kegiatan=data_kegiatan.id ORDER BY data_master_status.id DESC LIMIT 1 ) AS status_akhir FROM data_kegiatan
      INNER JOIN data_pemohon ON data_kegiatan.nik=data_pemohon.nik WHERE
    nama_kegiatan LIKE ? OR
    negara LIKE ? OR
    kota LIKE ? LIMIT ".$limit." OFFSET ".$offset." ",array($key,$key,$key));
    $notif="<div class='alert alert-success' style='margin-top:10px;'><h5>Hasil Pencarian : ".$_GET['key']."</h5></div>";
  }else{
    $qjumlahdata=$h->read("SELECT COUNT(id) AS jumlah FROM data_kegiatan",null);
    foreach ($qjumlahdata as $value) {
      $jumlahdata=$value['jumlah'];
    }
      $data=$h->read("SELECT id, data_kegiatan.nik,data_pemohon.nama, nama_kegiatan, durasi, negara, kota, surat_undangan, surat_deputi, surat_persetujuan, pas_foto,status,(SELECT nama FROM data_status INNER JOIN data_master_status ON data_status.id_status=data_master_status.id WHERE id_kegiatan=data_kegiatan.id ORDER BY data_master_status.id DESC LIMIT 1 ) AS status_akhir FROM data_kegiatan
        INNER JOIN data_pemohon ON data_kegiatan.nik=data_pemohon.nik LIMIT ".$limit." OFFSET ".$offset." " ,null);
  }
}else{
  if (isset($_GET['key'])) {
    $key="%".$_GET['key']."%";
    $qjumlahdata=$h->read("SELECT COUNT(id) AS jumlah FROM data_kegiatan WHERE
    nama_kegiatan LIKE ? OR
    negara LIKE ? OR
    kota LIKE ?",array($key,$key,$key));
    foreach ($qjumlahdata as $value) {
      $jumlahdata=$value['jumlah'];
    }
    $data=$h->read("SELECT id, data_kegiatan.nik,data_pemohon.nama, nama_kegiatan, durasi, negara, kota, surat_undangan, surat_deputi, surat_persetujuan, pas_foto,status,(SELECT nama FROM data_status INNER JOIN data_master_status ON data_status.id_status=data_master_status.id WHERE id_kegiatan=data_kegiatan.id ORDER BY data_master_status.id DESC LIMIT 1 ) AS status_akhir FROM data_kegiatan
      INNER JOIN data_pemohon ON data_kegiatan.nik=data_pemohon.nik WHERE
    nama_kegiatan LIKE ? OR
    negara LIKE ? OR
    kota LIKE ? LIMIT ".$limit." OFFSET ".$offset." ",array($key,$key,$key));
    $notif="<div class='alert alert-success' style='margin-top:10px;'><h5>Hasil Pencarian : ".$_GET['key']."</h5></div>";
  }else{
    $qjumlahdata=$h->read("SELECT COUNT(id) AS jumlah FROM data_kegiatan",null);
    foreach ($qjumlahdata as $value) {
      $jumlahdata=$value['jumlah'];
    }
    $data=$h->read("SELECT id, data_kegiatan.nik,data_pemohon.nama, nama_kegiatan, durasi, negara, kota, surat_undangan, surat_deputi, surat_persetujuan, pas_foto,status,(SELECT nama FROM data_status INNER JOIN data_master_status ON data_status.id_status=data_master_status.id WHERE id_kegiatan=data_kegiatan.id ORDER BY data_master_status.id DESC LIMIT 1 ) AS status_akhir FROM data_kegiatan
      INNER JOIN data_pemohon ON data_kegiatan.nik=data_pemohon.nik LIMIT ".$limit." OFFSET ".$offset." ",null);
  }

}



$jumlahpage=ceil($jumlahdata / $limit);

?>

<script type="text/javascript">
  $(document).ready(function(){

    $(document).on("click",".hapus",function(){
      var table="data_kegiatan";
      var ref="id";
      var id=$(this).data("id");
      var file=$(this).data("file");
        var cf=confirm("Yakin ingin menghapus data ini ?");
        if(cf==true){
            $.ajax({
              url:"operasi/hapus.php",
              method:"POST",
              dataType:"HTML",
              data:{table:table,ref:ref,id:id,file:file},
              cache:false
            }).done(function(data){
              alert(data);
              location.reload();
            });
        }
    });

    $(document).on("click",".aprove",function(){
      var table="data_kegiatan";
      var ref="id";
      var id=$(this).data("id");
      var field=$(this).data("field");
      var val=1;
        var cf=confirm("Yakin ingin menerima pengajuan ini ?");
        if(cf==true){
            $.ajax({
              url:"operasi/update.php",
              method:"POST",
              dataType:"HTML",
              data:{table:table,ref:ref,id:id,field:field,val:val},
              cache:false
            }).done(function(data){
              alert(data);
              location.reload();
            });
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
                      <form class="" action="" method="POST">
                        <input type="text" name="key" value="" class="form-control" placeholder="Cari Data (Ketik dan Enter)">
                      </form>
      <a href="data-kegiatanop.php" class="btn btn-primary" style="margin-top:10px;">Tambah</a>
      <?php echo $notif ?>
          <table class="table table-bordered" style="margin-top:10px">
            <tr>
              <th>NIK</th>
              <th>Nama</th>
              <th>Kegiatan</th>
              <th>Durasi</th>
              <th>Negara</th>
              <th>Kota</th>
              <th>Dokumen</th>
              <th>Status</th>
              <th>Operasi</th>
            </tr>
              <?php foreach ($data as $value): ?>
                <tr>
                <td><?php echo $value['nik'] ?></td>
                <td><?php echo $value['nama'] ?></td>
                <td><?php echo $value['nama_kegiatan'] ?></td>
                <td><?php echo $value['durasi'] ?></td>
                <td><?php echo $value['negara'] ?></td>
                <td><?php echo $value['kota'] ?></td>
                <td>
                  <li class="dropdown" style="list-style-type: none;">
                    <button type="button" name="button" class=" btn dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown">Dokumen</button>
                      <ul class="dropdown-menu dropdown-list" role="menu">
                          <li role="presentation"><a href="uploadfile.php?id=<?php echo $value['id'] ?>&kat=undangan" class="dropdown-item">Undangan</a></li>
                          <li role="presentation"><a href="uploadfile.php?id=<?php echo $value['id'] ?>&kat=deputi" class="dropdown-item">Deputi</a></li>
                          <li role="presentation"><a href="uploadfile.php?id=<?php echo $value['id'] ?>&kat=persetujuan" class="dropdown-item">Persetujuan</a></li>
                          <li role="presentation"><a href="uploadfile.php?id=<?php echo $value['id'] ?>&kat=foto" class="dropdown-item">Foto</a></li>
                      </ul>
                  </li>
                </td>
                <td><?php echo $value['status_akhir'] ?></td>
                <td>
                  <a href="data-kegiatanop.php?id=<?php echo $value['id'] ?>" class="btn btn-warning">Edit</a>
                  <button type="button" name="hapus" class="btn btn-danger hapus" data-id="<?php echo $value['id'] ?>" data-file="">Hapus</button>
                  <?php if ($value['status']==1): ?>
                    <a href="data-status-kegiatan.php?id=<?php echo $value['id'] ?>" class="btn btn-info">Cek Status</a>
                  <?php else: ?>
                    <button type="button" name="aprove" class="btn btn-default aprove" data-id="<?php echo $value['id'] ?>" data-field="status">Pending</button>
                  <?php endif; ?>

                </td>
              </tr>
              <?php endforeach; ?>
      </table>
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <?php for ($i=0;$i < $jumlahpage ; $i++ ): ?>
            <?php if (isset($_GET['key'])): ?>
              <?php
                if ($posisi==$i) {
                  $status="active";
                }else{
                  $status="";
                }
              ?>
              <li class="page-item <?php echo $status ?>"><a class="page-link" href="data-kegiatan.php?page=<?php echo $i ?>&key=<?php echo $_GET['key'] ?>"><?php echo $i+1; ?></a></li>
            <?php else: ?>
              <?php
                if ($posisi==$i) {
                  $status="active";
                }else{
                  $status="";
                }
              ?>
              <li class="page-item <?php echo $status ?>"><a class="page-link" href="data-kegiatan.php?page=<?php echo $i ?>"><?php echo $i+1; ?></a></li>
            <?php endif; ?>

          <?php endfor; ?>
        </ul>
      </nav>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>
