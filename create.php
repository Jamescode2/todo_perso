<?php
$mysqli = mysqli_connect("localhost","webclient","pass1234","todo");
if (isset($_GET["content"])) {

    $content = $_GET["content"];
    $important = false;
    $date = NULL;

    if (isset($_GET["important"])) $important = $_GET["important"];
    if (isset($_GET["date"])) $date = $_GET["date"];
    
    
    mysqli_query($mysqli,"INSERT INTO todolist VALUES (NULL,$content,$important,true,'',$date)");
    echo '{"lastId":'.mysqli_insert_id($mysqli).'}';
}
?>