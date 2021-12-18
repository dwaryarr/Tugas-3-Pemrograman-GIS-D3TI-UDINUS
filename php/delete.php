<?php
include "koneksipgsql.php";
$id = $_GET["id"];
$sql = "DELETE from hotel where id='$id'";
//echo $sql;
$hasil = pg_query($conn, $sql);
pg_close($conn);
header("location:tabledata.php");
