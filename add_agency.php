<?php
require_once("./connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];

    $sql = "INSERT INTO letting_agency (name, address, phone_number, email) VALUES ('$name', '$address', '$phone_number', '$email')";    
    
    if ($conn->query($sql) === TRUE) {
        echo "Нова агенція успішно додана!";
    } else {
        echo "Помилка: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Додати нову агенцію</title>
</head>
<body>
    <h2>Додати нову агенцію</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="name">Назва компанії:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="address">Адреса:</label><br>
        <input type="text" id="address" name="address" required><br><br>

        <label for="phone_number">Номер телефону:</label><br>
        <input type="text" id="phone_number" name="phone_number"><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br><br>

        <input type="submit" value="Додати">
    </form>
    <br>
    <a href="http://localhost/view_companies.php">Повернутися назад</a>
</body>
</html>
