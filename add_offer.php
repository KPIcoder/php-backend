<?php
require_once("./connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $offer_type = $_POST['offer_type'];
    $address = $_POST['address'];
    $room_count = $_POST['room_count'];
    $price = $_POST['price'];
    $letting_agency_id = $_POST['letting_agency_id'];
    $posted_at = date('Y-m-d H:i:s'); 

    $sql = "INSERT INTO property_offer (offer_type, address, room_count, price, posted_at, letting_agency_id) VALUES ('$offer_type', '$address', $room_count, $price, '$posted_at', $letting_agency_id)";

    if ($conn->query($sql) === TRUE) {
        echo "Нове оголошення успішно додане!";
    } else {
        echo "Помилка: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else if (isset($_GET['id'])) {
    $letting_agency_id = $_GET['id'];
} else {
    echo "Немає вибраної агенції.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Додати нове оголошення</title>
</head>
<body>
    <h2>Додати нове оголошення</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="hidden" name="letting_agency_id" value="<?php echo $letting_agency_id; ?>">

        <label for="offer_type">Тип оголошення:</label><br>
        <input type="text" id="offer_type" name="offer_type" required><br><br>

        <label for="address">Адреса:</label><br>
        <input type="text" id="address" name="address" required><br><br>

        <label for="room_count">Кількість кімнат:</label><br>
        <input type="number" id="room_count" name="room_count" required><br><br>

        <label for="price">Ціна:</label><br>
        <input type="number" id="price" name="price" required><br><br>

        <input type="submit" value="Додати">
    </form>
    <br>
    <a href="http://localhost/lettings/view_offers.php?id=<?php echo $letting_agency_id; ?>">Повернутися назад</a>
</body>
</html>
