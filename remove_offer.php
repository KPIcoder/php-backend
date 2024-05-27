<?php
require_once("./connection.php");

if (isset($_GET['id']) && isset($_GET['agency_id'])) {
    $offer_id = $_GET['id'];
    $agency_id = $_GET['agency_id'];

    $sql = "DELETE FROM property_offer WHERE id = $offer_id";

    if ($conn->query($sql) === TRUE) {
        echo "Оголошення успішно видалене!";
    } else {
        echo "Помилка при видаленні оголошення: " . $conn->error;
    }

    $conn->close();

    // Redirect back to the view_offers page
    header("Location: view_offers.php?id=$agency_id");
    exit;
} else {
    echo "Неправильний запит.";
}
?>
