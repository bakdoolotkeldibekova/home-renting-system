<?php
session_start();
session_destroy();
$msg = "Вы вышли с аккаунта!";
header("Location: login.php?msg=$msg");
exit;
?>
