<?php

include "db.php";
if (isset($_GET['bid'])) {
    $id = $_GET['bid'];
    $sql = $conn->prepare("delete from books where bid = ?");
    $sql->bind_param("i", $id);
    if ($sql->execute()) {
        header("Location: home.php");
        exit();
    } 
}

?>