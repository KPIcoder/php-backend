<?php
require_once("./connection.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sort = isset($_GET['sort']) ? $_GET['sort'] : '';

    switch ($sort) {
        case 'alphabet':
            $order_by = "ORDER BY address ASC";
            break;
        case 'price':
            $order_by = "ORDER BY price ASC";
            break;
        default:
            $order_by = "";
    }

    $sql = "SELECT * FROM property_offer WHERE letting_agency_id = $id $order_by";
    $result = $conn->query($sql);

    echo "<form method='get' action=''>";
    echo "<input type='hidden' name='id' value='$id'>";
    echo "<button type='submit' name='sort' value='alphabet'>Sort by Alphabet</button>";
    echo "<button type='submit' name='sort' value='price'>Sort by Price</button>";
    echo "</form><br>";

    if ($result->num_rows > 0) {
        echo "<table border='1' width='500' height='300'>";
        echo "<tr><th>ID</th><th>Offer Type</th><th>Address</th><th>Room Count</th><th>Price</th><th>Edit</th><th>Remove</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row["id"]."</td>";
            echo "<td>".$row["offer_type"]."</td>";
            echo "<td>".$row["address"]."</td>";
            echo "<td>".$row["room_count"]."</td>";
            echo "<td>".$row["price"]."</td>";
            echo "<td><a href='edit_offer.php?id=".$row["id"]."'>Edit</a></td>";
            echo "<td><a href='remove_offer.php?id=".$row["id"]."&agency_id=$id' onclick='return confirm(\"Are you sure you want to delete this offer?\")'>Remove</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Немає оголошень";
    }

    echo "<br><a href='add_offer.php?id=$id'>Додати нове оголошення</a><br>";
    echo "<br><a href='view_companies.php'>Повернутись назад до списку агенцій</a>";
} else {
    echo "Немає вибраної агенції.";
}

$conn->close();
?>
