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
    $qjumlahdata=$h->read("SELECT COUNT(id) AS jumlah FROM data_mitra WHERE
    nama LIKE ? OR
    keterangan LIKE ?",array($key,$key));
    foreach ($qjumlahdata as $value) {
      $jumlahdata=$value['jumlah'];
    }
    $data=$h->read("SELECT id,nama,keterangan FROM data_mitra WHERE
    nama LIKE ? OR
    keterangan LIKE ?
    LIMIT ".$limit." OFFSET ".$offset." ",array($key,$key));
    $notif="<div class='alert alert-success' style='margin-top:10px;'><h5>Hasil Pencarian : ".$_GET['key']."</h5></div>";
  }else{
    $qjumlahdata=$h->read("SELECT COUNT(id) AS jumlah FROM data_mitra",null);
    foreach ($qjumlahdata as $value) {
      $jumlahdata=$value['jumlah'];
    }
      $data=$h->read("SELECT id,nama,keterangan FROM data_mitra LIMIT ".$limit." OFFSET ".$offset." " ,null);
  }
}else{
  if (isset($_GET['key'])) {
    $key="%".$_GET['key']."%";
    $qjumlahdata=$h->read("SELECT COUNT(id) AS jumlah FROM data_mitra WHERE
    nama LIKE ? OR
    keterangan LIKE ?",array($key,$key));
    foreach ($qjumlahdata as $value) {
      $jumlahdata=$value['jumlah'];
    }
    $data=$h->read("SELECT id,nama,keterangan FROM data_mitra WHERE
      nama LIKE ? OR
      keterangan LIKE ?
      LIMIT ".$limit." OFFSET ".$offset." ",array($key,$key));
    $notif="<div class='alert alert-success' style='margin-top:10px;'><h5>Hasil Pencarian : ".$_GET['key']."</h5></div>";
  }else{
    $qjumlahdata=$h->read("SELECT COUNT(id) AS jumlah FROM data_mitra",null);
    foreach ($qjumlahdata as $value) {
      $jumlahdata=$value['jumlah'];
    }
    $data=$h->read("SELECT id,nama,keterangan FROM data_mitra LIMIT ".$limit." OFFSET ".$offset." ",null);
  }

}



$jumlahpage=ceil($jumlahdata / $limit);

?>

<script type="text/javascript">
  $(document).ready(function(){

    $(document).on("click",".hapus",function(){
      var table="data_mitra";
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
  });
</script>

<div class="page-inner">
    <div class="page-title">
        <h3>Dasboard</h3>
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li class="active">Dasboard</li>
            </ol>
        </div>
    </div>
    <div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">Data </h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                          <form class="" action="" method="POST">
                            <input type="text" name="key" value="" class="form-control" placeholder="Cari Data (Ketik dan Enter)">
                          </form>
      <a href="data-mitraop.php" class="btn btn-outline-primary" style="margin-top:10px;">Tambah</a>
      <?php echo $notif ?>
          <table class="table table-bordered" style="margin-top:10px">
            <tr>
              <th>Nama</th>
              <th>Keterangan</th>
              <th>Operasi</th>
            </tr>
              <?php foreach ($data as $value): ?>
                <tr>
                <td><?php echo $value['nama'] ?></td>
                <td><?php echo $value['keterangan'] ?></td>
                <td>
                  <a href="data-mitraop.php?id=<?php echo $value['id'] ?>" class="btn btn-outline-warning">Edit</a>
                  <button type="button" name="hapus" class="btn btn-outline-danger hapus" data-id="<?php echo $value['id'] ?>" data-file="">Hapus</button>
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
              <li class="page-item <?php echo $status ?>"><a class="page-link" href="data-mitra.php?page=<?php echo $i ?>&key=<?php echo $_GET['key'] ?>"><?php echo $i+1; ?></a></li>
            <?php else: ?>
              <?php
                if ($posisi==$i) {
                  $status="active";
                }else{
                  $status="";
                }
              ?>
              <li class="page-item <?php echo $status ?>"><a class="page-link" href="data-mitra.php?page=<?php echo $i ?>"><?php echo $i+1; ?></a></li>
            <?php endif; ?>

          <?php endfor; ?>
        </ul>
      </nav>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>