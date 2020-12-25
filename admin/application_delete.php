<?php
if (isset($_GET['id']) && isset($_GET['link'])) {
    include("../db.php");
    $id = $_GET['id'];
    $sql = "UPDATE `application`
    SET `deleted` = true
    WHERE `id` = $id";

    $conn->query($sql);
    $msg = "Операция прошла успешно!";
    $link = $_GET['link'] . "?msg=$msg";
    header("Location: $link");
 
}
?>
