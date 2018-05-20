<?php
require '../helper/helper.php';
$h=new Helper();
if(isset($_POST['id'])){
    $table=$_POST['table'];
    $ref=$_POST['ref'];
    $id=$_POST['id'];
    $field=$_POST['field'];
    $val=$_POST['val'];
    $h->exec("UPDATE ".$table." SET ".$field."=? WHERE ".$ref."=? ",array($val,$id));
    $h->exec("INSERT INTO data_status_permohonan(id_permohonan,id_status) VALUES(?,?) ",array($id,1));
    echo "Data berhasil diupdate";
}
?>
