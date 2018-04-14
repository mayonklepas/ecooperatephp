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
    $qjumlahdata=$h->read("SELECT COUNT(id) AS jumlah FROM data_kerjasama_dn WHERE
    mitra LIKE ? OR
    judul LIKE ? OR
    keterangan LIKE ?",array($key,$key,$key));
    foreach ($qjumlahdata as $value) {
      $jumlahdata=$value['jumlah'];
    }
    $data=$h->read("SELECT data_kerjasama_dn.id,data_mitra.nama, bidang, judul, no_dokumen, jenis_perjanjian, ruang_lingkup, waktu_penanda_tangan, masa_berlaku, masa_berakhir, pic, jabatan_pic, satker, dokumen, keterangan FROM data_kerjasama_dn LEFT JOIN data_mitra ON data_kerjasama_dn.id_mitra=data_mitra.id WHERE
      mitra LIKE ? OR
      judul LIKE ? OR
      keterangan LIKE ? LIMIT ".$limit." OFFSET ".$offset." ",array($key,$key,$key));
    $notif="<div class='alert alert-success' style='margin-top:10px;'><h5>Hasil Pencarian : ".$_GET['key']."</h5></div>";
  }else{
    $qjumlahdata=$h->read("SELECT COUNT(id) AS jumlah FROM data_kerjasama_dn",null);
    foreach ($qjumlahdata as $value) {
      $jumlahdata=$value['jumlah'];
    }
      $data=$h->read("SELECT data_kerjasama_dn.id,data_mitra.nama, bidang, judul, no_dokumen, jenis_perjanjian, ruang_lingkup, waktu_penanda_tangan, masa_berlaku, masa_berakhir, pic, jabatan_pic, satker, dokumen, data_kerjasama_dn.keterangan FROM data_kerjasama_dn  LEFT JOIN data_mitra ON data_kerjasama_dn.id_mitra=data_mitra.id LIMIT ".$limit." OFFSET ".$offset." " ,null);
  }
}else{
  if (isset($_GET['key'])) {
    $key="%".$_GET['key']."%";
    $qjumlahdata=$h->read("SELECT COUNT(id) AS jumlah FROM data_kerjasama_dn WHERE
    mitra LIKE ? OR
    judul LIKE ? OR
    keterangan LIKE ?",array($key,$key,$key));
    foreach ($qjumlahdata as $value) {
      $jumlahdata=$value['jumlah'];
    }
    $data=$h->read("SELECT data_kerjasama_dn.id,data_mitra.nama, bidang, judul, no_dokumen, jenis_perjanjian, ruang_lingkup, waktu_penanda_tangan, masa_berlaku, masa_berakhir, pic, jabatan_pic, satker, dokumen, data_kerjasama_dn.keterangan FROM data_kerjasama_dn  LEFT JOIN data_mitra ON data_kerjasama_dn.id_mitra=data_mitra.id WHERE
      mitra LIKE ? OR
      judul LIKE ? OR
      keterangan LIKE ? LIMIT ".$limit." OFFSET ".$offset." ",array($key,$key,$key));
    $notif="<div class='alert alert-success' style='margin-top:10px;'><h5>Hasil Pencarian : ".$_GET['key']."</h5></div>";
  }else{
    $qjumlahdata=$h->read("SELECT COUNT(id) AS jumlah FROM data_kerjasama_dn",null);
    foreach ($qjumlahdata as $value) {
      $jumlahdata=$value['jumlah'];
    }
    $data=$h->read("SELECT data_kerjasama_dn.id,data_mitra.nama, bidang, judul, no_dokumen, jenis_perjanjian, ruang_lingkup, waktu_penanda_tangan, masa_berlaku, masa_berakhir, pic, jabatan_pic, satker, dokumen, data_kerjasama_dn.keterangan FROM data_kerjasama_dn  LEFT JOIN data_mitra ON data_kerjasama_dn.id_mitra=data_mitra.id LIMIT ".$limit." OFFSET ".$offset." ",null);
  }

}


$jumlahpage=ceil($jumlahdata / $limit);

?>

<script type="text/javascript">
  $(document).ready(function(){

    $(document).on("click",".hapus",function(){
      var table="data_kerjasama_dn";
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
            <li class="active">Data Kerjasama Dalam Negeri</li>
        </ol>
    </div>
    <div class="page-title">
        <div class="container">
            <h3>Data Kerjasama Dalam Negeri</h3>
        </div>
    </div>
    <div id="main-wrapper" class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">Data Kerjasama Dalam Negeri</h4>
                    </div>
                    <div class="panel-body">
                          <form class="" action="" method="POST">
                            <input type="text" name="key" value="" class="form-control" placeholder="Cari Data (Ketik dan Enter)">
                          </form>
      <a href="data-kerjasama-dalam-negeriop.php" class="btn btn-primary" style="margin-top:10px;">Tambah</a>
      <?php echo $notif ?>
          <table class="table table-bordered" style="margin-top:10px">
            <tr>
              <th>Mitra</th>
              <th>Bidang</th>
              <th>Judul</th>
            <!--  <th>No. Dokumen</th>
              <th>Jenis Perjanjian</th>
              <th>Ruang Lingkup</th>-->
              <th>Waktu TTD</th>
              <th>Berlaku</th>
              <th>Berakhir</th>
              <!--<th>PIC</th>
              <th>Jabatan PIC</th>
              <th>SATKER</th>-->
              <th>Dokumen</th>
              <th>Keterangan</th>
              <th>Operasi</th>
            </tr>
              <?php foreach ($data as $value): ?>
                <tr>
                <td><?php echo $value['nama'] ?></td>
                <td><?php echo $value['bidang'] ?></td>
                <td><?php echo $value['judul'] ?></td>
                <td><?php echo date("d F Y",strtotime($value['waktu_penanda_tangan'])) ?></td>
                <td><?php echo date("d F Y",strtotime($value['masa_berlaku'])) ?></td>
                <td><?php echo date("d F Y",strtotime($value['masa_berakhir'])) ?></td>
                <td>
                  <?php if ($value['dokumen']=="" || $value['dokumen']=="na"): ?>
                    <a href="uploadfilekerjasama.php?id=<?php echo $value['id'] ?>&kat=dalam" class="btn btn-primary">Upload</a>
                  <?php else: ?>
                    <a href="uploadfilekerjasama.php?id=<?php echo $value['id'] ?>&kat=dalam" class="btn btn-primary">Upload</a>
                    <a href="file/<?php echo $value['dokumen'] ?>" class="btn btn-success">Download</a>
                  <?php endif; ?>
                </td>
                <td><?php echo $value['keterangan'] ?></td>
                <td>
                  <a href="data-kerjasama-dalam-negeriop.php?id=<?php echo $value['id'] ?>" class="btn btn-warning">Edit</a>
                  <button type="button" name="hapus" class="btn btn-danger hapus" data-id="<?php echo $value['id'] ?>" data-file="">Hapus</button>
                  <a href="data-status-dn.php?id=<?php echo $value['id'] ?>" class="btn btn-warning">Cek Status</a>
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
              <li class="page-item <?php echo $status ?>"><a class="page-link" href="data-kerjasama-dalam-negeri.php?page=<?php echo $i ?>&key=<?php echo $_GET['key'] ?>"><?php echo $i+1; ?></a></li>
            <?php else: ?>
              <?php
                if ($posisi==$i) {
                  $status="active";
                }else{
                  $status="";
                }
              ?>
              <li class="page-item <?php echo $status ?>"><a class="page-link" href="data-kerjasama-dalam-negeri.php?page=<?php echo $i ?>"><?php echo $i+1; ?></a></li>
            <?php endif; ?>

          <?php endfor; ?>
        </ul>
      </nav>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>
