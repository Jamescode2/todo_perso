<?php
$mysqli = mysqli_connect("localhost","webclient","pass1234","todo");
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    if(mysqli_query($mysqli,"DELETE FROM todolist WHERE id=$id")){
        echo '{"detected":true}';
    }
}
?>