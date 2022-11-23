<?php
$mysqli = mysqli_connect("localhost","webclient","pass1234","todo");
$result = mysqli_query($mysqli,"SELECT * FROM todolist");
$all= mysqli_fetch_all($result,MYSQLI_ASSOC);
echo json_encode($all);
?>