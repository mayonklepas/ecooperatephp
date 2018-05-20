<?php
include 'navbar.php';
require 'helper/helper.php';
$h=new Helper();
$id=$_GET['id'];
$data=$h->read("SELECT id,tanggal,nama_status FROM data_status_kerjasama_dn WHERE id_kerjasama=?",array($id));
?>
<script type="text/javascript">
  $(document).ready(function(){

    $(document).on("click",".hapus",function(){
      var table="data_status_kerjasama_dn";
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
    <div class="page-breadcrumb">
        <ol class="breadcrumb container">
            <li><a href="index.php">Home</a></li>
            <li><a href="data-kerjasama-dalam-negeri.php">Data Kerjasama Dalam Negeri</a></li>
            <li class="active">Data Status Dalam Negeri</li>
        </ol>
    </div>
    <div class="page-title">
        <div class="container">
            <h3>Data Status Kerjasama Dalam Negeri</h3>
        </div>
    </div>
    <div id="main-wrapper" class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">Data Status Kerjasama Dalam Negeri</h4>
                    </div>
                    <div class="panel-body">
                          <form class="" action="" method="POST">
                            <input type="text" name="key" value="" class="form-control" placeholder="Cari Data (Ketik dan Enter)">
                          </form>
      <a href="data-status-dnop.php?id_kerjasama=<?php echo $id ?>" class="btn btn-primary" style="margin-top:10px;">Tambah</a>
          <table class="table table-bordered" style="margin-top:10px">
            <tr>
              <th>Tanggal</th>
              <th>Status</th>
              <th>Operasi</th>
            </tr>
              <?php foreach ($data as $value): ?>
                <tr>
                <td><?php echo date("d F Y",strtotime($value['tanggal'])) ?></td>
                <td><?php echo $value['nama_status'] ?></td>
                <td>
                  <a href="data-status-dnop.php?id=<?php echo $value['id'] ?>&id_kerjasama=<?php echo $id ?>" class="btn btn-warning">Edit</a>
                  <button type="button" name="hapus" class="btn btn-danger hapus" data-id="<?php echo $value['id'] ?>" data-file="">Hapus</button>
                </td>
              </tr>
              <?php endforeach; ?>
      </table>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>
