<?php include("../db.php"); ?>
<?php
session_start();
if (!isset($_SESSION['username'])) {
    $msg = "Войдите в аккаунт чтобы продолжить!";
    header("Location: new.php?msg=$msg");
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
    <style type="text/css">
  table {
         width: 80%;
         margin-left: auto;
         margin-right: auto;
       }
    th, td {
    border: 1px solid black;
    height: 25px;
    }
    input{
        width:100%;
    }
  </style>
</head>
<body>

    <?php include("header.php"); ?>

    <?php 
    if (isset($_POST['submit'])) {
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $number_of_floors = isset($_POST['number_of_floors']) ? $_POST['number_of_floors'] : '';
        $number_of_rooms = isset($_POST['number_of_rooms']) ? $_POST['number_of_rooms'] : '';
        $land_area = isset($_POST['land_area']) ? $_POST['land_area'] : '';
        $price = isset($_POST['price']) ? $_POST['price'] : '';
        $state = isset($_POST['state']) ? $_POST['state'] : '';
        $rental_period = isset($_POST['rental_period']) ? $_POST['rental_period'] : '';
        $region = isset($_POST['region']) ? $_POST['region'] : '';
        $image = isset($_POST['image']) ? $_POST['image'] : '';
        $date = date("Y-m-d H:i:s");
        $description = isset($_POST['description']) ? $_POST['description'] : '';

        $sql = "INSERT into house (`image`, `title`, `date`, rental_period_id, land_area, number_of_floors, number_of_rooms, price, state_id, region_id, `description`) 
                values ('$image', '$title', '$date', '$rental_period', '$land_area', '$number_of_floors', '$number_of_rooms', '$price', '$state', '$region', '$description')";
        if ($conn->query($sql) === TRUE) {
            echo '<p class="text-success">Добавлена новая запись!</p>';
            header("Location: index.php");
        } else {
            echo '<p class="text-danger">Попробуйте снова! Укажите правильные данные.</p>';
        }
    }
    ?>

    <form action="new.php" method="post">
<table>
  <tr>
    <th colspan="2">Добавить объявление</th>
  </tr>
  <tr>
    <td>Название</td>
    <td><input type="text" required name="title" id="title" placeholder="title" value="<?= isset($_GET['title']) && $_GET['title'] != '' ? $_GET['title'] : '' ?>"/></td>
  </tr>
  <tr>
    <td>Количество этажей</td>
    <td><input required type="number" min="0" step="1" name="number_of_floors" value="<?= isset($_GET['number_of_floors']) && $_GET['number_of_floors'] != '' ? $_GET['number_of_floors'] : '' ?>"/></td>
  </tr>
  <tr>
    <td>Количество комнат</td>
    <td><input required type="number" min="0" step="1" name="number_of_rooms" value="<?= isset($_GET['number_of_rooms']) && $_GET['number_of_rooms'] != '' ? $_GET['number_of_rooms'] : '' ?>"/></td>
  </tr>
  <tr>
    <td>Площадь земельного участка</td>
    <td><input required type="text" name="land_area" value="<?= isset($_GET['land_area']) && $_GET['land_area'] != '' ? $_GET['land_area'] : '' ?>" placeholder="land area"/></td>
  </tr>
  <tr>
    <td>Цена</td>
    <td><input required type="number" min="0.00" max="10000.00" step="0.01" name="price" value="<?= isset($_GET['price']) && $_GET['price'] != '' ? $_GET['price'] : '' ?>"/></td>
  </tr>
  <tr>
    <td>Состояние</td>
    <td><?php getAllStates(); ?> 
    </td>
  </tr>
  <tr>
    <td>Период аренды</td>
    <td><?php getAllRental_Period() ?>
    </td>
  </tr>
  <tr>
    <td>Регион</td>
    <td>
    <?php getAllRegions()?>
    </td>
  </tr>
  <tr>
    <td>Ссылка на картинку</td>
    <td><input required type="text" name="image" placeholder="http://imageurl.com" value="<?= isset($_GET['image']) && $_GET['image'] != '' ? $_GET['image'] : '' ?>"/></td>
  </tr>
  <tr>
    <td><label for="description">Описание</label></td>
    <td><textarea required id="description" name="description" style="width:100%;" value="<?= isset($_GET['description']) && $_GET['description'] != '' ? $_GET['description'] : '' ?>"></textarea></td>
  </tr>
  <tr>
    <td colspan="2"> <button type="submit" name="submit" style="width:100%;">Добавить</button></td>
  </tr>
</table> 
</form>

<?php 
function getAllRegions() {
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "myDB";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 
$sql = "select id, region_name from region";
$result = $conn->query($sql);

?><select name="region" style="width:100%;">
<?php

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {?>
<option value="<?php echo $row["id"]; ?>"><?php echo $row["region_name"]; ?></option><?php
  }?>
</select><?php
} 
   $conn->close();
}
?>

<?php 
function getAllStates() {
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "myDB";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 
$sql = "select id, state_name from state";
$result = $conn->query($sql);

?><select name="state" style="width:100%;">
<?php

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {?>
<option value="<?php echo $row["id"]; ?>"><?php echo $row["state_name"]; ?></option><?php
  }?>
</select><?php
} 
   $conn->close();
}
?>


<?php 
function getAllRental_Period() {
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "myDB";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 
$sql = "select id, name from rental_period";
$result = $conn->query($sql);

?><select name="rental_period" style="width:100%;">
<?php

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {?>
<option value="<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></option><?php
  }?>
</select><?php
} 
   $conn->close();
}
?>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $('.toast').toast('show');
    </script>
    <?php $conn->close(); ?>
</body>
</html>
