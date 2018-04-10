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
    echo "Data berhasil diupdate";
}
?>
