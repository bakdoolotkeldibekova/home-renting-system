<?php
    include("../db.php");
    session_start();

    if (isset($_SESSION['username'])) {
        header("Location: index.php");
        exit;
    }

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $_SESSION['username'] = $username;
            header("Location: index.php");
        } else {
            $error = "Неверный логин или пароль!";
        }
    }

    // if (isset($_SESSION['username'])) {
    //     $username = $_SESSION['username'];
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>

    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <h6>Авторизация</h6>
                <?= isset($_GET['msg']) ? '<p class="text-danger">'.$_GET['msg'].'</p>' : "" ?>
                <?= '<p class="text-danger">'.$error.'</p>' ?>
                <form action="login.php" method="post">
                    <div class="form-group">
                        <input type="text" name="username" placeholder="Имя пользователя" value="<?= isset($_POST['username']) ? $_POST['username'] : '' ?>" class="form-control form-control-sm" id="username" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Пароль" value="<?= isset($_POST['password']) ? $_POST['password'] : '' ?>" class="form-control form-control-sm" id="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm btn-block" name="submit">Войти</button>

                </form>
            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <?php $conn->close(); ?>
</body>
</html>
