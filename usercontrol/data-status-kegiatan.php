<?php
include 'navbar.php';
require '../helper/helper.php';
$h=new Helper();
$id=$_GET['id'];
$data=$h->read("SELECT data_status.id,tanggal,data_master_status.nama FROM data_status LEFT JOIN data_master_status ON data_status.id_status=data_master_status.id WHERE id_kegiatan=?",array($id));
?>
<script type="text/javascript">
  $(document).ready(function(){

    $(document).on("click",".hapus",function(){
      var table="data_status";
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

<div class="container-fluid" style="margin-top:20px;">
  <div class="card">
    <div class="card-body">
      <h5 class="card-tittle"> Data Status Kegiatan </h5>
      <form class="" action="" method="GET">
        <input type="text" name="key" value="" class="form-control" placeholder="Cari Data (Ketik dan Enter)">
      </form>
      <a href="data-status-kegiatanop.php?id_kegiatan=<?php echo $id ?>" class="btn btn-outline-primary" style="margin-top:10px;">Tambah</a>
          <table class="table table-bordered" style="margin-top:10px">
            <tr>
              <th>Tanggal</th>
              <th>Status</th>
              <th>Operasi</th>
            </tr>
              <?php foreach ($data as $value): ?>
                <tr>
                <td><?php echo date("d F Y",strtotime($value['tanggal'])) ?></td>
                <td><?php echo $value['nama'] ?></td>
                <td>
                  <a href="data-status-kegiatanop.php?id=<?php echo $value['id'] ?>&id_kegiatan=<?php echo $id ?>" class="btn btn-outline-warning">Edit</a>
                  <button type="button" name="hapus" class="btn btn-outline-danger hapus" data-id="<?php echo $value['id'] ?>" data-file="">Hapus</button>
                </td>
              </tr>
              <?php endforeach; ?>
      </table>
    </div>
  </div>
</div>
</body>
</html>
