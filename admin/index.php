<?php include("../db.php"); ?>
<?php
session_start();
if (!isset($_SESSION['username'])) {
    $msg = "Войдите в аккаунт чтобы продолжить!";
    header("Location: login.php?msg=$msg");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Kulim+Park&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php include("header.php"); ?>

    <h3 style="text-align: center;">Объявления</h3>

    <main class="container">
        <?php
        $sql = "SELECT * FROM house";
        $result = $conn->query($sql);
        $houses = $result->fetch_all(MYSQLI_ASSOC);
        ?>
        <table class="table table-borderless table-hover table-sm table-responsive-sm">
            <thead class="thead-light">
                <tr>
                    <th>id</th>
                    <th>title</th>
                    <th>date</th>
                    <th>price</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($houses as $house) : ?>
                    <tr>
                        <td><?= $house['id'] ?></td>
                        <td>
                            <a href="info.php?id=<?= $house['id'] ?>" class="text-secondary" data-toggle="popover" data-img="<?= $house['image'] ?>">
                                <?= $house['title'] ?>
                            </a>
                        </td>
                        <td><?= $house['date'] ?></td>
                        <td><?= get_price($house['id']) ?></td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#delete_modal_<?= $house['id'] ?>" class="text-danger">
                                <i class="far fa-trash-alt" aria-hidden="true"></i>
                            </a>
                        </td>
                        <div class="modal" id="delete_modal_<?= $house['id'] ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6>Удалить сумку?</h6>
                                        <button class="close" type="button" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <?= $house['title'] ?>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="delete.php?link=index.php&id=<?= $house['id'] ?>" class="btn btn-danger">Удалить</a>
                                        <button type="button" class="btn btn-secondary" name="button" data-dismiss="modal">Отмена</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="popover"]').popover({
            //trigger: 'focus',
                trigger: 'hover',
                html: true,
                content: function () {
                return '<img class="img-fluid" src="'+$(this).data('img') + '" />';
                }
            })
        });
        $('.toast').toast('show');
    </script>
    <?php $conn->close(); ?>
</body>
</html>
