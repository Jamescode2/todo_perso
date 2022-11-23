<?php

$mysqli=mysqli_connect("localhost","webclient","pass1234","todo");

if (isset($_GET["field"],$_GET["id"],$_GET["newValue"])) {

    $field=$_GET["field"];
    $id=$_GET["id"];
    $newValue=$_GET["newValue"];


    $sql="UPDATE todolist SET $field=\"$newValue\" WHERE id=$id";

    mysqli_query($mysqli,$sql);

    echo '{"updated":true}';

}

?>
