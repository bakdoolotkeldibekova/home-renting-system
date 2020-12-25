<?php
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    if ($_COOKIE['l_'.$id]) {
        setcookie('l_'.$id, $id, time() + 1);
        echo "0";
    } else {
        setcookie('l_'.$id, $id);
        echo "1";
    }
}
?>
