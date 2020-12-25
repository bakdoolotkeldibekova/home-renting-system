<?php include("db.php"); ?>
<?php include("check.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- head -->
    <?php include("head.php"); ?>
</head>
<body>

    <!-- navbar -->
    <?php include("nav.php"); ?>

    <!-- item info -->
    <main class="container">
        <div class="row">
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM house WHERE id = $id";
                $result = $conn->query($sql);
                $house = $result->fetch_assoc();
            } else {
                echo "Id required!";
            }
            ?>
            <div class="col-lg-4">
                <?php
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM `image` WHERE `house` = $id";
                    $res = $conn->query($sql);
                    $images = $res->fetch_all(MYSQLI_ASSOC);
                }
                ?>
                <div id="images_carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#images_carousel" data-slide-to="0" class="active"></li>
                        <?php for ($i=1; $i <= $res->num_rows; $i++) : ?>
                            <li data-target="#images_carousel" data-slide-to="<?= $i ?>"></li>
                        <?php endfor; ?>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="<?= $house['image'] ?>" alt="First slide">
                        </div>
                        <?php foreach ($images as $img) : ?>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="<?= $img['image'] ?>" alt="Other slide">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <a class="carousel-control-prev" href="#images_carousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#images_carousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-lg-8">
                <h3 class="text-justify mt-3 mb-3 mt-lg-0 mt-xl-0"><?= $house['title'] ?></h3>
                <h6 class="text-justify mt-3 mb-3 mt-lg-0 mt-xl-0"><?= $house['description'] ?></h6>
                <div class="row">
                    <div class="col-lg-6 mb-2">
                        <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#shop" name="button">Арендовать</button>
                    </div>
                    <div class="col-lg-6 mb-2">
                        <button type="button" id="like_button" class="btn btn-outline-secondary btn-block" onclick="like_bag(<?= $_GET['id'] ?>)" name="button"><?= check_for_like($_GET['id']) ? 'Удалить из избранных' : 'В избранное' ?></button>
                    </div>
                           
                </div>
                <?php
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM `house` WHERE `id` = $id";
                    $result = $conn->query($sql);
                    $houses = $result->fetch_all(MYSQLI_ASSOC);     
                } else {
                    echo "Нет дополнительной информации!";
                }
                ?>
                <table class="table table-sm table-hover">
                    <tbody>
                        <?php foreach ($houses as $house) : ?>
                            <tr>
                                <td>Цена</td>
                                <td><?= $house['price']?> сом</td>
                            </tr>
                            <tr>
                                <td>Площадь земельного участка</td>
                                <td><?= $house['land_area'] ?></td>
                            </tr>
                            <tr>
                                <td>Период аренды</td>
                                <td><?php 
                                 $num = $house['rental_period_id'];
                                 $sql1 = "SELECT * FROM `rental_period` WHERE `id` = $num";
                                 $result1 = $conn->query($sql1);
                                
                                 if ($result1->num_rows > 0) {
                                    while($row = $result1->fetch_assoc()) {
                                  echo $row["name"];}} 
                                  ?></td>
                            </tr>
                            <tr>
                                <td>Состояние</td>
                                <td><?php 
                                 $num = $house['state_id'];
                                 $sql1 = "SELECT * FROM `state` WHERE `id` = $num";
                                 $result1 = $conn->query($sql1);
                                
                                 if ($result1->num_rows > 0) {
                                    while($row = $result1->fetch_assoc()) {
                                  echo $row["state_name"];}} 
                                  ?></td>
                            </tr>
                            <tr>
                                <td>Количество этажей</td>
                                <td><?= $house['number_of_floors']?></td>
                            </tr>
                            <tr>
                                <td>Количество комнат</td>
                                <td><?= $house['number_of_rooms']?></td>
                            </tr>
                            <tr>
                                <td>Регион</td>
                                <td><?php 
                                 $num = $house['region_id'];
                                 $sql1 = "SELECT * FROM `region` WHERE `id` = $num";
                                 $result1 = $conn->query($sql1);
                                
                                 if ($result1->num_rows > 0) {
                                    while($row = $result1->fetch_assoc()) {
                                  echo $row["region_name"];}} 
                                  ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div class="modal fade" id="shop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Арендовать</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <?php 
                        if (isset($_POST['submit'])) {
                            $phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';
                            $name_surname = isset($_POST['name_surname']) ? $_POST['name_surname'] : '';
                            $desc = isset($_POST['desc']) ? $_POST['desc'] : '';
                            $date = date("Y-m-d H:i:s");
                            $house_id = $house['id'];
                            
                            $sql = "INSERT INTO `application` (`house_id`, `phone_number`, `name_surname`, `descrioption`, `date`, `deleted`) 
                                    VALUES ('$house_id', '$phone_number', '$name_surname', '$desc', '$date', FALSE)";
                            if ($conn->query($sql) === TRUE) {
                                echo '<p class="text-success">Заявка отправлена!</p>';
                                header("Location: index.php");
                            } else {
                                echo '<p class="text-danger">Попробуйте снова! Укажите правильные данные.</p>';
                            }
                        }
                    ?>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="phone">Номер телефона</label>
                            <input type="tel" id="phone" placeholder="+996-000-000-000" class="form-control" name="phone_number" value="<?= isset($_GET['phone_number']) && $_GET['phone_number'] != '' ? $_GET['phone_number'] : '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="name">Имя и фамилия</label>
                            <input type="text" id="name" placeholder="Алим Алимов" class="form-control" name="name_surname" value="<?= isset($_GET['name_surname']) && $_GET['name_surname'] != '' ? $_GET['name_surname'] : '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="comment">Комментарий к заказу</label>
                            <textarea id="comment"rows="3" class="form-control" placeholder="Дополнительная информация к заказу..." name="desc" value="<?= isset($_GET['desc']) && $_GET['desc'] != '' ? $_GET['desc'] : '' ?>"></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Готово</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- bootstrap -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <!-- own script -->
    <script src="js/script.js" charset="utf-8"></script>
</body>
</html>
