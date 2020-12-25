<?php
session_start();
if (!isset($_SESSION['username'])) {
    $msg = "Войдите в аккаунт чтобы продолжить!";
    header("Location: login.php?msg=$msg");
}
?>
<header id="header" class="container mt-2">
    <h6>
    <a href="index.php" class="navbar-brand" title="На главную!">
        <?= $_SESSION['username'] ?>
    </a>
        <span class="float-right">
            <a href="new.php" title="Добавить объявление!"><i class="fas fa-plus-square"></i></a>
            <a href="application.php" title="Посмотреть заявки <?= $_SESSION['username'] ?>"><i class="fas fa-pen-square"></i></a>
            <a href="logout.php" title="Выйти с аккаунта <?= $_SESSION['username'] ?>"><i class="fas fa-sign-out-alt"></i></a>
        </span>
    </h6>
    <?php if (isset($_GET['msg'])): ?>
        <div class="toast" data-delay="15000" role="alert" aria-live="polite" aria-atomic="true" style="position: absolute; top: 10px; right: 14px;">
            <div class="toast-header">
                <strong class="mr-auto">DataBase</strong>
                <small>11 mins ago</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                <?= $_GET['msg']; ?>
            </div>
        </div>
    <?php endif; ?>
</header>
