<?php
require '../helper/helper.php';
$h=new Helper();
if(isset($_POST['id'])){
    $table=$_POST['table'];
    $ref=$_POST['ref'];
    $id=$_POST['id'];
    $file=$_POST['file'];
    if($file!="" || !$file!="na"){
      unlink("file/".$file);
    }
    $h->exec("DELETE FROM ".$table." WHERE ".$ref."=? ",array($id));
    echo "Data berhasil dihapus";
}
?>
