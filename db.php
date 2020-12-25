<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "myDB";

$conn = new mysqli($servername,$username,  $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function get_price($id) {
    global $conn;
    $sql = "SELECT * FROM house WHERE id = $id";
    $result = $conn->query($sql);
    if ($result != null) {
        $house = $result->fetch_assoc();
        return $house['price'] != null ? $house['price'] : 'неизвестно';
    }
    return 'неизвестно';
}

function get_sql_code($q) {
    $sql = "";
    if ($q == null) {
        $sql = "SELECT * FROM house LIMIT 24";
    } else {
        $sql = "SELECT * FROM house WHERE id = $q";
    }
    return $sql;
}
?>
