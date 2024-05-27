<?php
require_once("./connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $offer_id = $_POST['offer_id'];
    $offer_type = $_POST['offer_type'];
    $address = $_POST['address'];
    $room_count = $_POST['room_count'];
    $price = $_POST['price'];
    $letting_agency_id = $_POST['letting_agency_id'];

    $sql = "UPDATE property_offer SET offer_type='$offer_type', address='$address', room_count=$room_count, price=$price WHERE id=$offer_id";

    if ($conn->query($sql) === TRUE) {
        echo "Оголошення успішно оновлене!";
    } else {
        echo "Помилка: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

    // Redirect back to the view_offers page
    header("Location: view_offers.php?id=$letting_agency_id");
    exit;
} else if (isset($_GET['id'])) {
    $offer_id = $_GET['id'];

    $sql = "SELECT * FROM property_offer WHERE id = $offer_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $offer_type = $row['offer_type'];
        $address = $row['address'];
        $room_count = $row['room_count'];
        $price = $row['price'];
        $letting_agency_id = $row['letting_agency_id'];
    } else {
        echo "Оголошення не знайдено.";
        exit;
    }
} else {
    echo "Неправильний запит.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редагувати оголошення</title>
</head>
<body>
    <h2>Редагувати оголошення</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="hidden" name="offer_id" value="<?php echo $offer_id; ?>">
        <input type="hidden" name="letting_agency_id" value="<?php echo $letting_agency_id; ?>">

        <label for="offer_type">Тип оголошення:</label><br>
        <input type="text" id="offer_type" name="offer_type" value="<?php echo $offer_type; ?>" required><br><br>

        <label for="address">Адреса:</label><br>
        <input type="text" id="address" name="address" value="<?php echo $address; ?>" required><br><br>

        <label for="room_count">Кількість кімнат:</label><br>
        <input type="number" id="room_count" name="room_count" value="<?php echo $room_count; ?>" required><br><br>

        <label for="price">Ціна:</label><br>
        <input type="number" id="price" name="price" value="<?php echo $price; ?>" required><br><br>

        <input type="submit" value="Оновити">
    </form>
    <br>
    <a href="http://localhost/lettings/view_offers.php?id=<?php echo $letting_agency_id; ?>">Повернутися назад</a>
</body>
</html>
