<?php
require_once("./connection.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM property_offer WHERE letting_agency_id = $id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1' width=500 height=300>";
        echo "<tr><th>ID</th><th>Offer Type</th><th>Address</th><th>Room Count</th><th>Price</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row["id"]."</td>";
            echo "<td>".$row["offer_type"]."</td>";
            echo "<td>".$row["address"]."</td>";
            echo "<td>".$row["room_count"]."</td>";
            echo "<td>".$row["price"]."</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Немає оферів";
    }
} else {
    echo "Немає вибраної компанії.";
}

$conn->close();
?>